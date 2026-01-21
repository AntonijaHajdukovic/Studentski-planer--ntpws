<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Neispravan email ili lozinka.'
        ];
        header("Location: index.php?menu=7");
        exit;
    }
}
?>
<div class="page-card auth-card">
    <h2>Prijava</h2>
    <form method="post">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Lozinka" required><br><br>
    <button name="login">Prijavi se</button>
    </form>
    <div class="auth-switch">
        Nemaš račun?
        <a href="index.php?menu=6">Registriraj se</a>
    </div>
</div>