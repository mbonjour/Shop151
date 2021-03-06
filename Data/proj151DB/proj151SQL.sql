-- MySQL Script generated by MySQL Workbench
-- 09/09/16 18:08:10
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema projet151
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `projet151` ;

-- -----------------------------------------------------
-- Schema projet151
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projet151` DEFAULT CHARACTER SET utf8 ;
USE `projet151` ;

-- -----------------------------------------------------
-- Table `projet151`.`T_Adresse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Adresse` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Adresse` (
  `id_Adresse` INT NOT NULL AUTO_INCREMENT,
  `Ville` VARCHAR(45) NOT NULL,
  `NPA` INT NOT NULL,
  `Rue` VARCHAR(250) NOT NULL,
  `Pays` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Adresse`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Client`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Client` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Client` (
  `id_Client` INT NOT NULL AUTO_INCREMENT,
  `Nom` VARCHAR(45) NULL,
  `Prenom` VARCHAR(45) NULL,
  `Date_Naissance` DATE NULL,
  `Email` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Client`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Type_Adresse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Type_Adresse` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Type_Adresse` (
  `id_Type_Adresse` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Type_Adresse`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Adresse_Client`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Adresse_Client` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Adresse_Client` (
  `id_Adresse_Client` INT NOT NULL AUTO_INCREMENT,
  `FK_Client` INT NOT NULL,
  `FK_Adresse` INT NOT NULL,
  `FK_Type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Adresse_Client`, `FK_Type`),
  INDEX `fk_T_Adresse_Client_T_Client1_idx` (`FK_Client` ASC),
  INDEX `fk_T_Adresse_Client_T_Adresse1_idx` (`FK_Adresse` ASC),
  INDEX `fk_T_Adresse_Client_T_Type_Adresse1_idx` (`FK_Type` ASC),
  CONSTRAINT `fk_T_Adresse_Client_T_Client1`
    FOREIGN KEY (`FK_Client`)
    REFERENCES `projet151`.`T_Client` (`id_Client`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_T_Adresse_Client_T_Adresse1`
    FOREIGN KEY (`FK_Adresse`)
    REFERENCES `projet151`.`T_Adresse` (`id_Adresse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_T_Adresse_Client_T_Type_Adresse1`
    FOREIGN KEY (`FK_Type`)
    REFERENCES `projet151`.`T_Type_Adresse` (`id_Type_Adresse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Category` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Category` (
  `id_Category` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Category`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Articles` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Articles` (
  `id_Articles` INT NOT NULL AUTO_INCREMENT,
  `Nom` VARCHAR(45) NULL,
  `Description` TEXT(500) NULL,
  `Prix` VARCHAR(10) NULL,
  `Image_Path` VARCHAR(75) NULL,
  `FK_Category` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Articles`),
  INDEX `fk_T_Articles_T_Category1_idx` (`FK_Category` ASC),
  CONSTRAINT `fk_T_Articles_T_Category1`
    FOREIGN KEY (`FK_Category`)
    REFERENCES `projet151`.`T_Category` (`id_Category`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Commande`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Commande` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Commande` (
  `id_Commande` INT NOT NULL AUTO_INCREMENT,
  `session_ID` INT NULL,
  PRIMARY KEY (`id_Commande`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Etat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Etat` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Etat` (
  `id_Etat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Etat`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Commande_Client`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Commande_Client` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Commande_Client` (
  `id_Commande_Client` INT NOT NULL AUTO_INCREMENT,
  `Date_Commande_Client` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_Commande` INT NOT NULL,
  `FK_Client` INT NOT NULL,
  `FK_Etat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Commande_Client`),
  INDEX `fk_T_Commande_Client_T_Commande1_idx` (`FK_Commande` ASC),
  INDEX `fk_T_Commande_Client_T_Client1_idx` (`FK_Client` ASC),
  INDEX `fk_T_Commande_Client_T_Etat1_idx` (`FK_Etat` ASC),
  CONSTRAINT `fk_T_Commande_Client_T_Commande1`
    FOREIGN KEY (`FK_Commande`)
    REFERENCES `projet151`.`T_Commande` (`id_Commande`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_T_Commande_Client_T_Client1`
    FOREIGN KEY (`FK_Client`)
    REFERENCES `projet151`.`T_Client` (`id_Client`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_T_Commande_Client_T_Etat1`
    FOREIGN KEY (`FK_Etat`)
    REFERENCES `projet151`.`T_Etat` (`id_Etat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet151`.`T_Content`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet151`.`T_Content` ;

CREATE TABLE IF NOT EXISTS `projet151`.`T_Content` (
  `id_Content` INT NOT NULL AUTO_INCREMENT,
  `Quantity` INT NULL,
  `FK_Commande` INT NOT NULL,
  `FK_Articles` INT NOT NULL,
  PRIMARY KEY (`id_Content`),
  INDEX `fk_T_Content_T_Commande1_idx` (`FK_Commande` ASC),
  INDEX `fk_T_Content_T_Articles1_idx` (`FK_Articles` ASC),
  CONSTRAINT `fk_T_Content_T_Commande1`
    FOREIGN KEY (`FK_Commande`)
    REFERENCES `projet151`.`T_Commande` (`id_Commande`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_T_Content_T_Articles1`
    FOREIGN KEY (`FK_Articles`)
    REFERENCES `projet151`.`T_Articles` (`id_Articles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `t_type_adresse` (`id_Type_Adresse`) VALUES ('Livraison'), ('Facturation');
INSERT INTO `t_etat`(`id_Etat`) VALUES ('Traitement'),('Envoye'),('Livre'),('Paye'),('Factice');