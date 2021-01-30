<?php 
    include "connexion_pdo.php";
    if(isset($_POST['formForgotten_mdp']))//vérifier si la formulaire existe
    {
        $username = htmlspecialchars($_POST['username']);
        if(!empty($_POST['username']))
        {
            $req = $bdd->prepare('SELECT * FROM account WHERE username = "'.$username.'"');
            $req->execute(array($username));
            $username_count = $req->rowcount();
            if($username_count == 1)
            {
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
       <!--------------------------------------------------------------- L'entête  ----------------------------------------------------------->
        <?php include("entete.php");?>
        <!----------------------------------------------------------------- Le corps --------------------------------------------------------->
        <main >
            <section class="connexion">
                <h2>Veuillez entrer votre username s'il vous plaît:</h2>
                <form action="verify.php" method="POST">
                    <input type="text" name="username" placeholder="UserName">
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
        <!---------------------------------------------------------------- Le pied de page --------------------------------------------------->
        <?php include("pieddepage.php");?>
    </body>
</html>