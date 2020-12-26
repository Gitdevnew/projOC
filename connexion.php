
<?php
        // initialisation de la variable title ajoutéau header
        $title = 'Page connexion utilisateur';
        include("Commun/header.php");
?>



    <div id="corps">
      <div id="connect">
        <h2>    Connectez vous</h2>

        <!-- Formulaire de connexion -->
        <div class="formulaire">
          <form method="post" action="connexion_PDO.php">
            <fieldset>
            <legend>Utilisateur</legend>
            <label for="pseudo">Votre pseudo </label> <br>
            <input class="input" type="text" name="username" id="pseudo"> <br>
            <label for="mdp">Votre mot de passe </label> <br>
            <input class="input" type="password" name="password" id="mdp"><br>
            <input class="btn_connexion buttons btn-hover color-8" type="submit" value="Connexion"> <br><br>
            <a href="password_oublie.php"> Vous avez oublié votre mot de passe ? </a><br><br>
            </fieldset>
          </form>
        </div>

        <?php
        //affiche une erreur si le mdp est faux envoyé par la page connexion_PDO
        if(!empty($_GET['err']) && $_GET['err']== "password")
        {
          echo '<p style="color: #F51720;"><strong> Mot de passe ou pseudo incorrect ! </strong></p>';
        }

        // affiche une erreur si tous les champs ne sont pas remplis envoyé par la page connexion_PDO
        if(!empty($_GET['err']) && $_GET['err']== "champs")
        {
          echo '<p style="color: #F51720;"><strong>Veuillez remplir tous les champs.</strong></p>';
        }

        // affiche une validation si mdp modifié envoyé par la page nouveau_mot_de_passe
        if(!empty($_GET['ok']) && $_GET['ok']== "password")
        {
          echo '<p style="color: green;"><strong> Votre mot de passe a bien été modifié ! </strong> </p>';
        }
        ?>

      </div>
    </div>
<!-- footer -->
        <?php

        include("Commun/footer.php");
        ?>

