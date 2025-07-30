<?php
session_start();
if(!empty($_POST['disconnection'])){
  session_unset(); 
  session_destroy(); 
}
?>
<header>
  <a href="/CP7_PENABERMOND_Thomas/"><h1>Esport</h1></a>
  <nav>
    <ul>
      <li><a href="#">Equipes</a></li>
      <li><a href="#">Tournoi</a></li>
      <li><a href="#">Competition</a></li>
      <?php if(empty($_SESSION['name']) || empty($_SESSION['email'])): ?>
        <li class="fail-auth"><a href="/CP7_PENABERMOND_Thomas/auth/register.php">Inscription</a></li>
        <li class="fail-auth"><a href="/CP7_PENABERMOND_Thomas/auth/login.php">Connection</a></li>
      <?php endif; ?>
      <?php if(!empty($_SESSION['name']) || !empty($_SESSION['email'])): ?>
        <li class="suc-auth">
          <a href="/CP7_PENABERMOND_Thomas/users/profils.php">Profil de <?= htmlspecialchars($_SESSION['name']) ?></a>
        </li>
        <li class="suc-auth">
          <form action="#" method="post">
            <input type="submit" name="disconnection" value="Deconexion">
          </form>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
