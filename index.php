
<?php
// initialisation de la variable title ajoutéau header
$title = 'Accueil Groupement Banque-Assurance Français (GBAF)';
include("Commun/header.php");
?>

        <div class="container">
          <h2>  Extranet du Groupement Banque-Assurance Français (GBAF)</h2>
          <div class="buttons">
            <button class="btn-hover color-8">
             <a href="connexion.php">Allez à la page de connexion</a>
            </button>
          </div>
          <div class="buttons">
            <p> Nouvel utilisateur ?<br>
              <button class="btn-hover color-11" onclick= "window.location.href ='inscription.php';">Inscrivez vous</button>
            </p>
          </div>

        </div>

<?php
include("Commun/footer.php");
 ?>

