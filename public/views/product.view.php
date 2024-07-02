<?php include '../../includes/header.php'; ?>

<main>
    <h2>Product Details</h2>
    <div class="product-detail">
        <?php include 'layouts/product.main.php'; ?>
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p><?php echo htmlspecialchars($product['price']); ?> EUR</p>
        <form action="/webshop/public/views/layouts/cart.main.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>