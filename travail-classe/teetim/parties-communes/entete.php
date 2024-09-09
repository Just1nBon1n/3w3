<?php
	// Definir le tableau des langues disponible
	$languesDispo = [];
	$dossierI18n = scandir('i18n');
	foreach($dossierI18n as $fichier) {
		if ($fichier != '.' && $fichier != '..') {
			$languesDispo[] = substr($fichier, 0, 2);
		}
	}

	print_r($languesDispo);

	// Test
	// echo time();
	//setcookie('patati', 'patata', 365*24*3600);
	
	// Test : recuperer la jarre de "cookie" du browser
	//print_r($_COOKIE);

	// Accès aux paramètres d'URL (QueryString) en PHP
	// print_r($_GET);
	// echo $_GET['lan'];

	// Choix de langue
	// 1. Par défaut la langue est fr
	$langue = 'fr';

	// 2. Langue memoriser au prealable
	if(isset($_COOKIE['choixLangue'])) {
		$langue = $_COOKIE['choixLangue'];
	}

	// 3. Si l'utilisateur choisi explicitement une autre langue...
	if(isset($_GET['lan'])) {
		$langue = $_GET['lan'];
		// Stocker la langue dans un temoin HTTP (cookie)
		setcookie('choixLangue', $langue, time() + 30*24*3600);
	}

	// 1) Lire le fichier contenant le texte dans une chaîne de caractères.
	$textesJSON = file_get_contents('i18n/'.$langue.'.json');
	// Test : afficher la variable $textesJSON
	// echo $textesJSON;

	// 2) Convertir la chaîne JSON en quelque chose que PHP comprend.
	$textes = json_decode($textesJSON);
	// Test : imprimer le contenu de la variable $textes
	// echo $textes; // erreur : on ne peut imprimer autre chose qu'une chaîne de caractères
	// print_r($textes); // C'est bon

	// Raccourci pour la section commune "entete"
	$_ent = $textes->entete;
	// Raccourci pour la section commune "pp"
	$_pp = $textes->pp;

	// Raccourci pour TOUTES les pages spécifiques
	$_ = $textes->$page;

	// Imprimer un exemple d'accès aux textes :
	// echo $_ent->placeholderRecherche;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;900&family=Noto+Serif:ital,wght@0,400;0,900;1,400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>teeTIM // fibre naturelle ... conception artificielle</title>
	<meta name="description" content="Page d'accueil du concepteur de vêtements 100% fait au Québec, conçus par les étudiants du TIM à l'aide de designs produits par intelligence artificielle, et fabriqués avec des fibres 100% naturelles et biologiques.">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="icon" type="image/png" href="images/favicon.png" />
</head>

<body>
	<div class="conteneur">
		<header>
			<nav class="barre-haut">

				<!-- 
				Boucle pour generer une balise A pour 
				chaque fichier de langue dans le dossier i18n
				-->

				<a 
					class="<?php if($langue=='en') {echo 'actif';} 
					?>" href="?lan=en">en
				</a>
				
			</nav>
			<nav class="barre-logo">
				<label for="cc-btn-responsive" class="material-icons burger">menu</label>
				<a class="logo" href="index.php"><img src="images/logo.png" alt="<?= $_ent->altLogo ?>"></a>
				<a class="material-icons panier" href="panier.php">shopping_cart</a>
				<input class="recherche" type="search" name="motscles" placeholder="<?= $_ent->placeholderRecherche ?>">
			</nav>
			<input type="checkbox" id="cc-btn-responsive">
			<nav class="principale">
				<label for="cc-btn-responsive" class="menu-controle material-icons">close</label>
				<a href="teeshirts.php" class="<?php if($page=='teeshirts') {echo 'actif';} ?>"><?= $_ent->menuTeeshirts ?></a>
				<a href="casquettes.php"><?= $_ent->menuCasquettes ?></a>
				<a href="hoodies.php"><?= $_ent->menuHoodies ?></a>
				<span class="separateur"></span>
				<a href="aide.php"><?= $_ent->menuAide ?></a>
				<a href="apropos.php"><?= $_ent->menuNous ?></a>
			</nav>
		</header>