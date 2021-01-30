<?php
    session_start();
    include 'connexion_pdo.php';//pour se connecter à la base de donnée
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
        <?php include ('entete.php'); ?>
        <main>
            <?php
                if (!empty($_POST['username'])) 
                {
                    $username = htmlspecialchars($_POST['username']);
                    $bdd = $bdd->prepare('SELECT question, reponse FROM account WHERE username = ?');
                    $bdd->execute(array($username));
                    $test = $bdd->fetch();
                    if (!empty($test['question'])) 
                    {
                        ?>
                        <div class="verification">
                            <form action="change_password.php" method="POST">
                                <p> Question secrète :<?php echo $test['question']; ?></p>
                                <p>
                                    <label>Reponse :<input type="text" name="reponse" />
                                        <input type="hidden"  name="reponse" />
                                        <input type="hidden" value="<?php echo $username; ?>" name="username" />
            
                                    </label>
                                </p>
                                <p><button type="submit">Envoyer</button></p>
                            </form>
                        </div>
                        <?php
                    } 
                }
            ?>
        </main>
        <?php include ("pieddepage.php") ?>
    </body>
</html>