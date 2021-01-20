<?php
session_start();
include 'connexion_pdo.php';
if(isset($_GET['acteur'], $_GET['vote']) && !empty($_GET['acteur']) && !empty($_GET['vote']))
{
    $getacteur = $_GET['acteur'];
    $getvote = $_GET['vote'];
    $check = $bdd->prepare('SELECT id_acteur FROM acteurs WHERE id_acteur=?');
    $check->execute(array($getacteur));
    if($check->rowCount() == 1)
    {
        if($getvote == 1)
        {
            $check_like = $bdd->prepare('SELECT id FROM likes WHERE id_acteur = ? AND id_user = ?');
            $check_like ->execute(array($getacteur, $_SESSION['id_user']));
            $del = $bdd->prepare('DELETE FROM dislikes WHERE id_acteur = ? AND id_user = ?');
            $del ->execute(array($getacteur, $_SESSION['id_user']));

            if($check_like->rowCount() == 1)
            {
                $del = $bdd->prepare('DELETE FROM likes WHERE id_acteur = ? AND id_user = ?');
                $del ->execute(array($getacteur, $_SESSION['id_user']));
            }
            else
            {
                $insert = $bdd->prepare('INSERT INTO likes( id_acteur, id_user) VALUES (?,?)');
                $insert->execute(array($getacteur, $_SESSION['id_user']));
            }
            header('Location: page_acteur.php?acteur='.$_GET['acteur']);
        }
        elseif($getvote == 2)
        {
            $check_dislike = $bdd->prepare('SELECT id FROM dislikes WHERE id_acteur = ? AND id_user = ?');
            $check_dislike ->execute(array($getacteur, $_SESSION['id_user']));
            $del = $bdd->prepare('DELETE FROM likes WHERE id_acteur = ? AND id_user = ?');
            $del ->execute(array($getacteur, $_SESSION['id_user']));

            if($check_dislike->rowCount() == 1)
            {
                $del = $bdd->prepare('DELETE FROM dislikes WHERE id_acteur = ? AND id_user = ?');
                $del ->execute(array($getacteur, $_SESSION['id_user']));
            }
            else
            {
                $insert = $bdd->prepare('INSERT INTO dislikes( id_acteur, id_user) VALUES (?,?)');
                $insert->execute(array($getacteur, $_SESSION['id_user']));
            }
            header('Location: page_acteur.php?acteur='.$_GET['acteur']);
        }
        
    }
    else exit('erreur fatale');
}
else exit('erreur fatale');//envoye erreur car la condition !empty($_GET['vote']) n'accepte pas une valeur null or j'ai mis if($getvote == 0)
?>