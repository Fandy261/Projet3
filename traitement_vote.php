<?php
    session_start();
    include 'connexion_pdo.php';
    if(isset($_GET['acteur'], $_GET['vote']) && !empty($_GET['acteur']) && !empty($_GET['vote']))
    {
        $getacteur = $_GET['acteur'];
        $getvote = $_GET['vote'];
        $check = $bdd->prepare('SELECT * FROM acteurs WHERE id_acteur=?');//appel de chaque acteur
        $check->execute(array($getacteur));
        $check_user = $bdd->prepare('SELECT * FROM account WHERE id_user = ?');
        $check_user->execute(array($_SESSION['id_user']));
        while($check_user_connect = $check_user->fetch())
        {
            if($getvote == 1)//si on fait un j'aime sur un acteur
            {
                $getvote = 1;
                $check_connect = $bdd->prepare('SELECT * FROM vote WHERE id_acteur = ? AND id_user = ? AND vote=1');//on peut liker un acteur si on est connécté
                $check_connect ->execute(array($getacteur, $_SESSION['id_user']));
                $del = $bdd->prepare('DELETE FROM vote WHERE id_acteur = ? AND id_user = ? AND vote = -1');
                $del ->execute(array($getacteur, $_SESSION['id_user']));
                if($check_connect->rowCount() == 1)// si on a déjà liké alors on supprime le vote
                {
                    $del = $bdd->prepare('DELETE FROM vote WHERE id_acteur = ? AND id_user = ? AND vote = 1');
                    $del ->execute(array($getacteur, $_SESSION['id_user'], $getvote));
                }
                else//sinon on ajoute le vote à la table vote
                {
                    $insert = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES (?, ?, ?)');
                    $insert->execute(array($_SESSION['id_user'], $getacteur,$getvote));
                }
                header('Location: page_acteur.php?acteur='.$_GET['acteur']);
            }
            elseif($getvote == -1)//si on fait un j'aime pas sur un acteur
            {
                $getvote = -1;
                $check_connect = $bdd->prepare('SELECT * FROM vote WHERE id_acteur = ? AND id_user = ?  AND vote=-1');//on peut disliker un acteur si on est connécté
                $check_connect ->execute(array($getacteur, $_SESSION['id_user']));
                $del = $bdd->prepare('DELETE FROM vote WHERE id_acteur = ? AND id_user = ? AND vote=1');
                $del ->execute(array($getacteur, $_SESSION['id_user']));

                if($check_connect->rowCount() == 1)// si on a déjà liké alors on supprime le vote
                {
                    $del = $bdd->prepare('DELETE FROM vote WHERE id_acteur = ? AND id_user = ? AND vote = -1');
                    $del ->execute(array($getacteur, $_SESSION['id_user'],$getvote));
                }
                else//sinon on ajoute le vote à la table vote
                {
                    $insert = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES (?, ?, ?)');
                    $insert->execute(array($_SESSION['id_user'], $getacteur,$getvote));
                }
                header('Location: page_acteur.php?acteur='.$_GET['acteur']);
            }
            else exit('erreur fatale1');
        }
    }
?> 