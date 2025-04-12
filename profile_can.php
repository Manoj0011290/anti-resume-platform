<?php session_start();
// --- Database Connection (needed for pre-filling data) ---
// *Important*: Re-establish connection as it was closed in the previous logic block if run separately
$db = mysqli_connect('localhost', 'root', '', 'job_resume');
$profile_data = null; // Initialize
$profile_exists = false; // Flag to check if profile exists

// --- Check if user is logged in and fetch existing data ---
if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'candidate' && $db) {
    $username = $_SESSION['username'];
    $user_id = null;

    // Get user ID (same as before)
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

    // Fetch existing profile details if user_id found
    if ($user_id !== null) {
        // Select a column to check existence AND fetch data if it exists
        $profile_query = "SELECT name, email, phone_no, state FROM candidate_details WHERE user_id = ?";
        $stmt_profile = $db->prepare($profile_query);
        if ($stmt_profile) {
            $stmt_profile->bind_param("i", $user_id);
            $stmt_profile->execute();
            $result_profile = $stmt_profile->get_result();
            if ($result_profile->num_rows === 1) {
                $profile_data = $result_profile->fetch_assoc();
                $profile_exists = true; // Set flag to true if data is found
            }
            $stmt_profile->close();
        }
    }
    // Close DB connection - Important to close only once if needed elsewhere,
    // but here we close it after fetching data for this page load.
    if ($db) {
        mysqli_close($db);
    }
}

// --- Helper function to safely echo form values (same as before) ---
function echoValue($field) {
    global $profile_data;
    if (isset($profile_data) && isset($profile_data[$field])) {
        echo htmlspecialchars($profile_data[$field], ENT_QUOTES, 'UTF-8');
    } else {
        echo '';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
         :root {
            --primary-color: #5865F2; /* Blue */
            --secondary-color: #B9BBBE;
            --text-dark: #23272A;
            --text-light: #F8F8F8;
            --bg-light: #ECEFF1;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease-in-out;
            --primary-color-rgb: 88, 101, 242;
            --success-color: #2ecc71; /* Green */
            --success-color-rgb: 46, 204, 113;
            --grey-color: #7f8c8d; /* Grey */
            --grey-color-rgb: 127, 140, 141;
         }

        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-light); margin: 0; padding: 20px 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-y: auto; -webkit-overflow-scrolling: touch; }
        .container { background-color: var(--text-light); padding: 40px; border-radius: 16px; box-shadow: var(--box-shadow); width: 90%; max-width: 600px; text-align: center; position: relative; z-index: 2; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease-out forwards 0.3s, subtleMove 3s ease-in-out infinite alternate 1.1s; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
        h1 { color: var(--primary-color); margin-bottom: 30px; font-size: 2.5rem; letter-spacing: 1px; transform: scale(0.9); opacity: 0; animation: pulse 1.2s ease-in-out forwards 0.5s; }
        @keyframes pulse { to { transform: scale(1); opacity: 1; } }
        .form-group { margin-bottom: 25px; text-align: left; }
        .form-group label { display: block; margin-bottom: 10px; color: var(--text-dark); font-weight: 600; opacity: 0; transform: translateX(-20px); animation: slideInLeft 0.5s ease-out forwards 0.7s; }
        @keyframes slideInLeft { to { opacity: 1; transform: translateX(0); } }
        .form-group input[type="text"], .form-group input[type="email"] { width: calc(100% - 24px); padding: 14px; border: 1px solid var(--secondary-color); border-radius: 8px; font-size: 1rem; transition: var(--transition); opacity: 0; transform: scale(0.95); animation: zoomIn 0.6s ease-out forwards 0.9s; }
        @keyframes zoomIn { to { opacity: 1; transform: scale(1); } }
        .form-group input[type="text"]:focus, .form-group input[type="email"]:focus { border-color: var(--primary-color); outline: none; box-shadow: 0 5px 15px rgba(var(--primary-color-rgb), 0.2); }
        .form-group label[for="image"] { margin-top: 20px; }
        .file-upload-wrapper { position: relative; display: inline-flex; align-items: center; background-color: var(--bg-light); border: 2px dashed var(--primary-color); border-radius: 10px; padding: 12px 20px; text-align: center; cursor: pointer; transition: var(--transition); overflow: hidden; opacity: 0; transform: translateY(20px); animation: slideInUp 0.5s ease-out forwards 1.1s; }
        @keyframes slideInUp { to { opacity: 1; transform: translateY(0); } }
        .file-upload-wrapper:hover { background-color: #d4d8f7; border-color: #4351e0; }
        .file-upload-text { font-size: 1rem; color: var(--primary-color); margin-right: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px; display: inline-block; vertical-align: middle; }
        .file-upload-icon { font-size: 1.2rem; color: var(--primary-color); vertical-align: middle; }
        .form-group input[type="file"] { opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer; }
        .button-container { display: flex; justify-content: center; gap: 20px; margin-top: 40px; opacity: 0; transform: scale(0.9); animation: pulse 1.2s ease-in-out forwards 1.3s; }
        .btn { padding: 14px 30px; border: none; border-radius: 8px; font-size: 1.1rem; cursor: pointer; transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); font-weight: 600; }

        /* Specific Button Styles */
        .back-btn { /* Changed from save-btn */
            background-color: var(--grey-color);
            color: var(--text-light);
        }
        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(var(--grey-color-rgb), 0.4);
        }

        .add-btn {
            background-color: var(--success-color); /* Green */
            color: var(--text-light);
        }
         .add-btn:hover {
             transform: translateY(-3px);
             box-shadow: 0 7px 20px rgba(var(--success-color-rgb), 0.4);
         }

        .update-btn { /* Was submit-btn previously */
            background-color: var(--primary-color); /* Blue */
            color: var(--text-light);
        }
        .update-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(var(--primary-color-rgb), 0.4);
        }

        .message-container { margin-top: 30px; text-align: center; font-size: 1.1rem; font-weight: bold; padding: 10px; border-radius: 5px; display: none; }
        .message-container.show { display: block; opacity: 1; }
        .success-message { color: #1a6e3b; background-color: #d1f3e0; border: 1px solid #a3cfbb; }
        .error-message { color: #a94442; background-color: #f2dede; border: 1px solid #ebccd1; }
        .background-animation { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1; }
        .circle { position: absolute; border-radius: 50%; background: linear-gradient(45deg, rgba(106, 17, 203, 0.4), rgba(37, 117, 252, 0.4)); animation: moveCircles 25s linear infinite alternate; opacity: 0; will-change: transform, opacity; }
        .circle:nth-child(1) { width: 60px; height: 60px; top: 10%; left: 10%; animation-delay: 0s; animation-duration: 20s;}
        .circle:nth-child(2) { width: 80px; height: 80px; top: 30%; left: 80%; animation-delay: -5s; animation-duration: 30s;}
        .circle:nth-child(3) { width: 40px; height: 40px; top: 70%; left: 20%; animation-delay: -10s; animation-duration: 25s;}
        .circle:nth-child(4) { width: 100px; height: 100px; top: 80%; left: 60%; animation-delay: -15s; animation-duration: 35s;}
        .circle:nth-child(5) { width: 50px; height: 50px; top: 50%; left: 40%; animation-delay: -20s; animation-duration: 28s;}
        @keyframes moveCircles { 0% { transform: translate(0, 0) scale(0.5); opacity: 0; } 20% { opacity: 0.6; } 80% { opacity: 0.6; } 100% { transform: translate(calc(50vw - var(--width) * 2 * (0.5 - (rand() / getrandmax()))), calc(50vh - var(--height) * 2 * (0.5 - (rand() / getrandmax())) )) scale(1); opacity: 0; } }
        @keyframes subtleMove { 0% { transform: translateY(0); } 50% { transform: translateY(-5px); } 100% { transform: translateY(0); } }

    </style>
</head>
<body>
    <div class="background-animation">
        <div class="circle" style="--width: 60px; --height: 60px;"></div>
        <div class="circle" style="--width: 80px; --height: 80px;"></div>
        <div class="circle" style="--width: 40px; --height: 40px;"></div>
        <div class="circle" style="--width: 100px; --height: 100px;"></div>
        <div class="circle" style="--width: 50px; --height: 50px;"></div>
    </div>
    <div class="container">
        <h1>My Profile</h1>

        <?php
        if (isset($_SESSION['message'])) {
            $message_type_class = ($_SESSION['message_type'] ?? 'info') === 'success' ? 'success-message' : 'error-message';
            echo '<div class="message-container show ' . $message_type_class . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <form id="profileForm" action="save_profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name"><i class="fas fa-user"></i> Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" value="<?php echoValue('name'); ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echoValue('email'); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone"><i class="fas fa-phone"></i> Phone No:</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echoValue('phone_no'); ?>" required>
            </div>
            <div class="form-group">
                <label for="state"><i class="fas fa-map-marker-alt"></i> State:</label>
                <input type="text" id="state" name="state" placeholder="Enter your state" value="<?php echoValue('state'); ?>" required>
            </div>
            <div class="form-group">
                 <label for="image"><i class="fas fa-image"></i> Profile Image <?php echo $profile_exists ? '(Optional - Update)' : '(Optional - Add)'; ?>:</label>
                <div class="file-upload-wrapper">
                    <span class="file-upload-text">Choose File</span>
                    <span class="file-upload-icon"><i class="fas fa-upload"></i></span>
                    <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif">
                </div>
                 <small style="display: block; text-align: center; margin-top: 5px; color: #555;">
                     <?php echo $profile_exists ? 'Leave blank to keep current image.' : ''; ?> Max 5MB.
                 </small>
            </div>

            <div class="button-container">
                <a href="candidate_dashboard.php" class="btn back-btn"> <i class="fas fa-arrow-left"></i> Back
                </a>
                <?php if ($profile_exists): // If profile data was found, show Update button ?>
                    <button type="submit" class="btn update-btn" name="update_profile">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                <?php else: // Otherwise, show Add button ?>
                    <button type="submit" class="btn add-btn" name="add_profile">
                        <i class="fas fa-plus-circle"></i> Add Profile
                    </button>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <script>
        // Keep the script for updating the file input text (same as before)
        const fileInput = document.getElementById('image');
        const fileUploadTextSpan = document.querySelector('.file-upload-text');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileUploadTextSpan.textContent = this.files[0].name;
                } else {
                    fileUploadTextSpan.textContent = 'Choose File';
                }
            });
        }

        // Automatically hide session message (same as before)
        const messageContainer = document.querySelector('.message-container.show');
        if (messageContainer) {
            setTimeout(() => {
                messageContainer.style.opacity = '0';
                setTimeout(() => { messageContainer.style.display = 'none'; }, 500);
            }, 5000);
        }
    </script>
</body>
</html>