<?php
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<p>Nemate pristup admin sučelju.</p>";
    return;
}
?>
<div class="page-card">
    <h1 class="admin-title">Admin panel</h1>
    <div class="admin-menu">
        <a class="admin-btn" href="index.php?menu=8&action=users">👤 Upravljanje korisnicima</a>
        <a class="admin-btn" href="index.php?menu=8&action=tasks_json">📝 Pregled svih zadataka (JSON)</a>
    </div>
</div>
<?php
$view = $_GET['view'] ?? '';
if($view == 'users') include("users.php");
else if($view == 'tasks') include("tasks.php");
?>
