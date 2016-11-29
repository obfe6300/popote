-- MySQL Script generated by MySQL Workbench
-- 12/10/15 14:57:30
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema popote
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `popote` ;

-- -----------------------------------------------------
-- Schema popote
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `popote` DEFAULT CHARACTER SET utf8 ;
USE `popote` ;

-- -----------------------------------------------------
-- Table `popote`.`membres`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `popote`.`membres` ;

CREATE TABLE IF NOT EXISTS `popote`.`membres` (
  `id_membre` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(10) NOT NULL,
  `password` VARCHAR(10) NOT NULL,
  `nom` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(30) NOT NULL,
  `email` VARCHAR(40) NOT NULL,
  `type` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id_membre`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `popote`.`categorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `popote`.`categorie` ;

CREATE TABLE IF NOT EXISTS `popote`.`categorie` (
  `id_cat` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `description` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_cat`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `popote`.`sous_categorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `popote`.`sous_categorie` ;

CREATE TABLE IF NOT EXISTS `popote`.`sous_categorie` (
  `id_ss_cat` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `description` VARCHAR(50) NOT NULL,
  `id_cat` INT NOT NULL,
  PRIMARY KEY (`id_ss_cat`),
  INDEX `idx_fk_id_categorie_ss_cat` (`id_cat` ASC),
  CONSTRAINT `fk_id_categorie_ss_cat`
    FOREIGN KEY (`id_cat`)
    REFERENCES `popote`.`categorie` (`id_cat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `popote`.`recettes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `popote`.`recettes` ;

CREATE TABLE IF NOT EXISTS `popote`.`recettes` (
  `id_recette` INT NOT NULL AUTO_INCREMENT,
  `id_membre` INT NOT NULL,
  `titre` VARCHAR(100) NOT NULL,
  `nb_pers` INT NOT NULL,
  `cat_prix` VARCHAR(20) NULL,
  `cat_diff` VARCHAR(20) NULL,
  `note` INT NOT NULL,
  `nb_votes` INT NOT NULL,
  `description` VARCHAR(2000) NOT NULL,
  `preparation` VARCHAR(100) NOT NULL,
  `cuisson` VARCHAR(100) NOT NULL,
  `conseil` VARCHAR(500) NOT NULL,
  `id_cat` INT NULL,
  `id_ss_cat` INT NULL,
  PRIMARY KEY (`id_recette`),
  INDEX `idx_fk_id_membre_recettes` (`id_membre` ASC),
  INDEX `idx_fk_id_categorie_recettes` (`id_cat` ASC),
  INDEX `idx_fk_id_ss_categorie_recettes` (`id_ss_cat` ASC),
  UNIQUE INDEX `titre_UNIQUE` (`titre` ASC),
  CONSTRAINT `fk_id_membre_recettes`
    FOREIGN KEY (`id_membre`)
    REFERENCES `popote`.`membres` (`id_membre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_categorie_recettes`
    FOREIGN KEY (`id_cat`)
    REFERENCES `popote`.`categorie` (`id_cat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_ss_categorie_recettes`
    FOREIGN KEY (`id_ss_cat`)
    REFERENCES `popote`.`sous_categorie` (`id_ss_cat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `popote`.`commentaires`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `popote`.`commentaires` ;

CREATE TABLE IF NOT EXISTS `popote`.`commentaires` (
  `id_commentaire` INT NOT NULL AUTO_INCREMENT,
  `id_recette` INT NOT NULL,
  `id_membre` INT NOT NULL,
  `message` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  INDEX `idx_fk_id_recette_commentaires` (`id_recette` ASC),
  INDEX `idx_fk_id_membre_commentaires` (`id_membre` ASC),
  CONSTRAINT `fk_id_recette_commentaires`
    FOREIGN KEY (`id_recette`)
    REFERENCES `popote`.`recettes` (`id_recette`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_membre_commentaires`
    FOREIGN KEY (`id_membre`)
    REFERENCES `popote`.`membres` (`id_membre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `popote`.`ingredients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `popote`.`ingredients` ;

CREATE TABLE IF NOT EXISTS `popote`.`ingredients` (
  `id_ingredient` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `couleur` VARCHAR(50) NOT NULL,
  `type` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id_ingredient`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `popote`.`constituants`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `popote`.`constituants` ;

CREATE TABLE IF NOT EXISTS `popote`.`constituants` (
  `id_constituant` INT NOT NULL AUTO_INCREMENT,
  `id_recette` INT NOT NULL,
  `id_ingredient` INT NOT NULL,
  `quantite` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_constituant`),
  INDEX `idx_fk_id_recette_constituants` (`id_recette` ASC),
  INDEX `idx_fk_id_ingredient_constituants` (`id_ingredient` ASC),
  CONSTRAINT `fk_id_recette_constituants`
    FOREIGN KEY (`id_recette`)
    REFERENCES `popote`.`recettes` (`id_recette`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_ingredient_constituants`
    FOREIGN KEY (`id_ingredient`)
    REFERENCES `popote`.`ingredients` (`id_ingredient`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `popote`.`photos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `popote`.`photos` ;

CREATE TABLE IF NOT EXISTS `popote`.`photos` (
  `id_photo` INT NOT NULL AUTO_INCREMENT,
  `id_recette` INT NOT NULL,
  `lien` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_photo`),
  INDEX `idx_fk_id_recette_photo` (`id_recette` ASC),
  CONSTRAINT `fk_id_recette_photo`
    FOREIGN KEY (`id_recette`)
    REFERENCES `popote`.`recettes` (`id_recette`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `popote` ;

-- -----------------------------------------------------
-- Placeholder table for view `popote`.`ingredients_par_recette`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `popote`.`ingredients_par_recette` (`titre` INT, `nom` INT, `quantite` INT);

-- -----------------------------------------------------
-- Placeholder table for view `popote`.`recette_par_membre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `popote`.`recette_par_membre` (`titre` INT, `nom` INT, `prenom` INT);

-- -----------------------------------------------------
-- Placeholder table for view `popote`.`commentaire_par_membre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `popote`.`commentaire_par_membre` (`titre` INT, `nom` INT, `prenom` INT, `message` INT);

-- -----------------------------------------------------
-- Placeholder table for view `popote`.`photos_par_recette`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `popote`.`photos_par_recette` (`titre` INT, `lien` INT);

-- -----------------------------------------------------
-- Placeholder table for view `popote`.`categorie_par_recette`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `popote`.`categorie_par_recette` (`titre` INT, `nom` INT);

-- -----------------------------------------------------
-- View `popote`.`ingredients_par_recette`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `popote`.`ingredients_par_recette` ;
DROP TABLE IF EXISTS `popote`.`ingredients_par_recette`;
USE `popote`;
CREATE  OR REPLACE VIEW `ingredients_par_recette` AS
SELECT recettes.titre, ingredients.nom, constituants.quantite  FROM constituants JOIN ingredients ON constituants.id_ingredient = ingredients.id_ingredient 
JOIN recettes ON constituants.id_recette = recettes.id_recette
ORDER BY constituants.id_recette ASC;

-- -----------------------------------------------------
-- View `popote`.`recette_par_membre`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `popote`.`recette_par_membre` ;
DROP TABLE IF EXISTS `popote`.`recette_par_membre`;
USE `popote`;
CREATE  OR REPLACE VIEW `recette_par_membre` AS
SELECT recettes.titre, membres.nom, membres.prenom  FROM recettes JOIN membres ON recettes.id_membre = membres.id_membre 
ORDER BY membres.nom ASC;

-- -----------------------------------------------------
-- View `popote`.`commentaire_par_membre`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `popote`.`commentaire_par_membre` ;
DROP TABLE IF EXISTS `popote`.`commentaire_par_membre`;
USE `popote`;
CREATE  OR REPLACE VIEW `commentaire_par_membre` AS
SELECT recettes.titre, membres.nom, membres.prenom,  commentaires.message FROM commentaires 
JOIN recettes ON commentaires.id_recette = recettes.id_recette 
JOIN membres ON commentaires.id_membre = membres.id_membre 
ORDER BY membres.nom ASC;

-- -----------------------------------------------------
-- View `popote`.`photos_par_recette`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `popote`.`photos_par_recette` ;
DROP TABLE IF EXISTS `popote`.`photos_par_recette`;
USE `popote`;
CREATE  OR REPLACE VIEW `photos_par_recette` AS
SELECT recettes.titre, photos.lien FROM photos JOIN recettes ON photos.id_recette = recettes.id_recette ORDER BY recettes.titre ASC;

-- -----------------------------------------------------
-- View `popote`.`categorie_par_recette`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `popote`.`categorie_par_recette` ;
DROP TABLE IF EXISTS `popote`.`categorie_par_recette`;
USE `popote`;
CREATE  OR REPLACE VIEW `categorie_par_recette` AS
SELECT recettes.titre, categorie.nom, sous_categorie.nom  FROM recettes JOIN categorie ON  recettes.id_cat = categorie.id_cat
JOIN sous_categorie ON sous_categorie.id_ss_cat = recettes.id_ss_cat
ORDER BY recettes.titre ASC;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
