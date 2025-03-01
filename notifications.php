<?php
session_start();
include 'includes/auth.php'; // Ensure the user is logged in
include 'db.php';

// Fetch user details
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="styless.css"> <!-- Link to your CSS file -->
</head>
<body>


<style>/* General body styling */
body {
    background-color: #f4f4f9; /* Light background color */
    font-family: Arial, sans-serif;
    color: #8174A0; /* Primary text color */
    margin: 0;
    padding: 20px;
}

/* Dashboard container styling */
.dashboard {
    max-width: 800px;
    margin: 0 auto;
    background-color: #ffffff; /* White background for the dashboard */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Heading styling */
h1 {
    color: #8174A0; /* Primary heading color */
    margin-bottom: 10px;
}

/* Role text styling */
p {
    color: #A888B5; /* Secondary text color */
    font-size: 14px;
    margin-bottom: 20px;
}

/* Navigation links styling */
nav {
    margin-bottom: 20px;
}

nav a {
    color: #8174A0; /* Link color */
    text-decoration: none;
    margin-right: 10px;
    font-weight: bold;
}

nav a:hover {
    color: #A888B5; /* Hover link color */
}

/* Card styling for notifications */
.card {
    background-color: #ffffff; /* White background for the card */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card h2 {
    color: #8174A0; /* Card heading color */
    margin-bottom: 15px;
}

/* Notification item styling */
.notification {
    background-color: #f4f4f9; /* Light background for notifications */
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 10px;
    border: 1px solid #A888B5; /* Border color */
}

.notification h3 {
    color: #8174A0; /* Notification title color */
    margin-bottom: 5px;
}

.notification p {
    color: #A888B5; /* Notification text color */
    margin: 5px 0;
}

/* No notifications message styling */
.card p {
    color: #A888B5; /* Secondary text color */
    font-style: italic;
}</style>





    <div class="dashboard">
        <h1>Notifications</h1>
        <p>Role: <?= ucfirst($role) ?></p>

        <!-- Navigation Links -->
        <nav>
            <a href="dashboard.php">Dashboard</a> |
            <a href="notifications.php">Notifications</a> |
            <a href="chat.php">Chat</a> |
            <a href="logout.php">Logout</a>
        </nav>

        <!-- Display Notifications -->
        <div class="card">
            <h2>Your Notifications</h2>
            <?php
            if ($role === 'client') {
                // Fetch notifications for clients (e.g., new job applications)
                $stmt = $conn->prepare("
                    SELECT applications.id, jobs.title, users.username, applications.applied_at 
                    FROM applications 
                    JOIN jobs ON applications.job_id = jobs.id 
                    JOIN users ON applications.developer_id = users.id 
                    WHERE jobs.client_id = ?
                    ORDER BY applications.applied_at DESC
                ");
                $stmt->bind_param("i", $user_id);
            } elseif ($role === 'developer') {
                // Fetch notifications for developers (e.g., job application status updates)
                $stmt = $conn->prepare("
                    SELECT applications.id, jobs.title, applications.status, applications.applied_at 
                    FROM applications 
                    JOIN jobs ON applications.job_id = jobs.id 
                    WHERE applications.developer_id = ?
                    ORDER BY applications.applied_at DESC
                ");
                $stmt->bind_param("i", $user_id);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='notification'>";
                    if ($role === 'client') {
                        echo "<h3>New Application for Job: " . htmlspecialchars($row['title']) . "</h3>";
                        echo "<p>Applicant: " . htmlspecialchars($row['username']) . "</p>";
                        echo "<p>Applied on: " . $row['applied_at'] . "</p>";
                    } elseif ($role === 'developer') {
                        echo "<h3>Application Status for Job: " . htmlspecialchars($row['title']) . "</h3>";
                        echo "<p>Status: " . htmlspecialchars($row['status']) . "</p>";
                        echo "<p>Applied on: " . $row['applied_at'] . "</p>";
                    }
                    echo "</div>";
                }
            } else {
                echo "<p>No notifications found.</p>";
            }
            $stmt->close();
            ?>
            <button id="backButton">Go Back</button>
        </div>
        
    </div>
   <script> document.getElementById("backButton").addEventListener("click", function() {
    history.back();
});</script>
</body>


</html>