<?php 
    session_start();
    include "connexion_pdo.php";
    $reponse = $bdd->prepare('SELECT * FROM account WHERE username = ?');
    $reponse->execute(array($_SESSION['username']));
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
                    $updatemembre = $bdd->prepare('UPDATE account SET password = :mdp, nom = :nom, prenom = :prenom, username = :username, question = :question, reponse = :reponse WHERE username = :username');
                    $updatemembre->execute(array('mdp'=>$cryptedpassword,
                    'nom'=>$_POST['changed_nom'],
                    'prenom'=>$_POST['changed_prenom'],
                    'username'=>$_POST['changed_username'],
                    'question'=>$_POST['changed_question'],
                    'reponse'=>$_POST['changed_reponse']
                ));
                $updatemembre->closeCursor();
                header('Location: index.php');
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
        <!----------------------------------------------------------------- Le corps -------------------------------------------------------- -->
        <main >
            <a href="index.php" id="retour"><img src="images/retour.png" alt=""></a>
            <section class="profil">
                <h2>Profil de <?php echo $_SESSION['username'];?></h2>
                <p>Nom: <?php echo $_SESSION['nom']?></p>
                <p>Prénom: <?php echo $_SESSION['prenom']?></p>
                <form action="" method = "POST">
                    <table class="changed_password">
                        <tr>
                            <td><label for="changed_nom">Changez votre nom</label></td>
                            <td><input type="text" name="changed_nom" value="" ></td>
                        </tr>
                        <tr>
                            <td><label for="changed_prenom">Changez votre prénom</label></td>
                            <td><input type="text" name="changed_prenom" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="changed_username">Changez votre username</label></td>
                            <td><input type="text" name="changed_username" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="changed_password">Changez votre mot de passe</label></td>
                            <td><input type="password" name="changed_password" value="" id = "changed_password"></td>
                        </tr>
                        <tr>
                            <td><label for="changed_password2">Confirmez votre mot de passe</label></td>
                            <td><input type="password" name="changed_password2" value="" id = "changed_password2"></td>
                        </tr>
                        <tr>
                            <td><label for="changed_question">Changez votre question secrète</label></td>
                            <td><input type="text" name="changed_question" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="changed_reponse">Changez votre réponse à la question secrète</label></td>
                            <td><input type="text" name="changed_reponse" value=""></td>
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
