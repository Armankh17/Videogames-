<?php
// search-games.php
include("db_connect.php");

// Get search filters (if any)
$name        = $_GET['name']        ?? '';
$min_rating  = $_GET['min_rating']  ?? '';
$max_rating  = $_GET['max_rating']  ?? '';
$date_from   = $_GET['date_from']   ?? '';
$date_to     = $_GET['date_to']     ?? '';

// Base query
$sql = "SELECT * FROM videogames WHERE 1=1";

// Apply filters
if ($name != '') {
    $sql .= " AND game_name LIKE '%" . $mysqli->real_escape_string($name) . "%'";
}
if ($min_rating !== '') {
    $sql .= " AND rating >= " . intval($min_rating);
}
if ($max_rating !== '') {
    $sql .= " AND rating <= " . intval($max_rating);
}
if ($date_from != '') {
    $sql .= " AND released_date >= '" . $mysqli->real_escape_string($date_from) . "'";
}
if ($date_to != '') {
    $sql .= " AND released_date <= '" . $mysqli->real_escape_string($date_to) . "'";
}

$sql .= " ORDER BY released_date";

$results = mysqli_query($mysqli, $sql);

// Return results array
$games = [];
if ($results) {
    while ($row = mysqli_fetch_assoc($results)) {
        $games[] = $row;
    }
}

// You can return $games to the including page
return $games;
