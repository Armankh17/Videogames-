<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once "db_connect.php";
require_once "search-games.php";

// Collect search filters
$filters = [
    'name'       => $_GET['name']       ?? '',
    'min_rating' => $_GET['min_rating'] ?? '',
    'max_rating' => $_GET['max_rating'] ?? '',
    'date_from'  => $_GET['date_from']  ?? '',
    'date_to'    => $_GET['date_to']    ?? '',
];

// Get games (your original search file)
$games = searchGames($mysqli, $filters);

// Setup Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false
]);

// Render template
echo $twig->render('games_list.twig', [
    'games'   => $games,
    'filters' => $filters,
]);
