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
            $print_like = $bdd->prepare('SELECT * FROM vote WHERE id_acteur=?');
            $print_like ->execute(array($_GET['acteur']));
            $likes = $print_like->rowCount();
            $insert = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES (?, ?, ?)');
            $insert->execute(array($_SESSION['id_user'], $getacteur, $likes));
            header('Location: page_acteur.php?acteur='.$_GET['acteur']);
        }
        elseif($getvote == 2)
        {
            $print_dislike = $bdd->prepare('SELECT * FROM vote WHERE id_acteur=?');
            $print_dislike ->execute(array($_GET['acteur']));
            $dislikes = $print_dislike->rowCount();
            $insert = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES (?, ?, ?)');
            $insert->execute(array($_SESSION['id_user'], $getacteur, $dislikes));
            header('Location: page_acteur.php?acteur='.$_GET['acteur']);
        }
        else exit('erreur fatale1');
    }
    else exit('erreur fatale2');
}
?>