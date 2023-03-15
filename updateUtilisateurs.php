
<?php
require_once ("inc/connect-db.php");
//on récupère et on vérifie les données reçues par le formulaire
if ( isset($_POST['id']) && !empty($_POST['id'])){
$id = $_POST['id'] ;
}
// à faire sur chaque donnée reçue
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$email = $_GET['email'];
$role = $_GET['role'];
// on rédige la requête SQL
$sql = "UPDATE utilisateurs set
nom=:nom,prenom=:prenom,email=:email,role=:role
where idutilisateurs=:id";
try {
//on prépare la requête avec les données reçues
$statement = $pdo->prepare($sql);
$statement->bindParam(':nom', $nom, PDO::PARAM_STR);
$statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->bindParam(':role', $role, PDO::PARAM_STR);
$statement->bindParam(':id', $idutlisateurs, PDO::PARAM_INT);
$statement->execute();
//On renvoie vers la liste des salaries
 header("Location:listeUtilisateurs.php");
}
catch(PDOException $e){
 echo 'Erreur : '.$e->getMessage();
}
?>