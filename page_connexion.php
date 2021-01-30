<?php
    session_start();
    include "connexion_pdo.php";
    if(isset($_POST['formConnexion']))//pour vérifier si la formulaire existe
    {
        $username = htmlspecialchars($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if(!empty($_POST['username']) && !empty($_POST['password']))
        {
            $req = $bdd->prepare('SELECT * FROM account WHERE username = "'.$username.'"');
            $req->execute(array($username));
            $username_count = $req->rowcount();
            if($username_count == 1)
            {
                $donnees = $req->fetch();
                $passwordverified = password_verify($_POST['password'], $donnees['password']);
                //verifier que le mot de passe fourni par l'utilisateur correspond à celui de la bdd
                if($passwordverified == 1)
                {
                    // créer les variables session 
                    $_SESSION['nom'] = $donnees['nom'];
                    $_SESSION['prenom'] = $donnees['prenom'];
                    $_SESSION['username'] = $donnees['username'];   
                    $_SESSION['id_user'] = $donnees['id_user'];  
                    header('Location: index.php');//si les mots de passe correspondent alors on est connécté puis on redirige vers la page des acteurs
                }
                else
                {
                    $erreur = 'Mot de passe ne correspond pas, veuillez changer votre mot de passe s\'il vous plaît';
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
        <!-------------------------------------------------------------- L'entête ------------------------------------------------------>
        <?php include("entete.php");?>
        <!-------------------------------------------------------------- Le corps ------------------------------------------------------>
        <main >
            <section class="connexion">
                <h2>Connectez-vous</h2>
                <form method="POST" action=" ">
                    <input type="text" name="username" placeholder="UserName">
                    <input type="password" name="password"  placeholder="Votre mot de passe"/> 
                    <button type="submit" name="formConnexion">Se connecter</button>
                </form>
            </section>
            <a href="page_inscription.php" style="color: black">Vous n'avez pas de compte?</a>
            <a href="forgotten_mdp.php"style="color: black">Mot de passe oublié?</a>
            <?php
                if(isset($erreur))
                {
                    echo '<font color="red">'. $erreur .'</font>';
                }
            ?>
        </main>
        <!----------------------------------------------------- Le pied de page -------------------------------------------------------------->
        <?php include("pieddepage.php");?>
    </body>
</html>