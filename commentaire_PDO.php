<?php
// on transmet les informations de sessions l'arobase est une sécurité pour que l'erreur ne soit pas affichée en cas d'attaque
@session_start();
$title = 'Page ajout d\'un commentaire';
require('Commun/PDO.php');
require_once('Commun/header.php');

//verification de l'envoi d'un commentaire et de son remplissage

if(isset($_POST['envoyer']) && !empty($_POST['envoyer'])) {
    // et initialisation  des variables + sécurisation du commentaire pour les requètes
    $idUser = $_POST['id_user'];
    $idActeur = $_POST["id_acteur"];
    $commentaire = htmlspecialchars($_POST['commentaire']);


// puis on selectionne l'utilisateur et l'acteur pour Vérifier si l'utilisateur l'a déjà commenté (avec bind value + data-type: param int pour les ids)

$stmt = $bdd->prepare('SELECT commentaire FROM commentaires WHERE user_id= :id_user AND acteur_id = :id_acteur');

$stmt->bindValue(':id_user', $idUser, PDO::PARAM_INT);
$stmt->bindValue(':id_acteur', $idActeur, PDO::PARAM_INT);
$stmt->execute();

$stmt->closeCursor ();

// rowcount pour verifier si un commentaire de cet utilisateur sur cet acteur à déjà été envoyé

$commentaireDejaEnvoye = $stmt->rowcount();
    if ($commentaireDejaEnvoye == 0) {

        // si aucun commentaire n'a déjà été envoyer ( == 0) verifier si les champs sont remplis

        if(isset($_POST['commentaire']) AND !empty($_POST['commentaire'])) {
            //puis insertion du commentaire dans la base (avec bind value + data-type: param int pour les ids (la valeur par defaut est string : PDO::PARAM_STR donc pas besoin de rajouter pour commentaire))

            $stmt = $bdd->prepare('INSERT INTO commentaires(user_id, acteur_id, date_ajout, commentaire) VALUES (:id_user, :id_acteur, NOW(), :commentaire)');

                $stmt->bindValue(':id_user', $idUser, PDO::PARAM_INT);
                $stmt->bindValue(':id_acteur', $idActeur, PDO::PARAM_INT);
                $stmt->bindValue(':commentaire', $commentaire);
                $stmt->execute();

            // préparation de la variable succes pour affichage

                $succesCommentaire = '<p style="color: green; margin-left: 10px;"> Merci pour votre commentaire, il a bien été pris en compte !</p>
                <p> <a href="page_utilisateur.php" style="color: #0f646f;"> Cliquez ici pour retourner à la page des acteurs </a>';
        }
        // sinon si les variables sont vides, affichage d'un message
        else {
            echo '<p style="color: #F51720;"> Veuillez remplir tous les champs !</p>';
        }

        // et dans le cas ou un commentaire existe déjà message + redirection vers la page de presentation des acteurs
    }
    else {
        echo '<p style="color: #F51720; margin-top: 50px; text-align: center;"> Vous avez déjà envoyé un commentaire, un seul commentaire par acteur est autorisé !</p></br>';
        echo '<p> <a href="page_utilisateur.php" style="color: #0f646f; font-weight: bold; margin-left: 100px;" > Cliquez ici pour retourner à la page des acteurs </a>';
    }
}
?>
    <div class="comment_pdo">
        <div id="connect" >

            <!-- formulaire envoi commentaire + les id pour traitement des requetes -->

            <form class="formulaire" method="POST" action="commentaire_PDO.php?id=<?= $_GET['id']; ?>">
                <h2> Votre commentaire :</h2>
                <textarea  class="input" name="commentaire"></textarea> <br/> <br/>
                <input class="btn_connexion buttons btn-hover color-8" type="submit" value="Valider" name="envoyer" /> <br/>

                <!-- ajout de deux champs cachés pour pouvoir faire les verifications dans la base via la transmission des id -->

                <input type="hidden" name="id_acteur" id = "id_acteur" value="<?= $_GET['id']; ?>" />
                <input type="hidden" name="id_user" id = "id_user" value="<?= $_SESSION['id_user']; ?>" />
            </form>
            <!-- affichage variable succes si elle existe après envoi du commentaire-->

            <?php if(isset($succesCommentaire)) {echo $succesCommentaire;} ?>
        </div>
    </div>
<?php
include('Commun/footer.php');
?>
