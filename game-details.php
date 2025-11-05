<?php
// Connect to database
include 'first.php'; // use your new filename here

// Get id from URL
$id = $_GET['id'] ?? null;

if (!$id) {
  echo "<p>Invalid ID.</p>";
  exit;
}

$sql = "SELECT * FROM videogames WHERE game_id = $id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  ?>
  <h1><?= htmlspecialchars($row['game_name']); ?></h1>
  <p><?= nl2br(htmlspecialchars($row['game_description'])); ?></p>
  <p><strong>Release Date:</strong> <?= htmlspecialchars($row['released_date']); ?></p>
  <p><strong>Rating:</strong> <?= htmlspecialchars($row['rating']); ?></p>
  <a href="index.php"><< Back to list</a>
  <?php
} else {
  echo "<p>Game not found.</p>";
}

mysqli_free_result($result);
?>
