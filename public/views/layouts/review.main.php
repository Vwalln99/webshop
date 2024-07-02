<?php
require '../../config/database.php';
require '../../src/vendor/autoload.php';
require_once '../../src/classes/Database.php';
$reviews = $pdo->query("SELECT * FROM reviews")->fetchAll(PDO::FETCH_ASSOC);
