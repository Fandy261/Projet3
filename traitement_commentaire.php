<?php
   session_start();
   include 'connexion_pdo.php';
   $user_id = $_SESSION['id_user'];
   $acteur_id = $_POST['id_acteur'];
   $reponse = $bdd -> prepare('SELECT COUNT(*) AS nb_commentaires_user FROM post WHERE id_user=:userID AND  id_acteur=:acteur_id');
   $reponse ->execute(array(
      'userID' => $user_id,
      'acteur_id'=>$acteur_id
      
      ));
   $user_comment_count = $reponse->fetch();
   if(isset($_POST['form_comment']) AND ($user_comment_count['nb_commentaires_user'] == 0))//pour vérifier si la formulaire existe et qu'il y a pas encore de
   {
      $post= $_POST['post'];
      $comment = $bdd->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUES(?,?,NOW(),?)');
      $comment->execute(array($_SESSION['id_user'], $_POST['id_acteur'], $post));
   }
   header('Location: page_acteur.php?acteur='.$_POST['id_acteur']);
?>