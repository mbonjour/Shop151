<?php
include('connectDbSQL.php');

if(isset($_POST['artenregistrer'])) {
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
        if ($_FILES['fileArt']['error'] > 0) $erreur = "Erreur lors du transfert";
        $extension_upload = strtolower(  substr(  strrchr($_FILES['fileArt']['name'], '.')  ,1)  );
        if (!in_array($extension_upload,$extensions_valides) ) die ("Extension incorrecte");
        $nom = "../files/ImgArticles/".$_POST['artcategory']."/".$_FILES['fileArt']['name'];
        $resultat = move_uploaded_file($_FILES['fileArt']['tmp_name'],$nom);
        $sql  = "INSERT INTO `t_articles`(`Nom`,`Description`,`Prix`,`Image_Path`,`FK_Category`) VALUES ('".addslashes($_POST['article'])."','".addslashes($_POST['artdescription'])."',".addslashes($_POST['artprix']).",'".$nom."','".$_POST['artcategory']."')";
		mysql_query($sql) or die (mysql_error($db));
		mysql_close($db);
        header('location:articles.php');
    }
    if(isset($_POST['catenregistrer'])) {
        $sql  = "INSERT INTO `t_category`(`id_Category`) VALUES ('".addslashes($_POST['categorie'])."')";
		mysql_query($sql) or die (mysql_error($db));
		mysql_close($db);
        header('location:administration_articles.php');
    }
?>