<?php
if (!defined('__APP__')) die("Hacking attempt");
$stmt = $pdo->query("
    SELECT first_name, last_name, username, email, role
    FROM users
");
$users = $stmt->fetchAll();
?>
<div class="page-card">
  <h3>Svi korisnici</h3>
  <div class="admin-table-wrapper">
    <table class="admin-table" border="1" cellpadding="5" cellspacing="0">
      <tr>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Korisničko ime</th>
        <th>Email</th>
        <th>Uloga</th>
      </tr>
      <?php foreach ($users as $u): ?>
        <tr>
          <td><?= htmlspecialchars($u['first_name']) ?></td>
          <td><?= htmlspecialchars($u['last_name']) ?></td>
          <td><?= htmlspecialchars($u['username']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td><?= htmlspecialchars($u['role']) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <a class="admin-back" href="index.php?menu=8">← Natrag na admin</a>
</div>
