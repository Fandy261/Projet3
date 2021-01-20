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
                <a href="index.php"><img id="logo" src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png" alt="logo GBAF"></a> 
                <div id="icone"><a href="parametre_compte.php"><img src="images/icone.jpg" alt="icone" style="border-radius: 110px;width:45px; position:absolute;top:20px;right:270px;margin-right:10px"></a></div>
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
                 <div class="nom_prenom" style ="position:absolute;top:30px;right:90px;">
                    <a style="color:white" href="parametre_compte.php"><?php echo $_SESSION['nom']. "&nbsp". $_SESSION['prenom'];?></a> </div> 
                    <?php
                    
                }
                ?>
        </div>
    </header>
</html>

