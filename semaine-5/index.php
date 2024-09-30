<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Premier exemple de programation asynchrone avec javascript et php</title>
  <style>
    .btn {
      display: inline-block;
      background-color: #090;
      color: #fff;
      border: 1px solid #060;
      border-radius: 0.2rem;
      padding: 0.5rem;
      cursor: pointer;
    }

    .btn.inactif {
      pointer-events: none;
      background-color: #bbb;
    }

    .listeProduit {
      display: flex;
      flex-wrap: wrap;
    }

    .prd {
      width: clamp(10rem, 15vw, 20rem);
      border: 1px solid #aaa;
      padding: 0.5rem;
      margin: 0.5rem;
    }

    .prd img {
      width: inherit;
    }
  </style>
</head>
<body>
  <h2>Magasin général</h2>
  <div class="btn">Afficher produits</div>
  <section>
    <h3>Voici 3 produits aléatoire de notre catalogue</h3>

    <div class="listeProduits">
    </div>
  </section class="produit">

  <template id="gabarit-article">

    <!-- GABARIT -->
      <article class="prd">
        <img src="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg" alt="">
        <h4>Your perfect pack for everyday use and walks in the forest. 
            Stash your laptop (up to 15 inches) in the padded sleeve, your everyday
        </h4>
        <p>24.30$</p>
      </article> 

  </template>

  <script src="js/main.js"></script>
</body>
</html>