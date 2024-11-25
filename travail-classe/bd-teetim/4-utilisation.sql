-- Commande SQL de manipulation des données:
-- Opérations CRUD :
        -- Créer une catégorie (Create)
        -- Lire (Read)
        -- Mettre à jour (Update)
        -- Supprimer (Delete)
-- Dans SQL, cela reviens a apprendre les commandes suivantes :
        -- INSERT
        -- SELECT
        -- UPDATE
        -- DELETE

-- Note 1 : le langugage SQL n'est pas sensible à la casse, mais par convention
-- je vais toujours utiliser TOUT MAJUSCULE pour les mots clés du language.

-- Note 2 : par contre, les noms de la BD, des tables et de colonnes SONT sensibles à la casse.

-- -----------------
-- 1. Commande INSERT
-- -----------------

-- Syntaxe simplifiée de base :
--          INSERT INTO nomDeMaTable VALUES (val1, val2, val3, ...)
-- Où les valeurs val1, val2, val3, ... sont énumérés dans l'ordre de leurs définition
-- dans la table de la BD.

-- Exemples.

-- Vider la table et réinitialiser la clé primaire (le champ ID)
TRUNCATE categorie;
-- ATTENTION vide la table de un seul coup!!!!!

-- Exemples 1 : Créer la catégorie "Teeshirts"
INSERT INTO categorie VALUES (2131, 'Teeshirts');
INSERT INTO categorie VALUES (2131, 'Casquettes');

-- Exemple 2 : Créer toute les catégories en une seule commande
INSERT INTO categorie VALUES 
                        (0, 'Teeshirts'),
                        (0, 'Casquettes'), 
                        (0, 'Hoodies');

-- Exemple 3 : créer un produit de la catégorie "Teeshirts"

-- -----------------
-- 2. Commande SELECT
-- -----------------

-- Commande très complexem, très difficile à résumer
-- Syntaxe de base :
--          SELECT nomDeColones FROM nomDeLaTable
--        OU
--          SELECT * FROM nomDeLaTable
--        OU
--          SELECT nomDeColones FROM nomDeLaTable WHERE ...

-- Exemples.

-- Exemple 1 : Obtenir tout les champs des enregistrements de la table "categorie"
SELECT * FROM categorie;
SELECT id, nom FROM categorie;

-- Exemple 2 : Obtenir les noms des catégories dont le ID est > 2
SELECT nom FROM categorie WHERE id > 2;

-- Exemple 3 : Obtenir le nom et le prix des produits en ordre croissant de prix
SELECT nom, prix FROM produit ORDER BY prix ASC;

-- -----------------
-- 3. Commande UPDATE
-- -----------------

-- Modifie des enregistrement dune tble dans la BD
-- Syntaxe de base :
--      UPDATE nomDeLaTable SET nomDeCol1 = nVal1,
--                              nCol2 = nval2
--                              ...
--                              WHERE condition

-- Exemples.

-- Exemple 1 : Renommmer la catégorie "Hoodies" pour "Pulls à capuche"
UPDATE categorie SET nom = 'Pulls à capuche' WHERE id = 3;

-- Exemple 2 : Augmenter le prix de tout les produits de 20%
UPDATE produit SET prix = prix * 1.2;

-- Exemple 3 : Augmenter la quantité vendue du produit id#2 par 5 et augmenter le prix de 10%
UPDATE produit SET ventes = ventes + 5, prix = prix * 1.1 WHERE id = 2;

-- -----------------
-- 4. Commande DELETE
-- -----------------
-- Supprimer des enregistrement d'une table dans la BD
-- Syntaxe de base :
--      DELETE FROM nomDeLaTable; 
--                      WHERE condition;

-- Exemples.

-- Exemple 1 : Supprimer tout les produits vendue a moins de 10 unités
DELETE FROM produit WHERE ventes < 10;

-- Exemple 2 : Supprimer toutes les categories
DELETE FROM categorie;
-- NE MARCHE PAS NORMALEMENT (on peut le forcer)

-- Exemple 3 : Supprimer les catégories qui non pas de produits (enfants)
DELETE FROM categorie WHERE id > 1
