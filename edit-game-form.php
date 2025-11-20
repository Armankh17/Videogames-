<?php
require_once __DIR__ . '/vendor/autoload.php';
include("db_connect.php");

// Twig setup
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

// Get game ID
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Game ID not provided.");
}

// Fetch game
$stmt = $mysqli->prepare("SELECT * FROM videogames WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$game = $result->fetch_assoc();

if (!$game) {
    die("Game not found.");
}

// Render Twig template and pass data
echo $twig->render('edit-game-form.twig', [
    'game' => $game
]);
