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
        name="oldPassword"
        id="oldPassword"
        placeholder=" Ancien password"
        />
        <input
        type="password"
        name="newPassword"
        id="newPassword"
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
// verifie que l'utilisateur est bien connecté
if(!empty($_SESSION['name']) || !empty($_SESSION['email'])){
  // Puis si le formulaire a était envoyé
  if(!empty($_POST['delete'])){ 
    // supprime l'utilisateur de la base de données
    $stmt = $pdo->prepare("DELETE FROM users WHERE email = :email");
    $stmt->execute([
      'email' => $_SESSION['email']
    ]);
    // Supprime les données ainsi que la session de l'utilisateur
    session_unset(); 
    session_destroy();
    header('location: /CP7_PENABERMOND_Thomas/');
    exit();
  }
}
?>
<?php
// Mise à jour des informations utilisateurs
if (!empty($_POST['changeName']) || !empty($_POST['changeEmail']) || !empty($_POST['changePassword'])){
  // récupère l'email qui est en session
  $email = $_SESSION['email'];
  // Modifie le nom de l'utilisateur
  if(!empty($_POST['changeName']) && !empty($_POST['name'])){
    $stmt = $pdo->prepare('UPDATE users SET username = :name WHERE email = :email'); // mets a jour la bdd
    $stmt->execute([
      'name' => $_POST['name'],
      'email' => $email
    ]);
    $_SESSION['name'] = $_POST['name']; // mets a jour la session
    header('location: /CP7_PENABERMOND_Thomas/');
    exit();
  }
  // Modifie l'email de l'utilisateur
  if(!empty($_POST['changeEmail']) && !empty($_POST['email'])){
    $stmt = $pdo->prepare('UPDATE users SET email = :newEmail WHERE email = :email'); // mets a jour la bdd
    $stmt->execute([
      'newEmail' => $_POST['email'],
      'email' => $email
    ]);
    $_SESSION['email'] = $_POST['email']; // mets a jour la session
    header('location: /CP7_PENABERMOND_Thomas/');
    exit();
  }
  // Modifie le mdp de l'utilisateur
  if(!empty($_POST['changePassword']) && !empty($_POST['oldPassword']) && !empty($_POST['newPassword'])){
    $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE email = :email');
    $stmt->execute([
      'email' => $email
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // Vérifie l'ancien mot de passe puis hash le nouveau mdp
    if($user && password_verify($_POST['oldPassword'], $user['password_hash'])){
      $newHash = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
      $stmt = $pdo->prepare('UPDATE users SET password_hash = :newHash WHERE email = :email');
      $stmt->execute([
        'newHash' => $newHash,
        'email' => $email
      ]);
      // données stocker seulement en bdd donc pas de mise a jour de sessions
      header('location: /CP7_PENABERMOND_Thomas/');
      exit();
    }
  }
}
?>