<?php
    session_start();
    // $data = Array();
    include('connectDbSQL.php');
    include('header.php');

    $sqlUpdateState="UPDATE `t_commande_client` SET `FK_Etat`='Traitement' WHERE `FK_Commande`=".$_GET['id'];
    mysql_query($sqlUpdateState);
    echo('<h1>Votre commande a été passée, merci de votre participation !</h1>');

    include('footer.php');
?>