<?php
    include('header.php');
    session_start();
    include('connectDbSQL.php');
    include('connectDbAccess.php');  

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
                <p>Nom de la personne : <strong>'.$lastName.'</strong></p>
                <p>Prenom :  '.$firstName.'</p>
                <p>Date de naissance : '.$birthDate.'</p>
            </main>
        </body>
    </html>');
    include('footer.php');
?>