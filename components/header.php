<?php
session_start(); // Démarre la session ou continue celle existante
// Si le formulaire est sousmis (bouton cliqué)
if(!empty($_POST['disconnection'])){
  session_unset(); // On supprime toutes les variables de la sessions
  session_destroy(); // Puis on détruit la session
  // se qui nous déconnecte
}
?>
<header>
  <a href="/CP7_PENABERMOND_Thomas/"><h1>Esport</h1></a>
  <nav>
    <ul>
      <li><a href="/CP7_PENABERMOND_Thomas/teams/teams.php">Equipes</a></li>
      <li><a href="/CP7_PENABERMOND_Thomas/tournaments/tournaments.html">Tournoi</a></li>
      <li><a href="/CP7_PENABERMOND_Thomas/competition/competition.html">Competition</a></li>
      <!-- Lien de navigation si l'utilisateur n'ai pas connecter -->
      <?php if(empty($_SESSION['name']) || empty($_SESSION['email'])): ?>
        <li class="fail-auth"><a href="/CP7_PENABERMOND_Thomas/auth/register.php">Inscription</a></li>
        <li class="fail-auth"><a href="/CP7_PENABERMOND_Thomas/auth/login.php">Connection</a></li>
      <?php endif; ?>
      <!-- Lien de navigation si l'utilisateur est connecter -->
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
