<?php

    include('connectDbAccess.php');
    $sqlInsertAccess  = "INSERT INTO users (isActive) VALUES (0) WHERE ID=".addslashes($_GET['id']);
    $result = odbc_do($db, $sqlInsertAccess) or die( odbc_error($db) );
    odbc_close($db);

?>