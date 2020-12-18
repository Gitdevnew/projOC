<?php
//initialisation de la variable title ajouté au header
        $title = 'Page mot de passe oublié';

include("Commun/header.php");
?>

        <!-- Formulaire pseudo et réponse -->
        <div id="connect">
            <form class="formulaire" method="post" action="password_oublie.php">
                <label for="username"> Votre pseudo : </label> <br>
                <input class="input" type="text" name="username" id="username">
                 <br>
                <label for="reponse_secrete">Réponse à la question secrète :</label>
                <input class="input" type="text" name="reponsesecrete" id="reponsesecrete">
                <input class="btn_connexion" type="submit" value="Valider" name="envoyer"> <br>
            </form>
        </div>
<?php
include('Commun/footer.php');
?>
