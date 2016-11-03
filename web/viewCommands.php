<?php
    include('header.php');
    session_start();
    include('connectDbSQL.php');
    include('verifIfAdmin.php');

    $sql="SELECT `FK_Commande`,`FK_Etat` FROM `t_Client` 
    INNER JOIN `t_commande_client` 
    ON `t_client`.`id_client`=`t_commande_client`.`FK_Client` 
    WHERE `id_client`=".$_POST['user'];
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
                    echo'<tr>';
                    echo'<td align="left" bgcolor="ffffff"><a href="../web/viewCommand.php?id='.$database[$y]['FK_Commande'].'">Voir/Modifier détails de la commande '.$database[$y]['FK_Commande'].'</a></td>';
                    echo'<td align="left" bgcolor="ffffff"><strong>Etat actuel : '.$database[$y]['FK_Etat'].'</strong></td>';
                    echo'</tr>';
                }		
	}
    
    echo('</table>');
    include('footer.php');
?>