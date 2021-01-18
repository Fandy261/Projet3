<!--L'entête-->
<?php
//session_start();
include("connexion_pdo.php");//pour se connecter à la base de donnée
//$_SESSION['username'] = $_POST['username'];  
?>
<!DOCTYPE html>
<html>
    <header>
        <div id="naviguation">
                <img id="logo" src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png" alt="logo GBAF"> 
                <div id="icone"><img src="" alt="icone"></div>
                <!-- verification de l'existence des variables SESSION
                -----------------------------------------------------
                -----------------------------------------------------
                 -->
                <?php 
                echo '<pre>';
                //var_dump($_SESSION);
                echo '</pre>';
                if(!empty($_SESSION)){
                ?>
                 <div><?php echo $_SESSION['nom'];?> </div>
                <div><?php echo $_SESSION['prenom'];?> </div> 
                <div><a href="parametre_compte.php?username=<?php echo $_SESSION['username'];?>">Profil</a></div>
                <div><a href="page_deconnexion.php">Se déconnecter</a></div>
                <?php
                }
                ?>
        </div>
    </header>
</html>

