<html>
	<head>
		<title>A modifier</title>
	</head>
	<body>
        <?php
            include('header.php');
			include('connectDbSQL.php');
        ?>
		<form method="post" action="traitement.php">
			<p>
				<label for="article">Nom de l'article :</label>
				<input type="text" onsubmit="this.value=''" name="article" id="article" placeholder="Ex : Cocombre gluant" size="30" maxlength="10" />
			</p>
			<p>
				<label for="artprix">Prix de l'article(CHF) :</label>
				<input type="tel" onsubmit="this.value=''" name="artprix" id="artprix" placeholder="Ex : 79.90" size="30" maxlength="10" />
			</p>
			<p>
				<label for="artdescription">Insérer une descrption :</label>
			</p>
				<textarea onsubmit="this.value=''" name="artdescription" id="artpdescription" placeholder="Description ici." size="500" maxlength="500"> </textarea>
			<p>
				Insérer une image : <input type="file" name="nom"/>
			</p>			
			<p>
				<label for="artcategorie">Catégorie de l'article :</label>
			<select name="choix du nom" size="1" style="width:150px">
			<?php
				$data=array();
				$donnees=array();
				$sql="SELECT id_Category FROM `t_category`";
				$reponse = mysql_query($sql);
				while ($donnees = mysql_fetch_array($reponse))
				{
					$data[]=$donnees;
				
				}
				for ($i=0;$i<count($data);$i++){
					echo("<option value=\"".$data[$i]['id_Category']."\">".$data[$i]['id_Category']."</option>");
				}
			?>
			
			</select>
			<?php
			print_r($data);
			echo("<p>prout : ".$data[0]['id_Category']."</p>");
			?>
			</p>
			<input type="submit" name="artenregistrer" value="Enregistrer l'article">
			<INPUT TYPE="reset" NAME="breset" VALUE="Effacer">
		</form>
        <?php
            include('footer.php');
        ?>
	<body>
</html>