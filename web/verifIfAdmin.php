<?php
    if($_COOKIE['admin']==false || !isset($_COOKIE['admin'])){
        header('location:home.php');
    }
?>