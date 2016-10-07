<?php
include('header.php');
include('connectDbAccess.php');

session_start();
$database_titles=array("id","username","password","isAdmin");
$users=array();
$sql='SELECT * FROM users';
$result = odbc_do($db, $sql) or die( odbc_error($db) );
while($myrow = odbc_fetch_array( $result )){
    $users[]= $myrow;
}
odbc_close($db);
echo '<table width="100%" align="center" border="0" bgcolor="dcdcdc">';
			
			// Affichage des titres du tableau
			echo '<tr>';
			foreach ($database_titles as $Titre)//TODO: Remplir database_titles avec $database[][xxxx]
			{
				echo '<th align="left" bgcolor="dcdcdc">'.$Titre.'</th>';
			}
			echo '</tr>';
			
			// Affichage des articles 
			echo'<tr valign=center>';
			for ($i=0; $i < count($users); $i++)
			{
					foreach ( $users[$i] as $value)
					{
							echo'<a href="#"><td align="left" bgcolor="ffffff">'.$value.'</td></a>';
					}
					echo'</tr>';  
			}	
			echo'</table>';

include('footer.php');
?>