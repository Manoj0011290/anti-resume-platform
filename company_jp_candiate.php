<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS Variables for theming and consistency */
        :root {
            --primary-color: #4e6bff;
            --secondary-color: #6c7ae0;
            --accent-color: #ff6b6b;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --info-color: #3498db;
            --danger-color: #e74c3c;
            --gray-color: #6c757d;
            --border-radius: 10px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        /* Layout */
        .container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Back Button */
        .back-button {
            background: none;
            border: none;
            color: var(--info-color);
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .back-button:hover {
            color: var(--primary-color);
            transform: translateX(-3px);
        }

        /* Search and Filters Section */
        .search-filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(78, 107, 255, 0.2);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            background-color: var(--primary-color);
            color: white;
        }

        .btn:hover {
            background-color: #3a57e5;
            transform: translateY(-2px);
        }

        /* Results Section */
        .results-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
        }

        .candidate-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .candidate-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .candidate-info {
            margin-bottom: 0.75rem;
        }

        .candidate-info strong {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--secondary-color);
        }

        .candidate-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background-color: #e9ecef;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .search-filters {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group {
                min-width: auto;
            }

            .results-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="company_job_position.php" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
            <h1>Candidate Information</h1>
        </header>

        <!-- Search and Filters Section -->
        <section class="search-filters">
            <div class="form-group">
                <label class="form-label" for="job-title">Job Title</label>
                <input type="text" class="form-control" id="job-title" placeholder="e.g., Software Engineer">
            </div>
            <div class="form-group">
                <label class="form-label" for="year">Year</label>
                <select class="form-control" id="year">
                    <option value="">Any Year</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                </select>
            </div>
            <button class="btn">Search</button>
        </section>

        <!-- Results Section -->
        <section class="results-container">
            <div class="candidate-card">
                <h2 class="candidate-name">John Doe</h2>
                <div class="candidate-info">
                    <strong>Email:</strong> john.doe@example.com
                    <strong>Phone:</strong> (123) 456-7890
                    <strong>Experience:</strong> 5 years
                </div>
                <div class="candidate-skills">
                    <span class="skill-tag">Java</span>
                    <span class="skill-tag">Python</span>
                    <span class="skill-tag">SQL</span>
                </div>
            </div>

            <div class="candidate-card">
                <h2 class="candidate-name">Jane Smith</h2>
                <div class="candidate-info">
                    <strong>Email:</strong> jane.smith@example.com
                    <strong>Phone:</strong> (987) 654-3210
                    <strong>Experience:</strong> 3 years
                </div>
                <div class="candidate-skills">
                    <span class="skill-tag">JavaScript</span>
                    <span class="skill-tag">React</span>
                    <span class="skill-tag">Node.js</span>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
