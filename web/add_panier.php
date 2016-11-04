    <?php

    session_start();
    // $data = Array();
    include('connectDbSQL.php');  
    $idArticle=$_GET['id'];
    if (isset($_COOKIE['UserName']) && $_COOKIE['UserName']!=""){
        //Lier la commande (grâce au session_id) à l'article en ajoutant dans la table T_Content une entrée et une quantité à 1 par défaut, dans la gestion du panier on personalisera
        $sqlSelectIdCommand="SELECT `id_Commande` FROM `t_commande` WHERE `session_ID`='".session_id()."'";
        $resultIdCommand=mysql_query($sqlSelectIdCommand);
        $IdCommand=mysql_result($resultIdCommand,0);
        //TODO: Vérifier que l'entrée n'existe pas déjà dans t_content par un SELECT et incrémenter la quantité si c'est le cas
        $InsertContentCommand="INSERT INTO `t_content` (`Quantity`, `FK_Commande`, `FK_Articles`) VALUES (1,".$IdCommand.",".$idArticle.")";
        echo($InsertContentCommand);
        mysql_query($InsertContentCommand) or die(mysql_error());
        mysql_close();
    }
    else{
        echo("<p>Désolé vous n'êtes pas connecté !</p>");
        echo('<a href="../web/articles.php">Appuyer pour revenir aux articles !</a>');
        exit();
    }
    
    header('location:articles.php');

    ?>