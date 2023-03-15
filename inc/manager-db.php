<?php
/**
 * Ce script est composé de fonctions d'exploitation des données
 * détenues pas le SGBDR MySQL utilisées par la logique de l'application.
 *
 * C'est le seul endroit dans l'application où a lieu la communication entre
 * la logique métier de l'application et les données en base de données, que
 * ce soit en lecture ou en écriture.
 *
 * PHP version 7
 *
 * @category  Database_Access_Function
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2023 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

/**
 *  Les fonctions dépendent d'une connection à la base de données,
 *  cette fonction est déportée dans un autre script.
 */
require_once 'connect-db.php';


// Exemple d'une fonction sans paramètre, avec documentation technique PhpDoc  

/**
 * Obtenir la liste des pays
 *
 * @return liste d'objets de type StdClass représentant un Country 
 */
function getAllCountries()
{
    global $pdo;
    $query = 'SELECT * FROM Country;';
    return $pdo->query($query)->fetchAll();
}



// Exemple d'une fonction paramétrée, avec documentation technique PhpDoc  

/**
 * Obtenir la liste de tous les pays référencés d'un continent donné
 *
 * @param string $continent le nom d'un continent
 * 
 * @return array tableau d'objets (des pays)
 */
function getCountriesByContinent($continent)
{
    // pour utiliser la variable globale dans la fonction
    global $pdo;
    $query = 'SELECT * FROM Country WHERE Continent = :cont;';
    $prep = $pdo->prepare($query);
    // on associe ici (bind) le paramètre (:cont) de la req SQL,
    // avec la valeur reçue en paramètre de la fonction ($continent)
    // on prend soin de spécifier le type de la valeur (String) afin
    // de se prémunir d'injections SQL (des filtres seront appliqués)
    $prep->bindValue(':cont', $continent, PDO::PARAM_STR);
    $prep->execute();
    // var_dump($prep);  pour du debug
    // var_dump($continent);

    // on retourne un tableau d'objets (car spécifié dans connect-db.php)
    return $prep->fetchAll();
}
/**
 * Obtenir la liste de tous les pays référencés d'un continent donné
 *
 * @return array tableau d'objets (des pays)
 */
function getNomContinents() 
{
        global $pdo;
        $query = 'SELECT Distinct Continent FROM country;';
        return $pdo->query($query)->fetchAll();
}
/**
 * Obtenir la liste de tous les pays référencés d'un continent donné
 *
 * @param string $capital le nom d'un continent
 * 
 * @return array tableau d'objets (des pays)
 */
function getNomCapitale($capital)
{
        global $pdo;
        $query = 'SELECT Name from city WHERE id =:Capital;';
        $prep= $pdo->prepare($query);
        $prep->bindValue(':Capital', $capital, PDO::PARAM_STR);
        $prep->execute();
        return $prep->fetchAll();
}
/**
 * Vérifier que les informations saisies correspondent bien à l'utilisateur 
 * 
 * @param string $email l'email saisie
 * @param string $mdp le mot de passe saisie
 * 
 * @return $result retourne une ligne de la base de donnée
 */
function getAuthentification($email,$mdp)
{
    global $pdo;
    $query = "SELECT * FROM utilisateurs where email=:email and mdp=:mdp";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':email', $email);
    $prep->bindValue(':mdp', $mdp);
    $prep->execute();
    // on vérifie que la requête ne retourne qu'une seule ligne
    if ($prep->rowCount() == 1) {
        $result = $prep->fetch();
        return $result;
    }
    return false;
}
/**
 * Obtenir la liste de tout les utilisateurs 
 * 
 * @return $result renvoit un tableau object contenant les informations de tout les utilisateurs
 */
function getAllUtilisateurs()
{
    global $pdo;
    $query='SELECT * FROM utilisateurs';
    try{
        $result = $pdo->query($query)->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    catch (Exception $e){
        die("erreur dans la requête".$e->getMessage());
    }
}
/**
 * Obtenir les informations de l'utilisateur connecté
 * 
 * @param int $id récupére l'identifiant de l'utilisateur connecté 
 * 
 * @return $result retourne le tableau après la préparation 
 */
function getUtilisateurs($id)
{
    global $pdo;
    $requete = "SELECT * FROM utilisateurs where idutilisateurs = :id";
    try{
        $prep = $pdo->prepare($requete);
        $prep->bindParam(':id', $id, PDO::PARAM_INT);
        $prep->execute();
        $result = $prep->fetch();
        return $result;
    }
    catch (Exception $e ) {
        die("erreur dans la requete ".$e->getMessage());
    }
}
/**
 * Obtenir la liste de toutes les langues d'un pays référencé 
 *
 * @param string $pays le nom de la langue du pays concerné
 * 
 * @return array tableau d'objets (deslangues)
 */
function getLangue($pays)
{
    global $pdo;
    $query = 'SELECT language.Name FROM language, countrylanguage,country Where country.id=countrylanguage.idCountry AND countrylanguage.idLanguage=language.id AND country.Name=:pays;';
    $prep= $pdo->prepare($query);
    $prep->bindValue(':pays', $pays, PDO::PARAM_STR);
    $prep->execute();
    return $prep->fetchAll();
}
?>