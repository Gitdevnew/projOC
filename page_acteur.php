<?php
// on transmet les informations de sessions l'arobase est une sécurité pour que l'erreur ne soit pas affichée en cas d'attaque
@session_start();
$title = 'Page d\'un acteur';
require("Commun/PDO.php");
require_once("Commun/header.php");

// On vérifie d'abord que la variable $_GET['id'] est bien présente et remplie
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // On met l'id dans une variable $getId qui servira pour toutes les requetes de la page et l'envoi de l'id dans l'url (pour les pages: commentaire_PDO.php et like_dislike_PDO.php)
    $getId = ($_GET['id']);
    // On récupère toutes les données de l' acteur grace a son id avec un bind value
    $stmt = $bdd->prepare('SELECT * FROM acteur WHERE id_acteur = :id_acteur');
    $stmt->bindValue(':id_acteur', $getId, PDO::PARAM_INT);
    $stmt->execute();
}
// on verifie avec un rowcount == 1 que l' acteur est bien sélectionné (par son id) puis on rempli les variables d'affichage dans la page acteur
if($stmt->rowCount() == 1) {
    $result = $stmt->fetch();
    $nom = $result['acteur'];
    $description = $result['description'];
    $logo = $result['logo'];
}

?>

            <!-- Affichage des données de l'acteur -->
        <div class="aff_don">
            <div id="connect">
                <div class="contain_logo">
                    <img class="img_logo"  src="<?php echo $logo; ?>" alt="logo de l'acteur"/> <br/><br/>
                </div>
                <div class="contain_donnees">
                    <?php
                        echo '<h2>' . $nom . '</h2>';
                        echo $description;
                    ?>
                </div>
            </div>
        </div>
            <!-- Ajout des commentaires et des likes-dislikes -->

            <div>
                <div>
                       <!--Ajouter un commentaire le bouton renvoi vers la page de traitement des commentaires avec l'id dans l'url-->
                    <div class="like_dislike">
                        <button  class="btn_connexion buttons btn-hover color-8" onclick= "window.location.href ='commentaire_PDO.php?id=<?= $getId?>';"> Ajoutez un commentaire </button>

<!-- Code d'ajout et retrait des likes et dislikes après traitement-->
<?php
if($stmt->rowCount() == 1) {


// on rajoute 1 ou on enlève 1 au nombre des likes
$stmt = $bdd->prepare('SELECT id_like FROM likes WHERE acteur_id = :id_acteur');
$stmt->bindValue(':id_acteur', $getId, PDO::PARAM_INT);
$stmt->execute();
$likes = $stmt->rowCount();

// on rajoute 1 ou on enlève 1 au nombre des dislikes
$stmt = $bdd->prepare('SELECT id_dislike FROM dislikes WHERE acteur_id = :id_acteur');
$stmt->bindValue(':id_acteur', $getId, PDO::PARAM_INT);
$stmt->execute();
$dislikes = $stmt->rowCount();
}
?>
                    <!-- Likes: renvoi vers la page de traitement des like-dislike avec le numero de vote=1 attribué au like et l'id dans l'url et affichage du nombre de likes grace à la variable contenant le rowcount -->
                        <div class="like">
                        <button class="btn_like" name="vote" value="like" onclick= "window.location.href='like_dislike_PDO.php?vote=1&id=<?= $getId; ?>';" title="J'aime">
                        <img class="icon" src="Images/like_icon.png" alt="like">
                        <?= $likes ?>
                        </button>

                    <!-- Dislikes: renvoi vers la page de traitement des like-dislike avec le numero de vote=2 attribué au dislike et l'id dans l'url et affichage du nombre de dislikes grace à la variable contenant le rowcount -->
                        <div class="dislike">
                        <button class="btn_like"  name="vote" value="dislike" onclick= "window.location.href='like_dislike_PDO.php?vote=2&id=<?= $getId; ?>';" title="Je n'aime pas">
                        <img class="icon" src="Images/dislike-icon.png" alt="dislike">
                        <?= $dislikes ?>
                        </button>
                        </div>
                        </div>
                    </div>

                    <?php
                    // Comptage du nombre de commentaires sur cet acteur dans la table avec COUNT
                    $stmt = $bdd->prepare('SELECT COUNT(commentaire) as Cc FROM commentaires WHERE acteur_id =:id_acteur');
                    $stmt->bindValue(':id_acteur', $getId, PDO::PARAM_INT);
                    $stmt->execute();

                    // Et afficher le résultat avec une boucle while (affichage en dehors de la div des commentaires)
                    while($result = $stmt->fetch()) {

                        echo  '<h3 style="font-weight: bold; margin-left: 105px;">' . $result['Cc'] .  ' commentaire</h3>';
                    }

                    $stmt->closeCursor();
                    ?>


                </div>
            </div>


            <!-- Affichage des commentaires -->

            <div class="connect">
                <?php
                    //requete SELECT avec INNER JOIN entre les tables compte et commentaires pour récuperer les commentaires de l'acteur (grace à l'id) et afficher le plus récent en premier
                    $stmt = $bdd->prepare('SELECT commentaires.id_commentaire, commentaires.user_id, compte.prenom, compte.nom, commentaires.commentaire,
                    DATE_FORMAT(date_ajout, \'%d/%m/%Y \') AS date_commentaire
                    FROM commentaires INNER JOIN compte ON commentaires.user_id = compte.id_user
                    WHERE acteur_id = :id_acteur ORDER BY date_ajout DESC');
                    $stmt->bindValue(':id_acteur', $getId, PDO::PARAM_INT);
                    $stmt->execute();
                // puis affichage des infos de l'utilisateur et des commentaires avec une boucle while
                while ($result = $stmt->fetch()) {
                ?>
                <p class="p_pnd"><?= $result['prenom']; ?> <?= $result['nom']; ?> a commenté le : <?= $result['date_commentaire']; ?> </p>
                <p class="p_c" ><?= $result['commentaire']; ?></p>

                <?php
                }
                $stmt->closeCursor();
                ?>
            </div>

<?php
include('Commun/footer.php');
?>
