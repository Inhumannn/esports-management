<?php 
require_once('./config/connect.php'); 
$stmt = $pdo->prepare("SELECT name, game, description, start_date, end_date FROM tournaments");
$stmt->execute();
$tournaments= $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section id="section-tournaments">
  <?php foreach($tournaments as $tournament):?>
  <article class="section-tournaments-card">
    <div class="title-game">
      <h2><?= htmlspecialchars($tournament['name']) ?></h2>
      <h3><?= htmlspecialchars($tournament['game']) ?></h3>
    </div>
    <p><?= htmlspecialchars($tournament['description']) ?></p>
    <div class="date">
      <p><?= htmlspecialchars($tournament['start_date']) ?></p>
      <p><?= htmlspecialchars($tournament['end_date']) ?></p>
    </div>
  </article>
  <?php endforeach ?>
</section>
