<html>
	<head>
		<title>A modifier</title>
	</head>
	<body>
        <?php
            include('header.php');
			include('connectDbSQL.php');
        ?>
		<form method="post" action="traitement.php" enctype="multipart/form-data">
			<p>
				<label for="article">Nom de l'article :</label>
				<input type="text" name="article" id="article" placeholder="Ex : Cocombre gluant" size="30" maxlength="30" />
			</p>
			<p>
				<label for="artprix">Prix de l'article(CHF) :</label>
				<input type="tel" name="artprix" id="artprix" placeholder="Ex : 79.90" size="30" maxlength="10" />
			</p>
			<p>
				<label for="artdescription">Insérer une description :</label>
			</p>
				<textarea name="artdescription" id="artdescription" placeholder="Description ici." size="500" maxlength="500"> </textarea>
			<p>
				<label for="fileArt">Insérer une image : </label>
				<input type="file" name="fileArt" id="fileArt"/>
			</p>			
			<p>
				<label for="artcategorie">Catégorie de l'article :</label>
			<select name="artcategory" id="artcategory" size="1" style="width:150px">
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
			</p>
			<input type="submit" name="artenregistrer" value="Enregistrer l'article">
			<input type="reset" name="breset" value="Effacer">
		</form>
        <?php
            include('footer.php');
        ?>
	<body>
</html>