<?php 
  $equipeJSON = file_get_contents('data/equipe.json');
  $equipe = json_decode($equipeJSON);
  print_r($equipe);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Équipe de direction - Bell Canada</title>
  <style>
    main {
      width: 80vw;
      margin: 2rem auto;
      border: 1px solid black;
    }
    section.equipe {
      display: flex;
      column-gap: 1.5rem;
    }
    section.equipe article.personne {
      width: 250px;
    }

    article.personne img {
      width: 250px;
      border-radius: 1rem;
      background-color: #efefef;
    }
  </style>
</head>
<body>
  <main>
    <h2>Équipe de direction</h2>
    <section class="equipe">

      <!-- Gabarit employe -->
      <article class="personne">
        <img src="images/ID.png" alt="NOM">
        <h3>NOM</h3>
        <h4>POSTE</h4>
        <p>ANNEE</p>
      </article>
    </section>
  </main>
</body>
</html>