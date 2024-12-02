/********* 
 Gestion du Tri et du Filtre
*********/
let selectsTriFiltre = document.querySelectorAll("form.controle select");

// Pour chaque éléments SELECT saisit...
for(let select of selectsTriFiltre) {
  select.addEventListener("change", gererRequeteTriFiltreSynchrone);
}

function gererRequeteTriFiltreSynchrone(evt) {
  evt.target.form.submit();
}

/******************************************************************************/
/******************************************************************************/
/******************************************************************************/

/********* 
 Gestion du panier d'achat
 (entierement en Ajax)
*********/

// Fonction qui va gerer l'affichage des actions du panier (ajout, suppression, etc.)
function gererAffichageActionsPanier(panier) {
  console.log("Détail du panier reçu du serveur : ", panier);

  // Mettre a jour laffichage des sommaires, du badge,
  // du message de panier vide, etc.
}

let btnsAjouter = document.querySelectorAll(".liste-produits .btn-ajouter");

for (let btn of btnsAjouter) {
  btn.addEventListener("click", gererRequeteAjoutPanier);
}

async function gererRequeteAjoutPanier(evt) {
  // // Source du clic
  // console.log("Element qui a declenche le clic : ", evt.target);
  // // Element div de la classe qui contient le bouton
  // console.log("Element div de la classe qui contient le bouton : "
  //             , evt.target.closest("div.produit"));
  // // Attibut qui contient l'ID du produit
  // console.log("ID du produit qui a ete clique : "
  //             , evt.target.closest(".produit").getAttribute("data-pid"));
  // // Meme chose mais avec l'API du DOM qui sappelle "dataset"
  // console.log("ID du produit qui a ete clique : "
  //             , evt.target.closest(".produit").dataset.pid);

  // On va chercher l'ID du produit
  let pid = evt.target.closest(".produit").dataset.pid;
  // On envoie une requete HTTP asynchrone
  let reponseAjout = await fetch("async/panier.async.php?action=ajouter&pid=" + pid)
  let detailPanier = await reponseAjout.json();
  gererAffichageActionsPanier(detailPanier);
}
