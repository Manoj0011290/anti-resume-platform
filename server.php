<?php
session_start();

// Initialize an array to store errors
$errors = array();
$field_errors = array(); // For specific field errors

// Database connection (replace with your actual credentials)
$db = mysqli_connect('localhost', 'root', '', 'job_resume');

// Function to sanitize input data
function sanitize($data) {
    global $db;
    return mysqli_real_escape_string($db, trim($data));
}

// --- Login Form Handling (remains mostly the same) ---
if (isset($_POST['login_candidate'])) {
    $username = sanitize($_POST['candidate_username']);
    $password = $_POST['candidate_password']; // DO NOT SANITIZE password here before hashing

    if (empty($username)) {
        $field_errors['candidate_username'] = "Username is required";
    }
    if (empty($password)) {
        $field_errors['candidate_password'] = "Password is required";
    }

    if (empty($field_errors)) {
        $query = "SELECT * FROM users WHERE username='$username' AND user_type='candidate'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $user = mysqli_fetch_assoc($results);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = 'candidate';
                header('location: candidate_dashboard.php');
                exit(); // Ensure script stops here
            } else {
                $errors[] = "Incorrect username or password for candidate";
                $_SESSION['errors'] = $errors; // Store errors
                $_SESSION['field_errors'] = $field_errors;
                header("Location: c_login.php"); // Redirect back to login
                exit();
            }
        } else {
            $errors[] = "Incorrect username or password for candidate";
             $_SESSION['errors'] = $errors; // Store errors
             $_SESSION['field_errors'] = $field_errors;
            header("Location: c_login.php"); // Redirect back to login
            exit();
        }
    } else {
          $_SESSION['errors'] = $errors; // Store errors
          $_SESSION['field_errors'] = $field_errors;
        header("Location: c_login.php"); // Redirect back to login with errors
        exit();
    }
}

if (isset($_POST['login_company'])) {
    $username = sanitize($_POST['company_username']);
    $password =  $_POST['company_password']; // DO NOT SANITIZE password here before hashing

    if (empty($username)) {
        $field_errors['company_username'] = "Username is required";
    }
    if (empty($password)) {
        $field_errors['company_password'] = "Password is required";
    }

    if (empty($field_errors)) {
        $query = "SELECT * FROM users WHERE username='$username' AND user_type='company'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $user = mysqli_fetch_assoc($results);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = 'company';
                header('location: company_dashboard.php');
                exit(); // Ensure script stops here
            } else {
                 $errors[] = "Incorrect username or password for company";
                  $_SESSION['errors'] = $errors; // Store errors
                   $_SESSION['field_errors'] = $field_errors;
                   header("Location: c_login.php"); // Redirect back to login
                   exit();
            }
        } else {
            $errors[] = "Incorrect username or password for company";
             $_SESSION['errors'] = $errors; // Store errors
             $_SESSION['field_errors'] = $field_errors;
             header("Location: c_login.php"); // Redirect back to login
             exit();
        }
    }  else {
        $_SESSION['errors'] = $errors; // Store errors
        $_SESSION['field_errors'] = $field_errors;
        header("Location: c_login.php"); // Redirect back to login with errors
        exit();
    }
}

// --- Signup Form Handling ---
if (isset($_POST['signup'])) {
    $signup_type = isset($_POST['signup-type']) ? sanitize($_POST['signup-type']) : 'candidate';
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password']; // Don't sanitize yet for length check
    $company_code = ($signup_type === 'company' && isset($_POST['company_code'])) ? sanitize($_POST['company_code']) : '';

    // --- Input Validation ---
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    }

    if ($signup_type === 'company') {
        if (empty($company_code)) {
            $errors['company_code'] = "Company code is required";
        } else {
            $check_code_query = "SELECT id FROM companies WHERE company_code = '$company_code'";
            $code_result = mysqli_query($db, $check_code_query);
            if (mysqli_num_rows($code_result) == 0) {
                $errors['company_code'] = "Incorrect company code";
            } else {
                $company_data = mysqli_fetch_assoc($code_result);
                $company_id = $company_data['id'];
            }
        }
    }

    // --- Check if username or email already exists ---
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            $errors['username'] = "Username already exists";
        }
        if ($user['email'] === $email) {
            $errors['email'] = "Email already exists";
        }
    }

    // --- If no errors, register the user ---
    if (empty($errors)) {
        // Hash the password for security
        $hashed_password = password_hash(sanitize($password), PASSWORD_DEFAULT); // Sanitize before hashing

        if ($signup_type === 'candidate') {
            $query = "INSERT INTO users (username, email, password, user_type) VALUES('$username', '$email', '$hashed_password', 'candidate')";
        } else {
            $get_company_id_query = "SELECT id FROM companies WHERE company_code = '$company_code' LIMIT 1";
            $company_id_result = mysqli_query($db, $get_company_id_query);
            $company_data = mysqli_fetch_assoc($company_id_result);
            $company_id = $company_data['id'] ?? null;

            if ($company_id) {
                $query = "INSERT INTO users (username, email, password, user_type, company_id) VALUES('$username', '$email', '$hashed_password', 'company', '$company_id')";
            } else {
                // This should ideally not happen if the company code validation passed
                $errors['registration'] = "Error linking to company.";
            }
        }

        if (empty($errors) && mysqli_query($db, $query)) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now registered!";
            header('location: c_login.php'); // Redirect to homepage or dashboard
            exit(); // Ensure script stops here
        } else {
            $errors['registration'] = "Registration failed. Please try again.";
        }
    }  else {
        $_SESSION['errors'] = $errors; // Store errors
        header("Location: c_signup.php"); // Redirect back to signup with errors
        exit();
    }
}
?>
