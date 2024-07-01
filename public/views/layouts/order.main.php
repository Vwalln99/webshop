<?php

$orders = $pdo->query("SELECT * FROM orders")->fetchAll(PDO::FETCH_ASSOC);
