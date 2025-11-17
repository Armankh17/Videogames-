<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include search logic
$games = include("search-games.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Games List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="games_list.php">My Game Collection</a>
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link active" href="games_list.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="add-game-form.php">Add Game</a></li>
        </ul>

        <!-- Search Form -->
        <form class="d-flex" method="GET" action="games_list.php">
            <input class="form-control me-2" type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
            <input class="form-control me-2" type="number" name="min_rating" placeholder="Min rating" min="0" max="10" value="<?= htmlspecialchars($_GET['min_rating'] ?? '') ?>">
            <input class="form-control me-2" type="number" name="max_rating" placeholder="Max rating" min="0" max="10" value="<?= htmlspecialchars($_GET['max_rating'] ?? '') ?>">
            <input class="form-control me-2" type="date" name="date_from" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
            <input class="form-control me-2" type="date" name="date_to" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>

<h1>List of All Games</h1>

<table class="table table-bordered mt-4">
    <tr class="table-secondary">
        <th>Game Name</th>
        <th>Description</th>
        <th>Rating</th>
        <th>Release Date</th>
        <th style="width: 180px;">Actions</th>
    </tr>

    <?php if (!empty($games)): ?>
        <?php foreach ($games as $row): ?>
            <tr>
                <td><a href="game-details.php?id=<?= $row['game_id']; ?>"><?= htmlspecialchars($row['game_name']); ?></a></td>
                <td><?= htmlspecialchars($row['game_description']); ?></td>
                <td><?= htmlspecialchars($row['rating']); ?></td>
                <td><?= htmlspecialchars($row['released_date']); ?></td>
                <td>
                    <a href="edit-game.php?id=<?= $row['game_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete-game.php?id=<?= $row['game_id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">No games found.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
