<?php
    session_start();
    if(isset($_SESSION['id']) == true && isset($_SESSION['email']) == true){
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        header("Location: login.php");
    }
    header("Location: login.php");
    exit();
    ?>