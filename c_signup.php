<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .signup-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 600px;
            padding: 2rem;
            text-align: center;
        }

        /* Form Styles */
        .signup-form {
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

        /* Toggle Switch Styles */
        .toggle-switch {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        .toggle-switch input[type="radio"] {
            display: none;
        }

        .toggle-label {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
            color: #718096;
        }

        .toggle-switch input[type="radio"]:checked + .toggle-label {
            background-color: #4299e1;
            color: white;
            border-color: #4299e1;
        }

        /* Company Code Input Style */
        #company-code-input {
            display: none; /* Hidden by default */
        }

        #company-code-input.active {
            display: block; /* Displayed when company signup is selected */
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

        /* Validation Message Style */
        .validation-message {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 600px) {
            .signup-container {
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

            .toggle-label {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2 class="form-title">Create Your Account</h2>

        <div class="toggle-switch">
            <input type="radio" id="candidate-signup" name="signup-type" value="candidate" checked>
            <label for="candidate-signup" class="toggle-label">Candidate</label>

            <input type="radio" id="company-signup" name="signup-type" value="company">
            <label for="company-signup" class="toggle-label">Company</label>
        </div>

        <form class="signup-form" id="signup-form" action="server.php" method="post">
            <input type="hidden" name="signup" value="1"> <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-input" placeholder="Username" name="username" required>
                <?php if (isset($errors['username'])): ?>
                    <p class="validation-message"><?php echo $errors['username']; ?></p>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-input" placeholder="Email" name="email" required>
                <?php if (isset($errors['email'])): ?>
                    <p class="validation-message"><?php echo $errors['email']; ?></p>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-input" placeholder="Password" name="password" required>
                <?php if (isset($errors['password'])): ?>
                    <p class="validation-message"><?php echo $errors['password']; ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group" id="company-code-input">
                <i class="fas fa-building"></i>
                <input type="text" class="form-input" placeholder="Company Code" name="company_code">
                <?php if (isset($errors['company_code'])): ?>
                    <p class="validation-message"><?php echo $errors['company_code']; ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="submit-button">Sign Up</button>
        </form>

        <div class="additional-options">
            Already have an account? <a href="c_login.php">Log In</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const candidateRadio = document.getElementById('candidate-signup');
            const companyRadio = document.getElementById('company-signup');
            const companyCodeInput = document.getElementById('company-code-input');
            const signupForm = document.getElementById('signup-form');
            const companyCodeMessage = document.getElementById('company-code-message');

            // Toggle Company Code Input Visibility (remains the same)
            candidateRadio.addEventListener('change', function() {
                companyCodeInput.classList.remove('active');
                companyCodeInput.querySelector('input').required = false;
                companyCodeMessage.style.display = 'none';
            });

            companyRadio.addEventListener('change', function() {
                companyCodeInput.classList.add('active');
                companyCodeInput.querySelector('input').required = true;
            });

            // Form Submission Handling
            signupForm.addEventListener('submit', function(e) {
                let isValid = true;
                companyCodeMessage.style.display = 'none'; // Hide message on each submit attempt

                // Only validate company code if the company radio button is checked
                if (companyRadio.checked) {
                    const companyCode = companyCodeInput.querySelector('input').value;
                    // Replace "VALID_COMPANY_CODE" with the actual code you want to validate
                    if (companyCode !== "VALID_COMPANY_CODE") {
                        companyCodeMessage.style.display = 'block';
                        isValid = false;
                    }
                }

                if (!isValid) {
                    e.preventDefault(); // Prevent form submission if validation fails
                } else {
                    // **IMPORTANT:** Now, instead of just an alert, submit the form
                    // The form's action attribute is already set to "server.php"
                    // The browser will handle the submission.
                    // alert('Form submitted successfully!'); // Remove this line
                }
            });
        });
    </script>
</body>
</html>
