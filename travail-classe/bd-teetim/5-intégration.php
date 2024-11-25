<?php
    // Intégrer la BD teetim avec PHP
    // On va utilisé la librairie MySQLi

    // étape 1 : ouvrir une connexion au serveur MySQLi
    $cnx = mySQLi_connect("localhost", "root", "");
    // Spécifiez l'encodage de caractères pour la communication PHP/MySQL
    mysqli_set_charset($cnx, "utf8");

    // étape 2 : sélectionner une base de données
    mysqli_select_db($cnx, "teetim");

    // étape 3 : écrire et soummetre une commande SQL de type select
    $commande = "SELECT * FROM categorie";
    $resultat = mysqli_query($cnx, $commande);

    // etape 4 : travailler avec les résultats 
    // print_r($resultat);
    // Sortir une ligne (un enregistrement) de resultat (jeu denregistrement)
    // print_r(mysqli_fetch_row($resultat));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier exemple d'intégration PHP/MySQL</title>
</head>
<body>
  <h2>Exemple intégration PHP/MySQL</h2>
  <p>Liste des noms de catégories de teeTIM</p>
  <ul>
    <?php while($ligne = mysqli_fetch_object($resultat)) { ?>
        <li><?= $ligne->nom; ?></li>
    <?php } ?>
  </ul>  
</body>
</html>