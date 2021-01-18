<?php
session_start();
$_SESSION = array();
header('Location: page_connexion.php?username='.$_SESSION['username']);
session_destroy();
?>
<!DOCTYPE html> 
<html>

</html>