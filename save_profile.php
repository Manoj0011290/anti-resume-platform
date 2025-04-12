<?php
session_start();
error_reporting(E_ALL); // Enable error reporting for debugging
ini_set('display_errors', 1);

// --- Database Connection (Ensure this matches your setup) ---
$db = mysqli_connect('localhost', 'root', '', 'job_resume');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// --- Function to sanitize input data (same as in server.php) ---
function sanitize($data) {
    global $db;
    return mysqli_real_escape_string($db, trim($data));
}

// --- Check if the user is logged in as a candidate ---
if (!isset($_SESSION['username']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'candidate') {
    $_SESSION['message'] = "You must be logged in as a candidate to update your profile.";
    $_SESSION['message_type'] = "error";
    header('Location: c_login.php'); // Redirect to candidate login
    exit();
}

// --- Get the logged-in candidate's user ID ---
$username = $_SESSION['username'];
$user_id = null;

$user_query = "SELECT id FROM users WHERE username = ? AND user_type = 'candidate'";
$stmt_user = $db->prepare($user_query);
if ($stmt_user) {
    $stmt_user->bind_param("s", $username);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    if ($result_user->num_rows === 1) {
        $user_data = $result_user->fetch_assoc();
        $user_id = $user_data['id'];
    }
    $stmt_user->close();
}

if ($user_id === null) {
    // This should ideally not happen if the session is valid
    $_SESSION['message'] = "Error retrieving user information.";
    $_SESSION['message_type'] = "error";
    header('Location: ile_can.html'); // Redirect back to profile page
    exit();
}


// --- Process Form Submission ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Determine if it's an add or update action
    $is_update = isset($_POST['update_profile']);
    $is_add = isset($_POST['add_profile']);

    if ($is_update || $is_add) {

        // --- Get and sanitize text data ---
        $name = sanitize($_POST['name'] ?? '');
        $email = sanitize($_POST['email'] ?? ''); // Consider adding email validation FILTER_VALIDATE_EMAIL
        $phone = sanitize($_POST['phone'] ?? '');
        $state = sanitize($_POST['state'] ?? '');

        // --- Basic Validation ---
        $errors = [];
        if (empty($name)) $errors[] = "Name is required.";
        if (empty($email)) $errors[] = "Email is required.";
        // Add more validation as needed (e.g., phone format, email format)

        // --- Handle Image Upload (MEDIUMBLOB) ---
        $image_data = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_size = $_FILES['image']['size'];

            // Optional: Add size and type checks
            $max_size = 5 * 1024 * 1024; // 5MB limit
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $image_type = mime_content_type($image_tmp_name);

            if ($image_size > $max_size) {
                $errors[] = "Image file is too large (Max 5MB).";
            } elseif (!in_array($image_type, $allowed_types)) {
                 $errors[] = "Invalid image file type (Allowed: JPG, PNG, GIF).";
            } else {
                // Read image content for blob storage
                $image_data = file_get_contents($image_tmp_name);
                if ($image_data === false) {
                    $errors[] = "Failed to read image file.";
                    $image_data = null; // Reset on failure
                }
            }
        } elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Handle other upload errors
            $errors[] = "Error uploading image (Error code: " . $_FILES['image']['error'] . ")";
        }

        // --- Proceed only if no validation errors ---
        if (empty($errors)) {
            // --- Check if profile already exists for this user_id ---
            $check_query = "SELECT user_id FROM candidate_details WHERE user_id = ?";
            $stmt_check = $db->prepare($check_query);
            $stmt_check->bind_param("i", $user_id);
            $stmt_check->execute();
            $check_result = $stmt_check->get_result();
            $exists = $check_result->num_rows > 0;
            $stmt_check->close();

            // --- Prepare SQL for INSERT or UPDATE ---
            if ($exists && $is_update) {
                // UPDATE existing record
                $sql = "UPDATE candidate_details SET name = ?, email = ?, phone_no = ?, state = ?";
                $types = "ssss";
                $params = [$name, $email, $phone, $state];

                if ($image_data !== null) {
                    $sql .= ", image = ?";
                    $types .= "b";
                    $params[] = $image_data;
                }

                $sql .= " WHERE user_id = ?";
                $types .= "i";
                $params[] = $user_id;

                $stmt = $db->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param($types, ...$params);
                } else {
                    $errors[] = "Error preparing update statement: " . $db->error;
                }

            } elseif (!$exists && $is_add) {
                // INSERT new record
                $sql = "INSERT INTO candidate_details (user_id, name, email, phone_no, state, image) VALUES (?, ?, ?, ?, ?, ?)";
                $types = "issssb";
                $params = [$user_id, $name, $email, $phone, $state, $image_data];

                $stmt = $db->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param($types, ...$params);
                } else {
                    $errors[] = "Error preparing insert statement: " . $db->error;
                }
            } else {
                // Handle cases where the button doesn't match the existence of the profile
                if ($is_update && !$exists) {
                    $errors[] = "No profile found to update.";
                } elseif ($is_add && $exists) {
                    $errors[] = "Profile already exists. Use the update option.";
                }
            }

            // --- Execute the statement ---
            if (empty($errors) && isset($stmt) && $stmt->execute()) {
                $_SESSION['message'] = "Profile " . ($exists ? "updated" : "saved") . " successfully!";
                $_SESSION['message_type'] = "success";
            } elseif (empty($errors) && isset($stmt)) {
                // Execution failed
                $errors[] = "Database error: " . $stmt->error;
            }

            if (isset($stmt)) {
                $stmt->close();
            }

        }

        // --- Store errors in session if any occurred ---
        if (!empty($errors)) {
            $_SESSION['message'] = implode("<br>", $errors); // Combine errors
            $_SESSION['message_type'] = "error";
        }

        $db->close();
        header('Location: profile_successful.php'); // Redirect back to the profile page
        exit();

    } else {
        // If neither add nor update button was pressed
        header('Location: profile_successful.php');
        exit();
    }

} else {
    // If accessed directly without POST
    header('Location: ile_can.html');
    exit();
}
?>