<?php
session_start();

// Suppression des variables

unset($_SESSION['prenom']);
$_SESSION = array();

// Suppression de la session
session_destroy();

// Suppression des cookies
setcookie('login', '');
setcookie('pass_hache', '');
header('location: index.php');


?>
