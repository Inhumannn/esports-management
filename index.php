<!DOCTYPE html>
<html lang="fr-FR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/global.css" />
    <link rel="shortcut icon" href="public/logo.png" type="image/x-icon">
    <title>Esport - Accueil</title>
  </head>
  <!-- Inclus les composants dans la page principale -->
  <body id="page-main">
    <?php include 'components/header.php'; ?>
    <main>
      <h2>Tournois</h2>
      <?php include 'tournaments/displayTournaments.php' ?>
      <h2>Equipe</h2>
      <?php include 'teams/displayTeams.php' ?>
    </main>
    <?php include 'components/footer.php'; ?>
  </body>
</html>