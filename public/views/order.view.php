<main>
    <h2>Your Orders</h2>
    <?php include 'layouts/order.main.php'; ?>
    <ul>
        <?php foreach ($orders as $order) : ?>
            <li>Order #<?php echo htmlspecialchars($order['id']); ?> - $<?php echo htmlspecialchars($order['total']); ?></li>
        <?php endforeach; ?>
    </ul>
</main>