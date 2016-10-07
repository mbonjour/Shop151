<!--
Auteur : "Mickael Bonjour <mbonjour@protonmail.ch>"
Date : 03.05.2016
Version 1.00
Inter D�pendances : (Fichiers d�pendants)
-->

<?php
session_start();

	if ( isset($_POST['submit']) )
	{
		$_SESSION['messageInfo']="";

        include('connectDbAccess.php');
		$sqlInsertAccess  = "INSERT INTO users (username,password) VALUES ('".$_POST['pseudo']."','".$_POST['motpasse']."')";
		$result = odbc_do($db, $sqlInsertAccess) or die( odbc_error($db) );
		
		odbc_close($db);

		try {
            include('connectDbSQL.php');
			$sqlInsertSQL = "INSERT INTO t_client (Prenom, Nom, Date_Naissance)
			VALUES ('".$_POST['prenom']."', '".$_POST['nom']."', '".$_POST['birth']."')";
			$conn->exec($sqlInsertSQL);
		}
		catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
		$conn = null;
        
        header('location:home.php');
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
			<label for="nom">UTILISATEUR* : </label> 
			<input type="text" name="pseudo" value="mbonjour" required pattern="^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$" title="Contient entre 8 et 20 caractères et . ou _"> 
		</p> 
		<p> 
			<label for="nom">Prénom* : </label> 
			<input type="text" name="prenom" value="Mickael" required pattern="^[A-z]{2,20}$" title="Seulement des lettres, jusqu'à 20 caractères"> 
		</p> 
		<p> 
			<label for="motdepasse">MOT DE PASSE* : </label> 
			<input type="password" name="motpasse" required pattern="^.*(?=.{8,})(?=..*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=/.]).*$" title="Min. 8 caractères dont 1 nombre, 1 caractère spécial et 1 lettre majuscule p. ex. Mbonjour.1"> 
		</p>
		<p> 
			<label for="nom">Nom de famille* : </label> 
			<input type="text" name="nom" value="Bonjour" required pattern="^[A-z]{2,25}$" title="Seulement des lettres, jusqu'à 25 caractères"> 
		</p>
		<p> 
			<label for="nom">Email* : </label> 
			<input type="email" name="email" value="mic.bonjour@gmail.com" required> 
		</p>
		<p> 
			<label for="nom">Date de naissance* : </label> 
			<input type="date" name="birth" value="<?php echo date("Y-m-d");?>" required>
		</p>
		<p>Les champs marqués d'une * sont obligatoires, merci bien !</p>
		<p> 
			<input type="submit" name="submit"value="Create User"> 
		</p> 
		</form>
		</main>
		<?php
		include('footer.php');
		?>
	</body>
</html>
