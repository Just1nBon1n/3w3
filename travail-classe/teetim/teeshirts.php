<?php
// Définir la variable $page pour indiquer la page affichée.
$page = 'teeshirts';

// Inclure la partie de haut de la page.
include('parties-communes/entete.php');

// Intégrer le fichier JSON contenant les produits
$produits = json_decode(file_get_contents("data/teeshirts.json"));
?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
	</article>
	<article class="principal">
		<!-- Gabarit -->
		<?php foreach($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prd->id; ?>.webp" alt="<?= $prd->nom; ?>">
				</span>
				<span class="nom"><?= $prd->nom; ?></span>
				<span class="prix"><?= $prd->prix; ?> $</span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>