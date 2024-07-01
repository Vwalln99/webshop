<main>
    <h2>Our Products</h2>
    <?php include 'layouts/product.main.php'; ?>
    <ul>
        <?php foreach ($products as $product) : ?>
            <li><?php echo htmlspecialchars($product['name']); ?> - $<?php echo htmlspecialchars($product['price']); ?></li>
        <?php endforeach; ?>
    </ul>
</main>