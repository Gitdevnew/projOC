<?php
session_start();
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
        Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française.<br/> Sa mission est de promouvoir l'activité bancaire à l’échelle nationale.<br/> C’est aussi un interlocuteur privilégié des pouvoirs publics.</p><br>

    </div>

    <div id="container_acteurs">
      <div id="contain_text">
        <h2> Acteurs et Partenaires </h2>
          <p> Présentation de la liste des différents acteurs du système bancaire français :</p>
      </div>
    </div>
<?php
include('Commun/footer.php');
?>