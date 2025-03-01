<?php
session_start();
include 'includes/auth.php'; // Ensure the user is logged in
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'developer') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $developer_id = $_SESSION['user_id'];

    // Check if the developer has already applied for this job
    $stmt = $conn->prepare("SELECT * FROM applications WHERE job_id = ? AND developer_id = ?");
    $stmt->bind_param("ii", $job_id, $developer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Insert the application into the database
        $stmt = $conn->prepare("INSERT INTO applications (job_id, developer_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $job_id, $developer_id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Application submitted successfully!";
        } else {
            $_SESSION['error'] = "Failed to submit application. Please try again.";
        }
    } else {
        $_SESSION['error'] = "You have already applied for this job.";
    }

    $stmt->close();
}

header('Location: dashboard.php');
exit();
?>