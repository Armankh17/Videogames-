<?php
include("db_connect.php");

// Make sure form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name        = $_POST['GameName'];
    $description = $_POST['GameDescription'];
    $date        = $_POST['DateReleased'];
    $rating      = $_POST['GameRating'];

    // Prepare insert safely
    $stmt = $mysqli->prepare("
        INSERT INTO videogames (game_name, game_description, released_date, rating)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("sssi", $name, $description, $date, $rating);

    if ($stmt->execute()) {
        // Redirect back to game list after adding
        header("Location: games_list.php?added=1");
        exit;
    } else {
        echo "<p>Error adding game: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "<p>No form data received.</p>";
}
?>
