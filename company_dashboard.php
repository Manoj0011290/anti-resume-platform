<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --text-color: #333;
            --bg-color: #f4f6f8;
            --white: #fff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 0.5rem;
            --transition: all 0.3s ease-in-out;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .dashboard-container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .sidebar {
            width: 280px;
            background-color: var(--secondary-color);
            color: var(--white);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
            overflow-y: auto;
            height: 100vh;
            position: sticky;
            top: 0;
            left: 0;
            box-shadow: var(--shadow);
        }

        .sidebar h2 {
            margin-bottom: 2rem;
            font-weight: 700;
            font-size: 1.75rem;
            text-align: center;
            letter-spacing: 1px;
            color: var(--white);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin-bottom: 1.25rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: var(--transition);
            z-index: 0;
        }

        .sidebar-menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar-menu a:hover::before {
            left: 100%;
        }

        .sidebar-menu i {
            margin-right: 1rem;
            width: 24px;
            text-align: center;
            font-size: 1.2rem;
        }

        .main-content {
            flex: 1;
            padding: 3rem;
            overflow-y: auto;
            height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }

        .dashboard-title {
            font-size: 2.5rem;
            color: var(--text-color);
            font-weight: 700;
            letter-spacing: 1px;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-button {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-color);
            font-size: 1.1rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            background-color: var(--white);
            box-shadow: var(--shadow);
        }

        .profile-button:hover {
            background-color: #ecf0f1;
            transform: translateY(-3px);
        }

        .dropdown-content {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: var(--white);
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            min-width: 180px;
            padding: 0.75rem 0;
            display: none;
            z-index: 10;
        }

        .profile-dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            display: block;
            padding: 0.75rem 1.5rem;
            transition: var(--transition);
            color: var(--text-color);
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f7fafc;
        }

        .overview-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .overview-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            transition: var(--transition);
            border-left: 5px solid var(--primary-color);
        }

        .overview-card:hover {
            transform: translateY(-5px);
        }

        .overview-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .overview-card p {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
        }

        .section-title {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 2rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .notification-list {
            list-style: none;
            padding: 0;
        }

        .notification-list li {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: var(--transition);
            border-left: 3px solid var(--primary-color);
        }

        .notification-list li:hover {
            transform: translateY(-3px);
        }

        .notification-list li strong {
            font-weight: 600;
            color: var(--secondary-color);
            display: block;
            margin-bottom: 0.5rem;
        }

        .notification-list li p {
            color: var(--text-color);
            margin-top: 0.5rem;
        }

        /* Job Posts Management */
        .job-posts-management {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }

        .job-post-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            transition: var(--transition);
            border-left: 5px solid #2ecc71;
        }

        .job-post-card:hover {
            transform: translateY(-5px);
        }

        .job-post-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .job-post-card p {
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .job-post-card .actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .job-post-card .actions button {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .job-post-card .actions button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        /* Match Center */
        .match-center {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }

        .match-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            transition: var(--transition);
            border-left: 5px solid #f39c12;
        }

        .match-card:hover {
            transform: translateY(-5px);
        }

        .match-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .match-card p {
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .match-card .candidate-info {
            margin-bottom: 1rem;
        }

        .match-card .candidate-info strong {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--secondary-color);
        }

        .match-card .match-score {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Candidate Insights */
        .candidate-insights {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }

        .insight-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            transition: var(--transition);
            border-left: 5px solid #9b59b6;
        }

        .insight-card:hover {
            transform: translateY(-5px);
        }

        .insight-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .insight-card p {
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .insight-card .chart {
            /* Placeholder for chart */
            height: 200px;
            border: 1px solid #ddd;
            margin-top: 1rem;
            text-align: center;
            line-height: 200px;
            color: #777;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                overflow-y: visible;
                padding: 1rem;
            }

            .sidebar h2 {
                margin-bottom: 1rem;
                font-size: 1.5rem;
            }

            .sidebar-menu {
                display: flex;
                overflow-x: auto;
                padding-bottom: 1rem;
                margin-bottom: 2rem;
            }

            .sidebar-menu li {
                margin-right: 1rem;
                margin-bottom: 0;
            }

            .sidebar-menu a {
                padding: 0.6rem 0.8rem;
                white-space: nowrap;
                font-size: 0.9rem;
            }

            .main-content {
                padding: 2rem;
            }

            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .dashboard-title {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .job-posts-management,
            .match-center,
            .candidate-insights {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Anti-Resume Platform</h2>
            <ul class="sidebar-menu">
                <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard Overview</a></li>
                <li><a href="company_job_position.php"><i class="fas fa-briefcase"></i> Job Posts Management</a></li>
                <li><a href="#"><i class="fas fa-search"></i> Match Center</a></li>
                <li><a href="#"><i class="fas fa-user-friends"></i> Candidate Insights</a></li>
                <li><a href="#"><i class="fas fa-building"></i> Company Profile</a></li>
                <li><a href="#"><i class="fas fa-comments"></i> Post-Hire Feedback Loop</a></li>
                <li><a href="#"><i class="fas fa-bell"></i> Notifications & Reminders</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings & Permissions</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="dashboard-header">
                <h1 class="dashboard-title">Dashboard Overview</h1>
                <div class="profile-dropdown">
                    <button class="profile-button">
                        <i class="fas fa-user-circle"></i> John Doe
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Profile</a>
                        <a href="#">Settings</a>
                        <a href="c_login.php">Logout</a>
                    </div>
                </div>
            </header>

            <!-- Overview Cards -->
            <section class="overview-cards">
                <div class="overview-card">
                    <h3>Active Job Posts</h3>
                    <p>25</p>
                </div>
                <div class="overview-card">
                    <h3>Candidates Matched</h3>
                    <p>150</p>
                </div>
                <div class="overview-card">
                    <h3>New Applications</h3>
                    <p>42</p>
                </div>
                <div class="overview-card">
                    <h3>Average Match Score</h3>
                    <p>88%</p>
                </div>
            </section>

            <!-- Notifications & Reminders -->
            <section class="notifications">
                <h2 class="section-title">Notifications & Reminders</h2>
                <ul class="notification-list">
                    <li>
                        <strong>New Application Received</strong>
                        <p>A new candidate has applied for the "Senior Developer" position.</p>
                    </li>
                    <li>
                        <strong>Upcoming Interview</strong>
                        <p>Reminder: Interview with Jane Smith is scheduled for tomorrow at 10:00 AM.</p>
                    </li>
                    <li>
                        <strong>Feedback Needed</strong>
                        <p>Please provide feedback for the recently hired John Doe.</p>
                    </li>
                </ul>
            </section>

            <!-- Job Posts Management -->
            <section class="job-posts-management">
                <h2 class="section-title">Job Posts Management</h2>
                <div class="job-posts-management">
                    <div class="job-post-card">
                        <h3>Senior Developer</h3>
                        <p>We are seeking a skilled senior developer to join our team.</p>
                        <div class="actions">
                            <button>Edit</button>
                            <button>View</button>
                        </div>
                    </div>
                    <div class="job-post-card">
                        <h3>Data Scientist</h3>
                        <p>Join our team as a data scientist and help us analyze complex datasets.</p>
                        <div class="actions">
                            <button>Edit</button>
                            <button>View</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Match Center -->
            <section class="match-center">
                <h2 class="section-title">Match Center</h2>
                <div class="match-center">
                    <div class="match-card">
                        <h3>Candidate: John Smith</h3>
                        <div class="candidate-info">
                            <strong>Skills:</strong> Java, Python, SQL
                        </div>
                        <p class="match-score">Match Score: 92%</p>
                    </div>
                    <div class="match-card">
                        <h3>Candidate: Jane Doe</h3>
                        <div class="candidate-info">
                            <strong>Skills:</strong> Data Analysis, Machine Learning
                        </div>
                        <p class="match-score">Match Score: 88%</p>
                    </div>
                </div>
            </section>

            <!-- Candidate Insights -->
            <section class="candidate-insights">
                <h2 class="section-title">Candidate Insights</h2>
                <div class="candidate-insights">
                    <div class="insight-card">
                        <h3>Application Trend</h3>
                        <p>Number of applications per week</p>
                        <div class="chart">
                            Chart Here
                        </div>
                    </div>
                    <div class="insight-card">
                        <h3>Skills Distribution</h3>
                        <p>Distribution of top skills among candidates</p>
                        <div class="chart">
                            Chart Here
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
