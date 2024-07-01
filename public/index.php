<?php
require '../includes/functions.php';
require '../config/database.php';
require '../src/vendor/autoload.php';
require '../src/classes/Database.php';

$db = new Database($config);
$pdo = $db->getConnection();

include '../includes/header.php';
include 'views/index.view.php';
include '../includes/footer.php';
