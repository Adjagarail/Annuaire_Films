<?php
require 'Vue/vendor/autoload.php';

//Connexion a la base de données

include ('Model/model.php');

/*function liste()
{
  $connection = dbConnect();
  $liste = $connection ->query("SELECT * FROM films ORDER BY FilmsID DESC");
  $listes = $liste->fetch(); 
  return $listes;
}*/
function tutoriels()
{
    $connexion = new PDO('mysql:host=localhost;dbname=annuaire;charset=utf8','root','');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  $tutoriel = $connexion->query('SELECT * FROM films ORDER BY FilmsID DESC LIMIT 4');
  return $tutoriel;
}


//Routing
$page ='home';
if(isset($_GET['p']))
{
  $page = $_GET['p'];
}


//Rendu du template
$loader = new Twig_Loader_Filesystem('Vue/Templates');
$twig = new Twig_Environment($loader,['cache'=>false]);


switch($page)
{
  case 'home':
              echo $twig->render('home.twig',['tutoriels' => tutoriels()]);
              break;

  case 'film':
              echo $twig->render('film.twig',['title'=>'Film']);
              break;
  case 'acteur':
              echo $twig->render('acteur.twig',['title'=>'Acteur']);
              break;

  case 'realisateur':
              echo $twig->render('realisateur.twig',['title'=>'Realisateur']);

  default:
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('erreur.twig',['title'=>'Erreur 404']);
        break;
}
