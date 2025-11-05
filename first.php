<?php

$servername = "localhost";
$username   = "2451365";
$password   = "Ariankh1777@";
$dbname     = "db2451365";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
