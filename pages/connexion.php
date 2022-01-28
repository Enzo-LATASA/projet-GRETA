<?php 
    //vérification de l'existance de l'identifiant et du mot de passe.
    //chargement des paramètres de la BD et connexion
    include('./utils/db.php');

    $username = htmlspecialchars($_POST['username']);
    $pwd = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id_util, pwd_util, prenom_util, nom_util, ident_util, is_admin_util FROM utilisateurs WHERE ident_util=?");
    $stmt->execute([$username]);    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        //il y a un résultat donc l'utilisateur existe, maintenant vérification du mot de passe
        $pwdHashBD = $result['pwd_util'];
        if (password_verify($pwd, $pwdHashBD)) {
            //le mot de passe en BD(qui a été crypté en PHP avant insertion) correspond au mot de passe saisi par l'utilisateur
            
            $_SESSION["etatConnexion"] = "1";
            //toutes les informations concernant l'utilisateur pourront être accessible durant la session
            $_SESSION["prenom"] = $result['prenom_util'];
            $_SESSION["nom"] = $result['nom_util'];
            $_SESSION["ident"] = $result['ident_util'];
            $_SESSION["id_util"] = $result['id_util'];
            $_SESSION["is_admin"] = $result['is_admin_util'];

            //redirection vers la page d'accueil
            header('Location: index.php?page=home');
            die();
        } else {
            //ce paramètre stocké en session permettra de savoir que la connexion a échoué
            //et donc d'afficher un message d'echec sur la page d'authentification
            $_SESSION["etatConnexion"] = "0";
            header('Location: index.php?page=authentif');
            die();
        }
    
    } else {
        // l'identifiant n'existe pas
        $_SESSION["etatConnexion"] = "0";
        header('Location: index.php?page=authentif');
        die();  
    }
?>