<?php
define('__APP__', TRUE);

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include("db.php");

$menu = isset($_GET['menu']) ? (int)$_GET['menu'] : 1;
$action = isset($_GET['action']) ? $_GET['action'] : null;
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css?v=<?= time() ?>">
        <?php if ($menu == 8): ?>
        <link rel="stylesheet" href="admin.css">
        <?php endif; ?>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <meta http-equiv="content-type" content="text/html">
        <meta charset="utf-8">
        <meta name="description" content="student planner for school subjects">
        <meta name="keywords" content="student, planner, subjects, organization">
        <meta name="author" content="ahajdukov@tvz.hr">
        <title>Studentski planer</title>
    </head>
<body>
    <header>
    <nav>
        <?php include("menu.php"); ?>
    </nav>
    </header>

    <main>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
            <?= $_SESSION['message']['text'] ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <?php
    if($menu == 1) include("home.php");
    else if($menu == 2) include("subjects.php");
    else if($menu == 3) include("tasks.php");
    else if($menu == 4) include("contact.php");
    else if($menu == 5) include("profile.php");
    else if($menu == 6) include("register.php");
    else if($menu == 7) include("signin.php");
    else if ($menu == 8) {
        if ($action == 'users') {
            include("admin/users.php");
        } elseif ($action == 'tasks_json') {
            include("admin/tasks_json.php");
        } elseif ($menu == 8 && $action == 'edit_task') {
        include("admin/edit_task.php");
        } elseif ($menu == 8 && $action == 'update_task' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("
                UPDATE tasks 
                SET title=?, deadline=?, status=? 
                WHERE id=?
            ");
            $stmt->execute([
                $_POST['title'],
                $_POST['deadline'],
                $_POST['status'],
                (int)$_POST['id']
            ]);
            header("Location: index.php?menu=8");
            exit;
        } elseif ($action == 'delete_task') {
            include("admin/delete_task.php");
        }
        else {
            include("admin/admin.php");
            }
        }
    ?>
    </main>

    <footer>	
    <p>&copy; <?= date("Y") ?> Studentski planer</p>
    </footer>
</body>
</html>
