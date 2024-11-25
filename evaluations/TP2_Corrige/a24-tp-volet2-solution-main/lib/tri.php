<?php
/******
 Fonctions de comparaisons pour les différents critères de tri
******/

// ATTENTION : les noms des fonction de compraison correspondent aux valeurs
// des options de tri disponibles dans le UI !!!!

/**
 * Compare le prix de deux produits en ordre ascendant (du moins cher au plus cher)
 * 
 * @param Object $prd1 : un objet produit
 * @param Object $prd2 : un objet produit
 * 
 * @return Float : un nombre négatif si $prd1 est moins cher que $prd2, un nombre
 *                 positif si $prd1 est plus cher que $prd2, et 0 sinon.
 */
function prixAsc($prd1, $prd2) {
	return $prd1->prix - $prd2->prix;
}

// Ajoutez le commentaire PHPDoc : faites-le vous-même ;-)
function prixDesc($prd1, $prd2) {
	return $prd2->prix - $prd1->prix;
}

// Ajoutez le commentaire PHPDoc : faites-le vous-même ;-)
function ventesDesc($prd1, $prd2) {
	return $prd2->ventes - $prd1->ventes;
}

/* 
	Les autres fonctions de comparaison (ci-dessous) n'ont pas été implémentées 
	en classe.
*/

// À compléter (essayez !)
function nomAsc($prd1, $prd2) {
	return 0;
}

// À compléter (essayez !)
function nomDesc($prd1, $prd2) {
	return 0;
}

// À compléter (essayez !)
function dacDesc($prd1, $prd2) {
	return 0;
}
?>