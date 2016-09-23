<?php
	session_start();
	#################################################################
	#
	#	Programme:		index.php
	#	Auteur:		Tony Favre-Bulle
	#
	#################################################################
	#
	# 	Date :		Mars 2008
	#	Version :		1.0 - Etape No 2 (Reprise )
	#	R�visions :		
	#
	#################################################################
	#
	#	Afficheur dynamique de donn�es depuis un fichier CSV (g�n�ration dynamique du code HTML)
	#
	#################################################################
	
	// Donn�es pour les essais
	$Titre_Liste = array();
	$Liste = array();
	
	
	// Initialisation des variables
	$path_files='../Files/';					// Dossier des fichiers ressources
	$data_file='excursions.csv';				// Fichier de donn�es
	$database_titles=array();				// Titres des Items des la base
	$database=array();						// Liste des utilisateurs pour authentification
	$choice=array("5","10","20","50","100");// Option du choix d'affichage d'article par page
	$Nb_Tot_Page = 1;						// Nombre total de page du catalogue
	$window_title = "Excursions";			// Titre de la fen�tre HTML
	$sub_title = " Liste des excursions";		// Titre de la page
	$email = "mbonjour@protonmail.ch";	// Afresse mai pour le contact
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	// Chargement des donn�es du fichier CSV en m�moire (dans un tableau multi-dimensionnel)
	//////////////////////////////////////////////////////////////////////////////////////////////////
	// Le dossier existe-t-il ?
	if( is_dir($path_files) )
	{
		// Ouverture du dossier
		if( $path = opendir($path_files) )
		{
			// Lecture des fichiers pr�sents
			while( ($file = readdir($path)) != FALSE )
			{
				// Est-ce un fichier de donn�es ?
				if( $file != '.' && $file != '..' )
				{
					// Est-ce le bon fichier de donn�es ?
					if ( $file == $data_file )
					{
						// Ouverture du fichier en lecture
						$handle = fopen($path_files.$file, "r");
						
						// R�cup�ration des titres des colonnes (Premi�re ligne du fichier CSV)
						$database_titles=fgetcsv($handle, 1000, ";");
						
						// R�cup�ration des donn�es du fichier CSV (jusqu'� la fin du fichier)
						$index = 0;
						while ( ($data = fgetcsv($handle, 1000, ";")) !== FALSE )
						{    
							// M�morise le nombre d'Items par ligne de donn�e
							$fields = count($data);
							
							foreach ($data as $key => $value)
							{
								// R�cup�re les donn�es dans un tableau � deux dimensions
								$database[$index][$key]=$value;
							}
							
							// Incr�mente compteur donn�e suivante
							$index++;
						}
						
						// Fermeture du fichier
						fclose($handle);
					}
					
				}
			}
		}
	
		// Fermeture du dossier
		closedir($path);
	}
	else
	{
		// Message d'avertissement en cas d'echec
		echo 'Le dossier spécifié n\'existe pas...<br/>';
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	// Traitement des informations transmises dans l'URL ($_POST) et calculs de formattage des pages
	//////////////////////////////////////////////////////////////////////////////////////////////////
	// R�cup�ration de la page s�lectionn�e et Protection contre des injection malicieuses dans l'URL 
	if ( isset($_POST['Page']) && ($_POST['Page'] > 1) )
	{			
		$Page_Courante = $_POST['Page'];
	}
	else
	{
		$Page_Courante = 1;			// Num�ro de la page courante par d�faut(catalogue)
	}
	
	// R�cup�ration du nombre d'articles par page s�lectionn�s et 
	//Protection contre des injection malicieuses dans l'URL
	if ( isset($_POST['Nb_Article']) && ( $_POST['Nb_Article'] > 1 ) )
	{
		$Nb_Art_Page = $_POST['Nb_Article'];
	}
	else
	{
		$Nb_Art_Page = $choice[2];	// Choix par d�faut du nombre d'articles par page
	}
	
	// Nombre d'articles totaux (catalogue)
	$Nb_Art_Total = count($database);
	
	// Nombre total de pages (catalogue)
	$Nb_Tot_Page = ceil($Nb_Art_Total / $Nb_Art_Page);
	
	// Nombre d'Items par articles
	$Nb_Items_Art = count($database[0]);
	
	// D�tection du ni�me passage et correction du d�passement de page en fonction du nombre d'articles par page
	if ( isset($_POST['Page_Courante']) )
	{
		if ( $Page_Courante > $Nb_Tot_Page )
		{
			$Page_Courante = 1;		// Num�ro de la page courante par d�faut(catalogue)
		}
	}
	
	// Calcul des intervalles pour les articles (catalogue)
	$Dernier_Art_Page = ($Page_Courante * $Nb_Art_Page);
	$Premier_Art_Page = ($Dernier_Art_Page - $Nb_Art_Page);
	
	// D�tection de la fin de liste (page non compl�te)
	if ( $Dernier_Art_Page > $Nb_Art_Total ) 
	{ 
		$Dernier_Art_Page = $Nb_Art_Total;
	};

//////////////////////////////////////////////////////////////////////////////////////////////////
// G�n�ration de la partie HTML (dynamiquement)
//////////////////////////////////////////////////////////////////////////////////////////////////
echo '<html>
		<head>
			<title>'.$window_title.'</title>
		</head>
		<body>'; include('header.php'); 
		echo '
			<h1>'.$sub_title.'</h1>
		<hr>';
		
		// Envoi du script sur lui-m�me ind�pendament du nom du fichier( $_SERVER[PHP_SELF'] )
		echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'" name="Liste">
		<table width="100%" align="center" border="0">
		<tr>
			<td>Articles par page : <select name="Nb_Article" onchange="document.Liste.submit();">';
				foreach ($choice as $Nb_Art)
				{
					echo '<option';
					
					// Affichage avec focus correct du nombre d'articles dans la liste
					if ( isset ($_POST['Nb_Article']) &&  ($_POST['Nb_Article'] == $Nb_Art) )
					{
						echo ' selected';
					}elseif ($Nb_Art == $Nb_Art_Page )
					{
						echo ' selected';
					}
					echo'>'.$Nb_Art.'</option>';
				}
				echo '</select>';
			
			echo '</td>
			
			<td align="right">Page : <select name="Page" onchange="document.Liste.submit();">';
				for ( $Page=1; $Page <= $Nb_Tot_Page; $Page++ )
				{
					echo '<option';
					
					// Affichage avec focus correct du nombre de pages dans la liste
					if ( $Page==$Page_Courante )
					{
						echo ' selected';
					}
					echo'>'.$Page.'</option>';
				}
				echo '</select>';
			echo '</td>
		</tr>
		</table>
		</br>
		<hr>';
			
			// Affichage du contenu de la page (articles du catalogue)
			echo '<table width="100%" align="center" border="0" bgcolor="dcdcdc">';
			
			// Affichage des titres du tableau
			echo '<tr>';
			foreach ($database_titles as $Titre)
			{
				echo '<th align="left" bgcolor="dcdcdc">'.$Titre.'</th>';
			}
			echo '</tr>';
			
			// Affichage des articles 
			echo'<tr valign=center>';
			for ($Article=$Premier_Art_Page; $Article < $Dernier_Art_Page; $Article++)
			{
					for ( $Item=0; $Item < $Nb_Items_Art; $Item++)
					{
						echo'<td align="left" bgcolor="ffffff">'.$database[$Article][$Item].'</td>';
					}
					echo'</tr>';
			}
			
			echo'</table>';
			
			echo '<hr>';
			echo '<input type="hidden" name="Page_Courante" value="'.$Page_Courante.'">'; // M�morisation de la page courante
			echo'</form>';
			
			// Affichage du pied de page
			echo '<center>|&nbsp&nbsp<a href="javascript:window.print()">Imprimer la page</a>&nbsp&nbsp|&nbsp&nbsp<a
			href="mailto:'.$email.'">Contact</a>&nbsp&nbsp|</center></br>';
			include('footer.php');

	echo '</body>
</html>';
//////////////////////////////////////////////////////////////////////////////////////////////////
// Fin du script
//////////////////////////////////////////////////////////////////////////////////////////////////
?>
	