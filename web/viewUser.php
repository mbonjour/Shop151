<?php
    include('header.php');
    session_start();
    include('connectDbSQL.php');
    include('connectDbAccess.php');
    include('verifIfAdmin.php');

    $sql="SELECT ID,isAdmin,isActive FROM `users` WHERE username='".$_POST['user']."'";
    $result = odbc_do($db, $sql) or die( odbc_error($db) );
    $myrow = odbc_fetch_array( $result );
    odbc_close($db);
    $currentClient=$myrow['ID'];
    $clientIsAdmin=$myrow['isAdmin'];
    $clientIsActive=$myrow['isActive'];

    $sql2="SELECT id_Client,Nom,Prenom,Date_Naissance,FK_Type,Ville,NPA,Rue,Pays FROM `t_client` INNER JOIN `t_adresse_client` ON `t_client`.`id_Client`=`t_adresse_client`.`FK_Client` INNER JOIN `t_adresse` ON `t_adresse_client`.`FK_Adresse`=`t_adresse`.`id_Adresse` WHERE id_Client=".$currentClient;
    $req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
    while ($donnees = mysql_fetch_array($req))
        {
            $data[]=$donnees;
        }
    //$data = mysql_fetch_assoc($req);
    mysql_close();  
    
    $lastName = $data[0]['Nom'];
    $firstName = $data[0]['Prenom'];
    $birthDate = $data[0]['Date_naissance'];
    for ($i=0;$i<count($data);$i++){
        if($data[$i]['FK_Type'] == "Livraison"){
            //Si l'adresse a comme type Livraison on met dans livraison !'
            $rueLi=$data[$i]['Rue'];
            $villeLi=$data[$i]['Ville'];
            $npaLi=$data[$i]['NPA'];
            $paysLi=$data[$i]['Pays'];
        }
        else {
            //Si le type est autre (forcément Facturation) --> on met dans Adresse de Facturation
            $rueFa=$data[$i]['Rue'];
            $villeFa=$data[$i]['Ville'];
            $npaFa=$data[$i]['NPA'];
            $paysFa=$data[$i]['Pays'];
        }
    }
    if (isset($_POST['userModif'])){

    }

    echo ('
    <html>
        <body>
            <main>
            <form method="post" action="viewUser.php" enctype="multipart/form-data">
                <input type="hidden" name="idClient" id="idClient" value="'.$currentClient.'"/>
                <section>
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
					<input type="date" name="birthDate" id="birthDate" value="'.date("Y-m-d",strtotime($birthDate)).'" maxlength="10" />
				</p>
                <p>
					<label for="isActive">Utilisateur actif ( 1 = oui, 0 = non ) </label>
					<input type="text" name="isActive" id="isActive" value="'.$clientIsActive.'" maxlength="10" />
				</p>
                <p>
					<label for="isAdmin">Utilisateur admin ( 1 = oui, 0 = non ) </label>
					<input type="text" name="isAdmin" id="isAdmin" value="'.$clientIsAdmin.'" maxlength="10" />
				</p>
                </section>
                <section>
				<h2>Adresse de Livraison</h2>
				<p>
					<label for="rue">Rue* : </label>
					<input type="text" name="rue" value="'.$rueLi.'" required />
				</p>
				<p>
					<label for="ville">Ville* : </label>
					<input type="text" name="ville" value="'.$villeLi.'" required />
				</p>
				<p>
					<label for="npa">NPA* : </label>
					<input type="text" name="npa" value="'.$npaLi.'" required />
				</p>
				<p>
					<label for="pays">Pays* : </label>
					<input type="text" name="pays" value="'.$paysLi.'" required />
				</p>
			</section>
            <section>

				<h2>Adresse de Facturation</h2>
				<p>
					<label for="rueLi">Rue* : </label>
					<input type="text" name="rueLi" value="'.$rueFa.'" required />
				</p>
				<p>
					<label for="villeLi">Ville* : </label>
					<input type="text" name="villeLi" value="'.$villeFa.'" required />
				</p>
				<p>
					<label for="npaLi">NPA* : </label>
					<input type="text" name="npaLi" value="'.$npaFa.'" required />
				</p>
				<p>
					<label for="paysLi">Pays* : </label>
					<input type="text" name="paysLi" value="'.$paysFa.'" required />
				</p>
			</section>
                <input type="submit" name="userModif" value="Modifier Client">
            </main>
        </body>
    </html>');
    include('footer.php');
?>