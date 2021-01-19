
<?php
// initialisation de la variable title ajoutéau header
$title = 'Accueil Groupement Banque-Assurance Français (GBAF)';
include("Commun/header.php");
?>


        <div class="container">

         <h1 >  Extranet du Groupement Banque-Assurance Français (GBAF)</h1>

          <div class="buttons">
            <p> Allez à la page de connexion<br>
              <button class="btn_connexion btn-hover color-8" onclick= "window.location.href ='connexion.php';">Connexion</button>
            </p>
          </div>
          <div class="buttons">
            <p> Nouvel utilisateur ?<br>
              <button class="btn_connexion btn-hover color-11" onclick= "window.location.href ='inscription.php';">Inscrivez vous</button>
            </p>
          </div>

        </div>

<?php
include("Commun/footer.php");
 ?>

