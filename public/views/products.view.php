<?php

require '../../config/database.php';
require '../../src/classes/Product.php';
require '../../src/classes/Review.php';
include '../../includes/header.php';

$productObj = new Product($pdo);
$reviewObj = new Review($pdo);

$products = $productObj->getAllProducts();
?>

<main>
    <div>
        <h2>Products</h2>
        <ul class="products-container">
            <?php foreach ($products as $product) : ?>
                <li class="products">
                    <a href="product.view.php?id=<?php echo $product['id']; ?>">
                        <?php
                        $images = $productObj->getProductImages($product['id']);
                        if ($images) {
                            echo '<img src="' . htmlspecialchars($images[0]['image_url']) . '" alt="' . htmlspecialchars($product['name']) . '" style="width:100px;height:75px;">';
                        }
                        ?>
                        <?php echo htmlspecialchars($product['name']); ?>
                    </a>
                    <p>Price: <?php echo htmlspecialchars($product['price']); ?> EUR</p>
                    <p>Rating:
                        <?php
                        $average_rating = $reviewObj->getAverageRatingByProductId($product['id']);
                        echo $average_rating ? number_format($average_rating, 1) . '⭐' : 'No ratings yet';
                        ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>
<?php include '../../includes/footer.php'; ?>