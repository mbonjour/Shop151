<?php
    session_start();
    // $data = Array();
    include('header.php');

    include('connectDbSQL.php');
    $sqlUpdateState="UPDATE `t_commande_client` SET `FK_Etat`='Traitement' WHERE `FK_Commande`=".$_GET['id'];
    mysql_query($sqlUpdateState) or die(mysql_error());
    echo('<h1>Votre commande a été passée, merci de votre participation !</h1>');

    include('footer.php');

    //J'en peux tellement plus de voir que je fais de la merde sans pouvoir faire autrement...
?>