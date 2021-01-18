//vérifier si on a un même username 
        $req = $bdd->prepare('SELECT * FROM account WHERE username = "'.$pseudo.'"');
        $req->execute(array($pseudo));
        $pseudoExist = $req->rowcount();
        if($pseudoExist >=1)
        {
            $req2 = $bdd->prepare('SELECT * FROM account WHERE password = "'.$pass.'"');
            $req2->execute(array($pass));
            $passExist = password_verify($pass, password_hash($pass));
            if($passExist == 1)
            {
                $erreur = 'Vous êtes bien connecté';
            }
            else
            {
                $erreur = 'Mot de passe ou username ne correspond pas';
            }
        }
        else
        {
            $erreur = 'Veuillez créer un compte';
        }