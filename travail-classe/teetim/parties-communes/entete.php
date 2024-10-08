<?php
	// Définir le tableau des langues disponibles
	$languesDispo = [];
	$dossierI18n = scandir('i18n');
	// print_r($dossierI18n);
	foreach($dossierI18n as $fichier) {
		// Stratégie insuffisante pour se débarrasser des fichiers qui ne 
		// représentent pas des langues... et donc, meilleure stratégie :
		// Tester si la variable $fichier contient une chaîne qui ressemble 
		// à "LL.json"
		// Utiliser substr() ou les "expressions régulières"
		if($fichier != '.' && $fichier != '..' && $fichier != '.DS_Store') {
			$languesDispo[] = substr($fichier, 0, 2); 
		}
	}

	// print_r($languesDispo);

	// Test
	// echo time();
	// setcookie('patati', 'patata', time() + 365*24*3600);

	// Test : récupérer la "jarre de cookie" du browser
	// print_r($_COOKIE);

	// Accès aux paramètres d'URL (QueryString) en PHP
	// print_r($_GET);
	// echo $_GET['lan'];

	// Choix de langue
	// 1. Par défaut la langue est fr
	$langue = 'fr';

	// 2. Langue mémorisée au préalable (cookie) 
	// Programmer défensivement contre les injections par valeurs de cookies
	if(isset($_COOKIE['choixLangue']) 
						&& in_array($_COOKIE['choixLangue'], $languesDispo)) {
		$langue = $_COOKIE['choixLangue'];
	}

	// 3. Si l'utilisateur choisi explicitement une autre langue...
	// NE PAS FAIRE CONFIANCE aux valeurs qui viennent d'un utilisateur
	// Programmez DÉFENSIVEMENT (ici pour éviter une attaque par 
	// 'injection de code')
	if(isset($_GET['lan']) && in_array($_GET['lan'], $languesDispo)) {
		$langue = $_GET['lan'];
		// Stocker la langue dans un témoin HTTP (cookie)
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
<!-- Attribut DIR à compléter (point boni) -->
<html lang="<?= $langue ?>" dir="">

<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;900&family=Noto+Serif:ital,wght@0,400;0,900;1,400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $_->metaTitre  ?></title>
	<meta name="description" content="<?= $_->metaDesc  ?>">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="icon" type="image/png" href="images/favicon.png" />
</head>

<body>
	<div class="conteneur">
		<header>
			<nav class="barre-haut">

				<!-- 
					Boucle pour générer une balise A pour
					chaque fichier de langue dans le dossier i18n
				-->
				<?php foreach($languesDispo as $codeLangue) : ?>
					<a 
						class="<?= $langue==$codeLangue ? 'actif' : '' ?>" 
						href="?lan=<?= $codeLangue ?>"
						title="[À venir : nom de la langue (dans la langue)]"
					>
						<?= $codeLangue ?>
					</a>
				<?php endforeach ?>
			</nav>
			<nav class="barre-logo">
				<label for="cc-btn-responsive" class="material-icons burger">menu</label>
				<a class="logo" href="index.php"><img src="images/logo.png" alt="<?= $_ent->altLogo ?>"></a>
				<a class="material-icons panier" href="panier.php">shopping_cart</a>
				<input 
					class="recherche" 
					type="search" 
					name="motscles" 
					placeholder="<?= $_ent->placeholderRecherche ?>"
				>
			</nav>
			<input type="checkbox" id="cc-btn-responsive">
			<nav class="principale">
				<label for="cc-btn-responsive" class="menu-controle material-icons">close</label>
				<a href="teeshirts.php" class="<?= $page=='teeshirts' ? 'actif' :  '' ; ?>"><?= $_ent->menuTeeshirts ?></a>
				<a href="casquettes.php"><?= $_ent->menuCasquettes ?></a>
				<a href="hoodies.php"><?= $_ent->menuHoodies ?></a>
				<span class="separateur"></span>
				<a href="aide.php"><?= $_ent->menuAide ?></a>
				<a href="apropos.php"><?= $_ent->menuNous ?></a>
			</nav>
		</header>