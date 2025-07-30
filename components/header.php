<?php session_start(); ?>
<header>
  <a href="/CP7_PENABERMOND_Thomas/"><h1>Esport</h1></a>
  <nav>
    <ul>
      <li><a href="#">Equipes</a></li>
      <li><a href="#">Tournoi</a></li>
      <li><a href="#">Competition</a></li>
      <?php if(empty($_SESSION['name']) || empty($_SESSION['email'])): ?>
        <li class="fail-auth"><a href="/auth/register.php">Inscription</a></li>
        <li class="fail-auth"><a href="/auth/login.php">Connection</a></li>
      <?php endif; ?>
      <?php if(!empty($_SESSION['name']) || !empty($_SESSION['email'])): ?>
        <li class="suc-auth">Bonjour, <?= htmlspecialchars($_SESSION['name']) ?> !</li>
        <li class="suc-auth">
          <a href="/CP7_PENABERMOND_Thomas/users/profils" ><img src="/public/pfp.webp" alt="image de profil de l'utilisateur"/></a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
