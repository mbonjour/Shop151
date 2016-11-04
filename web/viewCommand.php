<?php
    include('header.php');
    session_start();
        // Donn�es pour les essais
	$Titre_Liste = array();
	$Liste = array();
	$currentId=0;
	
	// Initialisation des variables
	$database_titles=array();				// Titres des Items des la base
	$database=array();						// Liste des utilisateurs pour authentification
	$choice=array("5","10","20","50","100");// Option du choix d'affichage d'article par page
	$Nb_Tot_Page = 1;						// Nombre total de page du catalogue
	$window_title = "Détails commandes";			// Titre de la fen�tre HTML
	$sub_title = "Détails commandes";		// Titre de la page
	$email = "mbonjour@protonmail.ch";	// Afresse mai pour le contact
    if (isset($_POST['stateModif'])){
        include('connectDbSQL.php');
        $sqlUpState="UPDATE `t_commande_client` SET `FK_Etat`='".addslashes($_POST['stateCommand'])."' WHERE `FK_Commande`=".$_POST['idCommand'];
        mysql_query($sqlUpState);
        mysql_close();
        header('location:administration_commandes.php');
    }
    include('connectDbSQL.php');
    $sqlArticlesInCommand="SELECT `id_Articles`, `Nom`, `Description`, `Prix`, `Image_Path`, `FK_Category`,`Quantity` FROM `t_articles`
    INNER JOIN `t_content` 
    ON `t_articles`.`id_Articles`=`t_content`.`FK_Articles` 
    INNER JOIN `t_Commande` 
    ON `t_content`.`FK_Commande`=`t_Commande`.`id_commande`
    WHERE `id_commande`=".$_GET['id'];
    $resultAtriclesInCommand=mysql_query($sqlArticlesInCommand);
    while ($donnees = mysql_fetch_assoc($resultAtriclesInCommand))
    {
            $database[]=$donnees;
    }
    mysql_close();
    
    $fields = count($database);
    echo('<section>
    <h1>Contenu de la commande</h1>
    <table>');
        for ($y=0; $y < $fields; $y++)
        {
            $i=0;
                foreach ( $database[$y] as $value)
                {
                    switch($i){
                        case 0:
                            $currentId=$value;
                            $i++;
                            break;
                        case 1:
                            echo'<td align="left" bgcolor="ffffff"><strong><a href="../web/viewArticle.php?id='.$currentId.'">'.$value.'</a></strong></td>';
                            $i++;
                            break;
                        case 2:
                            echo'<td align="left" bgcolor="ffffff">'.$value.'</td>';
                            $i++;
                            break;
                        case 3:
                                                            
                            echo'<td align="left" bgcolor="ffffff">Prix (CHF) : '.$value.'</td>';
                            $i++;
                            break;
                        case 4:
                            echo'<td align="left" bgcolor="ffffff"><img src="'.$value.'" alt="imageArticles" class="imgArt"></td>';
                            $i++;  
                                break;
                        case 5:
                            echo'<td align="left" bgcolor="ffffff">'.$value.'</td>';
                            $i++;
                            break;
                    case 6:
                            echo'<td align="left" bgcolor="ffffff">Quantité : '.$value.'</td>';
                            $i++;
                            break;
                        default:
                            echo'<td align="left" bgcolor="ffffff">'.$value.'</td>';
                            $i++;
                    }
                }
                echo'</tr>';
        }
        
        echo('</table>
            </section>
            <section>
            <h1>Etat de la commande</h1>
            <form method="post" action="viewCommand.php" enctype="multipart/form-data">
            <input type="hidden" name="idCommand" id="idCommand" value="'.$_GET['id'].'"></input>
            <label for="stateCommand">Etat de la commande :</label>
            <select name="stateCommand" id="stateCommand" size="1" style="width:150px">');
                include('connectDbSQL.php');
                $sqlGetCurrentState="SELECT `FK_Etat` FROM `t_Commande` 
                INNER JOIN `t_commande_client` 
                ON `t_Commande`.`id_Commande`=`t_commande_client`.`FK_Commande` 
                WHERE `id_Commande`=".$_GET['id'];
                $reponse1=mysql_query($sqlGetCurrentState);
                $currentState=mysql_result($reponse1,0);
                $sql="SELECT `id_Etat` FROM `t_Etat`";
                $reponse = mysql_query($sql);
                while ($donnees = mysql_fetch_array($reponse))
                {
                    $data[]=$donnees;
                }
                for ($i=0;$i<count($data);$i++){
                    if($data[$i]['id_Etat'] == $currentState){
                        $selected="selected=\"selected\"";
                    }
                    else {
                        $selected="";
                    }
                    if($data[$i]['id_Etat'] != "Factice"){
                        echo("<option value=\"".$data[$i]['id_Etat']."\"".$selected.">".$data[$i]['id_Etat']."</option>");
                    }
                }
                mysql_close();
            echo('
                </select>
                </p>
                <input type="submit" name="stateModif" value="Modifier l\'état de la commande">
                <input type="reset" name="breset" value="Effacer">
                </form>
            ');
                    
        // Affichage du pied de page
        include('footer.php');

	echo '</body>
</html>';

////////////////////////////////////////////////////////////////////////////////////////////
// Fin du script
//////////////////////////////////////////////////////////////////////////////////////////////////
?>