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
  PRIMARY KEY (`id`)
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
  `vente` SMALLINT NOT NULL DEFAULT 0,
  `image` BLOB NULL DEFAULT NULL,
  `id_categorie` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `produit` ADD FOREIGN KEY (id_categorie) REFERENCES `categorie` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `categorie` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `produit` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `categorie` (`id`,`nom`) VALUES
-- ('','');
-- INSERT INTO `produit` (`id`,`nom`,`prix`,`vente`,`image`,`id_categorie`) VALUES
-- ('','','','','','');