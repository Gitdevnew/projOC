<?php
session_start();
$title = 'Page des likes et dislikes';
require("Commun/PDO.php");
// require_once("Commun/header.php");

//Vérification de la présence et du remplissage des variables  envoyés par la page page_acteur.php ( ids et transmission du vote 1 ou 2)

if(isset($_GET['vote']) AND isset($_GET['id']) AND isset($_SESSION['id_user']) AND !empty($_GET['vote']) AND !empty($_GET['id']) AND !empty($_SESSION['id_user'])) {
    // Puis on rempli des variables avec (int) pour les transformer en nombre entier (les variables get sont des strings)

    $id = (int)$_GET['id'];
    $vote = (int)$_GET['vote'];
    $idDeSession = (int)$_SESSION['id_user'];

    // On selectionne  l'id_acteur pour vérifier qu'il existe
    $stmt = $bdd->prepare('SELECT id_acteur FROM acteur WHERE id_acteur =:id_acteur');
    $stmt->bindValue(':id_acteur', $id, PDO::PARAM_INT);
    $stmt->execute();

    // utilisation d'un rowcount pour faire la verification
    if($stmt->rowCount() == 1) {
        // puis on verifie la valeur du vote si c'est = 1 c'est un like
        if($vote == 1) {
            // on vérifie si l'utilisateur  a déjà fait un like sur l'acteur + un bindvalue
            $stmtLike = $bdd->prepare('SELECT id_like FROM likes WHERE acteur_id = :id_acteur AND user_id = :id_user');
            $stmtLike->bindValue(':id_acteur', $id, PDO::PARAM_INT);
            $stmtLike->bindValue(':id_user', $idDeSession, PDO::PARAM_INT);
            $stmtLike->execute();

            // Si l'utilisateur a disliké l'acteur, on supprime le dislike
            $stmtDislike = $bdd->prepare('DELETE FROM dislikes WHERE acteur_id = :id_acteur AND user_id = :id_user');
            $stmtDislike->bindValue(':id_acteur', $id, PDO::PARAM_INT);
            $stmtDislike->bindValue(':id_user', $idDeSession, PDO::PARAM_INT);
            $stmtDislike->execute();

              // on verifie avec rowcount s'il y a déjà un like, et on le supprime
              if($stmtLike->rowCount() == 1) {
                  $stmtDislike = $bdd->prepare('DELETE FROM likes WHERE acteur_id = :id_acteur AND user_id = :id_user');
                  $stmtDislike->bindValue(':id_acteur', $id, PDO::PARAM_INT);
                  $stmtDislike->bindValue(':id_user', $idDeSession, PDO::PARAM_INT);
                  $stmtDislike->execute();
              }
              // autrement s'il n'y a pas de like, on le rajoute
              else {
                  $stmt = $bdd->prepare('INSERT INTO likes (acteur_id, user_id) VALUES (:id_acteur, :id_user)');
                  $stmt->bindValue(':id_acteur', $id, PDO::PARAM_INT);
                  $stmt->bindValue(':id_user', $idDeSession, PDO::PARAM_INT);
                  $stmt->execute();
              }
        }
        // la meme chose pour dislike, on verifie la valeur du vote si c'est =  2 c'est un dislike a traité
        elseif ($vote == 2) {
            // On vérifie si l'utilisateur de la session a déjà fait un dislike sur l'acteur
            $stmtLike = $bdd->prepare('SELECT id_dislike FROM dislikes WHERE acteur_id = :id_acteur AND user_id = :id_user');
            $stmtLike->bindValue(':id_acteur', $id, PDO::PARAM_INT);
            $stmtLike->bindValue(':id_user', $idDeSession, PDO::PARAM_INT);
            $stmtLike->execute();
            // Si l'utilisateur a déjà liké l'acteur, on supprime le like
            $stmtDislike = $bdd->prepare('DELETE FROM likes WHERE acteur_id = :id_acteur AND user_id = :id_user');
            $stmtDislike->bindValue(':id_acteur', $id, PDO::PARAM_INT);
            $stmtDislike->bindValue(':id_user', $idDeSession, PDO::PARAM_INT);
            $stmtDislike->execute();
              // on verifie avec un rowcount s'il y a déjà un dislike, et on le supprime
              if($stmtLike->rowCount() == 1) {
                  $stmtDislike = $bdd->prepare('DELETE FROM dislikes WHERE acteur_id = :id_acteur AND user_id = :id_user ');
                  $stmtDislike->bindValue(':id_acteur', $id, PDO::PARAM_INT);
                  $stmtDislike->bindValue(':id_user', $idDeSession, PDO::PARAM_INT);
                  $stmtDislike->execute();
              }
              // S'il n'y a pas déjà de dislike, on en rajoute 1
              else {
                  $stmt = $bdd->prepare('INSERT INTO dislikes (acteur_id, user_id) VALUES (:id_acteur, :id_user)');
                  $stmt->bindValue(':id_acteur', $id, PDO::PARAM_INT);
                  $stmt->bindValue(':id_user', $idDeSession, PDO::PARAM_INT);
                  $stmt->execute();
              }
        }
        // redirection et actualisation de la page acteur

        header('Location: page_acteur.php?id=' .$id);
    }
    // sinon gestion des erreurs
    else {
        exit('Erreur Fatale');
    }
}
else {
    exit('Erreur Fatale. <a href="page_utilisateur.php">Revenir à la page d\'accueil</a>');
}
?>
