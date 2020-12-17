
<?php

$title = 'Inscription nouvel utilisateur';
require("Commun/PDO.php");
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- affichage de la variable title dans la balise title-->
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
      <div >
        <a href="index.php">
          <img  src="Images/LOGO_GBAF.png" alt="logo" style="height: 100px;">
        </a>
      </div>
    </header>


      <div id="corps">
      <div id="connect">
        <h2>Inscription</h2>

        <form class="formulaire" method="post" action="inscription_PDO.php">
          <label for="nom"> Votre nom : </label> <br>
          <input class="input" type="text" name="nom">
          <label for="prenom"> Votre prénom : </label> <br>
          <input class="input" type="text" name="prenom">
          <label for="pseudo"> Votre pseudo : </label> <br>
          <input class="input" type="text" name="username">
          <label for="mdp"> Votre mot de passe : </label> <br>
          <input class="input" type="password" name="password">
          <label for="question"> Choisissez une question secrète : </label> <br>
          <select class="input" name="question">
            <option value="choix1">Le nom de jeune fille de votre mère</option>
            <option value="choix2">Le nom de votre premier animal de compagnie</option>
            <option value="choix3">La ville de naissance de votre père</option>
          </select> <br>
          <label for="reponse"> Réponse à la question secrète : </label> <br>
          <input class="input" type="text" name="reponse">
          <input class="btn_connexion" type="submit" name="valider" value="Valider">
        </form>
      </div>
    </div>

<!-- FOOTER -->
<?php

    include("Commun/footer.php");
?>
