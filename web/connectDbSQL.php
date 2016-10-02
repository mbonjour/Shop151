<?php
$conn;
$servername = "localhost";
$username = "projet151";
$password = "projet151";
$dbName="projet151";

$db = mysql_connect($servername, $username, $password) or die ('erreur connexion SQL');
mysql_select_db($dbName,$db);
?>