<?php
require("Commun/PDO.php");
// verification des variables session  pour afficher les header utilisateur connecté ou pas.
// Si les variables de sessions sont vides afficher le Header utilisateur non connecté
if(empty($_SESSION['id_user']) AND empty($_SESSION['pseudo']) AND empty($_SESSION['nom']) AND empty($_SESSION['prenom'])) {
?>
 <!-- Header utilisateur non connecté  -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <?php
            if(!empty($title))
            {
        ?>
        <title><?= $title; }?></title>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="CSS/main2.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <div>

                <a href="index.php">
                    <div id="logo">
                        <img class="logo" src="Images/LOGO_GBAF.png" alt="logo" style="height: 100px;">
                    </div>
                    <br><br>
                </a>
            </div>
        </header>
 <?php }
// Autrement si les variables de sessions ne sont pas vides afficher le Header utilisateur connecté
else {
?>
<!-- Header utilisateur connecté -->
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <?php
                if(!empty($title))
                {
            ?>
            <title><?= $title; }?></title>
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                </div>
            </header>
<?php }
?>


