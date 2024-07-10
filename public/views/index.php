<?php
require '../../includes/functions.php';
require '../../config/database.php';
require '../../src/vendor/autoload.php';
require '../../src/classes/Database.php';
require '../../src/classes/Product.php';
require '../../src/classes/Review.php';

$db = new Database($config);
$pdo = $db->getConnection();

include '../../includes/header.php';
$productObj = new Product($pdo);
$reviewObj = new Review($pdo);

$topSellingProduct = $productObj->getTopSellingProducts();

?>
<main class="main-index">
    <h2 class="ueberschrift">Welcome to our Webshop</h2>
    <p class="ueberschrift">With us you can shop whatever, wherever and whenever you want.</p>
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        echo '<p class="ueberschrift">Welcome, ' . $_SESSION['username'] . '!</p>';
    }
    ?>
    <h2 class="ueberschrift h2">Bestsellers</h2>
    <div class="top-selling-container">
        <?php if ($topSellingProduct) : ?>
            <?php foreach ($topSellingProduct as $product) : ?>
                <div class="products">
                    <a href="product.view.php?id=<?php echo $product['id']; ?>">
                        <?php
                        $images = $productObj->getProductImages($product['id']);
                        if ($images) {
                            foreach ($images as $image) {
                                echo '<img src="' . htmlspecialchars($image['image_url']) . '" alt="' . htmlspecialchars($product['name']) . '" style="width:100px;height:100px;">';
                            }
                        }
                        ?>
                        <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                    </a>
                    <p>Price: <?php echo htmlspecialchars($product['price']); ?> EUR</p>
                    <p>Rating:
                        <?php
                        $average_rating = $reviewObj->getAverageRatingByProductId($product['id']);
                        echo $average_rating ? number_format($average_rating, 1) . "⭐" : 'No ratings yet';
                        ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="ueberschrift">No top selling products found.</p>
        <?php endif; ?>
    </div>
</main>
<?php
include '../../includes/footer.php';
?>