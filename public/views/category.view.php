<?php
require '../../config/database.php';
require '../../src/classes/Product.php';
require '../../src/classes/Review.php';

$productObj = new Product($pdo);
$reviewObj = new Review($pdo);

$products = $productObj->getAllProducts();

$category_id = $_GET['id'] ?? null;

if (!$category_id) {
    header('Location: /webshop/public/index.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = :category_id");
$stmt->execute(['category_id' => $category_id]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkte in dieser Kategorie</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include '../../includes/header.php'; ?>

    <h2>Produkte in dieser Kategorie</h2>

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

    <?php include '../../includes/footer.php'; ?>
</body>

</html>