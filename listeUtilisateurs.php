<?php  require_once 'header.php'; ?>

<link rel="stylesheet" href="css/listeUtilisateurs.css" />
<?php
 require_once('inc/manager-db.php');
 $listeUti = getAllUtilisateurs();
 
?>
<?php
 require_once('inc/manager-db.php');
 // On récupère la session
session_start();
 // On teste pour voir si nos variables de session ont bien été enregistrées
 if (isset($_SESSION['nom']) && isset($_SESSION['role'])) {
  echo "<p style=text-align:right;>Bienvenue : ".$_SESSION['nom']."(".$_SESSION['role'].")";
  echo '<br><a href="./logout.php">Deconnexion</a>';
 }
 else
 header ('location: formulaireConnexion.php');
?>
<h1>Liste utilisateurs</h1> 
<table border=2>
  <tr>
    <th>id</th>
    <th>nom</th>
    <th>prenom</th>
    <th>email</th>
    <th>password</th>
    <th>role</th> 
    <th>update</th>
    <th>delete</th>
    

    
</tr>

 <?php foreach ($listeUti as $utilisateur ) :?>
<tr>
    <td><?php echo $utilisateur->idutilisateurs; ?></td>
    <td><?php echo $utilisateur->nom; ?></td>
    <td><?php echo $utilisateur->prenom; ?></td>
    <td><?php echo $utilisateur->email; ?></td>
    <td><?php echo $utilisateur->mdp; ?></td>
    <td><?php echo $utilisateur->role; ?></td>
    <td> <a href="update.php?id=<?php echo $utilisateur->idutilisateurs; ?>" >update</a></td>
    <td> <a href="delete.php?id=<?php echo $utilisateur->idutilisateurs; ?>" >delete</a></td>
</tr>
<?php endforeach; ?>
<?php
require_once 'javascripts.php';
?>