<?php 
require_once('../config/connect.php'); // Inclusion du fichier connect.php
session_start(); // Démarre la session ou continue celle existante
$message = ""; // Initalise la variable pour l'utiliser par la suite grâce a sa porter global

if (!empty($_POST['connexion'])) { // Vérifie si le formulaire d'inscription a été soumis
  $email = htmlspecialchars(trim($_POST['email']));  // Protège des attaques XSS et supprime les espaces blancs
  $password = trim($_POST['password']);

  // Vérifie que tout les champs sont remplis
  if (empty($email) || empty($password)) {
    exit("Attention : Tous les champs doivent être renseignés.");
  };

  // Réquipère l'adresse mail dans la bdd
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
  $stmt->execute([
    'email' => $email
  ]);
  $user = $stmt->fetch(); // retourne un objet json

  // Vérification du mot de passe est correct
  if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['name'] = $user['username']; // stocke le nom dans la session
        $_SESSION['email'] = $user['email']; // email le nom dans la session
        header('Location: /CP7_PENABERMOND_Thomas/index.php'); // Puis nous redirige sur la page principale
        exit(); // stop le script
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