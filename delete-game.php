<?php
include("db_connect.php");

// Make sure ID exists
if (!isset($_GET['id'])) {
    die("No game selected.");
}

$game_id = intval($_GET['id']);

$delete = "DELETE FROM videogames WHERE game_id = $game_id";
mysqli_query($mysqli, $delete);

// Redirect back to list
header("Location: games_list.php");
exit;
?>
