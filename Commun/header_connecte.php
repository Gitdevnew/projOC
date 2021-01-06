<?php
require("Commun/PDO.php");

// verification des variables session par sécurité pour afficher les donnees utilisateur

if(empty($_SESSION['id_user']) AND empty($_SESSION['pseudo']) AND empty($_SESSION['nom']) AND empty($_SESSION['prenom']))
{
    header('location: connexion.php');
}
else
{
?>

<!DOCTYPE html>
    <html lang="fr">
    <!-- Header utilisateur connecté -->
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <?php
                if(!empty($title))
                {
            ?>
            <title><?= $title; }?></title>
            <link rel="stylesheet" type="text/css" href="CSS/main2.css">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        </head>
        <body>
            <header>

                 <a href="page_utilisateur.php">
                    <span>
                        <img  src="Images/LOGO_GBAF.png" alt="logo" style="height: 80px;">
                    </span>
                </a>
                <div id="affichage_nom">
                   <!-- affichage des données utilisateurs dans le header récupéré par la super globale $_session -->
                    <p>
                        <?php
                            echo "Bienvenue  " . $_SESSION['nom'] .' '. $_SESSION['prenom'] . " !";
                        ?>
                    </p>
                    <!-- affichage des liens vers les parametres du compte utilisateur et page de deconnexion quand l'utilisateur est connecté -->
                    <button  class=" btn_connexion buttons btn-hover color-8"  onclick= "window.location.href = 'page_des_parametres_utilisateur.php';"> Paramètres Utilisateur
                    </button>
                    <button class="btn_connexion  buttons btn-hover color-11" onclick= "window.location.href = 'page_de_deconnexion.php';"> Déconnexion
                    </button>
                    <?php
                        }

                    ?>
                </div>
            </header>
