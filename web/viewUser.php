<?php
    include('header.php');
    session_start();
    include('connectDbSQL.php');
    include('connectDbAccess.php');
    include('verifIfAdmin.php');

    $currentClient = "";
    $clientIsAdmin = 1;
    $sql="SELECT ID,isAdmin FROM `users` WHERE username='".$_POST['user']."'";
    $result = odbc_do($db, $sql) or die( odbc_error($db) );
    $myrow = odbc_fetch_array( $result );
    odbc_close($db);
    $currentClient=$myrow['ID'];
    $clientIsAdmin=$myrow['isAdmin'];
    $sql2="SELECT * FROM `t_client` WHERE id_Client=".$currentClient;
    $req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
    $data = mysql_fetch_assoc($req);
    mysql_close();  

    $lastName = $data['Nom'];
    $firstName = $data['Prenom'];
    $birthDate = $data['Date_naissance'];

    echo ('
    <html>
        <body>
            <main>
            <form method="post" action="viewUser.php" enctype="multipart/form-data">
				<p>
					<label for="nom">Nom de famille :</label>
					<input type="text" name="nom" id="nom" value="'.$lastName.'" size="30" maxlength="30" />
				</p>
				<p>
					<label for="prenom">Prénom :</label>
					<input type="text" name="prenom" id="prenom" value="'.$firstName.'" maxlength="10" />
				</p>
                <p>
					<label for="birthDate">Date de naissance :</label>
					<input type="date" name="birthDate" id="birthDate" value="'.$firstName.'" maxlength="10" />
				</p>
            </main>
        </body>
    </html>');
    include('footer.php');
?>