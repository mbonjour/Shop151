<?php
    include('header.php');
    session_start();
   // $data = Array();
    include('connectDbSQL.php');  
    $sql="SELECT * FROM `t_articles` WHERE id_Articles=".$_GET['id'];
    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
    // on fait une boucle qui va faire un tour pour chaque enregistrement
    $data = mysql_fetch_assoc($req);
    mysql_close();    

    $currentId = $data['id_Articles'];
    $name = $data['Nom'];
    $description = $data['Description'];
    $price = $data['Prix'];
    $imgFilePath = $data['Image_Path'];
    $category = $data['FK_Category'];

    echo ('
    <html>
        <body>
            <main>
                <img src="'.$imgFilePath.'" alt="imageArticles" class="imgArt">
                <p>Nom de l\'article : <strong>'.$name.'</strong></p>
                <p>Description de l\'article :  '.$description.'</p>
                <p>Prix : '.$price.'</p>
                <p>Catégorie : '.$category.'</p>
                <a href="../web/add_panier.php?id='.$currentId.'">Ajouter au panier</a>
            </main>
        </body>
    </html>');
    include('footer.php');
?>