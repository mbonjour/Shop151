<html>
	<head>
		<title>A modifier</title>
		<met
	</head>
	<body>
		<form method="post" action="traitement.php">
			<p>
				<label for="article">Nom de l'article :</label>
				<input type="text" onsubmit="this.value=''" name="article" id="article" placeholder="Ex : God michet" size="30" maxlength="10" />
			</p>
			<p>
				<label for="artprix">Prix de l'article(CHF) :</label>
				<input type="tel" onsubmit="this.value=''" name="artprix" id="artprix" placeholder="Ex : 79.90" size="30" maxlength="10" />
			</p>
			<p>
				<label for="artcategorie">Catégorie de l'article :</label>
				<SELECT name="nom" size="1">
					<OPTION selected>Homme
					<OPTION>Femme
					<OPTION>Couple
				</SELECT>
			</p>
			<input type="submit" name="artenregistrer" value="Enregistrer l'article">
		</form>
	<body>
</html>