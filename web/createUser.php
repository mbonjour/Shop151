<!--
Auteur : "Mickael Bonjour <mbonjour@protonmail.ch>"
Date : 03.05.2016
Version 1.00
Inter D�pendances : (Fichiers d�pendants)
-->

<?php
session_start();
    
    // Identificateurs
	$dbNameAccess = "F:\\ICH 151 - Shop Online\\env_Shop\\www\\Users\\dbUsers.mdb";

	if ( isset($_POST['submit']) )
	{
        if (!file_exists($dbNameAccess)) {
			die("Could not find database file.");
		}
		$db = odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". $dbNameAccess ."; Uid=; Pwd=;","","") or die("Connect");
		$sql  = "INSERT INTO users (username,password) VALUES ('".$_POST['pseudo']."','".$_POST['motpasse']."')";
		$result = odbc_do($db, $sql) or die( odbc_error($db) );
		odbc_close($db);

		$servername = "localhost";
		$username = "projet151";
		$password = "projet151";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=projet151", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO t_client (Prenom, Nom, Date_Naissance)
			VALUES ('".$_POST['prenom']."', '".$_POST['nom']."', '".$_POST['birth']."')";
			// use exec() because no results are returned
			$conn->exec($sql);
		}
		catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
		$conn = null;
    }
        
    
?>
<!--Mettre CSS ce sera plus simple-->
<html>
	<head>
		<title>Home</title>
		<meta charset=utf-8/>
	</head>
	
	<body>
		<?php
		include('header.php');
		?>
		<main>
			
<form method="post" action="createUser.php">
		<h2>Authentification personnelle</h2>
		
		<!-- Vérifier tout les champs !!! -->
		<p> 
			<label for="nom">UTILISATEUR : </label> 
			<input type="text" name="pseudo" value=""> 
		</p> 
		<p> 
			<label for="nom">Prénom : </label> 
			<input type="text" name="prenom" value=""> 
		</p> 
		<p> 
			<label for="motdepasse">MOT DE PASSE : </label> 
			<input type="password" name="motpasse"> 
		</p>
		<p> 
			<label for="nom">Nom de famille : </label> 
			<input type="text" name="nom" value=""> 
		</p>
		<p> 
			<label for="nom">Date de naissance : </label> 
			<input type="date" name="birth">
		</p>
		
		<p> 
			<input type="submit" name="submit"value="IDENTIFIER"> 
		</p> 
		</form>
		</main>
		<?php
		include('footer.php');
		?>
	</body>
</html>
