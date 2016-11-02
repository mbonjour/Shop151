<?php
include('header.php');
session_start();

        $sqlSelectIdCommand="SELECT `id_Commande` FROM `t_commande` WHERE `session_ID`='".session_id()."'";
        $resultIdCommand=mysql_query($sqlSelectIdCommand);
        $IdCommand=mysql_result($resultIdCommand,0);


include('footer.php');
?>