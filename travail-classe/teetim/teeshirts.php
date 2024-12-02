<?php
	$page = "teeshirts";
	include('parties-communes/entete.php');

	/*
	Intégration des produits "teeshirts"
	*/
	// Inclure la librairie de gestion du catalogue
	include("lib/catalogue.php");

	// Filtre et tri
	$tri = $_GET["tri"] ?? "RAND()";
	$filtre = $_GET["filtre"] ?? "tous";

	// Obtenir les thèmes et produist de la catégorie Teeshirts (1).
	$themes = obtenirThemes($cnx, 1);
	$produits = obtenirProduits($cnx, 1, $filtre, $tri);
?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage; ?></h1>
		<form class="controle">
			<div class="filtre">
				<label for="filtre"><?= $textes->catalogue->filtreEtiquette; ?></label>
				<select name="filtre" id="filtre">
					<option value="tous">
						<?= $textes->catalogue->filtreTous; ?>
					</option>
					<?php foreach($themes as $thm): ?>
					<!-- Gabarit pour chaque "thème" -->
						<option 
							value="<?= $thm["theme"] ?>"
							<?= ($filtre == $thm["theme"]) ? " selected" : ""; ?>
						>
							<?= $thm["theme"] ?>
						</option>
					<!-- FIN gabarit thème -->
					<?php endforeach; ?>
				</select>
			</div>
			<div class="tri">
				<label for="tri"><?= $textes->catalogue->triEtiquette; ?></label>
				<select name="tri" id="tri">
					<option value="RAND()"><?= $textes->catalogue->triAlea; ?></option>
					<option <?= ($tri == "prix ASC") ? "selected" : ""; ?> value="prix ASC">
						<?= $textes->catalogue->triPrixAsc; ?>
					</option>
					<option <?= ($tri == "prix DESC") ? "selected" : ""; ?> value="prix DESC">
						<?= $textes->catalogue->triPrixDesc; ?>
					</option>
					<option <?= ($tri == "nom ASC") ? "selected" : ""; ?> value="nom ASC">
						<?= $textes->catalogue->triNomAsc; ?>
					</option>
					<option <?= ($tri == "nom DESC") ? "selected" : ""; ?> value="nom DESC">
						<?= $textes->catalogue->triNomDesc; ?>
					</option>
					<option <?= ($tri == "dac DESC") ? "selected" : ""; ?> value="dac DESC">
						<?= $textes->catalogue->triDateAjoutDesc; ?>
					</option>
					<option <?= ($tri == "ventes DESC") ? "selected" : ""; ?> value="ventes DESC">
						<?= $textes->catalogue->triVentesDesc; ?>
					</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal liste-produits">
		<?php foreach($produits as $prod) : ?>
			<div class="produit" data-pid="<?= $prod["id"]; ?>">
				<?php if($prod["ventes"] > 0) : ?>
					<div class="ventes"><?= $prod["ventes"]; ?></div>
				<?php endif; ?>
				<span class="image">
					<img 
						src="images/produits/teeshirts/<?= $prod["image"]; ?>" 
						alt=""
					>
				</span>
				<span class="nom"><?= $prod["nom"]; ?></span>
				<span class="prix"><?= $prod["prix"]; ?></span>
				<button class="btn-ajouter">Ajouter au panier</button>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>