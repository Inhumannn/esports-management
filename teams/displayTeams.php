<?php 
require_once('./config/connect.php'); 
$stmt = $pdo->prepare("SELECT teams.name, teams.created_at, users.username, team_members.role_in_team FROM teams LEFT JOIN team_members ON teams.id = team_members.team_id LEFT JOIN users ON team_members.user_id = users.id");
$stmt->execute();
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section id="section-teams">
  <?php foreach($teams as $team):?>
  <article class="section-teams-card">
    <h2><?= htmlspecialchars($team['name'] ?? 'Nom de la teams' )?></h2>
    <div>
      <p><?= htmlspecialchars($team['username'] ?? 'utilisateur dans la teams' )?></p>
      <p><?= htmlspecialchars($team['role_in_team'] ?? 'role de l\'utilisateur' )?></p>
    </div>
    <p><?= htmlspecialchars($team['created_at'] ?? 'date de création de la teams' )?></p>
  </article>
  <?php endforeach ?>
</section>