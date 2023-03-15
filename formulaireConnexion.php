<!DOCTYPE html>
<html>
<head>
	<title>Formulaire de connexion</title>
	<link rel="stylesheet" type="text/css" href="css/styleConnexion.css">
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="container">
		<h2>Connexion</h2>
		<form action="login.php" method="post">
			<div class="form-group">
				<label for="username">Email:</label>
				<input type="text" name="email">
			</div>
			<div class="form-group">
				<label for="password">Mot de passe :</label>
				<input type="password" name="mdp">
			</div>
			<button type="submit">Connexion</button>
		</form>
		<br>
		<h5>Pas encore inscrit? <a href="formulaireInscription.php">Inscription</a></h5>
		</br>
	</div>
</body>
</html>
<?php
require_once 'javascripts.php';
?>

