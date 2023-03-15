<?php 
require_once('inc/manager-db.php');
//on récupére la session s'il y en a une
session_start();
 // On teste pour voir si nos variables de session ont bien été enregistrées
 if (isset($_SESSION['nom']) && isset($_SESSION['role'])) {
  echo "<p style=text-align:right;>Bienvenue : ".$_SESSION['nom']."(".$_SESSION['role'].")";
  echo '<br><a href="./logout.php">Deconnexion</a>';
  echo "<br><a href=listeUtilisateurs.php?id=" .$_SESSION['email']. '>accès liste utilisateurs</a></p>';
 }
else
header ('location: formulaireConnexion.php');
?>
<?php
require_once ("inc/connect-db.php");
require_once ("inc/manager-db.php");
?>
<?php if($_SESSION['role']=='administrateur'):{
 $id = $_GET['id'] ;
 $utilisateur = getUtilisateurs($id);
}
?>
<form action="listeUtilisateurs.php" method="get" >
<fieldset>
<legend> <i>Liste des utlisateurs</i></legend>
Nom :
<input type="text" name="nom" required value="<?php echo $utilisateur->nom; ?>" /> <br />
Prénom :
<input type="text" name="prenom" required value="<?php echo $utilisateur->prenom; ?>" /> <br />
Email :
<input type="text" name="email" required value="<?php echo $utilisateur->email; ?>"/> <br />
Password :
<input type="text" name="password" required value="<?php echo $utilisateur->mdp; ?>"/> <br />
Roles :
<select name="Role">
 <option value="élève">élève</option>
 <option value="enseignant">enseignant</option>
 <option value="administrateur">administrateur</option>
 </select>
<input type="hidden" name="id" value="<?php echo $utilisateur->idutilisateurs ?> ">
<fieldset>
<input type="submit" value="mettre à jour" />
<input type="reset" value="Effacer" />
</form>
<?php else:?>
       <h1>Vous n'êtes pas administrateur</h1>
<?php endif?>