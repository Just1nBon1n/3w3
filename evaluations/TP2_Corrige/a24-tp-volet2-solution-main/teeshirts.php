<?php
$page = "teeshirts";
include('parties-communes/entete.php');

/*
	Intégration des produits "teeshirts"
*/
$catalogue = json_decode(file_get_contents("data/teeshirts.json"));

/* 
	TP/Volet 2 : Point 5 : Gestion du filtre (voir la suite plus loin dans le code)
*/
// On gère le filtre des produits en premier !
// Par défaut, on veut voir tous les produits...
$filtre = "tous";
// Mais si un paramètre est envoyé en URL ...
if(isset($_GET['filtre'])) {
	// ... on filtre selon la valeur reçue dans ce paramètre
	$filtre = $_GET['filtre'];
}

// Intialiser des tableaux vides pour nos données
$categories = []; 
$produits = [];

/* 
	TP/Volet 2 : Point 7 : Nombre de produits pour le critère "tous"
*/
// Initialiser un compteur du nombre de produits total dans le catalogue
// (Nous en avons besoin dans l'affichage du SELECT des critères de filtre)
$compteProduitsTotal = 0;

// Remplir les tableaux avec les données du fichier JSON t
foreach ($catalogue as $codeCat => $infoCat) {
	/* 
		TP/Volet 2 : Point 7 : Nombre de produits pour le critère "tous"
	*/
	// On incrémente le compteur de nombre de produits par le nombre
	// de produit dans la catégorie courante...
	$compteProduitsTotal += count($infoCat->produits);

	/* 
		TP/Volet 2 : Point 2 : Si le catalogue n'est pas traduit dans la langue 
		courante, utiliser le français.
		Pour valider ce code, affichez le catalogu en suédois (bouton "sv" dans 
		cette solution).
	*/
	// Remarquez qu'au lieu d'utiliser l'opérateur ternaire (X ? Y : Z), j'utilise ici
	// une alternative appelée "opérateur de coalescence des valeurs nulles" :-)))
	// Évidement c'est juste une alternative. Vous voulez apprendre ? Allez lire ici : 
	// https://www.php.net/manual/en/migration70.new-features.php
	$categories[$codeCat] = ($infoCat->nomCat->$langue ?? $infoCat->nomCat->fr) 
														. " (".count($infoCat->produits).")";
	/* 
		TP/Volet 2 : Point 7 : Ci-dessus, le nombre de produits pour chaque critère
	*/

	/* 
		TP/Volet 2 : Point 5 : Gestion du filtre (suite) 
	*/
	// C'est ici qu'on filtre : on ne fusionne le tableau des produits de cette 
	// catégorie que si la valeur du critère de filtre est "tous" ou correspond
	// au code de cette catégorie !!!
	if($filtre == 'tous' || $filtre == $codeCat) {
		$produits = array_merge($produits, $infoCat->produits);
	}
}

// Maintenant on fait le tri : 
// Par défaut, on mélange le tableau des produits
shuffle($produits);

$tri = "";
// Trier les produits si c'est demandé (et ce n'est pas "aléatoire")
if(isset($_GET["tri"]) && $_GET["tri"] != "aleatoire") {
	// Inclure la librairie de fonctions de comparaison (pour le tri des produits).
	include("lib/tri.php");
	// Le nom de la fonction de comparaison est passé dans le paramètre "tri" de l'URL.
	$tri = $_GET["tri"];
	// On passe le nom de la fonction de comparaison à la fonction de tri de PHP.
	usort($produits, $tri);
}
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