<?php
// mise en mémoire tampon
ob_start();
// connexion à la bdd et /initialisation de la variable title ajouté au header
$title = 'Changement du mot de passe';
require("Commun/PDO.php");
require_once("Commun/header.php");
// Demarrage session avec un arobase par sécurité
@session_start();

// verification des donnees de session
if (!empty($_SESSION['id_user'])) {
    //verification envoi et remplissage de la variable $_post
    if (isset($_POST['envoyer'])) {
        if(!empty($_POST['password'])) {
            // securisation du nouveau mot de passe envoyé par le formulaire avec password_hash($_POST['password'], PASSWORD_DEFAULT); et je fais un bind value, pas besoin de préciser le type: par défaut = string) et mise a jour du nouveau mot de passe dans la table compte

            $stmt = $bdd->prepare('UPDATE compte SET password= :password WHERE username= :username');
            $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
            $stmt->bindValue(':username', $_SESSION['pseudo']);
            $stmt->execute();


            // puis redirection vers la page connexion et envoi du message ok par l'url
            header('Location: connexion.php?ok=password');
        }
        // Si tout les champs ne sont pas remplis
        else {
            echo '<p style="color: #F51720;"><strong>Veuillez remplir tous les champs.</strong></p>';
        }
    }
}
// Autrement la page  ne doit pas s'afficher si la session n'est pas ouverte redirection vers connexion
else {
    header('location: connexion.php');
}
?>

        <div id="connect">
            <form class="form" method="post" action="nouveau_mot_de_passe.php">
                <label for="password"> Saisissez votre nouveau mot de passe ! :</label> <br>
                <input class="input" type="password" name="password" id="password"> <br>
                <input class="btn_connexion buttons btn-hover color-8" type="submit" value="Valider" name="envoyer"> <br>
            </form>
        </div>
<?php
// footer
include('Commun/footer.php');
?>
