-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 nov. 2024 à 16:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `teetim`
--

CREATE DATABASE IF NOT EXISTS `teetim` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `teetim`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` tinyint(4) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(2, 'Casquettes'),
(3, 'Hoodies'),
(1, 'Teeshirts');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` mediumint(9) NOT NULL,
  `code` char(29) NOT NULL,
  `date_modif` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date de dernière modification du panier (timestamp)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier_article`
--

CREATE TABLE `panier_article` (
  `id` mediumint(9) NOT NULL,
  `qte` tinyint(4) NOT NULL DEFAULT 1,
  `id_produit` smallint(6) NOT NULL,
  `id_panier` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` smallint(6) NOT NULL,
  `nom` varchar(500) NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `ventes` smallint(6) NOT NULL DEFAULT 0,
  `image` char(11) DEFAULT NULL,
  `theme` varchar(25) NOT NULL,
  `dac` date NOT NULL,
  `id_categorie` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `prix`, `ventes`, `image`, `theme`, `dac`, `id_categorie`) VALUES
(1, 'Cute comme un poisson tropical', 25.95, 34, 'ts0001.webp', 'Animaux', '2020-04-25', 1),
(2, 'Monstre douillet', 25.95, 123, 'ts0004.webp', 'Animaux', '2023-08-12', 1),
(3, 'Camarade basque', 20.50, 20, 'ts0006.webp', 'Animaux', '2023-02-27', 1),
(4, 'Chaton moteur', 27.50, 12, 'ts0007.webp', 'Animaux', '2024-10-01', 1),
(5, 'Renardcoptère', 17.95, 56, 'ts0009.webp', 'Animaux', '2023-05-04', 1),
(6, 'L\'outre d\'outremer', 15.95, 260, 'ts0013.webp', 'Animaux', '2023-10-11', 1),
(7, 'Fauteuil illégal', 20.50, 6, 'ts0002.webp', 'Inusité', '2024-06-20', 1),
(8, 'Cerveau volant', 24.50, 154, 'ts0014.webp', 'Inusité', '2023-08-08', 1),
(9, 'Beau bébébot', 26.50, 2, 'ts0019.webp', 'Inusité', '2024-09-05', 1),
(10, 'Grille-pain couac-couac', 20.00, 0, 'ts0020.webp', 'Inusité', '2024-10-01', 1),
(11, 'Un dunk dans l\'univers', 22.75, 21, 'ts0003.webp', 'Sport', '2024-01-02', 1),
(12, 'Basket courbe', 19.75, 158, 'ts0015.webp', 'Sport', '2023-09-04', 1),
(13, 'pizza, vino e calcio', 19.75, 40, 'ts0016.webp', 'Sport', '2024-07-18', 1),
(14, 'Bleu comme une orange', 25.95, 325, 'ts0005.webp', 'Nature', '2023-12-25', 1),
(15, 'Et vogue le navire', 15.50, 293, 'ts0008.webp', 'Nature', '2020-12-21', 1),
(16, 'Par une nuit d\'été sur Mars', 22.00, 48, 'ts0010.webp', 'Nature', '2024-01-30', 1),
(17, 'Le déjeuner pointilliste', 21.00, 55, 'ts0011.webp', 'Nature', '2024-02-21', 1),
(18, 'Portrait au tournesol', 29.99, 24, 'ts0012.webp', 'Nature', '2024-03-26', 1),
(19, 'Reflexion dans le lac', 21.50, 12, 'ts0017.webp', 'Nature', '2024-07-10', 1),
(20, 'Levé de soleil en automne', 22.95, 5, 'ts0018.webp', 'Nature', '2024-08-28', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier_article`
--
ALTER TABLE `panier_article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_produit` (`id_produit`,`id_panier`),
  ADD KEY `id_panier` (`id_panier`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`,`id_categorie`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier_article`
--
ALTER TABLE `panier_article`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier_article`
--
ALTER TABLE `panier_article`
  ADD CONSTRAINT `panier_article_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `panier_article_ibfk_2` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
