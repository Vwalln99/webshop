<?php

use App\Email;

require '../../vendor/autoload.php';


require '../../config/database.php';
require '../../config/config.php';
require '../../src/classes/Cart.php';
require '../../src/classes/Email.php';
include '../../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /webshop/public/views/login.view.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$cart = new Cart($pdo, $user_id);
$cartItems = $cart->getCartItems();
$totalPrice = $cart->getTotalPrice();

if (isset($_GET['success']) && $_GET['success'] === 'true') {
    $orderDetails = '<h2>Order Confirmation</h2><p>Thank you for your order! Here are the details:</p><ul>';
    foreach ($cartItems as $item) {
        $orderDetails .= '<li>' . htmlspecialchars($item['name']) . ' - ' . $item['quantity'] . ' x ' . htmlspecialchars($item['price']) . ' EUR </li>';
    }
    $orderDetails .= '</ul>';
    $orderDetails .= '<p>Total Price: ' . $totalPrice . ' EUR</p>';

    $email = new Email($mail_config);
    $user_email = "wallner.viktoria@gmx.net";
    $subject = "Order Confirmation";
    $message = $orderDetails;

    if ($email->send_mail($mail_config['username'], $user_email, $subject, $message)) {
        echo "Confirmation email sent!";
    } else {
        echo "Failed to send confirmation email.";
    }
    $cart->removeAllItems();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $cart->updateItem($product_id, $quantity);
    } elseif (isset($_POST['remove_item'])) {
        $product_id = $_POST['product_id'];
        $cart->removeItem($product_id);
    }
    header('Location: cart.view.php');
    exit();
}
?>

<main>
    <div class="cart">
        <h2>Your Cart</h2>
        <?php if (empty($cartItems)) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <form action="cart.view.php" method="post">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($cartItems as $item) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <button type="submit" name="update_quantity">Update</button>
                            </td>
                            <td><?php echo htmlspecialchars($item['price']); ?> EUR</td>
                            <td><?php echo $item['price'] * $item['quantity']; ?> EUR</td>
                            <td>
                                <button type="submit" name="remove_item">Remove</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?php echo $totalPrice; ?> EUR</td>
                        <td></td>
                    </tr>
                </table>
            </form>
            <a href="checkout.view.php">Checkout</a>
        <?php endif; ?>
    </div>
    <?php include '../../includes/footer.php'; ?>
</main>

</html>