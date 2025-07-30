<div class="navbar">
    <div class="nav-left">
        <a href="dashboard.php">Dashboard</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </div>
    <div class="nav-right">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</div>
