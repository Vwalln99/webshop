<?php

$products = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
