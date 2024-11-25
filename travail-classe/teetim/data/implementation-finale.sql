-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'categorie'
-- 
-- ---

DROP TABLE IF EXISTS `categorie`;
		
CREATE TABLE `categorie` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`nom`)
);

-- ---
-- Table 'produit'
-- 
-- ---

DROP TABLE IF EXISTS `produit`;
		
CREATE TABLE `produit` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(500) NOT NULL,
  `prix` DECIMAL(5,2) NOT NULL,
  `ventes` SMALLINT NOT NULL DEFAULT 0,
  `image` CHAR(11) NULL,
  `theme` VARCHAR(25) NOT NULL,
  `dac` DATE NOT NULL,
  `id_categorie` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`nom`, `id_categorie`)
);

-- ---
-- Table 'panier'
-- 
-- ---

DROP TABLE IF EXISTS `panier`;
		
CREATE TABLE `panier` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `code` CHAR(29) NOT NULL,
  `date_modif` TIMESTAMP NOT NULL COMMENT 'Date de dernière modification du panier (timestamp)',
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'panier_article'
-- 
-- ---

DROP TABLE IF EXISTS `panier_article`;
		
CREATE TABLE `panier_article` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `qte` TINYINT NOT NULL DEFAULT 1,
  `id_produit` SMALLINT NOT NULL,
  `id_panier` MEDIUMINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`id_produit`, `id_panier`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `produit` ADD FOREIGN KEY (id_categorie) REFERENCES `categorie` (`id`);
ALTER TABLE `panier_article` ADD FOREIGN KEY (id_produit) REFERENCES `produit` (`id`);
ALTER TABLE `panier_article` ADD FOREIGN KEY (id_panier) REFERENCES `panier` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `categorie` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `produit` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `panier` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `panier_article` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `categorie` (`id`,`nom`) VALUES
-- ('','');
-- INSERT INTO `produit` (`id`,`nom`,`prix`,`ventes`,`image`,`theme`,`dac`,`id_categorie`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `panier` (`id`,`code`,`date_modif`) VALUES
-- ('','','');
-- INSERT INTO `panier_article` (`id`,`qte`,`id_produit`,`id_panier`) VALUES
-- ('','','','');