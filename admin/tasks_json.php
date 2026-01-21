<?php
$json = file_get_contents(
    'http://localhost/ntpws/StudentskiPlaner/api/tasks.php'
);
$tasks = json_decode($json, true);
?>
<div class="page-card">
    <h2>Zadaci</h2>
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <tr>
                <th>Naziv</th>
                <th>Kolegij</th>
                <th>Rok</th>
                <th>Status</th>
                <th>Akcije</th>
            </tr>
            <?php foreach ($tasks as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t['title']) ?></td>
                <td><?= htmlspecialchars($t['subject']) ?></td>
                <td><?= htmlspecialchars($t['deadline']) ?></td>
                <td class="status <?= htmlspecialchars($t['status']) ?>"><?= htmlspecialchars($t['status']) ?></td>
                <td class="admin-actions-cell">
                    <a class="admin-edit" href="index.php?menu=8&action=edit_task&id=<?= (int)$t['id'] ?>">✏️</a>
                    <form method="post"
                        action="index.php?menu=8&action=delete_task"
                        onsubmit="return confirm('Sigurno obrisati zadatak?');">
                        <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
                        <button type="submit" class="admin-delete">🗑️</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <a class="admin-back" href="index.php?menu=8">← Natrag na admin</a>
</div>