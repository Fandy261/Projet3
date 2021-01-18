<!-- test  -->
<!-- <?php
//echo 'commentaire';
//echo '</br>';
//echo $_POST['id_acteur'];
//echo '</br>';
//echo $_POST['commentaire'];
?> -->
             <?php
             session_start();
             //declaration des variables concernant les commentaires
 $post= $_POST['post'];
 if(isset($_POST['form_comment']))//pour vérifier si la formulaire existe
 {
 
 include 'connexion_pdo.php';?>
            <?php 
            $reponse = $bdd -> prepare('SELECT id_acteur, nom, logo, description FROM acteurs WHERE id_acteur=?');
            $reponse ->execute(array($_GET['acteur']));
            $donnees = $reponse -> fetch();
            $reponse ->closeCursor();
            $comment = $bdd->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUES(?,?,NOW(),?)');
            $comment->execute(array($_SESSION['id_user'], $_POST['id_acteur'], $post));
            
 //$print_comment->fetch()s
 //$comment['id_user'] = $_SESSION['id_user'];
 }

 

header('Location: page_acteur.php?acteur='.$_POST['id_acteur']);//on remet quand tout fonctionne
//insert dans la base 

?>