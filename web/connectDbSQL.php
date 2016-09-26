<?php
$conn;
$servername = "localhost";
$username = "projet151";
$password = "projet151";

$conn = new PDO("mysql:host=$servername;dbname=projet151", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>