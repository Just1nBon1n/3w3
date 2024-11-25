<?php
// Gestion du catalogue
// Lire et convertir le fichier JSON contenant le catalogue des teeshirts
$catalogue = json_decode(file_get_contents("../data/teeshirts.json"));
// Tableau pour les produits
$produits = [];

/* 
	TP/Volet 2 : Point 6 : Gestion du filtre 
*/
// On gère le filtre des produits en premier !
$filtre = "tous";
if(isset($_GET['filtre'])) {
	$filtre = $_GET['filtre'];
}

// Remplir ce tableau avec les données de la variable $catalogue
foreach($catalogue as $codeCat => $infoCat) {
	/* 
		TP/Volet 2 : Point 6 : Gestion du filtre (suite)
	*/
	// Filtrer les produits au besoin
	if($filtre == 'tous' || $filtre == $codeCat) {
		$produits = array_merge($produits, $infoCat->produits);
	}
}

// Puis on gère le tri des produits.
// Par défaut, mélanger le tableau des produits
shuffle($produits);

$tri = "";
// Trier les produits si c'est demandé
if(isset($_GET["tri"]) && $_GET["tri"] != "aleatoire") {
	// Inclure la librairie de fonctions de comparaison (pour le tri des produits).
	include("../lib/tri.php");
	// Le nom de la fonction de comparaison est passé dans le paramètre "tri" de l'URL.
	$tri = $_GET["tri"];
	// On passe le nom de la fonction de comparaison à la fonction de tri de PHP.
	usort($produits, $tri);
}

// On produit la réponse HTTP sous forme d'une chaîne dans le format JSON.
echo json_encode($produits);
?>