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

let conteneur = document.querySelector(".listeProduits");

/**
 * Envoie une requête http au serveur et gère la réponse
 */
async function requeteAjax() {
  //"Désactivé" le bouton
  bouton.classList.add("inactif");
  // et vider le conteneur des articles
  conteneur.innerHTML = "";

  //Envoyer une requête HTTP
  let reponse = await fetch("scripts-asynchrones/aleatoire.php");
  let lesProduitsEnJSON = await reponse.json();

  //Réactiver le bouton
  bouton.classList.remove("inactif");

  // Gerer l'affichage
  afficherProduits2(lesProduitsEnJSON);
}

// Temps 3 : gestion de l'affichage

// Solution 1
function afficherProduits1(produits) {
  let conteneur = document.querySelector(".listeProduits");
  // Le vider
  conteneur.innerHTML = "";

  // Remplir le conteneur avec les produits reçus 
  // dans la réponse JSON
  let article, h4, p, titre, prix, imgUrl;
  for (let unPrd of produits) {
    article = document.createElement("article");
    article.classList.add("prd");
    titre = unPrd.title;
    prix = unPrd.price;
    imgUrl = unPrd.image;

    // H4 -> titre
    h4 = document.createElement("h4");
    h4.innerHTML = titre;
    
    // img -> src et alt
    img = document.createElement("img");
    img.src = imgUrl;
    img.alt = titre;

    // p -> prix
    p = document.createElement("p");
    p.innerHTML = prix + " $";

    // Ajouter les éléments dans le conteneur
    article.appendChild(img);
    article.appendChild(h4);
    article.appendChild(p);
    
    conteneur.appendChild(article);
  }
}

// Solution 2
function afficherProduits2(produits) {
  

  conteneur.innerHTML = "";
  let cloneArticle;
  let gabaritArticle = document.getElementById("gabarit-article");
  for (let unPrd of produits) {
    cloneArticle = gabaritArticle.content.cloneNode(true);
    //Changer les valeurs dans le clone
    cloneArticle.querySelector("img").src = unPrd.image;
    cloneArticle.querySelector("img").alt = unPrd.title;
    cloneArticle.querySelector("h4").textContent = unPrd.title;
    cloneArticle.querySelector("p").textContent = unPrd.price + " $";
    conteneur.appendChild(cloneArticle);
  }
}