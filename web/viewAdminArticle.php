<?php
    include('header.php');
    include('verifIfAdmin.php');
    session_start();
   // $data = Array();
    include('connectDbSQL.php');  
    $sql="SELECT * FROM `t_articles` WHERE Nom='".$_POST['artModify']."'";
    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
    // on fait une boucle qui va faire un tour pour chaque enregistrement
    $data = mysql_fetch_assoc($req);  

    $currentId = $data['id_Articles'];
    $name = $data['Nom'];
    $description = $data['Description'];
    $price = $data['Prix'];
    $imgFilePath = $data['Image_Path'];
    $category = $data['FK_Category'];
	$selected="";
    $data=array();
	$donnees=array();
    echo ('
    <h1>'.$name.'</h1>
    <img src="'.$imgFilePath.'" alt="imageArticles" class="imgArt">
    
    

    
    <form method="post" action="viewAdminArticle.php" enctype="multipart/form-data">
				<p>
					<label for="article">Nom de l\'article :</label>
					<input type="text" name="article" id="article" value="'.$name.'" size="30" maxlength="30" />
				</p>
				<p>
					<label for="artprix">Prix de l\'article(CHF) :</label>
					<input type="text" name="artprix" id="artprix" value="'.$price.'" maxlength="10" />
				</p>
				<p>
					<label for="artdescription">Insérer une description :</label>
				</p>
					<textarea name="artdescription" id="artdescription" size="500" maxlength="500">'.$description.'</textarea>
				<p>
					<label for="fileArt">Changer une image : </label>
					<input type="file" name="fileArt" id="fileArt" value='.$imgFilePath.'/>
				</p>			
				<p>
					<label for="artcategorie">Catégorie de l\'article :</label>
				<select name="artcategory" id="artcategory" size="1" style="width:150px">');
					
					$sql="SELECT id_Category FROM `t_category`";
					$reponse = mysql_query($sql);
					while ($donnees = mysql_fetch_array($reponse))
					{
						$data[]=$donnees;
					}
					for ($i=0;$i<count($data);$i++){
						if($data[$i]['id_Category'] == $category){
							$selected="selected=\"selected\"";
						}
						else {
							$selected="";
						}
						echo("<option value=\"".$data[$i]['id_Category']."\"".$selected.">".$data[$i]['id_Category']."</option>");
					}
                    mysql_close();
                echo('
				</select>
				</p>
				<input type="submit" name="artenregistrer" value="Enregistrer l\'article">
				<input type="reset" name="breset" value="Effacer">
		</form>
        ');
        include('footer.php');
?>