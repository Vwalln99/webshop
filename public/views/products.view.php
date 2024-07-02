<?php include '../../includes/header.php'; ?>

<main>
    <h2>Our Products</h2>
    <?php include 'layouts/products.main.php'; ?>
    <div class="products">
        <?php foreach ($products as $product) : ?>
            <div class="product">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><?php echo htmlspecialchars($product['price']); ?> EUR</p>
                <a href="product.view.php?id=<?php echo $product['id']; ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>