<?php
$reviews = $pdo->query("SELECT * FROM reviews")->fetchAll(PDO::FETCH_ASSOC);
