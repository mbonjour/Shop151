<!--
Auteur : "Mickael Bonjour <mbonjour@protonmail.ch>"
Date : 03.05.2016
Version 1.00
Inter D�pendances : (Fichiers d�pendants)
-->


<!--Mettre CSS ce sera plus simple-->
<html>
	<head>
		<title>Impressum</title>
		<meta charset=utf-8/>
	</head>
	
	<body>
		<?php
		include('header.php');
		?>
		<main>
		    <?php
            	
                $homepage = file_get_contents('../files/impressum.txt');
                echo $homepage;
                
                //$fp = fopen('../files/impressum.txt', 'r+'); //lecture du fichier
                //while (!feof($fp)) { //on parcourt toutes les lignes
                //echo fgets($fp, 4096); // lecture du contenu de la ligne
                //}
                //fclose($fp);
                
            ?>
		</main>
		<?php
		include('footer.php');
		?>
	</body>
</html>