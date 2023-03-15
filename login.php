<?php
 require_once('inc/manager-db.php');
 require_once('inc/connect-db.php');
 // on teste si nos variables sont définies et remplies
 if (isset($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['email'])&& !
empty($_POST['email'])) {
 // on appele la fonction getAuthentification en lui passant en paramètre le login et password
 $result = getAuthentification($_POST['email'],$_POST['mdp']);
 print_r($result);
 // si le résulat n'est pas false
 if($result){
// on la démarre la session
session_start ();
// on enregistre les paramètres de notre visiteur comme variables de session
$_SESSION['nom'] = $result->nom;
$_SESSION['email'] = $result->email;
$_SESSION['mdp'] = $result->mdp;
$_SESSION['role'] = $result->role;
// on redirige notre visiteur vers une page de notre section membre
header ('location: succes.php');

 }
 //si le résultat est false on redirige vers la page d'authentification
 else{
 header ('location: echec.php');
 }
 }

 //si nos variables ne sont pas renseignées on redirige vers la page d'authentification
 else {
 header ('location: echec.php');
 }
 ?>