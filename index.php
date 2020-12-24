<!DOCTYPE html>
 <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="CSS/main2.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <title>Accueil Groupement Banque-Assurance Français (GBAF).</title>
    </head>
<body>
  <div id="logo">
               <a href="index.php" title= "Page accueil"> <img src="Images/LOGO_GBAF.png" alt="logo" style="width: 100px;"></a>
  </div>

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
</body>
</html>
