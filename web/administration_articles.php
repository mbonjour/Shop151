<html>
	<head>
		<title>A modifier</title>
	</head>
	<body>
        <?php
            include('header.php');
			include('connectDbSQL.php');
			include('connectDbAccess.php');
			session_start();
			if (!isset($_SESSION['name'])){
				header('location:home.php');
			}
        ?>
		<form method="post" action="traitement_articles.php" enctype="multipart/form-data">
			<section>
				<H1>Ajouter un article</H1>
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
			</section>
			<section>
				<H1>Ajouter une catégorie</H1>
				<p>
					<label for="categorie">Nom de la catégorie :</label>
					<input type="text" name="categorie" id="categorie" placeholder="Ex : Homme" size="30" maxlength="30" />
				</p>
				<input type="submit" name="catenregistrer" value="Enregistrer la categorie">
				<input type="reset" name="breset" value="Effacer">
			</section>
		</form>
		<form action="viewArticle.php" enctype="multipart/form-data">
			<section>
				<H1>Modifier un Article</H1>
				<p>
					<label for="article">Choix Article à modifier : </label>
					<input type="text" name="modifArt" id="modifArt" placeholder="" size="30" maxlength="30" />
				</p>
				<input type="submit" name="artmodif" value="Modifier la categorie">
				<input type="reset" name="breset" value="Effacer">
			</section>
		</form>
		
        <?php
            include('footer.php');
        ?>
	<body>
</html>