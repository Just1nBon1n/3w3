<?php
  // Inclure les fonctions de comparaison utilisées dans le tri
include("../lib/tri.php");

/* DÉBUT : catalogue */
// Intégrer les produits
$catalogue = json_decode(file_get_contents("../data/teeshirts.json"));

$produits = [];

foreach($catalogue as $codeCat => $detailCat) {
	$produits = array_merge($produits, $detailCat->produits);
}
/* FIN : catalogue */

/* DÉBUT : Fonctionnalité de tri des produits */
// Mélanger le tableau des produits (critère de tri par défaut !!!)
shuffle($produits);

$tri = "";
// Remarquez : on exclut le cas ou le paramètre "tri" a la valeur "aleatoire"
if(isset($_GET["tri"]) && $_GET["tri"] != "aleatoire") {
	// Trier le tableau $produits
	$tri = $_GET["tri"];

	// Avertissement : ça suppose que la valeur de l'option du select de tri correspond
	// au nom de la fonction de comparaison.
	usort($produits, $tri);
}
/* FIN : tri */
 

  // Générer la réponse HTTP en JSON
  echo json_encode($produits);
?>