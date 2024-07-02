<?php
session_start();

require '../../../config/database.php';
require '../../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, role FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            if ($user['role'] === 'admin') {
                header('Location: /webshop/public/admin/index.php');
            } else {
                header('Location: /webshop/public/index.php');
            }
            exit();
        } else {
            echo  "Ungültiges Passwort.";
        }
    } else {
        echo "Benutzer nicht gefunden.";
    }
}
