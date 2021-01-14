
<?php
$title = 'Inscription nouvel utilisateur';
require("Commun/PDO.php");
include("Commun/header.php");
?>

    <div id="corps">
      <div id="connect">
        <h2>Inscription</h2>

        <?php // recuperation dans l'url et affichage du message d'erreur (envoyé par la page inscription_PDO) si le pseudo choisi n'est pas libre
        if(!empty($_GET['err']) && $_GET['err']== "pseudo") {
          echo '<p style="color: #F51720;"><strong> Pseudo déjà utilisé, veuillez en choisir un autre ! </strong></p>';
        }
        // recuperation dans l'url et affichage du message d'erreur (envoyé par la page inscription_PDO) si le remplissage des  champs infos n'est pas complet

        if(!empty($_GET['err']) && $_GET['err']== "champ") {
          echo '<p style="color: #F51720;"><strong> Veuillez remplir tous les champs. </strong></p>';
        }
        ?>

        <form class="formulaire" method="post" action="inscription_PDO.php">
          <label for="nom"> Votre nom : </label> <br>
          <input class="input" type="text" name="nom"><br>
          <label for="prenom"> Votre prénom : </label> <br>
          <input class="input" type="text" name="prenom"><br>
          <label for="pseudo"> Votre pseudo : </label> <br>
          <input class="input" type="text" name="username"><br>
          <label for="mdp"> Votre mot de passe : </label> <br>
          <input class="input" type="password" name="password"><br>
          <label for="question"> Choisissez une question secrète : </label> <br>
          <select class="input" name="question">
            <option value="choix1">Le nom de jeune fille de votre mère</option>
            <option value="choix2">Le nom de votre premier animal de compagnie</option>
            <option value="choix3">La ville de naissance de votre père</option>
          </select> <br>
          <label for="reponse"> Réponse à la question secrète : </label> <br>
          <input class="input" type="text" name="reponse">
          <input class="btn_connexion buttons btn-hover color-8" type="submit" name="valider" value="Valider">
        </form>
      </div>
    </div>

<!-- footer -->
<?php
include("Commun/footer.php");
?>

