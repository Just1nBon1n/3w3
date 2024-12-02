<?php
// Fonctions pour gérer le panier d'achats du site teeTIM

function creerPanier($cnx, $codePanier) {
  return creer($cnx, 
          "INSERT INTO panier 
            VALUES (0, '$codePanier', NOW())"
        );
}

function obtenirIdPanier($cnx, $codePanier) {
  $rep = lire($cnx, "SELECT id FROM panier WHERE code='$codePanier'");
  if(count($rep) > 0) {
    return $rep[0]["id"];
  }
  else {
    return 0;
  }
}

function ajouterArticle($cnx, $idPanier, $idProduit) {
  return creer($cnx, 
          "INSERT INTO panier_produits VALUES
             (0, 1 ,$idProduit, $idPanier)"
        );
}

function obtenirDetailPanier($cnx, $idPanier) {
  return lire($cnx, 
          "SELECT * FROM panier_article WHERE idPanier=$idPanier"
        );
}

?>