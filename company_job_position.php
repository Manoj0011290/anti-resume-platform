<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
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
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            background-color: var(--dark-color);
            color: white;
            padding: 1.5rem;
            transition: var(--transition);
            position: fixed;
            height: 100%;
            width: 250px;
            overflow-y: auto;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo img {
            width: 40px;
            margin-right: 1rem;
        }

        .sidebar-logo h2 {
            font-weight: 600;
            font-size: 1.2rem;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #e2e2e2;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .sidebar-menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar-menu a.active {
            background-color: var(--primary-color);
            color: white;
        }

        .sidebar-menu i {
            margin-right: 0.75rem;
        }

        /* Main Content */
        .main-content {
            grid-column: 2;
            padding: 2rem;
            transition: var(--transition);
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .notification-badge {
            position: relative;
        }

        .notification-badge::after {
            content: "";
            position: absolute;
            top: -5px;
            right: -5px;
            width: 10px;
            height: 10px;
            background-color: var(--accent-color);
            border-radius: 50%;
        }

        /* Cards */
        .card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Job Post Form */
        .form-group {
            margin-bottom: 1.25rem;
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

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
            padding-right: 2.5rem;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a57e5;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #e9ecef;
            color: var(--dark-color);
        }

        .btn-secondary:hover {
            background-color: #dee2e6;
            transform: translateY(-2px);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }

        /* File Upload */
        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 2rem;
            border: 2px dashed #e0e0e0;
            border-radius: var(--border-radius);
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .file-upload-label:hover {
            border-color: var(--primary-color);
            background-color: rgba(78, 107, 255, 0.05);
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload-text {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .file-upload-icon {
            font-size: 2rem;
            color: var(--gray-color);
            margin-bottom: 1rem;
        }

        /* Metrics Section */
        .metrics-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .metric-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border-left: 4px solid var(--primary-color);
        }

        .metric-card:hover {
            transform: translateY(-5px);
        }

        .metric-card.engagement {
            border-left-color: var(--info-color);
        }

        .metric-card.skill-match {
            border-left-color: var(--success-color);
        }

        .metric-card.feedback {
            border-left-color: var(--warning-color);
        }

        .metric-value {
            font-size: 2rem;
            font-weight: 700;
            margin: 1rem 0;
            color: var(--dark-color);
        }

        .metric-label {
            color: var(--gray-color);
            font-size: 0.9rem;
        }

        .progress-bar {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .progress-value {
            height: 100%;
            border-radius: 4px;
            background-color: var(--primary-color);
            width: 75%;
            transition: width 1s ease;
        }

        .engagement .progress-value {
            background-color: var(--info-color);
            width: 68%;
        }

        .skill-match .progress-value {
            background-color: var(--success-color);
            width: 92%;
        }

        .feedback .progress-value {
            background-color: var(--warning-color);
            width: 84%;
        }

        /* AI Suggestions */
        .suggestion-card {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .suggestion-card:hover {
            background-color: #e9ecef;
        }

        .suggestion-icon {
            font-size: 1.5rem;
            color: var(--info-color);
        }

        .suggestion-content {
            flex: 1;
        }

        .suggestion-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .suggestion-text {
            font-size: 0.9rem;
            color: var(--gray-color);
        }

        .suggestion-action {
            margin-left: auto;
        }

        /* Skill Tags */
        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .skill-tag {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background-color: #e9ecef;
            border-radius: 20px;
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .skill-tag:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Charts */
        .chart-container {
            position: relative;
            height: 200px;
            margin-top: 1rem;
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                position: fixed;
                left: -250px;
                z-index: 100;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .main-content {
                grid-column: 1;
                margin-left: 0;
            }
            
            .metrics-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .user-profile {
                width: 100%;
                justify-content: flex-end;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            animation: fadeIn 0.5s ease-out;
        }

        .metrics-container > div:nth-child(1) {
            animation-delay: 0.1s;
        }

        .metrics-container > div:nth-child(2) {
            animation-delay: 0.2s;
        }

        .metrics-container > div:nth-child(3) {
            animation-delay: 0.3s;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <img src="https://th.bing.com/th/id/OIP.QmdI0ha1pTW-AG3-spLTDQHaB6?rs=1&pid=ImgDetMain" alt="Logo">
                <h2>Anti-Resume</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="company_jp_candiate.php"><i class="fas fa-user-tie"></i> Candidates</a></li>
                <li><a href="#"><i class="fas fa-chart-bar"></i> Analytics</a></li>
                <li><a href="company_dashboard.php"><i class="fas fa-sign-out-alt"></i> Back</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h1>Company Dashboard</h1>
                <div class="user-profile">
                    <div class="notification-badge">
                        <i class="fas fa-bell"></i>
                    </div>
                    <img src="https://via.placeholder.com/40" alt="User profile">
                    <span>Tech Innovations Inc.</span>
                </div>
            </header>

             <!-- Create/Edit Job Post -->
            <section class="card">
                <div class="card-header">
                    <h2 class="card-title">Create/Edit Job Post</h2>
                </div>
                <form>
                    <div class="form-group">
                        <label class="form-label" for="job-title">Job Title</label>
                        <input type="text" class="form-control" id="job-title" placeholder="e.g., Senior Frontend Developer">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="job-description">Job Description</label>
                        <textarea class="form-control" id="job-description" placeholder="Describe the role and responsibilities..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upload Real Work Samples</label>
                        <div class="file-upload">
                            <label class="file-upload-label">
                                <div class="file-upload-text">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <span>Drag and drop files here, or click to browse</span>
                                    <small>Upload code samples, project briefs, or design assets</small>
                                </div>
                                <input type="file" multiple class="file-upload-input">
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Required Skills</label>
                        <div class="skill-tags">
                            <span class="skill-tag">JavaScript</span>
                            <span class="skill-tag">React</span>
                            <span class="skill-tag">Node.js</span>
                            <span class="skill-tag">REST API</span>
                            <span class="skill-tag">Git</span>
                            <span class="skill-tag">+ Add Skill</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="salary-range">Salary Range</label>
                        <select class="form-control form-select" id="salary-range">
                            <option>$50,000 - $70,000</option>
                            <option>$70,000 - $90,000</option>
                            <option>$90,000 - $110,000</option>
                            <option>$110,000 - $130,000</option>
                            <option>$130,000+</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="blind-matching" checked>
                            <label for="blind-matching">Enable blind initial matching to reduce bias</label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary"><i class="fas fa-save"></i> Save Draft</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Publish Job</button>
                    </div>
                </form>
            </section>

            <!-- Job Performance Metrics -->
            <section class="card">
                <div class="card-header">
                    <h2 class="card-title">Job Performance Metrics</h2>
                </div>
                <div class="metrics-container">
                    <div class="metric-card engagement">
                        <div class="metric-label">Candidate Engagement</div>
                        <div class="metric-value">68%</div>
                        <div class="progress-bar">
                            <div class="progress-value"></div>
                        </div>
                        <small>Percentage of candidates who completed all challenges</small>
                    </div>
                    <div class="metric-card skill-match">
                        <div class="metric-label">Skill-Match Percentage</div>
                        <div class="metric-value">92%</div>
                        <div class="progress-bar">
                            <div class="progress-value"></div>
                        </div>
                        <small>Average skill match of candidates to job requirements</small>
                    </div>
                    <div class="metric-card feedback">
                        <div class="metric-label">Feedback Score</div>
                        <div class="metric-value">84%</div>
                        <div class="progress-bar">
                            <div class="progress-value"></div>
                        </div>
                        <small>Average feedback score from completed challenges</small>
                    </div>
                </div>
                <div class="chart-container">
                    <!-- Mock chart representation -->
                    <div style="display: flex; align-items: flex-end; justify-content: space-around; height: 100%;">
                        <div style="background: var(--primary-color); width: 40px; height: 30%; border-radius: 5px 5px 0 0;"></div>
                        <div style="background: var(--primary-color); width: 40px; height: 50%; border-radius: 5px 5px 0 0;"></div>
                        <div style="background: var(--primary-color); width: 40px; height: 80%; border-radius: 5px 5px 0 0;"></div>
                        <div style="background: var(--primary-color); width: 40px; height: 65%; border-radius: 5px 5px 0 0;"></div>
                        <div style="background: var(--primary-color); width: 40px; height: 75%; border-radius: 5px 5px 0 0;"></div>
                        <div style="background: var(--primary-color); width: 40px; height: 90%; border-radius: 5px 5px 0 0;"></div>
                        <div style="background: var(--primary-color); width: 40px; height: 60%; border-radius: 5px 5px 0 0;"></div>
                    </div>
                </div>
            </section>

            <!-- AI-powered Suggestions -->
            <section class="card">
                <div class="card-header">
                    <h2 class="card-title">AI-powered Suggestions</h2>
                </div>
                <div class="suggestion-card">
                    <div class="suggestion-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="suggestion-content">
                        <h3 class="suggestion-title">Improve job description clarity</h3>
                        <p class="suggestion-text">Your job description uses technical jargon that may exclude qualified candidates. Consider simplifying terms like "microservices architecture" and "RESTful API implementation."</p>
                    </div>
                    <div class="suggestion-action">
                        <button class="btn btn-secondary">Apply</button>
                    </div>
                </div>
                <div class="suggestion-card">
                    <div class="suggestion-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="suggestion-content">
                        <h3 class="suggestion-title">Add "TypeScript" as a required skill</h3>
                        <p class="suggestion-text">Based on your work samples and challenge criteria, TypeScript appears to be an essential skill for this role. Adding it could improve match quality by 15%.</p>
                    </div>
                    <div class="suggestion-action">
                        <button class="btn btn-secondary">Apply</button>
                    </div>
                </div>
                <div class="suggestion-card">
                    <div class="suggestion-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="suggestion-content">
                        <h3 class="suggestion-title">Simplify the coding challenge</h3>
                        <p class="suggestion-text">Your current challenge has a 35% abandonment rate. Reducing complexity while maintaining assessment quality could improve completion rates.</p>
                    </div>
                    <div class="suggestion-action">
                        <button class="btn btn-secondary">Apply</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
