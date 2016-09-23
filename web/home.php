<!--
Auteur : "Mickael Bonjour <mbonjour@protonmail.ch>"
Date : 03.05.2016
Version 1.00
Inter D�pendances : (Fichiers d�pendants)
-->

<?php
session_start();
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
			<div width=100% align="center">
				<img src="../pictures/body.jpg" width=100%/>
			</div>
			<font size=2>© 2009 - Fondation SuisseMobile - <a href="http://www.suissemobile.ch" >www.suissemobile.ch</a></font>
		</main>
		<?php
		include('footer.php');
		?>
	</body>
</html>