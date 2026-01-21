<?php
if (!defined('__APP__')) die("Hacking attempt");
if(!isset($_SESSION['user_id'])) {
    echo "<p>Morate se prijaviti.</p>";
    return;
}

// Gotov zadatak
if(isset($_POST['done_task'])) {
    $stmt = $pdo->prepare("UPDATE tasks SET status='done' WHERE id=?");
    $stmt->execute([$_POST['task_id']]);
}

// Dohvati kolegije
$stmt = $pdo->prepare("SELECT * FROM subjects WHERE user_id=?");
$stmt->execute([$_SESSION['user_id']]);
$subjects = $stmt->fetchAll();

// Dodavanje zadatka
if(isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO tasks (subject_id,title,description,deadline) VALUES (?,?,?,?)");
    $stmt->execute([
        $_POST['subject_id'],
        $_POST['title'],
        $_POST['description'],
        $_POST['deadline']
    ]);
}

// Dohvat zadataka
$sql = "
SELECT tasks.*, subjects.name AS subject
FROM tasks
JOIN subjects ON tasks.subject_id = subjects.id
WHERE subjects.user_id=?
";

$params = [$_SESSION['user_id']];

if(!empty($_GET['filter_subject'])) {
    $sql .= " AND subjects.id = ?";
    $params[] = $_GET['filter_subject'];
}
if(!empty($_GET['filter_status'])) {
    if($_GET['filter_status'] == 'late') {
        $sql .= " AND tasks.deadline < CURDATE() AND tasks.status != 'done'";
    } else {
        $sql .= " AND tasks.status = ?";
        $params[] = $_GET['filter_status'];
    }
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$tasks = $stmt->fetchAll();
?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div class="page-card">
    <div class="page-section">
        <h3>Filtriranje zadataka</h3>
        <form method="get" class="subject-form form-inline">
        <input type="hidden" name="menu" value="3">
        <select name="filter_subject">
            <option value="">Svi kolegiji</option>
            <?php foreach($subjects as $s): ?>
            <option value="<?= $s['id'] ?>"
                <?= (isset($_GET['filter_subject']) && $_GET['filter_subject']==$s['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($s['name']) ?>
            </option>
            <?php endforeach; ?>
        </select>
        <select name="filter_status">
            <option value="">Svi statusi</option>
            <option value="pending">U tijeku</option>
            <option value="done">Gotovo</option>
            <option value="late">Kasni</option>
        </select>
        <button class="btn primary">Filtriraj</button>
        </form>
    </div>
    <hr>
    <div class="page-section">
        <h2>Dodaj zadatak</h2>
        <form method="post" class="task-form">
        <label>Kolegij</label>
        <select name="subject_id" required>
            <?php foreach($subjects as $s): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <label>Naziv zadatka</label>
        <input type="text" name="title" placeholder="Naziv zadatka" required>
        <label>Opis zadatka</label>
        <div id="editor"></div>
        <input type="hidden" name="description" id="description">
        <label>Rok</label>
        <input type="date" name="deadline" required>
        <button type="submit" name="add" class="btn primary">Dodaj zadatak</button>
        </form>
    </div>    
        <script>
        var quill = new Quill('#editor', { theme: 'snow' });
        document.querySelector('form').onsubmit = function() {
        document.getElementById('description').value = quill.root.innerHTML;
        };
        </script>
    <div class="page-section">
        <h3>Moji zadaci</h3>
        <div class="task-grid">
            <?php foreach($tasks as $t):
                $status = $t['status'];
                if($t['deadline'] < date('Y-m-d') && $status != 'done') {
                    $status = 'late';
                }
                $class = 'status-pending';
                if($status == 'done') $class = 'status-done';
                if($status == 'late') $class = 'status-late';
            ?>
                <div class="task-card <?= $class ?>">
                    <h4><?= htmlspecialchars($t['title']) ?></h4>
                    <div class="task-meta">
                        Kolegij: <?= htmlspecialchars($t['subject']) ?>
                        Rok: <?= $t['deadline'] ?>
                        Status: <b><?= $status ?></b>
                    </div>
                    <?php if($status != 'done'): ?>
                        <form method="post">
                            <input type="hidden" name="task_id" value="<?= $t['id'] ?>">
                            <button class="btn secondary" name="done_task">✔ Označi kao gotovo</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>