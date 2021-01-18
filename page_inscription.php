<?php include 'entete.php'; ?>
<!DOCTYPE html>
<?php
$bdd = new PDO ('mysql:host=localhost;dbname=projet3', 'root','');//pour se connecter à la base de donnée
if(isset($_POST['formInscription']))//pour vérifier si la formulaire existe
{
    //créer des variables associées aux entrées des utilisateurs en relation avec la table account
    $name = htmlspecialchars($_POST['nom']);
    $first_name = htmlspecialchars($_POST['prenom']);
    $username = $_POST['username'];
    $password = $_POST['password'] ;
    $password2 =  $_POST['password2'] ;
    $question = htmlspecialchars($_POST['question']);
    $answer = htmlspecialchars($_POST['reponse']);
    $usernamelength = strlen($username);
    //vérifie le fonctionnement du formulaire
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['question']) && !empty($_POST['reponse']) )
    { 
        //vérifier si un utilisateur a déjà le même nom et prénom, si oui fais-le répondre à la question secrète
        // if($_POST['nom'] == && $_POST['prenom'] == )
        // {

        // }
        if($usernamelength<=255)
        {
            //vérifie si un utilisateur a déjà utilisé cet username
            $reponse = $bdd->prepare('SELECT * FROM account WHERE username = "'.$username.'"');
            $reponse->execute(array($username));
            $usernameExist = $reponse->rowcount();
            if($usernameExist == 1)
            {
                $erreur = 'Username existe déjà. Veuillez changer votre userName';
            }
            else
            {
                if($password==$password2)
                {    
                    $cryptedpassword = password_hash($password, PASSWORD_DEFAULT);                   
                    $insertmembre = $bdd->prepare('INSERT INTO account(nom, prenom, username, password, question, reponse) VALUES(?,?,?,?,?,?)');
                    $insertmembre->execute(array($name, $first_name, $username, $cryptedpassword,$question, $answer));
                    $erreur = "Votre compte a été crée";
                    header('Location: page_connexion.php?id_user='.$_SESSION['username']);
                }
                else
                {
                    $erreur = 'Vos mots de passe ne correspondent pas';
                }
            }
            $reponse->closeCursor();
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
            
        </header>
        <main  align="center" class="page_inscription">
            <h2 align="center">Inscrivez-vous</h2>
            <form action=" " method="POST" >
                <table  align="center">
                    <tr>
                        <td align ="right"><label for="nom">Nom</label>:</td> 
                        <td><input type="text" name="nom" id="nom" value="<?php if(isset($name)){echo $name;}?>"></td> 
                    </tr>
                    <tr>
                        <td align ="right"><label for="prenom">Prénom</label>:</td> 
                        <td><input type="text" name="prenom" id="prenom" value="<?php if(isset($first_name)){echo $first_name;}?>"></td> 
                    </tr>
                    <tr>
                        <td align ="right"><label for="username">UserName</label>:</td> 
                        <td><input type="text" name="username" id="username" value="<?php if(isset($username)){echo $username;}?>"></td> 
                    </tr>
                    <tr>
                        <td align ="right"><label for="password">Mot de passe</label>:</td> 
                        <td><input type="password" name="password" id="password"></td> 
                    </tr>
                    <tr>
                        <td align ="right"><label> Retapez votre mot de passe</label>:</td>
                        <td><input type="password" name="password2" id="password2" ></td>
                    </tr>
                    <tr>
                        <td align ="right"><label for="question">Question secrète</label>:</td> 
                        <td><input type="text" name="question" id="question" value="<?php if(isset($question)){echo $question;}?>"></td> 
                    </tr>
                    <tr>
                        <td align ="right"><label for="reponse">Réponse à la question secrète</label>:</td> 
                        <td><input type="text" name="reponse" id="reponse" value="<?php if(isset($answer)){echo $answer;}?>"></td> 
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center"></br></br><button type="submit" name="formInscription">S'inscrire</button></td>
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