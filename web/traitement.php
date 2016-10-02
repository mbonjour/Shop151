<?php
if(isset($_POST['artenregistrer']))
    {
        include('connectDbSQL.php');
        $sql  = "SELECT username,password FROM users";
		$result = odbc_do($db, $sql) or die( odbc_error($db) );
		odbc_close($db);
        echo $_POST['article'];  
        echo $_POST['artprix'];    
    }
    else
    {
        echo "boite";
    }
?>