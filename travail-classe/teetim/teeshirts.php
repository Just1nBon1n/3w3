<?php
// Définir la variable $page pour indiquer la page affichée.
$page = 'teeshirts';

// Inclure la partie de haut de la page.
include('parties-communes/entete.php');

// Intégrer les produits
$catalogue = json_decode(file_get_contents("data/teeshirts.json"));
// print_r($catalogue);

$categories = [];
$produits = [];

foreach($catalogue as $codeCat => $detailCat) {
	// echo $codeCat."<br>";
	// echo $detailCat->nomCat->fr."<br>";
	// print_r($detailCat->produits);
	// echo "<hr/>";

	// Remplir le tableau $categories
	// On veut un tableau associatif avec le code de catégorie dans l'étiquette
	// et son nom dans la langue courante dans la valeur.
	$categories[$codeCat] = $detailCat->nomCat->$langue;

	// Remplir le tableau $produits
	// On veut un tableau contenant TOUS les produits quelle que soit la catégorie
	// dans laquelle ils sont catalogués.
	$produits = array_merge($produits, $detailCat->produits);
}

// Mélanger le tableau des produits
shuffle($produits);
// print_r($categories);
// print_r($produits);

?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
		<!-- Barre de tri/filtre -->
		<section class="controle">
			<div class="filtre">
				<label for="filtre">Filtrer par : </label>
				<select name="filtre" id="filtre">
					<option value="tous">Tous les produits</option>
					<option value="animaux">Animaux</option>
					<option value="nature">Nature</option>
					<option value="inusite">Inusité</option>
					<option value="sport">Sport</option>
				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option value="prix-asc">Prix / ascendant</option>
					<option value="prix-desc">Prix / descendant</option>
					<option value="nom-asc">Alpha / ascendant</option>
					<option value="nom-desc">Alpha / descendant</option>
					<option value="date_jout">Nouveauté</option>
					<option value="ventes-desc">Meilleur vendeur</option>
				</select>
			</div>
		</section>
	</article>

	<article class="principal">

		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prd->id ?>.webp" alt="<?= $prd->nom->$langue ?>">
				</span>
				<span class="nom"><?= $prd->nom->$langue ?></span>
				<span class="prix"><?= $prd->prix ?> $</span>
			</div>
		<?php endforeach; ?>

	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>