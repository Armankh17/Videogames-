<?php
// Disable error reporting (to avoid file paths or debugging output in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
include("db_connect.php");

// Get the game ID from the URL
if (!isset($_GET['id'])) {
    echo "No game ID provided.";
    exit();
}

$id = intval($_GET['id']); // Ensure it's an integer to prevent SQL injection

// Fetch the game details from the database
$sql = "SELECT * FROM videogames WHERE game_id=$id"; // Ensure the column name is correct
$result = mysqli_query($mysqli, $sql);

// Check for any SQL query errors
if (!$result) {
    echo "Error running query: " . mysqli_error($mysqli);
    exit();
}

// Fetch the game data from the result
$game = mysqli_fetch_assoc($result);

// If the game does not exist, show an error message
if (!$game) {
    echo "Game not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($game['game_name']); ?> - Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        h1 { color: #333; }
        p { line-height: 1.5; }
        a { text-decoration: none; color: #007BFF; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h1><?php echo htmlspecialchars($game['game_name']); ?></h1>

<p><strong>Description:</strong><br>
<?php echo nl2br(htmlspecialchars($game['game_description'])); ?></p>

<p><strong>Date Released:</strong> <?php echo htmlspecialchars($game['released_date']); ?></p>
<p><strong>Rating:</strong> <?php echo htmlspecialchars($game['rating']); ?></p>

<p><a href="games_list.php">Back to all games</a></p>

</body>
</html>
