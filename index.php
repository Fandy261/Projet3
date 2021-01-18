<?php
session_start();
include 'connexion_pdo.php';
?>
<!DOCTYPE html>
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
                <h1>h1</h1>
                <p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :
                    <ul>
                        <li>BNP Paribas;</li>
                        <li>BPCE;</li>
                        <li>Crédit agricole;</li>
                        <li>Crédit Mutuel-CIC;</li>
                        <li>Société Générale;</li>
                        <li>La Banque Postale.</li>
                    </ul>
                </p>
                <p>
                Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire
national. Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir
l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.
                </p>
                <div id="illustration">
                    <p>illustration</p>
                </div>
            </section>
            
                <?php 
                $reponse = $bdd -> query('SELECT id_acteur, nom, description FROM acteurs');
                while($donnees = $reponse -> fetch())
                {
                ?>
                    <section class="section_acteurs">
                        <h2><?php echo $donnees['nom'];?></h2>
                        <p>texte acteurs et partenaires</p>
                        <p>...</p>
                        <article class="acteurs">
                            <img src="" alt="logo_acteur">
                            <h3>h3</h3>
                            <?php
                            $shortDescription = substr($donnees['description'], 0, 200); 
                            ?>
                            <p><?php  echo $shortDescription . ' ' . '...';?></p>
                            <button><a href="page_acteur.php?acteur=<?php echo $donnees['id_acteur'];?> ">lire la suite</a> </button>
                            </article> 
                    </section>
                <?php 
                }
                $reponse->closeCursor();
                ?>
            </section>
        </main>
        <?php include ("pieddepage.php") ?>
    </body>
</html>
