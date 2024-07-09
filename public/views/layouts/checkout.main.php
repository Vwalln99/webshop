<?php

session_start();

require '../../../config/database.php';
require_once '../../../src/classes/Order.php';

$orderObj = new Order($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order'])) {
    $user_id = $_SESSION['user_id'];
    $address_line1 = $_POST['address_line1'] ?? '';
    $address_line2 = $_POST['address_line2'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $zip_code = $_POST['zip_code'] ?? '';
    $country = $_POST['country'] ?? '';
    $payment_type = $_POST['payment_type'] ?? '';
    $account_number = $_POST['account_number'] ?? '';
    $expiry_date = $_POST['expiry_date'] ?? '';

    $order_id = $orderObj->placeOrder($user_id, $address_line1, $address_line2, $city, $state, $zip_code, $country, $payment_type, $account_number, $expiry_date);

    if ($order_id) {
        header('Location: /webshop/public/views/cart.view.php?success=true');
        exit;
    } else {
        echo "Fehler beim Aufgeben der Bestellung.";
    }
}
