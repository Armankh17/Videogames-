<?php
include("db_connect.php");

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("No game selected.");
}

$game_id = intval($_GET['id']);

// Get game data
$sql = "SELECT * FROM videogames WHERE game_id = $game_id";
$result = mysqli_query($mysqli, $sql);
$game = mysqli_fetch_assoc($result);

if (!$game) {
    die("Game not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($mysqli, $_POST['game_name']);
    $rating = mysqli_real_escape_string($mysqli, $_POST['rating']);
    $released = mysqli_real_escape_string($mysqli, $_POST['released_date']);

    $update = "
        UPDATE videogames 
        SET game_name='$name', rating='$rating', released_date='$released'
        WHERE game_id=$game_id
    ";

    mysqli_query($mysqli, $update);

    header("Location: games_list.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Edit Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>Edit Game</h2>

<form method="POST">
    <div class="mb-3">
        <label>Game Name</label>
        <input type="text" name="game_name" class="form-control"
               value="<?= htmlspecialchars($game['game_name']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Rating</label>
        <input type="number" name="rating" class="form-control"
               value="<?= htmlspecialchars($game['rating']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Release Date</label>
        <input type="date" name="released_date" class="form-control"
               value="<?= htmlspecialchars($game['released_date']); ?>" required>
    </div>

    <button class="btn btn-success">Save Changes</button>
    <a href="games_list.php" class="btn btn-secondary">Cancel</a>
</form>

</body>
</html>
