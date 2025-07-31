<?php 
require_once('../config/connect.php');
if(!empty($_POST['nameTeam']) && !empty($_POST['create'])){
  $nameTeam = $_POST['nameTeam'];
  $stmt = $pdo->prepare('INSERT INTO teams (name) VALUE (:nameTeam)');
  $stmt->execute([
    'nameTeam' => $nameTeam
  ]);
}

$stmtRoles = $pdo->prepare('SELECT role_in_team FROM team_members');
$stmtRoles->execute();
$roles = $stmtRoles->fetchAll(PDO::FETCH_COLUMN)
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
  <body>
    <?php include '../components/header.php'; ?>
    <main>
      <section>
        <h2>Création de l'équipe</h2>
        <form action="#" method="post">
          <input type="text" name="nameTeam" id="nameTeam" placeholder="Nom de la team" required />
          <select name="role" id="role">
            <option value="" hidden></option>
            <?php foreach($roles as $role): ?>
              <option value="<?= htmlspecialchars($role) ?>"><?= htmlspecialchars($role) ?></option>
            <?php endforeach; ?>
          </select>
          <input type="submit" name="create" value="Créer" />
        </form>
      </section>
      <section>
        <h2>Rejoindre une équipe</h2>
        <form action="#" method="post">
          <?php include '../teams/displayTeams.php' ?>
          <input type="submit" name="joint" value="Rejoindre">
        </form>
          
        </form>
      </section>
    </main>
    <?php include '../components/footer.php'; ?>
  </body>
</html>
<?php 
// $name = $_SESSION['name'];
// $stmt = $pdo->prepare('INSERT INTO teams (name) VALUE (:nameTeam)');
// $stmt->execute([
//   'name' => $name
// ]);
?>