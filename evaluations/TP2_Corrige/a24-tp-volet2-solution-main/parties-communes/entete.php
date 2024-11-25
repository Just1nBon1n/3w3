<?php
	// Définir le tableau des langues disponibles
	$languesDispo = [];
	$dossierI18n = scandir('i18n');
	foreach($dossierI18n as $fichier) {
		if($fichier != '.' && $fichier != '..' && $fichier != '.DS_Store') {
			$languesDispo[] = substr($fichier, 0, 2); 
		}
	}

	$langue = 'fr';

	if(isset($_COOKIE['choixLangue']) 
						&& in_array($_COOKIE['choixLangue'], $languesDispo)) {
		$langue = $_COOKIE['choixLangue'];
	}

	if(isset($_GET['lan']) && in_array($_GET['lan'], $languesDispo)) {
		$langue = $_GET['lan'];
		setcookie('choixLangue', $langue, time() + 30*24*3600);
	}

	$textesJSON = file_get_contents('i18n/'.$langue.'.json');
	$textes = json_decode($textesJSON);
	// Raccourci pour la section commune "entete"
	$_ent = $textes->entete;
	// Raccourci pour la section commune "pp"
	$_pp = $textes->pp;
	// Raccourci pour TOUTES les pages spécifiques
	$_ = $textes->$page;
?>
<!DOCTYPE html>
<html lang="<?= $langue; ?>">

<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;900&family=Noto+Serif:ital,wght@0,400;0,900;1,400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>teeTIM // <?= $_->metaTitre; ?></title>
	<meta name="description" content="<?= $_->metaDesc; ?>">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="icon" type="image/png" href="images/favicon.png" />
</head>

<body>
	<div class="conteneur">
		<header>
			<nav class="barre-haut">
				<!-- Répéter une balise A pour chaque langue disponible -->
				<?php foreach($languesDispo as $codeLangue) : ?>
					<a 
						class="<?= $langue==$codeLangue ? 'actif' : '' ?>" 
						href="?lan=<?= $codeLangue ?>"
						title="[À faire : nom de la langue (dans la langue)]"
					>
						<?= $codeLangue ?>
					</a>
				<?php endforeach ?>

			</nav>
			<nav class="barre-logo">
				<label for="cc-btn-responsive" class="material-icons burger">menu</label>
				<a class="logo" href="index.php"><img src="images/logo.png" alt="<?= $_ent->altLogo; ?>"></a>
				<a class="material-icons panier" href="panier.php">shopping_cart</a>
				<input class="recherche" type="search" name="motscles" placeholder="<?= $_ent->placeholderRecherche; ?>">
			</nav>
			<input type="checkbox" id="cc-btn-responsive">
			<nav class="principale">
				<label for="cc-btn-responsive" class="menu-controle material-icons">close</label>
				<a href="teeshirts.php" class="<?= $page == 'teeshirts' ? 'actif' : ''; ?>"><?= $_ent->menuTeeshirts; ?></a>
				<a href="casquettes.php" class="<?= $page == 'casquettes' ? 'actif' : ''; ?>"><?= $_ent->menuCasquettes; ?></a>
				<a href="hoodies.php" class="<?= $page == 'hoodies' ? 'actif' : ''; ?>"><?= $_ent->menuHoodies; ?></a>
				<span class="separateur"></span>
				<a href="aide.php" class="<?= $page == 'aide' ? 'actif' : ''; ?>"><?= $_ent->menuAide; ?></a>
				<a href="apropos.php" class="<?= $page == 'apropos' ? 'actif' : ''; ?>"><?= $_ent->menuAPropos; ?></a>
			</nav>
		</header>