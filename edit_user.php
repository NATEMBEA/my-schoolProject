<?php
session_start();
include 'db.php';

// Ensure only admins can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($user_id) {
    $stmt = $conn->prepare("SELECT id, username, role FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $role, $user_id);
    if ($stmt->execute()) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Failed to update user.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="edit-container">
        <h1>Edit User</h1>
        <form method="POST" action="edit_user.php?id=<?= $user_id ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            <label for="role">Role:</label>
            <select name="role" required>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="client" <?= $user['role'] === 'client' ? 'selected' : '' ?>>Client</option>
                <option value="developer" <?= $user['role'] === 'developer' ? 'selected' : '' ?>>Developer</option>
            </select>
            <button type="submit">Update User</button>
        </form>
    </div>
</body>
</html>