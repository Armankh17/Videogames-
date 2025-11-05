<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>DB Test</title>
</head>
<body>
<h2>MySQL Connection Test</h2>
<p>Status: <?php echo $conn ? "Connected ✔" : "Not connected ✖"; ?></p>

<?php
$sql = "SELECT * FROM videogames LIMIT 5";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  echo "<table border='1' cellpadding='6' cellspacing='0'>";
  // header
  $firstRow = mysqli_fetch_assoc($result);
  echo "<tr>";
  foreach(array_keys($firstRow) as $col){
    echo "<th>" . h($col) . "</th>";
  }
  echo "</tr>";
  // first row
  echo "<tr>";
  foreach($firstRow as $v){
    echo "<td>" . h($v) . "</td>";
  }
  echo "</tr>";
  // remaining rows
  while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    foreach($row as $v){
      echo "<td>" . h($v) . "</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
  mysqli_free_result($result);
} else {
  echo "<p>No rows found (or table name differs).</p>";
}
?>
</body>
</html>
