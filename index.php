<?php
/**
 * Home Page
 *
 * PHP version 7
 *
 * @category  Page
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2021 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

require_once 'header.php';
require_once 'inc/manager-db.php';
//on récupére la session s'il y en a une
session_start();
 // On teste pour voir si nos variables de session ont bien été enregistrées
if (isset($_SESSION['nom']) && isset($_SESSION['role'])) {
    echo "<p style=text-align:right;>Bienvenue : ".$_SESSION['nom']."(".$_SESSION['role'].")";
    echo '<br><a href="./logout.php">Deconnexion</a>';
    if ($_SESSION['role']=='administrateur') {
        echo "<br><a href=listeUtilisateurs.php?id=" .$_SESSION['email']. '>accès liste utilisateurs</a></p>';
    }
}
// Vérifie si le paramètre "continent" est présent dans l'URL, sinon utilise "Europe" comme valeur par défaut
$continent = isset($_GET['continent']) ? $_GET['continent'] : 'Europe';

// Récupère les informations des pays du continent spécifié
$desPays = getCountriesByContinent($continent);
?>
<head>
<link rel="stylesheet" type="text/css" href="css/styleIndex.css">
</head>
<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 onclick="info(this)">Les pays en <?php echo $continent ?></h1>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Population</th>
            <th>Capitale</th>
            <th>Langues</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($desPays as $pays) : ?>
            <tr>
              <td><a><?php echo $pays->Name ?></a></td>
              <td><?php echo $pays->Population ?></td>
              <td>
                <?php
                $capital = getNomCapitale($pays->Capital);
                foreach ($capital as $nomCapitale) : ?>
                    <?php echo $nomCapitale->Name ?>
                <?php endforeach ?>
              </td>
              <td>
                <?php
                $langue = getLangue($pays->Name);
                foreach ($langue as $nomLangue) :?>
                    <?php echo $nomLangue->Name?>
                <?php endforeach?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>

      </table>
    </div>
  </div>
</main>

<?php
require_once 'javascripts.php';
require_once 'footer.php';
?>
