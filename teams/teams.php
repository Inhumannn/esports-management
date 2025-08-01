<?php 
require_once('../config/connect.php');
session_start(); // Démarre la session ou continue celle existante  

// Vérifie que l'utilisateur est connecter
if(isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}else {
  echo "Veuillez vous connecter pour réer une équipe !";
  exit();
}
// Création d'une équipe avec ajout automatique du premier membre
if(!empty($_POST['nameTeam']) && !empty($_POST['create'])){
  $nameTeam = $_POST['nameTeam'];

  // Insertion du nom de la team dans la table teams
  $stmt = $pdo->prepare('INSERT INTO teams (name) VALUES (:nameTeam)');
  $stmt->execute([
    'nameTeam' => $nameTeam
  ]);

  // Récupère l'id de la team
  $teamId = $pdo->lastInsertId();

  // Récupère l'id de users grace a l'email
  $stmtCheck = $pdo->prepare('SELECT id FROM users WHERE email = :email');
  $stmtCheck->execute([
    'email' => $email
  ]);
  $user = $stmtCheck->fetch(PDO::FETCH_ASSOC);

  if(!empty($user)) {
    $userId = $user['id'];
    // Ajout de l'utilisateur dans la team après l'avoir créer initialisement
    $stmtInsert = $pdo->prepare('INSERT INTO team_members (team_id, user_id) VALUES (?, ?)');
    $stmtInsert->execute([$teamId, $userId]);
    echo "lskfj";
  }
  // ---
  // vérifier qu'il est déjà dans un team pour qu'il ne puisse pas être deux fois dans la meme team
  // faire en sorte que le role attribuer sois respecter$
  // ---
  $stmtRoles = $pdo->prepare('SELECT role_in_team FROM team_members');
  $stmtRoles->execute();
  $roles = $stmtRoles->fetchAll(PDO::FETCH_COLUMN);
};
// Rejoindre une équipe
if(!empty($_POST['name']) && !empty($_POST['joint'])){
  // Récupère tout les id et name des teams
  $stmtTeams = $pdo->prepare('SELECT id, name FROM teams');
  $stmtTeams->execute();
  $teams = $stmtTeams->fetchAll(PDO::FETCH_ASSOC);

  $name = $_POST['name']; // Récupère le nom de l'équipe pour ensuite se rejouter dedans
  $teamId = '';
  // boucle foreach pour trouver l'id du nom de la team
  foreach($teams as $team){
    if($name === $team['name']){
      $teamId = $team['id'];
      break;
    }
  }

  // Récupère tout les id et les mails des utilisateurs
  $stmtCheck = $pdo->prepare('SELECT id, email FROM users');
  $stmtCheck->execute();
  $checks = $stmtCheck->fetchAll(PDO::FETCH_ASSOC);
  // boucle foreach pour trouver l'id de l'email qui est en sessions
  foreach($checks as $check){
    if($email === $check['email']){
      $userId = $check['id'];
      break;
    }
  }
  // Fait une vérification en récupérant tout les id des users
  $stmtVerif = $pdo->prepare('SELECT user_id FROM team_members');
  $stmtVerif->execute();
  $verif = $stmtVerif->fetchAll(PDO::FETCH_COLUMN);

  // if l'équipe et l'utilisateur existe et qu'il est pas déjà dans une équipe alors
  if(!empty($teamId) && !empty($userId) && !in_array($userId, $verif)){
  // On l'insère dans l' équipe
  $stmtInsert = $pdo->prepare('INSERT INTO team_members (team_id, user_id) VALUES (?, ?)');
  $stmtInsert->execute([$teamId, $userId]);
  echo "bien ajouté"; // Vérification que ça est bien marcher
  } else {
    echo " Tu fais déjà parti d'une équipe";
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
    <title>Esport Team</title>
  </head>
  <body id="teams">
    <?php include '../components/header.php'; ?>
    <main>
      <section>
        <h2>Création de l'équipe</h2>
        <form action="#" method="post">
          <input type="text" name="nameTeam" id="nameTeam" placeholder="Nom de la team" required />
          <select name="role" id="role">
            <option value="" hidden></option>
              <option value="captain">captain</option>
              <option value="organisateur">organisateur</option>
              <option value="member">member</option>
          </select>
          <input type="submit" name="create" value="Créer" />
        </form>
      </section>
      <section>
        <h2>Rejoindre une équipe</h2>
        <form action="#" method="post">
          <div>
            <input type="text" name="name" id="name" placeholder="Nom de la team" required >
            <input type="submit" name="joint" value="Rejoindre">
            <input type="submit" name="retrenchment" value="Se rétracter">
          </div>
          <?php include '../teams/displayTeams.php'; ?>
        </form>
          
        </form>
      </section>
    </main>
    <?php include '../components/footer.php'; ?>
  </body>
</html>