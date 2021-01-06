<?php
// récupération des données session
session_start();
$title = 'Page des paramètres utilisateur';
require("Commun/PDO.php");
require_once("Commun/header_connecte.php");
// on selectionne d'abord toutes les données de l'utilisateur présentes dans la base grace a son id et l'id de session que l'on met dans une variable ($user) pour faire les verifications(comparaisons)
if(isset($_SESSION['id_user'])) {
   $stmt = $bdd->prepare("SELECT * FROM compte WHERE id_user= :id_user");
   $stmt->bindValue(':id_user', $_SESSION['id_user']);
   $stmt->execute();
   $user = $stmt->fetch();
   $stmt->closeCursor();

   // verification du remplissage du champ et de la modification des données par l'utilisateur (on compare la nouvelle donnée avec celle existente dans la base: si != on modifie, si = rien ne se passe)
   // puis securisation des donnees avec htmlspecialchars et des bind values, toutes les modifications de la base de données se font avec l'id_user de l'utilisateur (récupéré par la session)
  // + création d'une variable après chaque requète pour afficher les messages erreurs ou succes a afficher sur le formulaire
   if(isset($_POST['n_nom']) AND !empty($_POST['n_nom']) AND $_POST['n_nom'] != $user['nom']) {
      $nNom = htmlspecialchars($_POST['n_nom']);
      $stmt = $bdd->prepare("UPDATE compte SET nom= :nom WHERE id_user= :id_user");
      $stmt->bindValue(':nom', $nNom);
      $stmt->bindValue(':id_user', $_SESSION['id_user']);
      $stmt->execute();
      $succesNom = '<p style="color: green;">Votre nom a été modifié, la modification s\'affichera lors de votre prochaine connexion ! </p>';
   }

   if(isset($_POST['n_prenom']) AND !empty($_POST['n_prenom']) AND $_POST['n_prenom'] != $user['prenom']) {
      $nPrenom = htmlspecialchars($_POST['n_prenom']);
      $stmt = $bdd->prepare("UPDATE compte SET prenom = :prenom WHERE id_user = :id_user");
      $stmt->bindValue(':prenom', $nPrenom);
      $stmt->bindValue(':id_user', $_SESSION['id_user']);
      $stmt->execute();
      $succesPrenom = '<p style="color: green;">Votre prénom a été modifié, la modification s\'affichera lors de votre prochaine connexion ! </p>';
   }

   if(isset($_POST['n_pseudo']) AND !empty($_POST['n_pseudo']) AND $_POST['n_pseudo'] != $user['username']) {
      // pour le pseudo il faut en plus verifier avec un rowcount que le nouveau pseudo saisi n'est pas deja utilise avant de modifier la table avec une deuxième requète
      $nPseudo = htmlspecialchars($_POST['n_pseudo']);
      $stmt = $bdd->prepare('SELECT * FROM compte WHERE username= :username');
      $stmt->bindValue(':username', $nPseudo);
      $stmt->execute();
      $pseudoDejaPris = $stmt->rowCount();
      // si le pseudo est libre (valeur = 0) on met à jour
      if($pseudoDejaPris == 0) {
      $stmt = $bdd->prepare("UPDATE compte SET username= :username WHERE id_user = :id_user");
      $stmt->bindValue(':username', $nPseudo);
      $stmt->bindValue(':id_user', $_SESSION['id_user']);
      $stmt->execute();
      $succesPseudo = '<p style="color: green;">Votre pseudo a bien été modifié ! </p>';
      }
      else {
         // Sinon on prépare une variable pour afficher un avertissement à l'utilisateur
         $erreurPseudo = '<p style="color: #F51720;"><strong> Ce pseudo est déjà utilisé ! </strong></p>';
      }
   }
   // idem pour question,reponse, mot de passe même procédure
   if(isset($_POST['n_question']) AND !empty($_POST['n_question']) AND $_POST['n_question'] != $user['question']) {
      $nQuestion = htmlspecialchars($_POST['n_question']);
      $stmt = $bdd->prepare("UPDATE compte SET question= :question WHERE id_user= :id_user");
      $stmt->bindValue(':question', $nQuestion);
      $stmt->bindValue(':id_user', $_SESSION['id_user']);
      $stmt->execute();
      $succesQuestion = '<p style="color: green;">Votre choix a été pris en compte !</p>';
   }

   if(isset($_POST['n_reponse']) AND !empty($_POST['n_reponse']) AND $_POST['n_reponse'] != $user['reponse']) {
      $nReponse = htmlspecialchars($_POST['n_reponse']);
      $stmt = $bdd->prepare("UPDATE compte SET reponse= :reponse WHERE id_user= :id_user");
      $stmt->bindValue(':reponse', $nReponse);
      $stmt->bindValue(':id_user', $_SESSION['id_user']);
      $stmt->execute();
      $succesReponse = '<p style="color: green;">Votre réponse a été modifiée ! </p>';
   }
   // sécurisation du nouveau mot de passe en plus avant modification
   if(isset($_POST['n_password']) AND !empty($_POST['n_password']) AND $_POST['n_password'] != $user['password']) {
      $nPassword = password_hash($_POST['n_password'], PASSWORD_DEFAULT);
      $stmt = $bdd->prepare("UPDATE compte SET password= :password WHERE id_user= :id_user");
      $stmt->bindValue(':password', $nPassword);
      $stmt->bindValue(':id_user', $_SESSION['id_user']);
      $stmt->execute();
      $succesPassword = '<p style="color: green;">Votre mot de passe a été modifié ! </p>';
   }

?>
<!-- formulaire de modification des informations + affichage des variables succes si modification-->

<div id="connect">
   <h3>Paramètres du compte utilisateur</h3>
   <form class="formulaire" method="post" action="page_des_parametres_utilisateur.php">
      <fieldset>
      <legend>Vos informations</legend>
      <label for="nom">Nom :</label>
      <input class="input" type="text" name="n_nom" placeholder="Nom" value="<?php echo $user['nom']; ?>" id="nom" />
      <?php if(isset($succesNom)) { echo $succesNom; } ?>
      <br />
      <br />
      <label for="prenom">Prénom :</label>
      <input class="input" type="text" name="n_prenom" placeholder="Prénom" value="<?php echo $user['prenom']; ?>" id="prenom" />
      <?php if(isset($succesPrenom)) { echo $succesPrenom; } ?>
      <br />
      <br />
      <!-- Pour le pseudo en plus affichage d'un avertissement pseudo déjà utilisé au cas où-->
      <label for="pseudo">Pseudo :</label>
      <input class="input" type="text" name="n_pseudo" placeholder="Pseudo" value="<?php echo $user['username']; ?>" id="pseudo" />
      <?php if(isset($succesPseudo)) { echo $succesPseudo;}
            if(isset($erreurPseudo)) { echo $erreurPseudo;} ?>
      <br />
      <br />
      <label for="question">Question secrète :</label>
      <select class="input" name="n_question" id="question">
         <option value="choix1">Le nom de jeune fille de votre mère</option>
         <option value="choix2">Le nom de votre premier animal de compagnie</option>
         <option value="choix3">La ville de naissance de votre père</option>
      </select>
      <?php if(isset($succesQuestion)) { echo $succesQuestion; } ?>
      <br/>
      <br/>
      <label for="reponse">Réponse à la question secrète :</label>
      <input class="input" type="text" name="n_reponse" placeholder="Réponse à la question choisie" id="reponse" />
      <?php if(isset($succesReponse)) { echo $succesReponse; } ?>
      <br />
      <br />
      <label for="password">Mot de passe :</label>
      <input class="input" type="password" name="n_password" placeholder="Mot de passe" id="password"/>
      <?php if(isset($succesPassword)) { echo $succesPassword; } ?>
      <br />
      <br />
      <input class="btn_connexion" type="submit" value="Mettre à jour" />
      </fieldset>
   </form><br/><br/>
</div>
<?php
}
else
{
   header("Location: connexion.php");
}
?>
