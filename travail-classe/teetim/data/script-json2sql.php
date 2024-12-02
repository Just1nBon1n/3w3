<?php
  $idCategorie = 1;
  $nomCategorie = "teeshirts";

  // Chaine SQL à générer
  $sql = "";

  $catalogue = json_decode(file_get_contents("$nomCategorie.json"));

  foreach($catalogue as $codeTheme => $detailTheme) {
    $theme = $detailTheme->nomCat->fr;
    $produits = $detailTheme->produits;
    foreach ($produits as $produit) {
      $nom = addslashes($produit->nom->fr);
      $sql .= "INSERT INTO produit (id, nom, theme, prix, ventes, image, dac, id_categorie) VALUES (0, '$nom', '$theme', $produit->prix, $produit->ventes,'$produit->id.webp', '$produit->dac', $idCategorie); \n";
    }
  }

  // Fichier SQL à générer.
  $nomFichier = $nomCategorie.".sql";
  $fichierSQL = file_put_contents($nomFichier, $sql);

  if($fichierSQL) echo "Fichier SQL généré";
?>