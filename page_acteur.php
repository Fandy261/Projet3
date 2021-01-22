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
            <?php include 'connexion_pdo.php';?>
            <?php 
            $reponse = $bdd -> prepare('SELECT id_acteur, nom, logo, description FROM acteurs WHERE id_acteur=?');
            $reponse ->execute(array($_GET['acteur']));
            $donnees = $reponse -> fetch()
            ?>
            <section class="description_acteur">
                <center><img id="logo_acteur" src="<?php echo $donnees['logo'];?>" alt="logo_acteur" ></center>
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
                        $acteur = $acteur->fetch();
                        $id = $acteur['id_acteur'];

                        $likes = $bdd->prepare('SELECT * FROM likes WHERE id_acteur = ?');
                        $likes ->execute(array($id));
                        $likes = $likes->rowCount();
                        
                        $dislikes = $bdd->prepare('SELECT * FROM dislikes WHERE id_acteur = ?');
                        $dislikes ->execute(array($id));
                        $dislikes = $dislikes->rowCount();
                    }
                    
                }
                ?> 
                <div class="newComment" style = "margin-left: 1050px">
                    <label for="reveal-comment" class="button"> Nouveau commentaire</label>
                    <input type="checkbox" id="reveal-comment" role="button">
                    <div id="newComment">
                        <form  action="traitement_commentaire.php" method="POST">
                            <textarea name="post" id = "post" cols="30" rows="6" style="border-radius: 10px" ></textarea>
                            <input type="hidden" value="<?php echo $donnees['id_acteur'];?>" name="id_acteur" id="id_acteur"></br>
                            <button type="submit" name = "form_comment" style="margin-right: 50px">Publier</button>
                        </form>
                    </div>
                </div>
                <div class="vote">
                    <div class="vote_bar">
                        <div class="vote_progress"></div>
                    </div>
                    <div class="vote_btns">
                        <form action="traitement_vote.php?acteur=<?php echo $donnees['id_acteur'];?>&vote=1" method = "POST">
                            <button type="submit" class="vote_btn vote_like"><i class="fa fa-thumbs-up"></i> <?php echo $likes ?></button>
                        </form>
                        <form action="traitement_vote.php?acteur=<?php echo $donnees['id_acteur'];?>&vote=2" method = "POST">
                            <button type="submit" class="vote_btn vote_dislike"><i class="fa fa-thumbs-down"></i> <?php echo $dislikes ?></button>
                        </form>
                    </div>
                </div>

            <!-- Création d'espace de commentaires 
            --------------------------------------
            --------------------------------------
            -->
            <section class="comment">
                <h4>Commentaires</h4>
                <?php 
                $print_comment = $bdd->prepare('SELECT a.username, p.date_add, p.post FROM post p LEFT JOIN account a ON p.id_user = a.id_user  WHERE id_acteur=? ORDER BY post DESC LIMIT 0,5 ');
                $print_comment ->execute(array($_GET['acteur']));
                while($comment = $print_comment->fetch())
                {
                    ?>
                    <div class="table_comment">
                        <p class="p1"><?php echo $comment['username'];?></p>
                        <p class="p2"><?php  echo $comment['date_add'];?></p>
                        <p class="p3"><?php echo $comment['post'];?></p>
                    </div>
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
