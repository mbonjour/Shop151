<?php
    include('header.php');
    session_start();

    include('connectDbAccess.php');
    $sqlSelectUserId="SELECT ID FROM users WHERE username='".$_COOKIE['UserName']."'";
    $resultSelectID = odbc_do($db, $sqlSelectUserId) or die( odbc_error($db) );
    while($myrow = odbc_fetch_array( $resultSelectID )){
        $usersID[]= $myrow;
    }
    odbc_close();
    include('connectDbSQL.php');
    $sql="SELECT `FK_Commande`,`FK_Etat`,`Date_Commande_Client` FROM `t_Client` 
    INNER JOIN `t_commande_client` 
    ON `t_client`.`id_client`=`t_commande_client`.`FK_Client` 
    WHERE `id_client`=".$usersID[0]['ID'];
    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
    $database=array();
    // on fait une boucle qui va faire un tour pour chaque enregistrement
    while($data = mysql_fetch_assoc($req))
    {
        $database[]=$data;
    }
    echo('<table>');
    for ($y=0; $y < count($database); $y++){
				if($database[$y]['FK_Etat']!="Factice"){
                    echo('<tr>');
                    echo('<td align="left" bgcolor="ffffff"><a href="../web/viewCommand.php?id='.$database[$y]['FK_Commande'].'">Voir/Modifier détails de la commande '.$database[$y]['FK_Commande'].'</a></td>');
                    echo('<td align="left" bgcolor="ffffff"><strong>Etat actuel : '.$database[$y]['FK_Etat'].'</strong></td>');
                    echo('<td align="left" bgcolor="ffffff"><strong>Date Commande :'.$database[$y]['Date_Commande_Client'].'</strong></td>');
                    echo('</tr>');
                }		
	}
    echo('</table>');
    include('footer.php');
?>