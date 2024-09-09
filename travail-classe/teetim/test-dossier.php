<?php 
  //Test lecture du contenu d'un dossier avec PHP

  //Obtenir la liste des fichiers
  $contenuI18n = scandir('i18n');

  //Afficher uniquement les codes de langue sans l'extension de fichier
  for($i = 0; $i < count($contenuI18n); $i++) {
    //Filtrer les deux valeur '.' et '..'
    if ($contenuI18n[$i] != '.' && $contenuI18n[$i] != '..') {
      echo substr($contenuI18n[$i], 0, 2). '<br>';
    }
  }

  print_r($contenuI18n);
?>