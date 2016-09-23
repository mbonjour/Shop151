<?php
	#################################################################
	#
	#	Programme:		verif.inc.php
	#	Auteur:		Tony Favre-Bulle
	#
	#################################################################
	#
	# 	Date :		Juillet 2008
	#	Version :		1.0
	#	R�visions :		-
	#
	#################################################################
	#
	#	Gestion de sessions n�cessite les fichiers: index.php, start.php (formulaire et page WEB) et 
	# 	users.csv (pour les noms d'utilisateurs et mots de passe).
	#
	#################################################################
	
	// Identificateurs
	$dbName = "F:\\ICH 151 - Shop Online\\env_Shop\\www\\Users\\dbUsers.mdb";

	$users=array();				// Liste des utilisateurs pour authentification
	
	// Fonction de v�rification du couple Utilisateur et mot de passe
		function verification($nom, $pass, &$data)
		{
			$verify = false;
		
			for ($x=0; $x < count($data); $x++)
			{
				if ( ($data[$x]['username'] == $nom) && ($data[$x]['password'] == $pass) )
				{
					$verify = true;
					break;
				}
			}
			return ($verify);
		}

		// Chargement des données UTILISATEURS et MOT DE PASSE depuis fichier CSV
		
		if (!file_exists($dbName)) {
			die("Could not find database file.");
		}
		$db = odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". $dbName ."; Uid=; Pwd=;","","") or die("Connect");
		$sql  = "SELECT username,password FROM users";
		$result = odbc_do($db, $sql) or die( odbc_error($db) );
		// odbc_result_all($result);
		while($myrow = odbc_fetch_array( $result )){
    		$users[]= $myrow;
		}
		echo '<pre>';
		print_r($users);
		echo '</pre>';
		//affichage des résultats, pour savoir si l'insertion a marchée:
		if($result)
			echo("<center>La requête a été correctement ".$users[0]["username"]."effectuée</center>") ;
		else
			echo("<center>L'insertion à échouée"."</center>") ;
		odbc_close($db);
?>