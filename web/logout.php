<?php
    session_start();
    $_SESSION=array();//on efface toutes les variables de la session
    session_destroy(); // Puis on détruit la session
    setcookie('UserName');
    header('location:./home.php');
?>