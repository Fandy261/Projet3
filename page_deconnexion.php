<?php
    session_start();
    session_destroy();//détruire les variables session
    header('Location: page_connexion.php');
?>
