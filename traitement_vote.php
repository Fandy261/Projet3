<?php
session_start();
include 'connexion_pdo.php';
if(isset($_GET['acteur'], $_GET['vote']) && !empty($_GET['acteur']) && !empty($_GET['vote']))
{
    $getacteur = $_GET['acteur'];
    $getvote = $_GET['vote'];
    $check = $bdd->prepare('SELECT id_acteur FROM acteurs WHERE id_acteur=?');//appel de chaque acteur
    $check->execute(array($getacteur));
    if($check->rowCount() == 1)//si on a un acteur on peut voter
    {
        if($getvote == 1)//si on fait un j'aime sur un acteur
        {
            $check_like = $bdd->prepare('SELECT id FROM likes WHERE id_acteur = ? AND id_user = ?');//on peut voter un acteur si on est connécté
            $check_like ->execute(array($getacteur, $_SESSION['id_user']));
            $del = $bdd->prepare('DELETE FROM dislikes WHERE id_acteur = ? AND id_user = ?');
            $del ->execute(array($getacteur, $_SESSION['id_user']));

            if($check_like->rowCount() == 1)// si on a déjà liké alors on supprime le vote
            {
                $del = $bdd->prepare('DELETE FROM likes WHERE id_acteur = ? AND id_user = ?');
                $del ->execute(array($getacteur, $_SESSION['id_user']));
            }
            else//sinon on ajoute le vote à la bdd
            {
                $insert = $bdd->prepare('INSERT INTO likes( id_acteur, id_user) VALUES (?,?)');
                $insert->execute(array($getacteur, $_SESSION['id_user']));
            }
            header('Location: page_acteur.php?acteur='.$_GET['acteur']);//on redirige vers la page des acteurs
        }
        elseif($getvote == 2)//si on fait un j'aime pas sur un acteur
        {
            $check_dislike = $bdd->prepare('SELECT id FROM dislikes WHERE id_acteur = ? AND id_user = ?');
            $check_dislike ->execute(array($getacteur, $_SESSION['id_user']));
            $del = $bdd->prepare('DELETE FROM likes WHERE id_acteur = ? AND id_user = ?');
            $del ->execute(array($getacteur, $_SESSION['id_user']));

            if($check_dislike->rowCount() == 1)// si on a déjà disliké alors on supprime le vote
            {
                $del = $bdd->prepare('DELETE FROM dislikes WHERE id_acteur = ? AND id_user = ?');
                $del ->execute(array($getacteur, $_SESSION['id_user']));
            }
            else//sinon on ajoute le vote à la bdd
            {
                $insert = $bdd->prepare('INSERT INTO dislikes( id_acteur, id_user) VALUES (?,?)');
                $insert->execute(array($getacteur, $_SESSION['id_user']));
            }
            header('Location: page_acteur.php?acteur='.$_GET['acteur']);//on redirige vers la page des acteurs
        }
        
    }
    else exit('erreur fatale');
}
else exit('erreur fatale');
?>