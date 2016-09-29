<?php
$db;
$dbName = $_SERVER['DOCUMENT_ROOT']."/projects/Shop151/Users/dbUsers.mdb";
if (!file_exists($dbName)) {
			die("Could not find database file.". $dbName);
}
$db = odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". $dbName ."; Uid=; Pwd=;","","") or die("Connect");
?>