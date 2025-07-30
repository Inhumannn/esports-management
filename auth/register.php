<?php
require_once('../config/connect.php');
session_start();

if (!empty($_POST['register'])) {
  $name = htmlspecialchars(trim($_POST['name']));
  $email = htmlspecialchars(trim($_POST['email']));
  $password = trim($_POST['password']);

  if (empty($name) || empty($email) || empty($password)) {
    exit("Attention : Tous les champs doivent être renseignés.");
  };

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $_SESSION['name'] = $name;
  $_SESSION['email'] = $email;
  $_SESSION['password'] = $hashedPassword;

  $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (:name, :email, :password)");
  $stmt->execute([
    'name' => $name,
    'email' => $email,
    'password' => $hashedPassword
  ]);

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
    <link rel="shortcut icon" href="public/logo.png" type="image/x-icon" />
    <title>Esport Incription</title>
  </head>
  <body id="page-register">
    <main>
      <h1>Formulaire</h1>
      <form action="#" method="post">
        <input type="text" name="name" id="name" placeholder=" Name" />
        <input type="email" name="email" id="email" placeholder=" Email" />
        <input
          type="password"
          name="password"
          id="password"
          placeholder=" Password"
        />
        <input type="submit" name="register" value="Enregister" />
      </form>
    </main>
  </body>
</html>
