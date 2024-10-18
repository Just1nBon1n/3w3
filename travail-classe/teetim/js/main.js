/*******
  Gestion du catalogue (tri/filtre, etc.)
*******/

// TRI
// Saisir le SELECT qui permet le tri
let selectTri = document.querySelector("select#tri");

// S'il existe, lui assoscier un écouteur d'événements pour détecter quand sa valeur change
if(selectTri) {
  // Tester les deux méthodes (synchrone et asynchrone) en changeant
  // la fonction de rappel gestionnaire d'événement
  selectTri.addEventListener("change", gererRequeteTriAsynchrone);
}

function gererRequeteTriSynchrone(evt) {
  console.log("La valeur du critère de tri a changé : ", evt.target.value);
  console.log("Le FORM qui contient le SELECT : ", evt.target.closest("form"));
  console.log("Une autre façon d'y accéder (raccourci) : ", evt.target.form);
  // Saisir le formulaire associé avec le SELECT ...
  let leFrm = evt.target.form;

  // ... et le soumettre 
  leFrm.submit();
}

async function gererRequeteTriAsynchrone(evt) {
  // Ne pas soumettre le formulaire, mais plutôt envoyer une requête HTTP avec JS 
  // C'est à dire : l'API Fetch
  let reponseTri = await fetch("async/teeshirts.async.php?tri=" + evt.target.value);
  let produitsTries = await reponseTri.json();

  gererAffichageProduits(produitsTries);
}


function gererAffichageProduits(produits) {
  console.log("Le tableau produits trié selon la requête : ", produits);
  let conteneur = document.querySelector("article.principal");
  conteneur.innerHTML = "";
  // Et réinsérer dans le conteneur un bloc HTML pour chaque produit du tableau "produits"
  let gabaritProduit = document.querySelector("#gabarit-produit").content;
  let divProduit;
  
  for(let prd of produits) {
    divProduit = gabaritProduit.cloneNode(true); // deep clone : clone l'élément et TOUS ses descendants
    divProduit.querySelector("span.nom").innerHTML = prd.nom.en;

    // Insère divProduit dans le conteneur
    conteneur.append(divProduit);
  }

  console.log("Langue du site : ", document.querySelector("html").lang);
  console.log("Cookies : ", document.cookie);
  
}

