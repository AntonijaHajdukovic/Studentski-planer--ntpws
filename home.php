<?php
if (!defined('__APP__')) die("Hacking attempt");
if(isset($_SESSION['user_id'])) {

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM subjects WHERE user_id=?");
    $stmt->execute([$_SESSION['user_id']]);
    $subjects_count = $stmt->fetchColumn();

    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM tasks 
        JOIN subjects ON tasks.subject_id = subjects.id
        WHERE subjects.user_id=?
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $tasks_count = $stmt->fetchColumn();

    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM tasks 
        JOIN subjects ON tasks.subject_id = subjects.id
        WHERE subjects.user_id=?
          AND tasks.deadline < CURDATE()
          AND tasks.status != 'done'
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $late_count = $stmt->fetchColumn();
}
?>
<div class="page-card home-card">
    <h2 class="home-title">Studentski planer zadataka</h2>
    <p class="home-subtitle">
        Organiziraj kolegije, prati zadatke i rokove na jednom mjestu.
    </p>
    <img src="images/to_do_list.jpg" class="home-image">
    <?php if (isset($_SESSION['user_id'])): ?>
        <p class="home-welcome">Dobrodošla natrag! 🎓</p>
        <div class="home-actions">
            <a href="index.php?menu=2" class="home-action-link">Moji kolegiji</a>
            <a href="index.php?menu=3" class="home-action-link">Moji zadaci</a>
        </div>
    <?php else: ?>
        <div class="home-guest">
            <p class="home-guest-text">
                Dobrodošla! Prijavi se ili se registriraj.
            </p>
            <div class="home-actions">
                <a href="index.php?menu=7" class="btn primary">🔑 Prijava</a>
                <a href="index.php?menu=6" class="btn secondary">📝 Registracija</a>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <section class="stats-section">
            <h3 class="stats-title">Statistika</h3>
            <div class="stats">
                <div class="stat-card">
                    <h3><?= $subjects_count ?></h3>
                    <p>Kolegija</p>
                </div>
                <div class="stat-card">
                    <h3><?= $tasks_count ?></h3>
                    <p>Zadataka</p>
                </div>
                <div class="stat-card late">
                    <h3><?= $late_count ?></h3>
                    <p>Kasni zadaci</p>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>