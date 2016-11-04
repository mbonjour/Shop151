<!--
Auteur : "Mickael Bonjour <mbonjour@protonmail.ch>"
Date : 03.05.2016
Version 1.00
Inter D�pendances : (Fichiers d�pendants)
-->

<?php
session_start();

	if ( isset($_POST['createUser']) )
	{
		$_SESSION['messageInfo']="";

        include('connectDbAccess.php');
		$sqlInsertAccess  = "INSERT INTO users (username,password,isActive) VALUES ('".addslashes($_POST['pseudo'])."','".addslashes($_POST['motpasse'])."',1)";
		$result = odbc_do($db, $sqlInsertAccess) or die( odbc_error($db) );
		
		odbc_close($db);

		include('connectDbSQL.php');
		$sqlInsertSQL = "INSERT INTO t_client (Prenom, Nom, Date_Naissance)
		VALUES ('".$_POST['prenom']."', '".addslashes($_POST['nom'])."', '".addslashes($_POST['birth'])."')";
		mysql_query($sqlInsertSQL);
		$idClientCreated = mysql_insert_id();

        if(isset($_POST['isAdresseLivraisonShowed'])){
			//si c'est coché (mêmes adresses)
			$sqlInsertAddresSame="INSERT INTO `t_adresse`(`Ville`, `NPA`, `Rue`, `Pays`) VALUES ('".addslashes($_POST['ville'])."','".addslashes($_POST['npa'])."','".addslashes($_POST['rue'])."','".addslashes($_POST['pays'])."')";
			mysql_query($sqlInsertAddresSame);
			$idAdressSame = mysql_insert_id();
			$sqlInsertLi="INSERT INTO `t_adresse_client`(`FK_Adresse`, `FK_Client`, `FK_type`) VALUES ('".$idAdressSame."','".$idClientCreated."','Livraison')";
			mysql_query($sqlInsertLi);
			$sqlInsertFa="INSERT INTO `t_adresse_client`(`FK_Adresse`, `FK_Client`, `FK_type`) VALUES ('".$idAdressSame."','".$idClientCreated."','Facturation')";
			mysql_query($sqlInsertFa);
		}
		else
		{
			//si c'est pas coché --> addresses différentes
			$sqlInsertAdressLi="INSERT INTO `t_adresse`(`Ville`, `NPA`, `Rue`, `Pays`) VALUES ('".addslashes($_POST['villeLi'])."','".addslashes($_POST['npaLi'])."','".addslashes($_POST['rueLi'])."','".addslashes($_POST['paysLi'])."')";
			mysql_query($sqlInsertAdressLi);
			$idAdressLi =  mysql_insert_id();
			$sqlInsertAdressFa="INSERT INTO `t_adresse`(`Ville`, `NPA`, `Rue`, `Pays`) VALUES ('".addslashes($_POST['ville'])."','".addslashes($_POST['npa'])."','".addslashes($_POST['rue'])."','".addslashes($_POST['pays'])."')";
			mysql_query($sqlInsertAdressFa);
			$idAdressFa = mysql_insert_id();
			$sqlInsertLi="INSERT INTO `t_adresse_client`(`FK_Adresse`, `FK_Client`, `FK_type`) VALUES ('".$idAdressLi."','".$idClientCreated."','Livraison')";
			mysql_query($sqlInsertLi);
			$sqlInsertFa="INSERT INTO `t_adresse_client`(`FK_Adresse`, `FK_Client`, `FK_type`) VALUES ('".$idAdressFa."','".$idClientCreated."','Facturation')";
			mysql_query($sqlInsertFa);
		}

		// $to  = 'mickael.bonjour@epfl.ch';
        // $subject = 'Validation email';
        // $message = "";//"Go to localhost/web/validateUser.php?id=".$idClientCreated;

        // $headers = 'From: validate@epfl.ch' . "\r\n" .
        //             'Reply-To: validate@epfl.ch' . "\r\n" .
        //             'X-Mailer: PHP/' . phpversion();
        // mail($to, $subject, $message, $headers);
        header('location:home.php');
    }
?>

<!--Mettre CSS ce sera plus simple-->
<html>

<head>
	<title>Home</title>
	<meta charset=utf-8/>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		crossorigin="anonymous"></script>
	<script>
			$(document).ready(function() {
    			$("#isAdresseLivraisonShowed").change(function (){
					$("#isAdresseLivraisonShowed").prop('checked')? $("#adresseLivraisonSection").hide(1000) :  $("#adresseLivraisonSection").show(1000);
				});
			});
		</script>
</head>

<body>
		<?php
			include('header.php');
		?>
	<main>

		<form method="post" action="createUser.php">
			<h2>Authentification personnelle</h2>

			<!-- Vérifier tout les champs !!! -->
			<section>
				<h2>Infos de connexions</h2>
				<p>
					<label for="nom">UTILISATEUR* : </label>
					<input type="text" name="pseudo" value="mbonjour" required pattern="^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$"
						title="Contient entre 8 et 20 caractères et . ou _" />
				</p>
				<p>
					<label for="motdepasse">MOT DE PASSE* : </label>
					<input type="password" name="motpasse" required pattern="^.*(?=.{8,})(?=..*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=/.]).*$"
						title="Min. 8 caractères dont 1 nombre, 1 caractère spécial et 1 lettre majuscule p. ex. Mbonjour.1" />
				</p>
			</section>

			<section>
				<h2>Infos sur le client</h2>
				<p>
					<label for="nom">Prénom* : </label>
					<input type="text" name="prenom" value="Mickael" required pattern="^[A-z]{2,20}$" title="Seulement des lettres, jusqu'à 20 caractères"
					/>
				</p>
				<p>
					<label for="nom">Nom* : </label>
					<input type="text" name="nom" value="Bonjour" required pattern="^[A-z]{2,25}$" title="Seulement des lettres, jusqu'à 25 caractères"
					/>
				</p>
				<p>
					<label for="nom">Email* : </label>
					<input type="email" name="email" value="mic.bonjour@gmail.com" required />
				</p>
				<p>
					<label for="nom">Date de naissance* : </label>
					<input type="date" name="birth" value="<?php echo date(" Y-m-d ");?>" required />
				</p>
			</section>

			<section>
				<h2>Adresse de facturation</h2>
				<p>
					<label for="rue">Rue* : </label>
					<input type="text" name="rue" value="Avenue de la Prairie 22" required />
				</p>
				<p>
					<label for="ville">Ville* : </label>
					<input type="text" name="ville" value="Vevey" required />
				</p>
				<p>
					<label for="npa">NPA* : </label>
					<input type="text" name="npa" value="1800" required />
				</p>
				<p>
					<label for="pays">Pays* : </label>
					<input type="text" name="pays" value="Switzerland" required />
				</p>
			</section>

			<label for="isAdresseLivraisonShowed">L'adresse de livraison est la même que celle de facturation </label>
			<input type="checkbox" id="isAdresseLivraisonShowed" name="isAdresseLivraisonShowed" value="same"/>

			<section id="adresseLivraisonSection">

				<h2>Adresse de livraison</h2>
				<p>
					<label for="rueLi">Rue* : </label>
					<input type="text" name="rueLi" value="Avenue de la Prairie 22" required />
				</p>
				<p>
					<label for="villeLi">Ville* : </label>
					<input type="text" name="villeLi" value="Vevey" required />
				</p>
				<p>
					<label for="npaLi">NPA* : </label>
					<input type="text" name="npaLi" value="1800" required />
				</p>
				<p>
					<label for="paysLi">Pays* : </label>
					<input type="text" name="paysLi" value="Switzerland" required />
				</p>
			</section>
			<p>
				<p>Les champs marqués d'une * sont obligatoires, merci bien !</p>
				<input type="submit" name="createUser" value="Create User" />
			</p>
		</form>
	</main>
	<?php
		include('footer.php');
	?>
</body>

</html>