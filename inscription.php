<!-- <DOCTYPE html>

<html>

    <head>
        <meta charset ="utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <title> Réponses au formulaire </title>
    <head>

    <body>
<a href="index.php"> Pour voir la liste des pays </a><br> -->
   
   <?php
require_once("inc/connect-db.php");
//on récupère et on vérifie les données reçues par le formulaire
if ( isset($_POST['nom']) && !empty($_POST['nom'])){
    $nom = $_POST['nom'] ;
    }




// à faire sur chaque donnée reçue
$nom = $_POST["nom"];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['mdp'];
$role=$_POST['role'];

// Vérifie si l'adresse e-mail existe déjà dans la base de données
$requete = $pdo->prepare('SELECT COUNT(*) FROM utilisateurs WHERE email = ?');
$requete->execute([$email]);
$resultat = $requete->fetchColumn();

if ($resultat > 0) {
    // Si l'adresse e-mail existe déjà, affiche un message d'erreur
    echo "Cette adresse e-mail est déjà utilisée.";
} else {

// on rédige la requête SQL
$sql = " INSERT into utilisateurs (nom, prenom,email,mdp,role)
values (:Nom, :Prenom, :Email, :mdp, :Role)";
try {
//on prépare la requête avec les données reçues
$query = $pdo->prepare($sql);
$query->bindParam(':Nom', $nom, PDO::PARAM_STR);
$query->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
$query->bindParam(':Email', $email, PDO::PARAM_STR);
$query->bindParam(':mdp', $password, PDO::PARAM_STR);
$query->bindParam(':Role', $role, PDO::PARAM_STR);
$query->execute();




//On renvoie vers la liste des pays 
 header("Location:index.php");
}
catch(PDOException $e){
 echo 'Erreur : '.$e->getMessage();
}
}
?>