<?php $current = $menu ?? 1; ?>

<ul>
  <li><a href="index.php?menu=1" class="<?= $current==1 ? 'active' : '' ?>">Početna</a></li>
  <li><a href="index.php?menu=4" class="<?= $current==4 ? 'active' : '' ?>">Kontakt</a></li>
  
  <?php if(isset($_SESSION['user_id'])): ?>
    <li><a href="index.php?menu=2" class="<?= $current==2 ? 'active' : '' ?>">Kolegiji</a></li>
    <li><a href="index.php?menu=3" class="<?= $current==3 ? 'active' : '' ?>">Zadaci</a></li>
    <li><a href="index.php?menu=5" class="<?= $current==5 ? 'active' : '' ?>">Profil</a></li>
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <li><a href="index.php?menu=8" class="<?= $current==8 ? 'active' : '' ?>">Admin</a></li>
    <?php endif; ?>
    <li><a href="signout.php">Odjava</a></li>
  <?php else: ?>
    <li><a href="index.php?menu=7">Prijava</a></li>
    <li><a href="index.php?menu=6">Registracija</a></li>
  <?php endif; ?>
</ul>

