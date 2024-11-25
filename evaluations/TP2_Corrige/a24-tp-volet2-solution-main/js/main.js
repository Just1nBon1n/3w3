/********* 
 Gestion du Tri et du Filtre
*********/

/***********
 NOTEZ que j'ai fait plus que ce qui est demandé dans le TP/Volet 2 : j'ai 
 combiné le traitement du filtre et du tri.
***********/

/* 
	TP/Volet 2 : Points 5 et 6 : Gestion de l'interactivité de filtre 
*/
// On saisit les deux éléments SELECT de tri et de filtre
let selectsTriFiltre = document.querySelectorAll("form.controle select");

// Pour chaque éléments SELECT saisit...
for(let select of selectsTriFiltre) {
  // ... on "attache" l'écouteur d'événement "change"
  /* 
    TP/Volet 2 : Point 5 : Gestion de l'interactivité de filtre 
  */
  // Version synchrone
  select.addEventListener("change", gererRequeteTriFiltreSynchrone);
  
  /* 
    TP/Volet 2 : Point 6 : Géstion de l'interactivité de filtre 
  */
  // Version asynchrone...
  //select.addEventListener("change", gererRequeteTriFiltreAsynchrone);
}

/* 
  TP/Volet 2 : Point 5 : Gestion de l'interactivité de filtre 
*/
// Version synchrone
function gererRequeteTriFiltreSynchrone(evt) {
  // Aller au formulaire et le soumettre
  evt.target.form.submit();
}

/* 
  TP/Volet 2 : Point 6 : Gestion de l'interactivité de filtre 
*/
// Version asynchrone (technique Ajax)
async function gererRequeteTriFiltreAsynchrone(evt) {
  // ON NE SOUMET PAS LE FORMULAIRE HTML !!!!

  // Requête HTTP avec l'API Fetch
  // Remarquez que pour faire fonctionner le tri et le filtre ensemble, nous 
  // avons besoin d'envoyer dans les paramètres URL les valeurs des deux SELECTS
  let reponseTriFiltre = await fetch("async/teeshirts.async.php?tri=" 
                                    + evt.target.form.tri.value
                                    + "&filtre="
                                    + evt.target.form.filtre.value
                        );
  let produitsFiltresEtTries = await reponseTriFiltre.json();

  gererAffichageProduits(produitsFiltresEtTries);
}

/* 
  TP/Volet 2 : Point 6 : Gestion de l'affichage (avec le badge des ventes !!) 
*/
function gererAffichageProduits(produits) {
  let langue = document.querySelector("html").lang;
  // Faire une boucle sur produits et cloner le gabarit pour chaque produit
  // en remplaçant les valeurs à la bonne place
  let conteneur = document.querySelector("article.principal");
  conteneur.innerHTML = "";
  let gabarit = document.querySelector("#gabarit-produit").content;
  let divProduit;
  for(let prd of produits) {
    // On clone le gabarit
    divProduit = gabarit.cloneNode(true); // deep clone

    divProduit.querySelector('.ventes').innerHTML = prd.ventes;
    // Si les ventes sont 0, on retire l'élément HTML du DOM 
    if(prd.ventes == 0) {
      // POUF... il est parti !!
      divProduit.querySelector('.ventes').remove();    
    }
    // Remarquez comment on retombe sur le français si le nom du produit n'est
    // pas disponible dans la langue courante...
    divProduit.querySelector(".nom").innerHTML = prd.nom[langue] ?? prd.nom.fr;
    divProduit.querySelector(".prix").innerHTML = prd.prix + " $";
    divProduit.querySelector("img").alt = prd.nom[langue] ?? prd.nom.fr;
    divProduit.querySelector("img").src = `images/produits/teeshirts/${prd.id}.webp`;
    
    conteneur.append(divProduit);
  }
}
