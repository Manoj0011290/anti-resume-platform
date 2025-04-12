<?php
session_start();

$current_page = 'c_login.php'; // Define the current page

$errors = $_SESSION['errors'] ?? [];
$field_errors = $_SESSION['field_errors'] ?? [];

// Clear errors to avoid displaying them on subsequent visits
unset($_SESSION['errors']);
unset($_SESSION['field_errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anti-Resume Job Platform | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Resetted and Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f8;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Container Styles */
        .login-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            text-align: center;
        }

        /* Form Styles */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #2d3748;
        }

        .input-group {
            position: relative;
            width: 100%;
        }

        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
        }

        .form-input {
            padding: 1rem 1rem 1rem 3rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            width: 100%;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.2);
        }

        /* Error Styles */
        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .form-input.error {
            border-color: #dc2626;
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.2);
        }

        .form-input.error:focus {
            border-color: #dc2626;
        }


        /* Button Styles */
        .submit-button {
            background-color: #4299e1;
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .submit-button:hover {
            background-color: #2b6cb0;
        }

        /* Switch between candidate and company login */
        .login-switch {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1.5rem;
        }

        .login-switch button {
            background: none;
            border: none;
            color: #718096;
            cursor: pointer;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            transition: color 0.2s;
        }

        .login-switch button:hover {
            color: #4299e1;
        }

        .login-switch button.active {
            color: #4299e1;
            font-weight: 500;
        }

        .additional-options {
            margin-top: 1.5rem;
            color: #718096;
            font-size: 0.9rem;
        }

        .additional-options a {
            color: #4299e1;
            margin-left: 0.5rem;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 600px) {
            .login-container {
                padding: 1.5rem;
            }

            .form-title {
                font-size: 1.75rem;
            }

            .form-input {
                padding: 0.75rem 0.75rem 0.75rem 2.5rem;
                font-size: 0.9rem;
            }

            .submit-button {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
          <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <div class="login-switch">
            <button id="candidate-login-btn" class="active">Candidate Login</button>
            <button id="company-login-btn">Company Login</button>
        </div>

        <form id="candidate-login-form" class="login-form" method="POST" action="server.php">
            <h2 class="form-title">Candidate Login</h2>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-input  <?= isset($field_errors['candidate_username']) ? 'error' : '' ?>" name="candidate_username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-input  <?= isset($field_errors['candidate_password']) ? 'error' : '' ?>" name="candidate_password" placeholder="Password" required>
            </div>
            <button type="submit" name="login_candidate" class="submit-button">Login</button>
        </form>

        <form id="company-login-form" class="login-form" style="display: none;" method="POST" action="server.php">
            <h2 class="form-title">Company Login</h2>
            <div class="input-group">
                <i class="fas fa-building"></i>
                <input type="text" class="form-input <?= isset($field_errors['company_username']) ? 'error' : '' ?>" name="company_username" placeholder="Company Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-input <?= isset($field_errors['company_password']) ? 'error' : '' ?>" name="company_password" placeholder="Password" required>
            </div>
            <button type="submit" name="login_company" class="submit-button">Login</button>
        </form>

        <div class="additional-options">
            <a href="c_forgot.html">Forgot Password?</a>
            <span>  Don't have an account?</span>
            <a href="c_signup.php">  Sign Up</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const candidateLoginBtn = document.getElementById('candidate-login-btn');
            const companyLoginBtn = document.getElementById('company-login-btn');
            const candidateLoginForm = document.getElementById('candidate-login-form');
            const companyLoginForm = document.getElementById('company-login-form');

            candidateLoginBtn.addEventListener('click', function() {
                candidateLoginBtn.classList.add('active');
                companyLoginBtn.classList.remove('active');
                candidateLoginForm.style.display = 'flex';
                companyLoginForm.style.display = 'none';
            });

            companyLoginBtn.addEventListener('click', function() {
                companyLoginBtn.classList.add('active');
                candidateLoginBtn.classList.remove('active');
                companyLoginForm.style.display = 'flex';
                candidateLoginForm.style.display = 'none';
            });

             <?php if (isset($field_errors) && (isset($field_errors['candidate_username']) || isset($field_errors['candidate_password']) || isset($field_errors['company_username']) || isset($field_errors['company_password']))): ?>
                document.querySelector('.form-input.error')?.focus();
            <?php endif; ?>
        });
    </script>
</body>
</html>
