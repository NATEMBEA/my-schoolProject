<nav>
    <a href="dashboard.php">Dashboard</a>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="admin.php">Admin Panel</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</nav>