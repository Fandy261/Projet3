<?php session_start();
    include "connexion_pdo.php";
    $reponse = $bdd->prepare('SELECT * FROM account WHERE id_user = ?');
    $reponse->execute(array($_SESSION['id_user']));
    $donnees = $reponse->fetch();
    if(isset($_POST['form_changedMdp']))
    {
        if(!empty($_POST['changed_password']) && !empty($_POST['changed_password2']))
        {
            $password = $_POST['changed_password'];
            $password2 = $_POST['changed_password2'];
            if($password==$password2)
                {   
                    $cryptedpassword = password_hash($password, PASSWORD_DEFAULT);
                    $updatemembre = $bdd->prepare('UPDATE account SET password = :mdp WHERE id_user = :id_user');
                    $updatemembre->execute(array('mdp'=>$cryptedpassword,
                                                'id_user' =>$_SESSION['id_user']));
                    $updatemembre->closeCursor();
                    header('Location: page_connexion.php');
                }
            else echo 'erreur mot de passe different';
        }
        else echo 'tous les champs doivent être complétés';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Extranet</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <!--------------------------------------------------------------- L'entête  ----------------------------------------------------------->
        <header>
        <?php include("entete.php");?>
        </header>
        <!----------------------------------------------------------------- Le corps -------------------------------------------------------- -->
        <main >
            <a href="index.php" id="retour"><img src="images/retour.png" alt=""></a>
            <section class="profil">
                <h2 align="center">Profil de <?php echo $_SESSION['username'];?></h2>
                <form action="" method = "POST" align="center">
                <table class="changed_password" align="center">
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
                    <td><button type="submit" name="form_changedMdp">Envoyez</button></td>
                    </tr>
                </table>
                </form>
                <?php
                if(isset($erreur))
                {
                    echo '<font color="red">'. $erreur .'</font>';
                }
                ?>
                 <div class="deconnexion"><button style = "color: black"><a href="page_deconnexion.php" >Se déconnecter</a></button></div>
            </section>
        </main>
        
        <!---------------------------------------------------------------- Le pied de page ------------------------------------------------------>
        <footer>
            <?php include("pieddepage.php");?>
        </footer>
    </body>
</html>
<?php 
?>