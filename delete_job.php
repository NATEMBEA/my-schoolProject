<?php
include 'includes/auth.php';
include 'db.php';

$job_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role === 'client') {
    $stmt = $conn->prepare("DELETE FROM jobs WHERE id = ? AND client_id = ?");
    $stmt->bind_param("ii", $job_id, $user_id);
} elseif ($role === 'developer') {
    $stmt = $conn->prepare("DELETE FROM applications WHERE job_id = ? AND developer_id = ?");
    $stmt->bind_param("ii", $job_id, $user_id);
}

$stmt->execute();
$stmt->close();

header('Location: dashboard.php');
exit();
?>