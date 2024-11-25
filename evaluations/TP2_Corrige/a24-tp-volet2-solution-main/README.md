# Solution modèle - TP/Volet 2.

>Vous pouvez vous répérer dans le code de la solution modèle en recherchant les commentaires marqués `TP/Volet 2` pour tous les points concernant le TP/Volet 2 (sauf les fichiers JSON dans lesquels les commentaires ne sont pas permis :wink:)

---

# TP/Volet 2 : Adapter un site Web dynamique en y intégrant une interface utilisateur riche par programmation asynchrone en `JavaScript`.

## Travail d'équipe permis à raison de deux personnes pas équipe maximum.

>Date limite de remise : consultez Omnivox.

>Si vous travaillez en équipe, **les deux personnes** doivent accepter les fichiers du TP sur *GitHub Classroom*.

>Vous travaillez ensuite chacun.e sur votre version de code localement, et vous faites vos fusions et synchronisations du code correctement (attention : ce n'est pas simple ; assister aux séances de cours pour apprendre comment optimiser le travail d'équipe).

>Divisez le travail dans l'équipe de façon à simplifier/faciliter ces fusions (expérimentez, c'est le moment idéal !)

## Objectif/exigences généraux
* Utilisation du format `JSON` pour le stockage de données du site Web
* Utilisation du format `JSON` pour l'internationnalisation du site Web
* Produire le contenu `HTML` dynamiquement avec `PHP` 
* Gérer les requêtes `HTTP` (méthode `GET`) en `PHP` 
* Formater l'affichage `HTML` avec `CSS` 
* Utiliser la programmation `JavaScript` *asynchrone* pour améliorer l'interface utilisateur du site Web

## Étapes à suivre avant de commencer le travail
1. Clonez le dépôt sur votre machine locale à l'endroit approprié

2. Testez le site sur votre serveur Web avant de commencer le travail

## Fonctionnalités à implémenter
1. [i18n] Internationnaliser (externaliser et traduire) les étiquettes de tri des produits de la page `teeshirts.php`.

2. [i18n & catalogue] Produisez le code `PHP` adéquat pour faire en sorte que si la langue courante ne correspond pas à une langue dans laquelle le catalogue de produits est disponible, le français est alors utilisée à la place de la langue active. 
> Pour tester cette fonctionnalité, ajoutez une nouvelle langue dans le dossier `i18n` mais n'ajoutez pas les traductions dans le fichier `teeshirts.json` du catalogue (dossier `data`).

3. [Catalogue] Complétez le fichier `teeshirts.json` pour y intégrer les 20 produits représentés dans le fichier `Google Sheets` suivant : https://docs.google.com/spreadsheets/d/18r9TTOW1rXar0my3GQnLoiMGH2vk2LXwgncbu4V3_-w/edit?usp=sharing.

4. [Catalogue] Intégrez l'affichage du nombre de ventes dans la page Web `teeshirts.php` comme dans les captures d'écrans disponibles ci-dessous. Produisez le code PHP à l'endroit approprié, et modifiez la feuille de style `CSS` adéquatement. Attention, remarquez l'affichage lorsqu'aucun exemplaire d'un produit n'a été encore vendu (ventes == 0) !

5. [Catalogue] Intégrez l'affichage des teeshirts filtrés par catégorie (démo en classe) : lorsque l'utilisateur modifie la catégorie, la page Web est réaffichée avec les teeshirts correspondants à la catégorie sélectionnée uniquement. Attention : il est très important aussi de produire le code `PHP` adéquat pour que la catégorie affichée soit sélectionnée dans la liste déroulante (par défaut, les navigateurs Web sélectionnent toujours la première option d'une liste déroulante lorsqu'une page Web est chargée -- et ce n'est pas ce que l'on veut !)

6. [Catalogue & *code asynchrone*] Intégrez la même fonctionnalité qu'au point 5 ci-dessus, mais cette fois-ci en utilisant `PHP`, `JavaScript`, et la *programmation asynchrone*.

7. [Catalogue] Affichez dynamiquement à côté de chaque critère de filtre disponible, le nombre de produits correspondant à ce critère, comme illustré dans les captures d'écrans.

8. [Panier d'achats] Créez la page du *Panier d'achats* en suivant le gabarit illustré dans les captures d'écrans. Portez attention au CSS, *mobile first*, et ajustez la requête média pour les plus grands *viewports* adéquatement. Les étiquettes statiques du panier d'achats doivent être externalisées (dans les fichiers de textes du dossier `i18n`) mais les produits contenu dans le panier sont représentés statiquement sans être générés dynamiquement pour ce travail, donc vous pouvez laisser leurs textes en français.

9. [Autres pages du site Web] Créez **TOUTES** les pages manquantes du site Web, en utilisant la page `casquettes.php` comme modèle. Remarquez que les noms de ces fichiers doivent être les mêmes que ceux utilisés dans les liens (URL) dans le site.

10. [i18n] Externalisez les textes de la page du *panier d'achats* et de toutes les autres pages que vous venez de créer dans les fichiers de textes `fr` et `en`. 

11. [i18n & L12n] Produisez une traduction complète des textes statiques du site (dossier `i18n`) et des textes du catalogue des teeshirts (fichier `teeshirts.json`) dans une troisième langue de votre choix (autre que le *français* et *l'anglais* bien évidement). 

12. [Remise] Testez votre solution, puis faites la remise sur `GitHub` avant l'échéance de la date de remise. Votre dernier `commit` de remise **finale** doit avoir le message suivant : "TP/Volet 2 complété et testé."

### Gardez une copie personnelle de votre travail : les dépôts de remises sur `582-3W3` seront supprimés une fois les notes publiées.

---

## Démo

* En classe.

## Captures d'écran

* Filtre des teeshirts, quantités disponibles pour chaque critère, troisième langue
<img src="/_captures/1.png" alt="Filtre des teeshirts" title="Filtre des teeshirts, quantités disponibles pour chaque critère, troisième langue" />

* Panier d'achats - "mobile"
<img src="/_captures/2.png" alt="Panier d'achats - mobile" title="Panier d'achats - mobile" />

* Panier d'achats - "desktop"
<img src="/_captures/3.png" alt="Panier d'achats - desktop" title="Panier d'achats - desktop" />

* Affichage dynamique du nombre de ventes
<img src="/_captures/4.png" alt="Affichange des ventes" title="Affichange des ventes" />
