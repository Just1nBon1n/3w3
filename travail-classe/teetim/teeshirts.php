<?php
// Définir la variable $page pour indiquer la page affichée.
$page = 'teeshirts';

// Inclure la partie de haut de la page.
include('parties-communes/entete.php');

// Inclure les fonctions de comparaison utilisées dans le tri
include("lib/tri.php");

/* DÉBUT : catalogue */
// Intégrer les produits
$catalogue = json_decode(file_get_contents("data/teeshirts.json"));

$categories = [];
$produits = [];

foreach($catalogue as $codeCat => $detailCat) {
	$categories[$codeCat] = $detailCat->nomCat->$langue;
	$produits = array_merge($produits, $detailCat->produits);
}
/* FIN : catalogue */

/* DÉBUT : Fonctionnalité de tri des produits */
// Mélanger le tableau des produits (critère de tri par défaut !!!)
shuffle($produits);
 
$tri = "";
// Remarquez : on exclut le cas ou le paramètre "tri" a la valeur "aleatoire"
if(isset($_GET["tri"]) && $_GET["tri"] != "aleatoire") {
	// Trier le tableau $produits
	$tri = $_GET["tri"];

	// Avertissement : ça suppose que la valeur de l'option du select de tri correspond
	// au nom de la fonction de comparaison.
	usort($produits, $tri);
}
/* FIN : tri */
?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
		<!-- Barre de tri/filtre -->
		<form class="controle">
			<div class="filtre">
				<label for="filtre"><?= $textes->catalogue->filtreEtiquette ?></label>
				<select name="filtre" id="filtre">
					<option value="tous"><?= $textes->catalogue->filtreTous ?></option>
					
					<?php foreach($categories as $codeCat => $nomCat) :  ?>
						<option value="<?= $codeCat ?>"><?= $nomCat ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option value="aleatoire">* Aléatoire</option>

					<option <?= ($tri == "prixAsc") ? "selected" : "" ?> value="prixAsc">* Prix / ascendant</option>
					<option <?= ($tri == "prixDesc") ? "selected" : "" ?> value="prixDesc">* Prix / descendant</option>
					<option <?= ($tri == "nomAsc") ? "selected" : "" ?> value="nomAsc">Alpha / ascendant</option>
					<option <?= ($tri == "nomDesc") ? "selected" : "" ?> value="nomDesc">Alpha / descendant</option>
					<option <?= ($tri == "dacDesc") ? "selected" : "" ?> value="dacDesc">Nouveauté</option>
					<option <?= ($tri == "ventesDesc") ? "selected" : "" ?> value="ventesDesc">* Meilleur vendeur</option>
				</select>
			</div>
		</form>
	</article>

	<article class="principal">

		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prd->id ?>.webp" alt="<?= $prd->nom->$langue ?>">
				</span>
				<span class="nom"><?= $prd->nom->$langue ?></span>
				<span class="prix"><?= number_format($prd->prix, 2, ','); ?> $</span>
			</div>
		<?php endforeach; ?>

	</article>
	
	<template id="gabarit-produit">
		<div class="produit">
			<span class="image">
				<img src="images/produits/teeshirts/ID.webp" alt="NOM">
			</span>
			<span class="nom">NOM</span>
			<span class="prix">PRIX $</span>
		</div>
	</template>

</main>
<?php include('parties-communes/pied2page.php'); ?>