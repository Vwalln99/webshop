<?php
require 'header.admin.php';
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['role'] !== 'admin') {
    header('Location: /webshop/public/index.php');
    exit();
}
?>

<main>
    <h2>Admin area</h2>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <p>Manage your webshop here.</p>
</main>

</html>