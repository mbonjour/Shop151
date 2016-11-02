<?php
    session_start();
    $_SESSION=array();//on efface toutes les variables de la session
    session_destroy(); // Puis on détruit la session
    setcookie('UserName');
    setcookie('admin');

    //Delete de la commande si l'ID n'aparaît pas dans la table T_Content

    
    header('location:./home.php');
?>