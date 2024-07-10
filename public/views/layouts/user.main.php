<?php
require_once '../../../config/database.php';
session_start();

$updateMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $updateMessage = "Data successfully updated";
    $_SESSION['update_message'] = $updateMessage;
    header('Location: /webshop/public/views/user.view.php');
    unset($_SESSION['update_message']);
    exit();
}
