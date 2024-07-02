<?php include '../../includes/header.php'; ?>
<?php include '../../config/database.php'; ?>

<div class="cart">
    <h2>Your Cart</h2>
    <?php if (empty($_SESSION['cart'])) : ?>
        <p>Your cart is empty.</p>
    <?php else : ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $product_id => $quantity) :
                $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
                $stmt->execute([':id' => $product_id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$product) {
                    echo "<tr><td colspan='4'>Product with ID $product_id not found.</td></tr>";
                    continue;
                }

                $total = $product['price'] * $quantity;
                $totalPrice += $total;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?> EUR</td>
                    <td><?php echo $total; ?> EUR</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3">Total</td>
                <td><?php echo $totalPrice; ?> EUR</td>
            </tr>
        </table>
        <a href="checkout.view.php">Checkout</a>
    <?php endif; ?>
</div>

<?php include '../../includes/footer.php'; ?>