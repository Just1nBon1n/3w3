<?php 
// Gestion du code du serveur (PHP) asynchrone
// Les operateur de manipulation de donnees BD du panier 
// Une de : ajouter, modifier, supprimer

// On a besoin de la connexion a la BD
include("../lib/sql.php");
include("../lib/panier.php");

// Obtenir une connexion a la BD
$cnx = connexion();

//ID du panier (je ne veit pas inclure lentete)
$idPanier = $_SESSION["idPanier"];

$action = $_GET["action"] ?? false;

switch($action) {
  case "ajouter":
    // Code pour ajouter un produit au panier de l'utilisateur
    $pid = $_GET["pid"];
    // INSERT INTO panier_produits VALUES (0, 1, $pid, $isPanier)
    ajouterArticle($cnx, $idPanier, $pid);
    break;
  case "modifier":
    // Code pour modifier la quantite d'un produit dans le panier de l'utilisateur
    break;
  case "supprimer":
    // Code pour supprimer un produit du panier de l'utilisateur
    break;
}



// À la fin, on produit le detail du panier en JSON et on 
// l'envoie en reponse HTTP a la requete JS qui la demande...
echo json_encode(obtenirDetailPanier($cnx, $idPanier));
?>