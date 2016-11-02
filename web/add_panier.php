    <?php

    session_start();
    // $data = Array();
    include('connectDbSQL.php');  
    $idArticle=$_GET['id'];

    //Lier la commande (grâce au session_id) à l'article en ajoutant dans la table T_Content une entrée et une quantité à 1 par défaut, dans la gestion du panier on personalisera

    header('location:./articles.php');

    ?>