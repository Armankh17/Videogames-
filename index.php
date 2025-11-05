<?php
require_once 'first.php';          // your DB connection (must define $conn)
$q = isset($_GET['q']) ? trim($_GET['q']) : '';  // read search term FIRST
include 'header-navbar.php';       // navbar uses $q to prefill the box
?>

<h1 class="mb-3">All Video Games</h1>

<?php
// Build query (W3Schools style with mysqli prepared statements)
if ($q !== '') {
  $sql  = "SELECT game_id, game_name, rating
           FROM videogames
           WHERE game_name LIKE ?
           ORDER BY game_name ASC";
  $stmt = mysqli_prepare($conn, $sql);
  $like = "%".$q."%";
  mysqli_stmt_bind_param($stmt, 's', $like);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
} else {
  // no search -> list all
  $sql = "SELECT game_id, game_name, rating FROM videogames ORDER BY game_name ASC";
  $result = mysqli_query($conn, $sql);
}
?>

<ul class="list-group">
<?php if ($result && mysqli_num_rows($result) > 0): ?>
  <?php while($row = mysqli_fetch_assoc($result)): ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="game-details.php?id=<?= (int)$row['game_id'] ?>" class="text-decoration-none">
        <?= htmlspecialchars($row['game_name'], ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <span class="badge bg-primary rounded-pill">
        <?= htmlspecialchars($row['rating'], ENT_QUOTES, 'UTF-8'); ?>
      </span>
    </li>
  <?php endwhile; ?>
<?php else: ?>
  <li class="list-group-item">No games found</li>
<?php endif; ?>
</ul>

<?php
if (isset($stmt)) { mysqli_stmt_close($stmt); }
if (isset($result) && gettype($result) === 'object') { mysqli_free_result($result); }
include 'footer.php';
