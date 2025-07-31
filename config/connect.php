<?php
// Paramètres pour la connexion a la base de données
$host = 'localhost'; // Hote de la base de données
$dbname = 'esports'; // Nom de la base de données
$username = 'esportAdmin'; // Nom d'utilisateur pour se connecter a la base de données
$password = 'esport1234'; // Mot de passe de l'utilisateur
try {
  // PDO pour se connecter à la base de données
  $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8",
    $username,
    $password,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );
} catch (PDOException $e) {
  // Message d'erreur en cas d'échecs au niveau de la connexion de la base de données
  die("Erreur de connexion : ".$e->getMessage());
};
?>