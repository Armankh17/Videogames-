<?php
// Connect to database
include("db_connect.php");

// Get the game ID from URL
$id = $_GET['id'];

// Fetch the game data
$result = mysqli_query($mysqli, "SELECT * FROM videogames WHERE id=$id");
$game = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Game</title>
</head>
<body>

<h1>Edit Game</h1>

<form action="update-game.php" method="post">
    <input type="hidden" name="id" value="<?php echo $game['id']; ?>">

    Game Name:<br>
    <input type="text" name="GameName" value="<?php echo $game['game_name']; ?>"><br><br>

    Description:<br>
    <textarea name="GameDescription" rows="5" cols="40"><?php echo $game['game_description']; ?></textarea><br><br>

    Date Released:<br>
    <input type="date" name="DateReleased" value="<?php echo $game['released_date']; ?>"><br><br>

    Rating:<br>
    <input type="number" name="GameRating" value="<?php echo $game['rating']; ?>"><br><br>

    <input type="submit" value="Update Game">
</form>

</body>
</html>
