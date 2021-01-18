<?php
session_start();
include("connexion_pdo.php");//pour se connecter à la base de donnée
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ma page acteur</title>
        <meta name="description" content="html">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    </head>
    <body>
        <header>
        <?php include('entete.php');?>
        </header>
        <main>
            <a align = "left" href="index.php?username=<?php echo $_SESSION['username'];?>">Retour à la page d'acceuil</a>
            <?php include 'connexion_pdo.php';?>
            <?php 
            $reponse = $bdd -> prepare('SELECT id_acteur, nom, logo, description FROM acteurs WHERE id_acteur=?');
            $reponse ->execute(array($_GET['acteur']));
            $donnees = $reponse -> fetch()
            ?>
            <section class="description_acteur">
                <img id="logo_acteur" src="<?php echo $donnees['logo'];?>" alt="logo_acteur">
                <h2><?php echo $donnees['nom'];?></h2>
                <p><?php echo $donnees['description'];?></p>
            </section>
            <?php 
            $reponse->closeCursor();
            ?>
            <!-- like/dislike -->
            <?php
                if(isset($_GET['acteur']) && !empty($_GET['acteur']))
                {
                    $acteur = $bdd->prepare('SELECT * FROM acteurs WHERE id_acteur=?');
                    $acteur->execute(array($_GET['acteur']));
                    if($acteur->rowCount() == 1)
                    {
                        $print_like = $bdd->prepare('SELECT * FROM vote WHERE id_acteur=?');
                        $print_like ->execute(array($_GET['acteur']));
                        $likes = $print_like->fetch();
                        $print_dislike = $bdd->prepare('SELECT * FROM vote WHERE id_acteur=?');
                        $print_dislike ->execute(array($_GET['acteur']));
                        $dislikes = $print_dislike->fetch();
                        $print_like->closeCursor();
                        $print_dislike->closeCursor();
                    }
                    
                }
                ?>
                <div class="vote">
                    <div class="vote_bar">
                        <div class="vote_progress"></div>
                    </div>
                    <div class="vote_btns">
                        <form action="" method = "POST">
                            <button type="submit" class="vote_btn vote_like"><i class="fa fa-thumbs-up"></i><a style="text-decoration: none" href="traitement_vote.php?acteur=<?php echo $donnees['id_acteur'];?>&vote=1"><?php echo $likes['vote'];?></a></button>
                        </form>
                        <form action="" method = "POST">
                            <button type="submit" class="vote_btn vote_dislike"><i class="fa fa-thumbs-down"></i><a style="text-decoration: none" href="traitement_vote.php?acteur=<?php echo $donnees['id_acteur'];?>&vote=2"><?php  echo $dislikes['vote'];?></a></button>
                        </form>
                    </div>
                </div>
            </section>
            <!-- Création d'espace de commentaires 
            --------------------------------------
            --------------------------------------
            -->
            <section class="comment">
                <label for="reveal-comment" class="button"> Nouveau commentaire</label>
                <input type="checkbox" id="reveal-comment" role="button">
                <div id="newComment">
                    <form  action="traitement_commentaire.php" method="POST">
                        <textarea name="post" id = "post" cols="50" rows="3" ></textarea>
                        <input type="hidden" value="<?php echo $donnees['id_acteur'];?>" name="id_acteur" id="id_acteur">
                        <button type="submit" name = "form_comment"></button>
                    </form>
                </div>
                <h4>Commentaires</h4>
                <?php 
                // $req = $bdd->query('SELECT * FROM account');
                // while($req = $req->fetch())
                // {
                //     echo $req['username'];
                // }
                // $req->closeCursor();
                $print_comment = $bdd->prepare('SELECT * FROM post WHERE id_acteur=? ORDER BY post ASC LIMIT 0,5 ');
                $print_comment ->execute(array($_GET['acteur']));
                while($comment = $print_comment->fetch()){
                    echo $comment['id_user'].':' ;
                    ?>
                    <?php
                    echo $comment['date_add'].':';
                echo $comment['post'];?>
                </br>
                <?php
                }
                $print_comment->closeCursor();
                ?>
            </section>
            <?php
            if(isset($erreur))
            {
                echo '<font color="red">'. $erreur .'</font>';
            }
            ?>
        </main>
        <footer>
            <?php include 'pieddepage.php';?>
        </footer>
    </body>
</html>
