<?php
require '../../config/database.php';
require '../../src/classes/Product.php';
require '../../src/classes/Review.php';
include '../../includes/header.php';

$productObj = new Product($pdo);
$reviewObj = new Review($pdo);

$products = $productObj->getAllProducts();
$product_id = $_GET['id'] ?? null;

$category_id = $_GET['id'] ?? null;

if (!$category_id) {
    header('Location: /webshop/public/index.php');
    exit();
}
$stmt = $pdo->prepare("SELECT name FROM categories WHERE id = :category_id");
$stmt->execute(['category_id' => $category_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    echo "Category not found.";
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = :category_id");
$stmt->execute(['category_id' => $category_id]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="ueberschrift">
    <h2><?php echo htmlspecialchars($category['name']); ?></h2>
    <div class="product-detail-main">
        <?php foreach ($products as $product) : ?>
            <li class="products">
                <a href="product.view.php?id=<?php echo $product['id']; ?>">
                    <?php
                    $images = $productObj->getProductImages($product_id);
                    if ($images) {
                        foreach ($images as $image) {
                            echo '<img src="' . htmlspecialchars($image['image_url']) . '" alt="' . htmlspecialchars($product['name']) . '" style="width:100px;height:100px;">';
                        }
                    }
                    ?>
                    <?php echo htmlspecialchars($product['name']); ?>
                </a>
                <p>Price: <?php echo htmlspecialchars($product['price']); ?> EUR</p>
                <p>Rating:
                    <?php
                    $average_rating = $reviewObj->getAverageRatingByProductId($product['id']);
                    echo $average_rating ? number_format($average_rating, 1) . "⭐" : 'No ratings yet';

                    ?>
                </p>
            </li>
        <?php endforeach; ?>
    </div>
</main>
<?php include '../../includes/footer.php'; ?>