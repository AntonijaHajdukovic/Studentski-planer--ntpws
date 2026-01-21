<?php
if (!defined('__APP__')) die("Hacking attempt");
if(!isset($_SESSION['user_id'])) {
    echo "<p>Morate se prijaviti.</p>";
    return;
}
if(isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO subjects (user_id,name,professor,ects) VALUES (?,?,?,?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['name'],
        $_POST['profesor'],
        $_POST['ects']
    ]);
}
$stmt = $pdo->prepare("SELECT * FROM subjects WHERE user_id=?");
$stmt->execute([$_SESSION['user_id']]);
$subjects = $stmt->fetchAll();
?>
<div class="page-card">
  <h2>Moji kolegiji</h2>
  <form class="subject-form" method="post">
    <input type="text" name="name" placeholder="Naziv kolegija" required>
    <input type="text" name="profesor" placeholder="Profesor">
    <input type="number"name="ects" placeholder="ECTS">
    <button type="submit" class="btn primary" name="add">➕ Dodaj</button>
  </form>
  <div class="subjects-list">
      <?php foreach ($subjects as $s): ?>
          <div class="subject-item">
              <div>
                  <strong><?= htmlspecialchars($s['name']) ?></strong><br>
                  <span class="subject-meta">
                      <?= htmlspecialchars($s['professor']) ?> · <?= (int)$s['ects'] ?> ECTS
                  </span>
              </div>
          </div>
      <?php endforeach; ?>
  </div>
</div>