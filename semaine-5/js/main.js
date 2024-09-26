// Premeir exemple de programation asynchrone
// En 3 temps
// 1. JS : Gérer l'interactivité avec l'utilisateur et faire la requete http
//         au serveurs
// 2. PHP : Générer la réponse et la renvoyer a JS
// 3. JS : Traiter la réponse reçue et mettre a jour l'affichage (UI)

// Temps 1 : faire la requete HTTP

// Détecter le click sur le bouton
let bouton = document.querySelector(".btn");
bouton.addEventListener("click", requeteAjax);

/**
 * Envoie une requête http au serveur et gère la réponse
 */
async function requeteAjax() {
  //Envoyer une requête HTTP
  let reponse = await fetch("scripts-asynchrones/aleatoire.php");
  let lesProduitsEnJSON = await reponse.json();

  // Gerer l'affichage
  afficherProduit(lesProduitsEnJSON);
}

// Temps 3 : gestion de l'affichage
function afficherProduit(produits) {
  // PROCHAIN COURS
}