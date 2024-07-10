<?php
session_start();

include '../../config/database.php';

$totalItemsInCart = 0;

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    $user_id = $_SESSION['user_id'];
    $cartStmt = $pdo->prepare("SELECT COUNT(product_id) as total_quantity FROM carts WHERE user_id = :user_id");
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
    <title>Webshop</title>
    <link rel="stylesheet" href="/webshop/public/styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/webshop/public/views/index.php">Home</a></li>
                <li><a href="/webshop/public/views/products.view.php">Products</a></li>
                <li><a href="/webshop/public/views/cart.view.php">🛒 (<?php echo $totalItemsInCart; ?>)</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Categories</a>
                    <div class="dropdown-content">
                        <?php
                        $stmt = $pdo->query("SELECT * FROM categories");
                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($categories as $category) {
                            echo '<a href="/webshop/public/views/category.view.php?id=' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</a>';
                        }
                        ?>
                    </div>
                </li>
                <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                    echo '<li><a href="/webshop/public/views/user.view.php">' . $_SESSION['username'] . '</a></li>';
                    echo '<li><a href="/webshop/public/views/layouts/logout.main.php">Logout</a></li>';
                } else {
                    echo '<li><a href="/webshop/public/views/login.view.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>