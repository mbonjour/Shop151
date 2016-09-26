<?php
$db;
$dbName = "E:\\ICH 151 - Shop Online\\env_Shop\\www\\Users\\dbUsers.mdb";
if (!file_exists($dbName)) {
			die("Could not find database file.");
}
$db = odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". $dbName ."; Uid=; Pwd=;","","") or die("Connect");
?>