<?php
require_once __DIR__ . '/vendor/autoload.php';

// Twig setup
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

// Render the Twig template
echo $twig->render('add-game-form.twig');
