<?php
if (!defined('__APP__')) die("Hack attempt");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: index.php?menu=8&action=tasks_json");
exit;
?>
<h2>Uredi zadatak</h2>
<form method="post">
    <label>Naziv</label>
    <input type="text" name="title"
           value="<?= htmlspecialchars($task['title']) ?>" required>

    <label>Rok</label>
    <input type="date" name="deadline" value="<?= $task['deadline'] ?>" required>
    <label>Status</label>
    <select name="status">
        <option value="pending" <?= $task['status']=='pending'?'selected':'' ?>>Pending</option>
        <option value="done" <?= $task['status']=='done'?'selected':'' ?>>Done</option>
        <option value="late" <?= $task['status']=='late'?'selected':'' ?>>Late</option>
    </select>
    <button type="submit" name="save">Spremi</button>
</form>
