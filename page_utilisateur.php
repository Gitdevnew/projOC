<?php
// rajout arobase par securité a session
@session_start();
 $title = 'Page utilisateur connecté';
 require("Commun/PDO.php");
include("Commun/header_connecte.php");

?>

<br>
<div id="contain_desc">
  <br><br><br>
  <h1> Bienvenue sur l'extranet de GBAF </h1>
  <p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :<br/><br/>
  BNP Paribas <br/>
  BPCE <br/>
  Crédit Agricole <br/>
  Crédit Mutuel-CIC <br/>
  Société Générale <br/>
  La Banque Postale<br/><br/>
  Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.<br/>
  Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française.<br/> Sa mission est de promouvoir l'activité bancaire à l’échelle nationale.<br/> C’est aussi un interlocuteur privilégié des pouvoirs publics.
  </p><br>
</div>

<div id="container_acteurs">
  <div id="contain_text">
    <h2> Acteurs et Partenaires </h2>
    <p> Présentation de la liste des différents acteurs du système bancaire français :</p>
  </div>

  <div>
    <?php
    $stmt = $bdd->query('SELECT * FROM acteur');
    // Boucle while pour l'affichage des données des acteurs, permettra de rajouter des acteurs sans changer le code (ce qui aurait été le cas si j'avais utilisé une boucle for)
    while($acteur = $stmt->fetch()) {
    ?>
    <div class="contain_acteur">
      <!-- Affichage du logo,nom et début de la description -->
      <img src="<?php echo $acteur['logo'];?>" alt="logo"/>
    <div>
        <?php
          echo '<h2>' . $acteur['acteur'] . '</h2>';
          echo substr($acteur['description'], 0, 114).'...';
        ?>
        <!-- Envoi sur la page de l'acteur avec l'id dans l'url -->
        <button class="btn_connexion  buttons btn-hover color-1" onclick= "window.location.href='page_acteur.php?id=<?php echo $acteur['id_acteur']; ?>';">Afficher la suite
        </button>
      </div>
    </div>
    <?php
    }
    ?>
  </div>
</div>
<?php
include('Commun/footer.php');
?>
