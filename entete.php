<header>
    <div id="naviguation">
        <!-- logo gbaf et l'icone de droite avec le nom et prénom d'utilisateur -->
        <a href="index.php">
            <img id="logo" src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png" alt="logo GBAF">
        </a> 
        <div class="header_right">
            <div id="icone">
                <a href="parametre_compte.php">
                    <img src="images/icone.jpg" alt="icone" >
                </a>
            </div>
            <?php 
                if(!empty($_SESSION)){
            ?>
            <div class="nom_prenom">
                <a href="parametre_compte.php">
                    <?php echo $_SESSION['nom'] . "&nbsp" . $_SESSION['prenom'];
                    ?>
                </a> 
            </div> 
            <?php
            }
            ?>
        </div>
    </div>
</header>

 

