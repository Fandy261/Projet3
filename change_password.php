<?php session_start();
    include "connexion_pdo.php";
    $username = htmlspecialchars($_POST['username']);
    $reponse = $bdd->prepare('SELECT * FROM account WHERE username = ?');
    $reponse->execute(array($username));
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
                    $updatemembre = $bdd->prepare('UPDATE account SET password = :mdp WHERE username = :username');
                    $updatemembre->execute(array('mdp'=>$cryptedpassword,
                                                'username'=>$username));
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
            <link rel="stylesheet"href="style.css">
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <meta name="description" content="Extranet">
            <meta name="author" content="Fandeferana Tsirimihanta">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <!--------------------------------------------------------------- L'entête  ----------------------------------------------------------->
            <?php include("entete.php");?>
            <!----------------------------------------------------------------- Le corps ---------------------------------------------------------->
            <main >
                <a href="index.php" id="retour"><img src="images/retour.png" alt=""></a>
                <section class="profil">
                    <h2>Profil de <?php echo $username;?></h2>
                    <form action="" method = "POST">
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
                                <td><input type="hidden" value="<?php echo $username; ?>" name="username" /></td>
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
                    <div class="deconnexion">
                        <button style = "color: black">
                            <a href="page_deconnexion.php" >Se déconnecter</a>
                        </button>
                    </div>
                </section>
            </main>
            
            <!---------------------------------------------------------------- Le pied de page ------------------------------------------------------>
            <?php include("pieddepage.php");?>
        </body>
    </html>
    <?php 
?>