<?php
/*********
Fonctions de comparaison pour le tri des produits TeeTim
*********/

// Fonctions de comparaison pour les différents critères de tri
function prixAsc($prd1, $prd2) {
	/*
	if($prd1->prix < $prd2->prix) {
		return -154548;
	}
	else if($prd1->prix > $prd2->prix) {
		return 100.58965;
	}
	else {
		return 0; 
	}
	*/
	return $prd1->prix - $prd2->prix;
}

function prixDesc($prd1, $prd2) {
	return $prd2->prix - $prd1->prix;
}

function ventesDesc($prd1, $prd2) {
	return $prd2->ventes - $prd1->ventes;
}

// Les 3 prochaines fonctions de comparaison laissées en exercice
function nomAsc($prd1, $prd2) {
	return 0;
}

function nomDesc($prd1, $prd2) {
	return 0;
}

// Facile
function dacDesc($prd1, $prd2) {
	return 0;
}

// A ne pas faire (mais un bon exercice)
// function aleatoire($prd1, $prd2) {
// 	return 0;
// }

?>