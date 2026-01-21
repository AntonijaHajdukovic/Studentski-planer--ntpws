<?php
if (!defined('__APP__')) die("Hacking attempt");

$role = $_SESSION['role'] ?? 'student';

$roleLabel = ($role === 'admin') ? 'Admin' : 'Student';

$stmt = $pdo->prepare("
    SELECT first_name, last_name, username, email
    FROM users
    WHERE id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<div class="page-card profile-page">
    <h2>Moj profil</h2>
    <div class="profile-header">
        <div class="profile-avatar">
            <?= strtoupper(substr($user['first_name'], 0, 1)) ?>
        </div>
        <div class="profile-role <?= $role === 'admin' ? 'role-admin' : 'role-student' ?>">
            <?= $role === 'admin' ? 'Admin' : 'Student' ?>
        </div>
    </div>
    <div class="profile-row">
        <span class="profile-label">Ime</span>
        <span class="profile-value"><?= htmlspecialchars($user['first_name']) ?></span>
    </div>
    <div class="profile-row">
        <span class="profile-label">Prezime</span>
        <span class="profile-value"><?= htmlspecialchars($user['last_name']) ?></span>
    </div>
    <div class="profile-row">
        <span class="profile-label">Korisničko ime</span>
        <span class="profile-value"><?= htmlspecialchars($user['username']) ?></span>
    </div>
    <div class="profile-row">
        <span class="profile-label">Email</span>
        <span class="profile-value"><?= htmlspecialchars($user['email']) ?></span>
    </div>
</div>
