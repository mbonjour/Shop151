<?php
	session_start();
    // Donn�es pour les essais
	$Titre_Liste = array();
	$Liste = array();
	$currentId=0;
	
	// Initialisation des variables
	$database_titles=array();				// Titres des Items des la base
	$database=array();						// Liste des utilisateurs pour authentification
	$choice=array("5","10","20","50","100");// Option du choix d'affichage d'article par page
	$Nb_Tot_Page = 1;						// Nombre total de page du catalogue
	$window_title = "Panier";			// Titre de la fen�tre HTML
	$sub_title = " Articles dans le panier";		// Titre de la page
	$email = "mbonjour@protonmail.ch";	// Afresse mai pour le contact

        include('connectDbSQL.php');
        $sqlSelectIdCommand="SELECT `id_Commande`,`FK_Etat` FROM `t_commande` INNER JOIN `t_commande_client` ON `T_Commande`.`id_commande`=`t_commande_client`.`FK_Commande` WHERE `session_ID`='".session_id()."'";
        $resultSelectId=mysql_query($sqlSelectIdCommand);
        while ($id = mysql_fetch_array($resultSelectId))
        {
                $idSelect[]=$id;
        }
		$idCommand=$idSelect[0]['id_Commande'];
		$stateCommand=$idSelect[0]['FK_Etat'];
        $sqlArticlesInCommand="SELECT `id_Articles`, `Nom`, `Description`, `Prix`, `Image_Path`, `FK_Category`,`Quantity` FROM `t_articles`
        INNER JOIN `t_content` 
        ON `t_articles`.`id_Articles`=`t_content`.`FK_Articles` 
        INNER JOIN `t_Commande` 
        ON `t_content`.`FK_Commande`=`t_Commande`.`id_commande`
        WHERE `id_commande`=".$idSelect[0]['id_Commande'];
        $resultAtriclesInCommand=mysql_query($sqlArticlesInCommand);
        while ($donnees = mysql_fetch_assoc($resultAtriclesInCommand))
        {
                $database[]=$donnees;
        }
        mysql_close();
        $fields = count($database);
		if($fields>0 && $stateCommand=="Factice"){
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
			foreach ($database_titles as $Titre)//TODO: Remplir database_titles avec $database[][xxxx]
			{
				echo '<th align="left" bgcolor="dcdcdc">'.$Titre.'</th>';
			}
			echo '</tr>';
			
			// Affichage des articles 
			echo'<tr valign=center>';
			for ($Article=$Premier_Art_Page; $Article < $Dernier_Art_Page; $Article++)
			{
				$i=0;
					foreach ( $database[$Article] as $value)
					{
						switch($i){
							case 0:
								$currentId=$value;
								$i++;
								break;
							case 1:
								echo'<td align="left" bgcolor="ffffff"><strong><a href="../web/viewArticle.php?id='.$currentId.'">'.$value.'</a></strong></td>';
								$i++;
								break;
							case 2:
								echo'<td align="left" bgcolor="ffffff">'.$value.'</td>';
								$i++;
								break;
							case 3:
                                                                
								echo'<td align="left" bgcolor="ffffff">Prix (CHF) : '.$value.'</td>';
								$i++;
								break;
							case 4:
								echo'<td align="left" bgcolor="ffffff"><img src="'.$value.'" alt="imageArticles" class="imgArt"></td>';
								$i++;  
							        break;
							case 5:
								echo'<td align="left" bgcolor="ffffff">'.$value.'</td>';
								$i++;
								break;
						case 6:
								echo'<td align="left" bgcolor="ffffff">Quantité : '.$value.'</td>';
								$i++;
								break;
							default:
								echo'<td align="left" bgcolor="ffffff">'.$value.'</td>';
								$i++;
						}
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
			echo('<a href="../web/checkout.php?id='.$idCommand.'">Checkout !</a>');
		}else{
			include('header.php');
			echo('<h1>Pas d\'articles dans le panier !</h1>');
		}
			echo('<a href="../web/historicCommands.php">Historique des commandes</a>');
			include('footer.php');

	echo '</body>
</html>';

////////////////////////////////////////////////////////////////////////////////////////////
// Fin du script -- Fin de ma vie aussi
//////////////////////////////////////////////////////////////////////////////////////////////////
?>