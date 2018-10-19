<?php
/**
 * Created by PhpStorm.
 * User: kalidou
 * Date: 17/10/2018
 * Time: 11:36
 */

// Renvoie la liste de tous les films
function getFilm($FilmsID) {
    $db = dbConnect();
    $req = $db->prepare('select * from films where FilmsID = :FilmsID');
    $req->bindValue(':FilmsID', $FilmsID, PDO::PARAM_INT);

    if ($req->execute())
        return $req->fetch(PDO::FETCH_ASSOC);
    else
        throw new Exception ("Aucun film ne correspond à votre requete '$FilmsID'");
}

/***** Rechercher un Acteur *****/
function getActeur($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM acteur WHERE id_acteur = ?');
    $req->execute(array($postId));
    $post = $req->fetch();
    return $post;
}

/***** Insert *****/
function InsertFilm()
{
    $db = dbConnect();
    $req = $db->prepare('insert into films(FilmsID,Categorie,RealisateurID,ActeurID,Titre,Resume,Annee,Duree,ImageUrl)
                                  VALUES (:FilmsID,:Categorie,:RealisateurID,:ActeurID,:Titre,:Resume,:Annee,:Duree,:ImageUrl)');
    $req->execute([
        'FilmsID' => $FilmsID,
        'Categorie'=> $FilmsID,
        'RealisateurID' => $FilmsID,
        'ActeurID' => $FilmsID,
        'Titre' => $FilmsID,
        'Resume' => $FilmsID,
        'Annee' => $FilmsID,
        'Duree' => $FilmsID,
        'ImageUrl' => $FilmsID
    ]);
    $post = $req->fetch();
    return $post;
}


function Films()
{
    $db = dbConnect();
    $req = $db->query("SELECT * FROM films") or die(print_r($db->errorInfo()));
    $post = $req->fetch();
    return $post;
}


function Acteur(){
    $db = dbConnect();
    $req = $db->query("SELECT * FROM acteur") or die(print_r($db->errorInfo()));
    $post = $req->fetch();
    return $post;
}

function Realisateur(){
    $db = dbConnect();
    $req = $db->query("SELECT * FROM realisateur") or die(print_r($db->errorInfo()));
    $post = $req->fetch();
    return $post;
}

/***** Connexion à la BD *****/
function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=annuaire;charset=utf8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
