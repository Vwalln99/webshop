<main>
    <h2>Welcome to our Webshop</h2>
    <?php include 'layouts/index.main.php'; ?>
    <p>Our products</p>
    <ul>
        <?php foreach ($products as $product) : ?>
            <li><?php echo htmlspecialchars($product['name']); ?> - $<?php echo htmlspecialchars($product['price']); ?></li>
        <?php endforeach ?>
    </ul>
</main>