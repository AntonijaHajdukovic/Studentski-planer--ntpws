<?php
$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch();

if (!$task) {
    echo "<p>Zadatak ne postoji.</p>";
    return;
}
?>
<h2>Uredi zadatak</h2>
<form method="post" action="index.php?menu=8&action=tasks_json">
    <input type="hidden" name="id" value="<?= (int)$task['id'] ?>">
    <label>Naziv</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>"><br><br>
    <label>Rok</label><br>
    <input type="date" name="deadline" value="<?= $task['deadline'] ?>"><br><br>
    <label>Status</label><br>
    <select name="status">
        <option value="pending" <?= $task['status']=='pending'?'selected':'' ?>>Pending</option>
        <option value="done" <?= $task['status']=='done'?'selected':'' ?>>Done</option>
    </select>
    <br>
    <button type="submit">💾 Spremi</button>
</form>
<a href="index.php?menu=8">← Natrag na admin</a>
