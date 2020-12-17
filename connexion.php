
<?php
        //initialisation de la variable title ajouté au header
        $title = 'Page connexion utilisateur';
        include("Commun/header.php");
?>



    <div id="corps">
      <div id="connect">
        <h2>    Connectez vous</h2>
        <!-- Formulaire de connexion -->
        <div class="formulaire">
          <form method="post" action="verification_connexion.php">
            <label for="pseudo">Votre pseudo </label> <br>
            <input class="input" type="text" name="username" id="pseudo"> <br>
            <label for="mdp">Votre mot de passe </label> <br>
            <input class="input" type="password" name="password" id="mdp"><br>
            <input class="btn_connexion" type="submit" value="Connexion"> <br><br>
            <a href="password_oublie.php"> Vous avez oublié votre mot de passe ? </a><br><br>
          </form>
        </div>
        <div class="new_u">
          <p> Nouvel utilisateur ?<br>
            <button class="btn_connexion" onclick= "window.location.href ='inscription.php';">Inscrivez vous</button>
          </p>
        </div>
      </div>
    </div>
<!-- FOOTER -->
<?php

    include("Commun/footer.php");
 ?>

