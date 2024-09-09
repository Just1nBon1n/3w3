<?php 
	// Définir la variable $page pour indiquer la page affichée.
	$page = 'teeshirts';

	// Inclure la partie de haut de la page.
	include('parties-communes/entete.php'); 
?>
<main class="page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
	</article>
	<article class="principal">
		<?= $_->aVenir ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>