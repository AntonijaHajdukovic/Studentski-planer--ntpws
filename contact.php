<?php
if (!defined('__APP__')) die("Hacking attempt");
if (isset($_POST['send'])) {
    $stmt = $pdo->prepare("
        INSERT INTO contact_messages (first_name,last_name, email, message)
        VALUES (?, ?, ?,?)
    ");
    $stmt->execute([
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['message']
    ]);
    $_SESSION['message'] = [
        'type' => 'success',
        'text' => 'Poruka je poslana. Hvala!'
    ];
    header("Location: index.php?menu=4");
    exit;
}
?>
<h2>Kontakt</h2>
    <div class="map-section">
        <h3>Gdje se nalazimo</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2781.0175351144535!2d16.03896387577984!3d45.81090721023981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4766790020667469%3A0xa9a20d6e234405b1!2sTehni%C4%8Dko%20veleu%C4%8Dili%C5%A1te%20u%20Zagrebu%20(TVZ)%20-%20INRO!5e0!3m2!1shr!2shr!4v1769030041341!5m2!1shr!2shr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
<div class="page-card auth-card">
    <form method="post">
        <label for="first_name">Ime *</label>
        <input type="text" name="first_name" placeholder="Ime" required><br><br>
        <label for="last_name">Prezime *</label>
        <input type="text" name="last_name" placeholder="Prezime" required><br><br>
        <label for="email">Email *</label>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <label for="message">Ostavite poruku *</label>
        <textarea name="message" placeholder="Vaša poruka..." required></textarea><br><br>
        <button name="send" class="btn primary">Pošalji</button>
    </form>
</div>
