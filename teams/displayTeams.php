<?php
// Récupère les inforamtions des équipes, membres et utilisateurs en fesant une jointure
$stmt = $pdo->prepare("SELECT teams.name, teams.created_at, users.username, team_members.role_in_team FROM teams LEFT JOIN team_members ON teams.id = team_members.team_id LEFT JOIN users ON team_members.user_id = users.id");
$stmt->execute();
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section id="section-teams">
  <!-- Utilisation d'une boucle pour afficher les résultats -->
  <?php foreach($teams as $team):?>
  <article class="section-teams-card">
    <!-- Nom de l'équipe -->
    <h3><?= htmlspecialchars($team['name'] ?? 'Nom de la teams' )?></h3>
    <div>
      <!-- Nom du membre -->
      <p><?= htmlspecialchars($team['username'] ?? 'utilisateur dans la teams' )?></p>
      <!-- role de l'équipe -->
      <p><?= htmlspecialchars($team['role_in_team'] ?? 'role de l\'utilisateur' )?></p>
    </div>
    <!-- date de création de l'équipe -->
    <p><?= htmlspecialchars($team['created_at'] ?? 'date de création de la teams' )?></p>
  </article>
  <?php endforeach ?>
</section>