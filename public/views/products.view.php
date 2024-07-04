<?php

require '../../config/database.php';
require '../../src/classes/Product.php';
require '../../src/classes/Review.php';

$productObj = new Product($pdo);
$reviewObj = new Review($pdo);

$products = $productObj->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>

<body>
    <?php include '../../includes/header.php'; ?>
    <div class="products">
        <h2>Products</h2>
        <ul>
            <?php foreach ($products as $product) : ?>
                <li>
                    <a href="product.view.php?id=<?php echo $product['id']; ?>">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </a>
                    <p>Price: <?php echo htmlspecialchars($product['price']); ?> EUR</p>
                    <p>Rating:
                        <?php
                        $average_rating = $reviewObj->getAverageRatingByProductId($product['id']);
                        echo $average_rating ? number_format($average_rating, 1) : 'No ratings yet';
                        ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>