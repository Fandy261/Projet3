<?php
session_start();
include 'connexion_pdo.php';
?>
<!DOCTYPE html>
<?php
if(!empty($_SESSION))//pour vérifier si les variables sessions ne sont pas vides
{
?>
<html>
    <head>
        <title>Extranet</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="description" content="Extranet">
        <meta name="author" content="Fandeferana Tsirimihanta">
    </head>
    <body>
        <header>
        <?php include ('entete.php'); ?>
        </header>
       
        <!--le contenu-->
        <main>
            <section class="presentation">
                <h1>Groupement Banque-Assurance Français</h1>
                <p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :
                </p>
                <img src="images/banques.jpg" alt="illustration">
                <p>
                Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire
national. Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir
l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.
                </p>
            </section>
            
            <?php 
            // impportation des données de la table acteurs dans la base de donnée
            $reponse = $bdd -> query('SELECT id_acteur, nom, description, logo FROM acteurs');?>
            <div class="section_acteurs">
            <h1>Acteurs et partenaires</h1>
            <?php
            while($donnees = $reponse -> fetch())
            {
            ?>
                <article class="acteurs">
                    <a href="page_acteur.php?acteur=<?php echo $donnees['id_acteur'];?>"><img id="logo_acteurs_index" src="<?php echo $donnees['logo'];?>" alt="logo_acteur"></a>
                    <?php
                    $shortDescription = substr($donnees['description'], 0, 300); //une fonction qui sert à retourner une partie de la description
                    ?>
                    <div>
                        <h3 class="nom"> <?php echo $donnees['nom'];?></h3>
                        <p><?php  echo $shortDescription . ' ' . '...';?></p>
                    </div>
                </article> 
                <button><a href="page_acteur.php?acteur=<?php echo $donnees['id_acteur'];?> ">lire la suite</a> </button>
                    <?php 
                    }
                    $reponse->closeCursor();
                    ?>
            </div>
        </main>
        <?php include ("pieddepage.php") ?>
    </body>
</html>
<?php
}
?>