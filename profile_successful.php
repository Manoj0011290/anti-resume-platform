<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Updated</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .back-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: #fff;
            background-color: #4299e1;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .back-button:hover {
            background-color: #2b6cb0;
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }

            .back-button {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Profile Has Been Updated</h1>
        <p>Thank you for keeping your information up to date.</p>
        <a href="candidate_dashboard.php" class="back-button">Go Back</a>
    </div>
</body>
</html>
