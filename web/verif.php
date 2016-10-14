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
		
		include('connectDbAccess.php');

		$sql  = "SELECT username,password FROM users";

		$result = odbc_do($db, $sql) or die( odbc_error($db) );
		//odbc_result_all($result);
		while($myrow = odbc_fetch_array( $result )){
    		$users[]= $myrow;
		}
		//affichage des résultats, pour savoir si l'insertion a marchée:
		odbc_close($db);
?>