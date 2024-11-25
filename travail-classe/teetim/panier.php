<?php
$page = "panier";
include('parties-communes/entete.php');
?>
<!-- 
	TP/Volet 2 : Point 8 : Page panier
-->
<main class="page-panier">
  <article class="amorce">
    <h1><?= $_->titrePage; ?></h1>
  </article>
  <article class="principal">
    <div class="liste-panier">
      <div class="article">
        <span class="groupe-ligne">
          <span class="image">
            <img src="images/produits/teeshirts/ts0004.webp" alt="">
          </span>
          <span class="nom">Monstre douillet</span>
        </span>
        <span class="groupe-ligne">
          <span class="couleur vert"></span>
          <span class="taille">M</span>
          <span class="quantite"><input type="number" name="quantite" value="5" min="1" max="9"></span>
          <span class="prix">29.50 $</span>
          <span class="btn-supprimer material-icons">delete</span>
        </span>
      </div>
      <div class="article">
        <span class="groupe-ligne">
          <span class="image">
            <img src="images/produits/teeshirts/ts0005.webp" alt="">
          </span>
          <span class="nom">Bleu comme une orange</span>
        </span>
        <span class="groupe-ligne">
          <span class="couleur rose"></span>
          <span class="taille">XS</span>
          <span class="quantite"><input type="number" name="quantite" value="2" min="1" max="9"></span>
          <span class="prix">19.99 $</span>
          <span class="btn-supprimer material-icons">delete</span>
        </span>
      </div>
    </div>
    <div class="sommaire-panier">
      <span class="nb-articles">(<?= $_->nbArticles; ?> 7)</span>
      <span class="sous-total"><?= $_->sousTotal; ?> 187.48 $</span>
      <span class="btn-commander"><?= $_->btnCommander; ?></span>
    </div>
  </article>
</main>
<?php include('parties-communes/pied2page.php'); ?>