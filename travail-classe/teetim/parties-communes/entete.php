<?php
	// On veut travailler avec les variables de session
	session_start();

	// Inclure les librairies nécessaire pour manipuler les données. 
	include("lib/sql.php");
	// Se connecter à la BD MySQL.
	$cnx = connexion();

	// Gestion du panier
	include("lib/panier.php");

	$idPanier = 0;

	if(isset($_COOKIE["teetim-panier"])) {
		// Vérifier que la valeur dans le cookie correspond à un panier dans la BD
		$idPanier = obtenirIdPanier($cnx, $_COOKIE["teetim-panier"]);
	}

	// Si $idPanier est 0 ----> il n'y a pas de panier valide !!!
	if($idPanier == 0) {
		// Générer un code unique pour le chariot de l'utilisateur
		$codePanier = uniqid("teetim", true);
		// echo $codePanier;
		// Planter ce code dans un témoin HTTP dans le navigateur du visiteur au site
		setcookie("teetim-panier", $codePanier, time()+365*24*60*60);
		// Créer un enregistrement dans la table panier ayant ce code de panier
		$idPanier = creerPanier($cnx, $codePanier);
	}

	// Stocker le id du panier dans la "session utilisateur"
	$_SESSION["idPanier"] = $idPanier;

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
				<!-- [TPv3] Point 8 : Badge de l'icone du panier d'achats -->
				<div class="panier-icone">
					<label for="panier-cc" class="material-icons">shopping_cart</label>
					<input type="checkbox" id="panier-cc">
					<!-- 
						[TPv3] Point 1 : utilisez la variable $detailPanier pour générer 
						dynamiquement le contenu du sommaire panier de l'entête.
					-->
					<div class="sommaire-panier">
						<div class="ligne1">
							<span class="nb-articles">
								<span class="etiquette">#Articles : </span>
								<span class="nombre">2</span>
							</span>
							<label for="panier-cc" class="material-icons">close</label>
						</div>
						<div class="ligne2">
							<span class="sous-titre">Sous-total du panier</span>
							<span class="sous-total montant-fr">59.00</span>
						</div>
						<div class="ligne3 btn-afficher-panier">
							<a href="panier.php">Voir le panier d'achats</a>
						</div>
					</div>
				</div>
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