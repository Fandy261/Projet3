<?php
session_start();
?>
<!DOCTYPE html>
<?php 
$bdd = new PDO ('mysql:host=localhost;dbname=projet3', 'root','');//pour se connecter à la base de donnée
if(isset($_POST['formForgotten_mdp']))//pour vérifier si la formulaire existe
{
    //créer des variables associées aux entrées des utilisateurs en relation avec la table account
    $username = htmlspecialchars($_POST['username']);
    $question = htmlspecialchars($_POST['question']);
    if(!empty($_POST['username']) && !empty($_POST['question']))
    {
        //vérifier si on a un même username 
        $req = $bdd->prepare('SELECT * FROM account WHERE username = "'.$username.'"');
        $req->execute(array($username));
        $username_count = $req->rowcount();
        if($username_count == 1)
        {
            $donnees = $req->fetch();
            $req2 = $bdd->prepare('SELECT * FROM account WHERE question = "'.$question.'"');
            $req2->execute(array($question));
            $question_count = $req2->rowcount();
            // $passwordverified = password_verify($_POST['password'], $donnees['password']);
            //verifier que le mot de passe fourni par l'utilisateur correspond à celui de la bdd
            if($question_count>= 1)
            {
                // créer quelques variables de session dans $_SESSION
                $_SESSION['nom'] = $donnees['nom'];
                $_SESSION['prenom'] = $donnees['prenom'];
                $_SESSION['username'] = $donnees['username'];   
                $_SESSION['id_user'] = $donnees['id_user'];  
                //var_dump($_SESSION);
                echo 'Veuillez créer un nouveau mot de passe';
                header('Location: parametre_compte.php?id_user='.$_POST['username']);
            }
            else
            {
                $erreur = 'Veuillez tapez bien votre question secrète:';
                // header('Location: parametre_compte.php');
            }
            $req->closeCursor();
        }
        else
        {
            $erreur = 'Veuillez vérifier votre username';
        }
        $req->closeCursor();
    }
    else
    {
        $erreur = 'Tous les champs doivent être complétés!';
    }
}
?>
<html>
    <head>
        <title>Extranet</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <!-- L'entête  
        -------------------------------------------------------
        -------------------------------------------------------
        -->
        <header>
            <?php include("entete.php");?>
        </header>
        <!-- Le corps
        ------------------------------------------------------
        ------------------------------------------------------
         -->
        <main >
            <!-- <time datetime="2021-01-12">January 12, 2021</time> -->
            <section class="connexion">
                <h2 align="center">Veuillez entrer votre username et la question secrète s'il vous plaît:</h2>
                <form method="POST" align="center">
                    <input type="text" name="username" placeholder="UserName">
                    <input type="text" name="question" id="question" placeholder="Question secrète">
                    <button type="submit" name="formForgotten_mdp">Envoyer</button>
                </form>
            </section>
            <?php
                if(isset($erreur))
                {
                    echo '<font color="red">'. $erreur .'</font>';
                }
            ?>
        </main>
        
        <!-- Le pied de page 
        ------------------------------------------------------------
        ------------------------------------------------------------
        -->
        <footer>
            <?php include("pieddepage.php");?>
        </footer>
    </body>
</html>