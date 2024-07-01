<?php
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
