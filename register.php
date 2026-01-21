<?php
require 'db.php';
if(isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $pass       = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, username, email, password)
        VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $first_name,
        $last_name,
        $username,
        $email,
        $pass
    ]);
    $_SESSION['message'] = [
    'type' => 'success',
    'text' => 'Registracija uspješna! Sada se možeš prijaviti.'
];
    header("Location: index.php?menu=6");
    exit;
}
?>
<div class="page-card auth-card">
    <h2>Registracija</h2>
    <form method="post">
        <label for="fname">Ime *</label>
        <input type="text" id="fname" name="first_name" placeholder="Upišite ime.." required><br><br>
        <label for="lname">Prezime *</label>
        <input type="text" id="lname" name="last_name" placeholder="Upišite prezime.." required><br><br>
        <label for="username">Korisničko ime *</label>
        <input type="text" id="username" name="username" placeholder="Upišite korisničko ime.." required><br><br>
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" placeholder="Upišite email.." required><br><br>
        <label for="password">Lozinka *</label>
        <input type="password" id="password" name="password" placeholder="Upišite željenu lozinku.." required><br><br>
        <button name="register">Registriraj se</button>
    </form>
    <div class="auth-switch">
        Već imaš račun?
        <a href="index.php?menu=7">Prijavi se</a>
    </div>
</div>
