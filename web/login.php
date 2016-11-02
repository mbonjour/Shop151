<?php
	#################################################################
	#
	#	Programme:		index.php
	#	Auteur:		Tony Favre-Bulle
	#
	#################################################################
	#
	# 	Date :		Juillet 2008
	#	Version :		1.0
	#	Révisions :		-
	#
	#################################################################
	#
	#	Gestion de sessions nécessite les fichiers: verif.php, home.php (traitement et page WEB) et 
	# 	users.csv (pour les noms d'utilisateurs et mots de passe).
	#
	#################################################################
	
	// Démarrage d'une session
	session_start(); 

	// Identificateurs	
	$pseudo='';					// Nom du dernier utilisateur
	$message_erreur='';			// Message d'erreur
	
	
	// Le nom du dernier utilisateur existe-t-il dans le cookie ?
	if ( isset($_COOKIE['UserName'] ) )
	{
		if ( isset($_COOKIE['memo'] ) )
		{
			if($_COOKIE['memo'] == true)
			{
				$pseudo=$_COOKIE['UserName'];
			}
		}
	}
	
	if ( isset($_POST['submit']) )
	{
		// Authentification - vérification des données UTILISATEUR et MOT DE PASSE
		include("verif.php");
		include("connectDbAccess.php");
        
		// Les données du formulaire sont-elles complètes ?
		if (  $_POST['pseudo']!='' &&  $_POST['motpasse']!=''  )
		{ 
			// OUI
			// On mémorise les informations
			$user = $_POST['pseudo'] ; 
			$pwd = $_POST['motpasse'];
	        $sqlActive  = "SELECT isActive FROM users WHERE username='".$_POST["pseudo"]."'";
            $resultActive = odbc_do($db, $sqlActive) or die( odbc_error($db) );
            while($myrow = odbc_fetch_array( $resultActive )){
                $isActive[]= $myrow;
            }
            if ($isActive[0]['isActive'] == 1){
                //  Le couple Nom et mot de passe sont-ils valides ?
                if ( verification($user, $pwd, $users) )
                { 
                    // OUI
                    // L'utilisateur est identifié 
                    // et on change d'identifiant de session (pour plus de sécurité) 
                    session_regenerate_id();
            
                    // On mémorise son nom (pour utilisation ultérieure durant la session)
                    $_SESSION['name']=$user;

                    // Mémorisation de l'utilisateur est-elle souhaitée?
                    setcookie('UserName',$user,time()+3600);
                    setcookie('admin',$user,time()+3600);
                    
                    if ( isset($_POST['memo']) )
                    {
                        if ($_REQUEST['memo']=='yes')
                        {
                            // OUI
                            // Pseudo mémorisé dans un cookie
                            setcookie('memo',true,time()+3600);
                        }
                        else
                        {
                            // NON
                            // Cookie vidé
                            setcookie('memo',false,time()+3600);
                        }
                    }
                    $sql  = "SELECT isAdmin FROM users WHERE username='".$_POST["pseudo"]."'";
                    $result = odbc_do($db, $sql) or die( odbc_error($db) );
                    while($myrow = odbc_fetch_array( $result )){
                        $isAdmin[]= $myrow;
                    }
                    if ($isAdmin[0]['isAdmin'] == 1){
                        setcookie('admin',$isAdmin[0]['isAdmin'],time()+3600);
                    }
                    else{
                        setcookie('admin',$isAdmin[0]['isAdmin'],time()+3600);
                    }
                    header('location:home.php');
                    odbc_close($db);			
                    exit();

					//Faire la création de la commande ???
					
                }
			else {
				// NON
				// Utilisateur non valide ! 
				$message_erreur = '<br/>Le pseudo est inconnu ou le mot de passe n\'est pas valide! <br/><br/><br/>' ; 
			}
		}
        else {
            // Utilisateur pas actif
            $message_erreur="Vous êtes une merde votre compte est désactivé, sucer les boules des admins le réactivera peut-être";
        }
    }
    else {
        // NON
        // Message d'avertissement
        $message_erreur ='<br/>Veuillez compléter tous les champs ! <br/><br/><br/>'; 
    }
}
?>

<!-- Formulaire d'authentification -->
<html>
	<head><title>Authentification personnelle</title></head>
	<body>
		<?php
		include('header.php');
		?>
		<form method="post" action="login.php" enctype="multipart/form-data">
		<h2>Authentification personnelle</h2>
		
		<?php
			//Message éventuel d'erreur de saisie des données
			if ( $message_erreur != '')
			{
				echo'<p><font color="ff0000">'.$message_erreur.'<font/><font color="000000"><font/></p>';
			}
		?>
		
		<p> 
			<label for="nom">UTILISATEUR : </label> 
			<input type="text" name="pseudo" value="<?php echo $pseudo; ?>"> 
		</p> 
		<p> 
			<label for="motdepasse">MOT DE PASSE : </label> 
			<input type="password" name="motpasse"> 
		</p>
		<p> 
			<input type="hidden" name="memo" value="no">
			<input type="checkbox" name="memo" value="yes" checked>Sauvegarder le nom d'utilisateur<br/><br/>
		</p> 
		<p> 
			<input type="submit" name="submit"value="IDENTIFIER"> 
		</p> 
		</form>
		<p><a href="createUser.php">Pas encore inscrit ?</a></p>
		<?php
		include('footer.php');
		?>
	</body>  
</html> 