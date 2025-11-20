<?php
require_once __DIR__ . '/vendor/autoload.php';
include("db_connect.php");

// Twig setup
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("No game ID provided.");
}

$id = intval($_GET['id']); // safe integer conversion

// Fetch game details
$stmt = $mysqli->prepare("SELECT * FROM videogames WHERE game_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$game = $result->fetch_assoc();

if (!$game) {
    die("Game not found!");
}

// Render template
echo $twig->render('game-details.twig', [
    'game' => $game
]);
