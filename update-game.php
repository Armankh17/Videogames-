<?php
// Connect to database
include("db_connect.php");

// Get form data
$id = $_POST['id'];
$name = $_POST['GameName'];
$description = $_POST['GameDescription'];
$date = $_POST['DateReleased'];
$rating = $_POST['GameRating'];

// Update the record
$sql = "UPDATE videogames SET game_name='$name', game_description='$description', released_date='$date', rating='$rating' WHERE id=$id";

if (mysqli_query($mysqli, $sql)) {
    echo "Record updated successfully. <a href='games_list.php'>View games</a>";
} else {
    echo "Error updating record: " . mysqli_error($mysqli);
}

mysqli_close($mysqli);
?>
