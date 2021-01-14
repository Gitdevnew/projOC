<?php

// page de traitement des infos du formulaire de la page inscription.php

require("Commun/PDO.php");

    // si la variable $_POST['valider'] existe

  if (isset($_POST['valider'])) {
    // securisation des donnees envoyées et du password et initialisation des variables à insérer

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']) ;
    $username = htmlspecialchars($_POST['username']);
    $password_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $question = ($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);

    // on verifie si tous les champs sont remplis

    if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['question']) AND !empty($_POST['reponse'])) {
      //d'abord on vérifie si le pseudo est déjà utiliser
      $stmt = $bdd->prepare("SELECT id_user FROM compte WHERE username = ?");

      $stmt->bindValue(1, $username);
      $stmt->execute();

      $stmt->closeCursor();
      // verification avec un rowcount
      $pseudoexistedeja = $stmt->rowcount();
      if ($pseudoexistedeja == 0) {
        // si les champs sont remplis et que le pseudo n'est pas déja utilisé alors insertion dans la bdd

        $stmt = $bdd->prepare("INSERT INTO compte(nom, prenom, username, password, question, reponse)
            VALUES (:nom, :prenom, :username, :password, :question, :reponse)");

        // on lie les valeurs avec Bind value par sécurité (ici pas besoin de préciser le type: par défaut = string)

        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password_hache);
        $stmt->bindValue(':question', $question);
        $stmt->bindValue(':reponse', $reponse);

        $stmt->execute();



        // puis redirection  vers la page  connexion
        header('Location: connexion.php');
      }
      else {
        // sinon si erreurs redirection vers la page inscription et affichage des erreurs dans la page inscription avec la methode get dans l'url
        header('location: inscription.php?err=pseudo');
      }
    }
    else {
      header('location: inscription.php?err=champ');
    }
  }
?>
