<?php
// on transmet les informations de sessions l'arobase est une sécurité pour que l'erreur ne soit pas affichée en cas d'attaque
@session_start();
require("Commun/PDO.php");

    // récupération des informations correspondant au pseudo saisi

    $stmt = $bdd->prepare('SELECT id_user, nom, prenom, password FROM compte WHERE username = :username');
    $stmt->bindValue(':username', $_POST['username']);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->closeCursor ();

    // verification du remplissage des champs

    if (!empty($_POST['username']) AND !empty($_POST['password'])) {

        // verification que le mdp est bien celui enregistré
        $motdepasseBon = password_verify($_POST['password'], $result['password']);

        // s'il n'est pas bon redirection vers la page connexion et transmission message d'erreur password par l'url a affiché sur le formulaire

        if (!$motdepasseBon) {
            header('Location: connexion.php?err=password');
        }

        // sinon si tout est bon renvoi sur la page utilisateur connecté
        else {
            $_SESSION['id_user'] = $result['id_user'];
            $_SESSION['pseudo'] = $_POST['username'];
            $_SESSION['nom']= $result['nom'];
            $_SESSION['prenom']= $result['prenom'];
            header('Location: page_utilisateur.php');
        }
    }

    // sinon si tout les champs ne sont pas rempli redirection vers la page connexion et envoi dans l'url d'un message erreur champs par l'url a affiché sur le formulaire

    else {
        header('Location: connexion.php?err=champs');
    }
?>
