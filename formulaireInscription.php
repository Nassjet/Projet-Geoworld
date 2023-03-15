<?php 
require_once 'header.php';
require_once('inc/manager-db.php');
//on récupére la session 
session_start ();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mon super site web</title>
  <link rel="stylesheet" href="css/styleInscription.css">
</head>
<body>
	<h3>Inscription</h3>

	<form action="inscription.php" action="#" method="post">

		<div class="row">

			<div class="form-group col-md-6 col-sm-6">
				<input type="text" class="form-control" name="nom" required placeholder="Nom*" />
			</div>

			<div class="form-group col-md-6 col-sm-6">
				<input type="text" class="form-control" name="prenom" required placeholder="Prénom*" />
			</div>
			
			<div class="form-group col-md-6 col-sm-6">
				<label for="email">Email:</label>
				<input type="text" name="email" class="form-control" required placeholder="Email*"/>
			</div>
							
			<div class="form-group col-md-6 col-sm-6">
				<label for="mdp">Password:</label>
				<input type="text" name="mdp" class="form-control" required placeholder="Mot de passe*" />
			</div>
			
			<div class="form-group col-md-6 col-sm-6">
				<label for="role">Rôle :</label>
				<select name="role" class="form-control">
					<option value="eleve">Élève</option>
					<option value="enseignant">Enseignant</option>
					<option value="administrateur">administrateur</option>
				</select>
			</div>

			<div class="form-group col-md-6 col-sm-6">
				<input type="submit" value="S'inscrire" class="btn btn-primary" />
			</div>
			<p>Vous avez déjà un compte?  <a href="formulaireConnexion.php">Se connecter</a></p>

		</div>

	</form>
</body>
</html>
<?php
require_once 'javascripts.php';
?>