<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/global.css">
  <link rel="shortcut icon" href="../public/logo.png" type="image/x-icon">
  <title>Esport Profil</title>
</head>
<body>
  <?php include '../components/header.php'; ?>
  <main>
    <form action="#" method="post">
      <input type="submit" name="delete" value="Supprimer le compte">
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