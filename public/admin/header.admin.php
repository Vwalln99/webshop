<?php
session_start();


include '../../config/database.php';

$totalItemsInCart = 0;

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    $user_id = $_SESSION['user_id'];
    $cartStmt = $pdo->prepare("SELECT SUM(product_id) as total_quantity FROM carts WHERE user_id = :user_id");
    $cartStmt->execute([':user_id' => $user_id]);
    $cartResult = $cartStmt->fetch(PDO::FETCH_ASSOC);
    $totalItemsInCart = $cartResult['total_quantity'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/webshop/public/styles.css">
</head>

<header>
    <nav>
        <ul>
            <li><a href="/webshop/public/admin/index.php">Home</a></li>
            <li><a href="/webshop/public/admin/products.php">Products</a></li>
            <li><a href="/webshop/public/admin/users.php">Users</a></li>
            <li><a href="/webshop/public/admin/statistics.admin.php">Statistics</a></li>
            <li><a href="/webshop/public/admin/logout.php">Logout</a></li>
        </ul>
    </nav>
</header>