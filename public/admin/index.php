<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['role'] !== 'admin') {
    header('Location: /webshop/public/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminbereich</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/webshop/public/admin/index.php">Home</a></li>
                <li><a href="/webshop/public/admin/products.php">Products</a></li>
                <li><a href="/webshop/public/admin/users.php">Users</a></li>
                <li><a href="/webshop/public/admin/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Adminbereich</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p>Manage your webshop here.</p>
    </main>
</body>

</html>