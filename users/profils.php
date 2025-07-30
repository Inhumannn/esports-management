<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/global.css">
  <link rel="shortcut icon" href="../public/logo.png" type="image/x-icon">
  <title>Esport Profil</title>
</head>
<body id="page-profils">
  <?php include '../components/header.php'; ?>
  <main>
    <form action="#" method="post">
      <div>
        <label for="name">Name : <?= htmlspecialchars($_SESSION['name']) ?></label>
        <input type="text" name="name" id="name" placeholder=" Nouveau Name" />
        <input type="submit" name="changeName" value="Changer">
      </div>
      <div>
        <label for="email">Email : <?= htmlspecialchars($_SESSION['email']) ?></label>
        <input type="email" name="email" id="email" placeholder=" Nouvelle Email" />
        <input type="submit" name="changeEmail" value="Changer">
      </div>
      <div>
        <label for="password">Mot de passe : </label>
        <input
        type="password"
        name="password"
        id="password"
        placeholder=" Password"
        />
        <input
        type="password"
        name="password"
        id="password"
        placeholder=" Nouveaux Password"
        />
        <input type="submit" name="changePassword" value="Changer">
      </div>
      <input type="submit" name="delete" class="delete" value="Supprimer le compte">
    </form>
  </main>
  <?php include '../components/footer.php'; ?>
</body>
</html>
<?php
require_once('../config/connect.php');
if(!empty($_SESSION['name']) || !empty($_SESSION['email'])){
  if(!empty($_POST['delete'])){
    $stmt = $pdo->prepare("DELETE FROM users WHERE email = :email");
    $stmt->execute([
      'email' => $_SESSION['email']
    ]);
    session_unset(); 
    session_destroy();
    header('location: /CP7_PENABERMOND_Thomas/');
    exit();
  }
}
?>
<?php 
if (!empty($_POST['changeName']) || !empty($_POST['changeEmail']) || !empty($_POST['changePassword'])){
  if(!empty($_POST['changeName']) && !empty($_POST['name'])){
    // a faire
  }
  if(!empty($_POST['changeEmail']) && !empty($_POST['email'])){
    // a faire
  }
  if(!empty($_POST['changePassword']) && !empty($_POST['password'])){
    // a faire
  }
}
?>