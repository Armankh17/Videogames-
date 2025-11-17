<?php
$mysqli = new mysqli("localhost","2451365","Ariankh1777@","db2451365");
if ($mysqli -> connect_errno) {
echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
}
?>