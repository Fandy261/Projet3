<?php
    session_start();
    include("connexion_pdo.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ma page acteur</title>
        <meta name="description" content="html">
        <link rel="stylesheet"href="style.css">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    </head>
    <body>
        <!-------------------------------------------------------------- L'entête ------------------------------------------------------>
        <?php include("entete.php");?>
        <!-------------------------------------------------------------- Le corps ------------------------------------------------------>
        <main>
            <?php 
                $reponse = $bdd -> prepare('SELECT id_acteur, nom, logo, description FROM acteurs WHERE id_acteur=?');
                $reponse ->execute(array($_GET['acteur']));
                $donnees = $reponse -> fetch();
            ?>
            <a href="index.php" id="retour">
                <img src="images/retour.png" alt="">
            </a>
            <section class="description_acteur">
                <img id="logo_acteur" src="<?php echo $donnees['logo'];?>" alt="logo_acteur" >
                <h2>
                    <?php echo $donnees['nom'];?>
                </h2>
                <p>
                    <?php echo $donnees['description'];?>
                </p>
            </section>
            <?php 
                $reponse->closeCursor();
            ?>
            <!----------------------- like/dislike ------------------------------------------>
            <?php
                if(isset($_GET['acteur']) && !empty($_GET['acteur']))
                {
                    $acteur = $bdd->prepare('SELECT * FROM acteurs WHERE id_acteur=?');
                    $acteur->execute(array($_GET['acteur']));
                    $acteur_check = $acteur->fetch();
                    $likes = $bdd->prepare('SELECT * FROM vote WHERE id_acteur = ?  AND vote=1');
                    $likes ->execute(array($_GET['acteur']));
                    $likes = $likes->rowCount();
                    
                    $dislikes = $bdd->prepare('SELECT * FROM vote WHERE   id_acteur = ? AND  vote=-1');
                    $dislikes ->execute(array($_GET['acteur']));
                    $dislikes = $dislikes->rowCount();  
                }
            ?> 
            <div class="newComment">
                <label for="reveal-comment" class="button"> Nouveau commentaire</label>
                <input type="checkbox" id="reveal-comment" role="button">
                <div id="espace_newComment">
                    <form  action="traitement_commentaire.php" method="POST">
                        <textarea name="post" id = "post" cols="30" rows="6" style="border-radius: 10px" >
                        </textarea>
                        <input type="hidden" value="<?php echo $donnees['id_acteur'];?>" name="id_acteur" id="id_acteur">
                        </br>
                        <button type="submit" name = "form_comment" style="margin-right: 50px">Publier</button>
                    </form>
                </div>
            </div>
            <div class="vote">
                <div class="vote_bar">
                    <div class="vote_progress" style="background-color: #63b96b; height: 4px;width:<?php echo ($likes+$dislikes) == 0 ? 100  : (100*$likes/($likes+$dislikes));?>%">
                    </div>
                </div>
                <div class="vote_btns">
                    <form action="traitement_vote.php?acteur=<?php echo $donnees['id_acteur'];?>&vote=1" method = "POST">
                        <button type="submit" class="vote_btn vote_like"><i class="fa fa-thumbs-up"></i> 
                            <?php echo $likes ?>
                        </button>
                    </form>
                    <form action="traitement_vote.php?acteur=<?php echo $donnees['id_acteur'];?>&vote=-1" method = "POST">
                        <button type="submit" class="vote_btn vote_dislike"><i class="fa fa-thumbs-down"></i> 
                            <?php echo $dislikes ?>
                        </button>
                    </form>
                </div>
            </div>
            <!------------------- Création d'espace de commentaires ---------------------------->
            <section class="comment">
                <?php 
                    $print_comment = $bdd->prepare('SELECT a.username, p.date_add, p.post FROM post p LEFT JOIN account a ON p.id_user = a.id_user  WHERE id_acteur=? ORDER BY post DESC LIMIT 0,5 ');
                    $print_comment ->execute(array($_GET['acteur']));
                    $print_nbr_comment = $print_comment->rowCount();
                ?>
                <h4><?php echo $print_nbr_comment ;?> Commentaires</h4>
                <?php 
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
        <!----------------------------------------------------- Le pied de page -------------------------------------------------------------->
        <?php include("pieddepage.php");?>
    </body>
</html>