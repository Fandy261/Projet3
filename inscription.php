<!DOCTYPE html>
<?php
$bdd = new PDO ('mysql:host=localhost;dbname=projet3', 'root','');
if(isset($_POST['forminscription']))//pour vérifier si la formulaire existe
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $pass = $_POST['pass'] ;
    //$pass = sha1($_POST['pass'], PASSWORD_DEFAULT);
    $pass2 =  $_POST['pass2'] ;
    $email = htmlspecialchars($_POST['email']);
    $pseudolength = strlen($pseudo);
    if(!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && !empty($_POST['email']) )
    {
        if($pseudolength<=255)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $reqmail = $bdd->prepare('SELECT * FROM membres WHERE email=?');
                $reqmail->execute(array($email));
                $emailexist = $reqmail->rowcount();
                if($emailexist == 0)
                {
                    if($pass==$pass2)
                    {    
                    $cryptedPass = password_hash($pass, PASSWORD_DEFAULT);                   
                    $insertmembre = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(?,?,?,CURDATE())');
                    $insertmembre->execute(array($pseudo, $cryptedPass,$email));
                    $erreur = "Votre compte a été crée";
                        header('LOCATION: index.php');
                    }
                    else
                    {
                        $erreur = 'Vos mots de passe ne correspondent pas';
                    }
                }
                else
                {
                    $erreur = "Votre email a déjà été utilisé!";
                }
            }
            else
            {
                $erreur = "Votre email n'est pas valide";
            }
        }
        else
        {
           $erreur= 'Votre pseudo ne doit pas dépasser 255 charactères';
        }
    }
    else 
    {
        $erreur =  "Tous les champs doivent être complétés";
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Page d'Inscription</title>
    </head>
    <body>
        <header>
            <?php include 'entete.php'; ?>
        </header>
        <main  align="center">
            <h2 align="center">Inscrivez-vous</h2>
            <form action=" " method="POST" >
                <table  align="center">
                    <tr>
                        <td align ="right"><label for="pseudo">Pseudo</label>:</td> 
                        <td><input type="text" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)){echo $pseudo;}?>"></td> 
                    </tr>
                    <tr>
                        <td align ="right"><label for="pass">Mot de passe</label>:</td> 
                        <td><input type="password" name="pass" id="pass"></td> 
                    </tr>
                    <tr>
                        <td align ="right"><label> Retapez votre mot de passe</label>:</td>
                        <td><input type="password" name="pass2" id="pass2" ></td>
                    </tr>
                    <tr>
                        <td align ="right"><label for="email">Adresse email</label>:</td>
                        <td><input type="email" name="email" id="email" placeholder="@" value="<?php if(isset($email)){echo $email;}?>"></br></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center"></br></br><button type="submit" name="forminscription">S'inscrire</button></td>
                    </tr>
                </table>             
            </form>
            <?php
            if(isset($erreur))
            {
                echo '<font color="red">'. $erreur .'</font>';
            }
            ?>
        </main>
        <footer>
            <?php include 'pieddepage.php'; ?>
        </footer>
    </body>
</html>