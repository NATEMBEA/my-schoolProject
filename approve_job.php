<?php
include 'includes/auth.php';
include 'db.php';

if (isset($_GET['application_id'])) {
    $application_id = $_GET['application_id'];

    // Fetch application details
    $stmt = $conn->prepare("
        SELECT applications.developer_id, jobs.title 
        FROM applications 
        JOIN jobs ON applications.job_id = jobs.id 
        WHERE applications.id = ?
    ");
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $stmt->bind_result($developer_id, $job_title);
    $stmt->fetch();
    $stmt->close();

    if ($developer_id) {
        // Mark job as approved
        $stmt = $conn->prepare("UPDATE applications SET status = 'approved' WHERE id = ?");
        $stmt->bind_param("i", $application_id);
        $stmt->execute();
        $stmt->close();

        // Send notification to the developer
        $message = "Your application for the job '$job_title' has been approved!";
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
        $stmt->bind_param("is", $developer_id, $message);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('Job approved successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid application!'); window.location.href='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Application ID missing!'); window.location.href='dashboard.php';</script>";
}
?>
