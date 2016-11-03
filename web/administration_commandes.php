<?php
include('header.php');
include('connectDbAccess.php');
include('verifIfAdmin.php');

session_start();
$users=array();
?>
<form method="post" action="viewCommands.php" enctype="multipart/form-data">
	<section>
			<H1>Détails sur les utilisateurs</H1>
			<select name="user" id="user" size="1" style="width:150px">
			<?php
				$data=array();
				$donnees=array();
				$sql="SELECT * FROM `users`";
				$reponse = mysql_query($sql);
				$result = odbc_do($db, $sql) or die( odbc_error($db) );
				while($myrow = odbc_fetch_array( $result )){
					$users[]= $myrow;
				}
				odbc_close($db);
				for ($i=0;$i<count($users);$i++){
					echo("<option value=\"".$users[$i]['ID']."\">".$users[$i]['username']."</option>");
				}
			?>
			</select>
		<input type="submit" name="adminenregistrer" value="Voir les commandes pour cet User">
	</section>
</form>
<?php
include('footer.php');
?>