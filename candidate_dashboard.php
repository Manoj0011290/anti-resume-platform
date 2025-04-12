<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Candidate Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary: #3b82f6;
      --secondary: #1e3a8a;
      --accent: #f59e0b;
      --dark: #1e293b;
      --light: #f8fafc;
      --success: #10b981;
      --danger: #ef4444;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      display: grid;
      grid-template-columns: 240px 1fr;
      min-height: 100vh;
      background: linear-gradient(45deg, #f8fafc, #f1f5f9);
      overflow-x: hidden;
    }

    /* Animated Sidebar */
    .sidebar {
      background: linear-gradient(195deg, var(--secondary), var(--primary));
      color: var(--light);
      padding: 2rem 1.5rem;
      position: relative;
      transform: translateZ(0);
      box-shadow: 4px 0 15px rgba(0,0,0,0.1);
      transition: var(--transition);
    }

    .sidebar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, rgba(255,255,255,0.1), transparent);
      pointer-events: none;
    }

    .sidebar-header {
      padding: 1rem 0;
      margin-bottom: 2rem;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar-header h2 {
      font-size: 1.5rem;
      font-weight: 600;
      text-align: center;
      background: linear-gradient(to right, #fff 0%, #cbd5e1 100%);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .nav-links {
      list-style: none;
    }

    .nav-item {
      margin: 0.75rem 0;
      position: relative;
      overflow: hidden;
    }

    .nav-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255,255,255,0.1);
      transition: var(--transition);
    }

    .nav-item:hover::before {
      left: 0;
    }

    .nav-link {
      display: flex;
      align-items: center;
      padding: 1rem 1.5rem;
      color: var(--light);
      text-decoration: none;
      border-radius: 8px;
      transition: var(--transition);
      position: relative;
      z-index: 1;
    }

    .nav-link i {
      width: 30px;
      font-size: 1.2rem;
      transition: var(--transition);
    }

    .nav-link span {
      transform: translateX(0);
      transition: transform 0.3s ease;
    }

    .nav-link:hover {
      transform: translateX(10px);
    }

    .nav-link:hover i {
      color: var(--accent);
    }

    /* Main Content */
    .main-content {
      padding: 3rem;
      position: relative;
    }

    /* Dashboard Grid */
    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }

    /* Animated Cards */
    .dashboard-card {
      background: white;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
      transition: var(--transition);
      transform: translateY(0);
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }

    .dashboard-card::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      transform: scaleX(0);
      transition: var(--transition);
    }

    .dashboard-card:hover::after {
      transform: scaleX(1);
    }

    .card-header {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .card-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      background: rgba(59,130,246,0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
    }

    .card-icon i {
      font-size: 1.5rem;
      color: var(--primary);
    }

    .card-content h3 {
      font-size: 1.25rem;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .card-content p {
      color: #64748b;
      font-size: 0.9rem;
    }

    /* Progress Bar */
    .progress-container {
      margin-top: 1.5rem;
    }

    .progress-label {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
      color: #64748b;
      font-size: 0.9rem;
    }

    .progress-bar {
      height: 8px;
      background: #e2e8f0;
      border-radius: 4px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      width: 75%;
      transition: var(--transition);
      position: relative;
    }

    .progress-fill::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255,255,255,0.2);
      animation: progress-shine 2s infinite;
    }

    @keyframes progress-shine {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(200%); }
    }

    /* Floating Logout Button */
    .logout-btn {
      position: fixed;
      top: 2rem;
      right: 3rem;
      background: var(--danger);
      color: white;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 8px;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: 0 4px 6px -1px rgba(239,68,68,0.3);
    }

    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(239,68,68,0.3);
    }

    /* Animations */
    @keyframes cardEntrance {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .dashboard-card {
      animation: cardEntrance 0.6s ease-out;
      animation-fill-mode: backwards;
    }

    .dashboard-card:nth-child(1) { animation-delay: 0.2s; }
    .dashboard-card:nth-child(2) { animation-delay: 0.4s; }
    .dashboard-card:nth-child(3) { animation-delay: 0.6s; }

    /* Mobile Responsive */
    @media (max-width: 768px) {
      body {
        grid-template-columns: 1fr;
      }

      .sidebar {
        position: fixed;
        width: 100%;
        height: auto;
        bottom: 0;
        z-index: 100;
        padding: 1rem;
        transform: translateY(100%);
      }

      .sidebar.active {
        transform: translateY(0);
      }

      .nav-links {
        display: flex;
        justify-content: space-around;
      }

      .nav-link span {
        display: none;
      }

      .main-content {
        padding: 1.5rem;
        margin-bottom: 80px;
      }

      .logout-btn {
        top: 1rem;
        right: 1rem;
      }
    }
  </style>
</head>
<body>

  <nav class="sidebar">
    <div class="sidebar-header">
      <h2>Candidate Portal</h2>
    </div>
    <ul class="nav-links">
      <li class="nav-item">
        <a href="profile_can.php" class="nav-link">
          <i class="fas fa-user"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="test.html" class="nav-link">
          <i class="fas fa-clipboard-list"></i>
          <span>Tests</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="score.html" class="nav-link">
          <i class="fas fa-chart-bar"></i>
          <span>Scores</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="jobs.html" class="nav-link">
          <i class="fas fa-briefcase"></i>
          <span>Jobs</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="main-content">
    <button class="logout-btn" onclick="window.location.href='c_login.php'">
      <i class="fas fa-sign-out-alt"></i>
      Logout
    </button>

    <h1>Welcome Back, Candidate!</h1>
    
    <div class="dashboard-grid">
      <div class="dashboard-card">
        <div class="card-header">
          <div class="card-icon">
            <i class="fas fa-clipboard-check"></i>
          </div>
          <div class="card-content">
            <h3>Upcoming Tests</h3>
            <p>2 pending assessments</p>
          </div>
        </div>
        <div class="progress-container">
          <div class="progress-label">
            <span>Preparation Progress</span>
            <span>75%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill"></div>
          </div>
        </div>
      </div>

      <div class="dashboard-card">
        <div class="card-header">
          <div class="card-icon">
            <i class="fas fa-user-check"></i>
          </div>
          <div class="card-content">
            <h3>Profile Strength</h3>
            <p>Complete your profile for better matches</p>
          </div>
        </div>
        <div class="progress-container">
          <div class="progress-label">
            <span>Profile Completion</span>
            <span>60%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" style="width: 60%"></div>
          </div>
        </div>
      </div>

      <div class="dashboard-card">
        <div class="card-header">
          <div class="card-icon">
            <i class="fas fa-briefcase"></i>
          </div>
          <div class="card-content">
            <h3>Applied Jobs</h3>
            <p>3 active applications</p>
          </div>
        </div>
        <div class="progress-container">
          <div class="progress-label">
            <span>Application Success Rate</span>
            <span>40%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" style="width: 40%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
