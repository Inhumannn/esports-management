<?php
require_once('../config/connect.php'); // Inclusion du fichier connect.php
session_start(); // Démarre la session ou continue celle existante

if (!empty($_POST['register'])) { // Vérifie si le formulaire d'inscription a été soumis
  // Récupère et arrange les données du formulaires
  $name = htmlspecialchars(trim($_POST['name'])); // Protège des attaques XSS et supprime les espaces blancs
  $email = htmlspecialchars(trim($_POST['email']));
  $password = trim($_POST['password']);

  // Vérifie que tout les champs sont remplis
  if (empty($name) || empty($email) || empty($password)) {
    exit("Attention : Tous les champs doivent être renseignés.");
  };

  // Sachage du mot de passe 
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Stock les informations en sessions
  $_SESSION['name'] = $name;
  $_SESSION['email'] = $email;
  $_SESSION['password'] = $hashedPassword;

  // Insère un nouvelle utilisateur avec de nouvelle valeurs
  $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (:name, :email, :password)");
  $stmt->execute([
    'name' => $name,
    'email' => $email,
    'password' => $hashedPassword
  ]);

  // Vérifie que la ligne a était insérer donc fonctionnelle
  if ($stmt->rowCount() > 0) {
    $lastId = $pdo->lastInsertId();
    echo "<p style='color: green;'>Nouveau membre ajouté avec succès. ID inséré : $lastId</p>";
    echo "<p>Bienvenu, ".$_SESSION['name']."! </p>";
    echo '<meta http-equiv="refresh" content="3;url=../index.php">';
    exit();
  } else {
    echo "Aucune ligne insérée";
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
  <body id="page-register">
    <main>
      <h1>Formulaire</h1>
      <form action="#" method="post">
        <input type="text" name="name" id="name" placeholder=" Name" required/>
        <input type="email" name="email" id="email" placeholder=" Email" required/>
        <input
          type="password"
          name="password"
          id="password"
          placeholder=" Password"
        required/>
        <input type="submit" name="register" value="Enregister" />
      </form>
    </main>
  </body>
</html>