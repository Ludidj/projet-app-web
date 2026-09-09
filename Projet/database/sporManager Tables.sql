-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Sports`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Sports` (
  `idSports` INT NOT NULL,
  `nomSport` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`idSports`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Equipe` (
  `idEquipe` INT NOT NULL,
  `idSport` INT NULL,
  `nom` VARCHAR(45) NULL,
  `Division` INT NULL,
  PRIMARY KEY (`idEquipe`),
  
  INDEX `fk_Sport_idx` (`idSport` ASC) VISIBLE,
  CONSTRAINT `fk_Sport`
    FOREIGN KEY (`idSport`)
    REFERENCES `mydb`.`Sports` (`idSports`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Joueurs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Joueurs` (
  `idJoueurs` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  `prénom` VARCHAR(45) NULL,
  `numero` INT(2) NULL,
  `division` INT NULL,
  `age` INT(2) NULL,
  `sexe` VARCHAR(45) NULL,
  `idEquipe` INT NULL,
  PRIMARY KEY (`idJoueurs`),
  INDEX `idEquipe_idx` (`idEquipe` ASC) VISIBLE,
  CONSTRAINT `idEquipe`
    FOREIGN KEY (`idEquipe`)
    REFERENCES `mydb`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Match`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Match` (
  `idMatch` INT NOT NULL,
  `idEquipe` INT NULL,
  `date` DATE NULL,
  `Lieu` VARCHAR(100) NULL,
  `heure` TIME NULL,
  `idAdversaire` INT NULL,
  `scoreEquipe` INT NULL,
  `scoreAdversair` INT NULL,
  PRIMARY KEY (`idMatch`),
  INDEX `FK_IDEQUIPE_idx` (`idEquipe` ASC) VISIBLE,
  CONSTRAINT `FK_IDEQUIPE`
    FOREIGN KEY (`idEquipe`)
    REFERENCES `mydb`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adversaire`
    FOREIGN KEY (`idEquipe`)
    REFERENCES `mydb`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Entrainement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Entrainement` (
  `idEntrainement` INT NOT NULL,
  `idEquipe` INT NULL,
  `heure` VARCHAR(45) NULL,
  `fréquence` VARCHAR(45) NULL,
  PRIMARY KEY (`idEntrainement`),
  INDEX `idEquipe_idx` (`idEquipe` ASC) VISIBLE,
  CONSTRAINT `idEquipe_fk`
    FOREIGN KEY (`idEquipe`)
    REFERENCES `mydb`.`Equipe` (`idEquipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
