<?php
// Include authentication and database connection
include 'includes/auth.php';
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>

<style>/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #8174A0;
    margin: 0;
    padding: 0;
}

.dashboard {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1, h2, h3 {
    color: #8174A0;
}

p {
    color: #A888B5;
}

/* Navigation Links */
nav {
    margin-bottom: 20px;
}

nav a {
    color: #8174A0;
    text-decoration: none;
    margin-right: 10px;
}

nav a:hover {
    color: #EFB6C8;
}

/* Cards */
.card {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

/* Job and Application Cards */
.job, .application {
    border-bottom: 1px solid #EFB6C8;
    padding: 15px 0;
}

.job:last-child, .application:last-child {
    border-bottom: none;
}

/* Buttons */
.delete-btn, .apply-btn, .chat-btn, .approve-btn {
    display: inline-block;
    padding: 8px 16px;
    margin-top: 10px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
}

.delete-btn {
    background-color: #EFB6C8;
    color: #ffffff;
}

.delete-btn:hover {
    background-color: #d89aac;
}

.apply-btn {
    background-color: #A888B5;
    color: #ffffff;
}

.apply-btn:hover {
    background-color: #8f6f9d;
}

.chat-btn {
    background-color: #FFD2A0;
    color: #8174A0;
}

.chat-btn:hover {
    background-color: #e6b88c;
}

.approve-btn {
    background-color: #8174A0;
    color: #ffffff;
}

.approve-btn:hover {
    background-color: #6a5f8a;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard {
        padding: 10px;
    }

    nav a {
        display: block;
        margin: 5px 0;
    }
}</style>




    <div class="dashboard">
        <h1>Welcome, <?= $_SESSION['username'] ?>!</h1>
        <p>Role: <?= ucfirst($role) ?></p>

        <!-- Navigation Links -->
        <nav>
            <a href="post_job.php">Post a Job</a> |
            <a href="notifications.php">Notifications</a> |
            <a href="chat.php">Chat</a> |
            <a href="logout.php">Logout</a>
        </nav>

        <!-- Display Jobs -->
        <div class="card">
            <h2><?= $role === 'client' ? 'Your Posted Jobs' : 'Available Jobs' ?></h2>
            <?php
            if ($role === 'client') {
                // Fetch jobs posted by the client
                $stmt = $conn->prepare("SELECT * FROM jobs WHERE client_id = ?");
                $stmt->bind_param("i", $user_id);
            } else {
                // Fetch all available jobs for developers
                $stmt = $conn->prepare("SELECT * FROM jobs");
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='job'>";
                    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<p>Posted on: " . $row['posted_at'] . "</p>";

                    if ($role === 'client') {
                        // Clients can delete their jobs
                        echo "<a href='delete_job.php?id=" . $row['id'] . "' class='delete-btn'>Delete Job</a>";
                    } else {
                        // Developers can apply for jobs
                        echo "<a href='apply_job.php?job_id=" . $row['id'] . "' class='apply-btn'>Apply for Job</a>";
                    }

                    echo "</div>";
                }
            } else {
                echo "<p>No jobs found.</p>";
            }
            $stmt->close();
            ?>
        </div>

        <!-- Display Applications (for clients) -->
       <!-- Display Applications (for clients) -->
<?php if ($role === 'client'): ?>
    <div class="card">
        <h2>Job Applications</h2>
        <?php
        $stmt = $conn->prepare("
            SELECT applications.id, applications.developer_id, applications.status, jobs.title, users.username 
            FROM applications 
            JOIN jobs ON applications.job_id = jobs.id 
            JOIN users ON applications.developer_id = users.id 
            WHERE jobs.client_id = ?
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='application'>";
                echo "<h3>Job: " . htmlspecialchars($row['title']) . "</h3>";
                echo "<p>Applicant: " . htmlspecialchars($row['username']) . "</p>";
                echo "<p>Status: " . ucfirst($row['status']) . "</p>";
                echo "<a href='chat.php?receiver_id=" . $row['developer_id'] . "' class='chat-btn'>Chat with Applicant</a>";

                // Show "Approve" button only if the application is pending
                if ($row['status'] === 'pending') {
                    echo " | <a href='approve_job.php?application_id=" . $row['id'] . "' class='approve-btn'>Approve</a>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No applications found.</p>";
        }
        $stmt->close();
        ?>
    </div>
<?php endif; ?>


        <!-- Display Applied Jobs (for developers) -->
        <?php if ($role === 'developer'): ?>
            <div class="card">
                <h2>Your Applied Jobs</h2>
                <?php
                $stmt = $conn->prepare("
                    SELECT jobs.title, jobs.description, applications.applied_at 
                    FROM applications 
                    JOIN jobs ON applications.job_id = jobs.id 
                    WHERE applications.developer_id = ?
                ");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='job'>";
                        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<p>Applied on: " . $row['applied_at'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>You haven't applied to any jobs yet.</p>";
                }
                $stmt->close();
                ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>