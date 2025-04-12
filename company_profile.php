<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Scorers Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
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

        .container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .leaderboard-table thead th {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 500;
        }

        .leaderboard-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .leaderboard-table tbody tr:last-child td {
            border-bottom: none;
        }

        .leaderboard-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .leaderboard-table tbody tr:hover {
            background-color: #e9ecef;
        }

        .table-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .profile-details strong {
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .leaderboard-table {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Top Scorers</h1>
        </header>

        <!-- Phase 1 Leaderboard -->
        <section>
            <h2 class="section-title">Phase 1 Leaderboard</h2>
            <table class="leaderboard-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection details
                    $servername = "localhost";
                    $username = "root"; // Replace with your database username
                    $password = ""; // Replace with your database password
                    $dbname = "job_resume"; // Replace with your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to fetch top scorers in Phase 1
                    $sql = "SELECT name, email, score_phase1 FROM candidates ORDER BY score_phase1 DESC LIMIT 10";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $rank = 1;
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $rank . "</td>";
                            echo "<td><img src='https://via.placeholder.com/40' alt='Avatar' class='table-avatar'></td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>";
                            echo "<div class='profile-details'>";
                            echo "<strong>Email:</strong> " . $row["email"] . "<br>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td>" . $row["score_phase1"] . "</td>";
                            echo "</tr>";
                            $rank++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>No top scorers found for Phase 1.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Phase 2 Leaderboard -->
        <section>
            <h2 class="section-title">Phase 2 Leaderboard</h2>
            <table class="leaderboard-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection details
                    $servername = "localhost";
                    $username = "root"; // Replace with your database username
                    $password = ""; // Replace with your database password
                    $dbname = "job_resume"; // Replace with your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to fetch top scorers in Phase 2
                    $sql = "SELECT name, email, score_phase2 FROM candidates ORDER BY score_phase2 DESC LIMIT 10";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $rank = 1;
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $rank . "</td>";
                            echo "<td><img src='https://via.placeholder.com/40' alt='Avatar' class='table-avatar'></td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>";
                            echo "<div class='profile-details'>";
                            echo "<strong>Email:</strong> " . $row["email"] . "<br>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td>" . $row["score_phase2"] . "</td>";
                            echo "</tr>";
                            $rank++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>No top scorers found for Phase 2.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
