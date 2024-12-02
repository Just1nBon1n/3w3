<?php
// Fonctions pour gérer la manipulation des données des produits TeeTIM

function obtenirThemes($cnx, $idCategorie) {
  return lire($cnx, 
          "SELECT DISTINCT theme 
              FROM produit 
              WHERE id_categorie=$idCategorie"
        );
}

function obtenirProduits($cnx, $idCategorie, $filtre, $tri) {
  $filtreClauseWhere = ($filtre=="tous") ? "" : " AND theme = '$filtre'";
  return lire($cnx, 
            "SELECT * FROM produit 
              WHERE id_categorie=$idCategorie 
              $filtreClauseWhere 
                ORDER BY $tri"
        );
}

/*
function obtenirDetailProduit() {

}
*/
?>