<?php
require 'header.admin.php';
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['role'] !== 'admin') {
    header('Location: /webshop/public/index.php');
    exit();
}
?>

<main>

    <main>
        <h2>Adminbereich</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p>Manage your webshop here.</p>
    </main>
</main>

</html>