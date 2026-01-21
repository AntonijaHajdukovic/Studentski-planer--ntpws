<?php
//Konekcija na bazu
$pdo = new PDO("mysql:host=localhost;dbname=planner;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
