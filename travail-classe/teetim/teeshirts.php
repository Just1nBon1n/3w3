<?php
$page = "teeshirts";
include('parties-communes/entete.php');

/*
	Intégration des produits "teeshirts"
*/

?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage; ?></h1>
		<form class="controle">
			<div class="filtre">
				<label for="filtre"><?= $textes->catalogue->filtreEtiquette; ?></label>
				<select name="filtre" id="filtre">
					<option value="tous">
						<?= $textes->catalogue->filtreTous." (".$compteProduitsTotal.")"; ?>
					</option>

					<?php foreach ($categories as $codeCat => $nomCat) : ?>
						<!-- 
							TP/Volet 2 : Point 5 : Catégorie sélectionnée 
						-->
						<option value="<?= $codeCat; ?>" <?= ($codeCat==$filtre) ? "selected" : ""; ?>>
							<?= $nomCat; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="tri">
				<!-- TP/Volet 2 : Point 1 : Étiquettes de tri externalisées -->
				<label for="tri"><?= $textes->catalogue->triEtiquette; ?></label>
				<select name="tri" id="tri">
					<option value="aleatoire">* <?= $textes->catalogue->triAlea; ?></option>
					<option <?= ($tri == "prixAsc") ? "selected" : ""; ?> value="prixAsc">
						* <?= $textes->catalogue->triPrixAsc; ?>
					</option>
					<option <?= ($tri == "prixDesc") ? "selected" : ""; ?> value="prixDesc">
						* <?= $textes->catalogue->triPrixDesc; ?>
					</option>
					<option <?= ($tri == "nomAsc") ? "selected" : ""; ?> value="nomAsc">
						<?= $textes->catalogue->triNomAsc; ?>
					</option>
					<option <?= ($tri == "nomDesc") ? "selected" : ""; ?> value="nomDesc">
						<?= $textes->catalogue->triNomDesc; ?>
					</option>
					<option <?= ($tri == "dacDesc") ? "selected" : ""; ?> value="dacDesc">
						<?= $textes->catalogue->triDateAjoutDesc; ?>
					</option>
					<option <?= ($tri == "ventesDesc") ? "selected" : ""; ?> value="ventesDesc">
						* <?= $textes->catalogue->triVentesDesc; ?>
					</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal">
		<?php foreach($produits as $prod) : ?>
			<div class="produit">
				<!-- 
					TP/Volet 2 : Point 4 : Badge des ventes 
				-->
				<?php if($prod->ventes > 0) : ?>
					<div class="ventes"><?= $prod->ventes; ?></div>
				<?php endif; ?>
				<!-- 
					TP/Volet 2 : Point 2 : Si le catalogue n'est pas traduit dans la langue 
					courante, utiliser le français 
				-->
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prod->id; ?>.webp" alt="<?= $prod->nom->$langue ?? $prod->nom->fr; ?>">
				</span>
				<span class="nom"><?= $prod->nom->$langue ?? $prod->nom->fr; ?></span>
				<span class="prix"><?= number_format($prod->prix, 2); ?> $</span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<!-- Le gabarit utilisé pour implémenter l'affichage avec la méthode Ajax (JS asynchrone) -->
<template id="gabarit-produit">
	<div class="produit">
		<div class="ventes"></div>
		<span class="image">
			<img src="images/produits/teeshirts/" alt="">
		</span>
		<span class="nom"></span>
		<span class="prix"></span>
	</div>
</template>
<?php include('parties-communes/pied2page.php'); ?>