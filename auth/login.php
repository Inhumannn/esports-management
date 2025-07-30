<?php 
require_once('../config/connect.php');
session_start();
$message = "";

if (!empty($_POST['connexion'])) {
  $email = htmlspecialchars(trim($_POST['email']));
  $password = trim($_POST['password']);

  if (empty($email) || empty($password)) {
    exit("Attention : Tous les champs doivent être renseignés.");
  };

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
  $stmt->execute([
    'email' => $email
  ]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['name'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        header('Location: /CP7_PENABERMOND_Thomas/index.php');
        exit();
    } else {
        $message = '<p style="color:red;">Mauvais identifiants</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr-FR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/global.css" />
    <link rel="shortcut icon" href="../public/logo.png" type="image/x-icon" />
    <title>Esport Incription</title>
  </head>
  <body id="page-login">
    <main>
      <h1>Formulaire</h1>
      <form action="#" method="post">
        <input type="email" name="email" id="email" placeholder=" Email" required/>
        <input
        type="password"
        name="password"
        id="password"
        placeholder=" Password"
        required/>
        <input type="submit" name="connexion" value="Connexion" />
      </form>
      <?= $message ?>
    </main>
  </body>
</html>