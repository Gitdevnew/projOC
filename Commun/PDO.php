<?php
try {
  $bdd = new PDO('mysql:host=localhost;dbname=proj3oc;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $e) {
     $message = "Erreur PDO avec le message : " . $e->getMessage();
     die($message);
}
