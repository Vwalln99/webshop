<?php
session_start();

require '../../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        exit("Benutzer ist nicht eingeloggt.");
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
    $sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity) ON DUPLICATE KEY UPDATE quantity = quantity +:quantity";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':product_id' => $product_id,
        ':quantity' => $quantity
    ]);

    header('Location: /webshop/public/views/cart.view.php');
    exit();

    //TODO: verknüpfen von user_id und cart_items, nach abmelden soll die cart mit den zugehörigen cart_items(id) für den user wieder sichtbar sein beim anmelden(session)
}
