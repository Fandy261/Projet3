<?php session_start();
include "connexion_pdo.php";
if(isset($_SESSION['username']))
{
    //$getid = intval($_GET['id_user']);
    $reponse = $bdd->prepare('SELECT * FROM account WHERE id_user = ?');
    //$reponse->execute(array($_SESSION['id_user']));
    $donnees = $reponse->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Extranet</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <!-- L'entête  -->
        <header>
        <?php include("entete.php");?>
        </header>
        <main >
            <section class="profil">
                <h2 align="center">Profil de <?php echo $_SESSION['username'];?></h2>
                <!-- <p><a href="#changed_password">Veuillez changer votre mot de passe s'il vous plaît</a></p> -->
                <form action="page_connexion.php" method = "POST">
                <table class="changed_password">
                    <tr>
                        <td><label for="changed_password">Changez votre mot de passe</label></td>
                        <td><input type="password" name="changed_password" value="" id = "changed_password"></td>
                    </tr>
                    <tr>
                        <td><label for="changed_password2">Confirmez votre mot de passe</label></td>
                        <td><input type="password" name="changed_password2" value="" id = "changed_password2"></td>
                    </tr>
                    <tr>
                        <td></br></td>
                        <td></br></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td><button type="submit" name="send">Envoyez</button></td>
                    </tr>
                </table>
                </form>
                <?php
                if(isset($erreur))
                {
                    echo '<font color="red">'. $erreur .'</font>';
                }
                ?>
            </section>
        </main>
        
        <!-- Le pied de page -->
        <footer>
            <?php include("pieddepage.php");?>
        </footer>
    </body>
</html>
<?php 
}
?>