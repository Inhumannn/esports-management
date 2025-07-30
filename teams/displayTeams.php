<?php 
require_once('./config/connect.php'); 
$stmt = $pdo->prepare("SELECT * FROM teams");
// 
$stmt->execute();
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section id="section-teams">
  <?php foreach($teams as $team):?>
  <article class="section-teams-card">
    <h2><?= htmlspecialchars($team['name']) ?></h2>
    <div>
      <p><?= htmlspecialchars($team['team _member']) ?></p>
      <p><?= htmlspecialchars($team['role_in_team']) ?></p>
    </div>
    <p><?= htmlspecialchars($team['created_at']) ?></p>
  </article>
  <?php endforeach ?>
</section>
