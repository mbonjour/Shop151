<?php
    session_start();


    //Delete de la commande si l'ID n'aparaît pas dans la table T_Content
    include('connectDbSQL.php');
    $sqlSelectIdCommand="SELECT `id_Commande` FROM `t_commande` WHERE `session_ID`='".session_id()."'";
    $resultIdCommand=mysql_query($sqlSelectIdCommand);
    $IdCommand=mysql_result($resultIdCommand,0);
    $sqlControlContent="SELECT `id_Content` FROM `t_content` WHERE `FK_Commande`=".$IdCommand['id_Commande'];
    $resultControl=mysql_query($sqlControlContent);
    $numRows=mysql_num_rows($resultControl);
    if ($numRows == 0) {
        $sqlDeleteCommandClient="DELETE FROM `t_commande_client` WHERE `FK_Commande`=".$IdCommand['id_Commande'];
        mysql_query($sqlDeleteCommandClient);
        $sqlDeleteCommand="DELETE FROM `t_commande` WHERE `id_Commande`=".$IdCommand['id_Commande'];
        mysql_query($sqlDeleteCommand);
    }
    mysql_close();


    $_SESSION=array();//on efface toutes les variables de la session
    session_destroy(); // Puis on détruit la session
    setcookie('UserName');
    setcookie('admin');
    header('location:./home.php');
?>