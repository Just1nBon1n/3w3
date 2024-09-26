<?php
  // Temps 2 : produire la réponse HTTP

  /**
   * 1) Lire le fichier JSON contenant les produits
   * 2) Décoder le JSON en PHP
   * 3) Sélectionner 3 produits aléatoires dasn le tableau
   * 4) Renvoyer le tableau des 3 produits aléatoires sous la
   *    forme d'une chaîne JSON
   */

  $produitsJSON = file_get_contents("../data/produits.json");
  $produits = json_decode($produitsJSON);
  shuffle($produits);
  $produitsAleatoires = array_slice($produits, 0, 3);
  $produitsAleatoiresJSON = json_encode($produitsAleatoires);

  echo $produitsAleatoiresJSON;
?>