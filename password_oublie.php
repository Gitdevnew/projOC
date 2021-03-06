<?php
// Mise en mémoire tampon
ob_start();
// connexion à la bdd et initialisation de la variable title ajouté au header
$title = 'Page mot de passe oublié';
require("Commun/PDO.php");
require_once("Commun/header.php");
// démarrage de la session l'arobase sert a ne pas afficher l'erreur en cas d'attaque
@session_start();

//verification de l'envoi et securisation des donnees
if (isset($_POST['envoyer'])) {
    $username = htmlspecialchars($_POST['username']);
    $reponse = htmlspecialchars($_POST['reponsesecrete']);

    // verification du remplissage
    if (!empty($_POST['username']) AND !empty($_POST['reponsesecrete'])) {
        // on prepare la requete sur l'utilisateur on lie les valeurs avec Bind value par sécurité (ici pas besoin de préciser le type: par défaut = string)

        $stmt = $bdd->prepare('SELECT * FROM compte WHERE username = :username');

        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();

        // Si $result est vrai (si on ne met pas cette condition on obtient une erreur de type bool quand le pseudo saisi n'existe pas, mettre cette condition élimine l'erreur)
        if ($result) {
            // on compare la réponse envoyée via le formulaire avec celle de la  bdd
            $reponseCorrecte = (($_POST['username'] == $result['username']) AND ($_POST['reponsesecrete'] == $result['reponse']));



            // si la réponse n'est pas correcte on rempli une variable erreur a afficher
            if (!$reponseCorrecte) {
                $erreur = '<p style="color: #F51720;"><strong> Réponse incorrecte !</strong></p>';
            }

            // sinon si elle est correcte et que tout est ok on redirige vers la page nouveau mot de passe pour le changer
            else {
                $_SESSION['id_user'] = $result['id_user'];
                $_SESSION['pseudo'] = $result['username'];
                $_SESSION['nom']= $result['nom'];
                $_SESSION['prenom']= $result['prenom'];
                header('Location: nouveau_mot_de_passe.php');
            }
        }
    }

    // sinon on recupere le default de remplissage dans une variable champs
    else {
        $champs = '<p style="color: #F51720;"><strong>Veuillez remplir tous les champs.</strong></p>';
    }

}

?>

        <!-- Formulaire pseudo et réponse -->
        <div id="connect">
            <form class="formulaire" method="post" action="password_oublie.php">
                <label for="username"> Votre pseudo : </label> <br>
                <input class="input" type="text" name="username" id="username">
                 <br>
                <label for="reponsesecrete">Réponse à la question secrète :</label>
                <input class="input" type="text" name="reponsesecrete" id="reponsesecrete">
                <input class="btn_connexion buttons btn-hover color-8" type="submit" value="Valider" name="envoyer"> <br>
            </form>
            <?php
            // Affichage de la variable erreur si la reponse secrete est mauvaise
            if(isset($erreur)) {
                echo $erreur;
            }
            ?>
            <!-- Affichage de la vaiable champs si tout les champs ne sont pas remplis-->
            <?php
            if(isset($champs)) {
                echo $champs;
            }
            ?>
        </div>
<?php
include('Commun/footer.php');
?>
