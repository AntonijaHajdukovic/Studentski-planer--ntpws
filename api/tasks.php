<?php
define('__APP__', true);
header('Content-Type: application/json');
require_once('../db.php');
$stmt = $pdo->query("
    SELECT t.id, t.title, t.deadline, t.status, s.name AS subject
    FROM tasks t
    JOIN subjects s ON t.subject_id = s.id
");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($tasks, JSON_PRETTY_PRINT);
