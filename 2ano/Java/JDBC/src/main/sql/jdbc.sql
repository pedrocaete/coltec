-- MySQL Script generated by MySQL Workbench
-- Sun Oct 27 18:13:49 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema jdbc
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema jdbc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `jdbc` DEFAULT CHARACTER SET utf8 ;
USE `jdbc` ;

-- -----------------------------------------------------
-- Table `jdbc`.`banco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jdbc`.`banco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cnpj` VARCHAR(14) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jdbc`.`agencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jdbc`.`agencia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `endereco` VARCHAR(255) NOT NULL,
  `id_banco` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_agencia_banco_idx` (`id_banco` ASC) VISIBLE,
  CONSTRAINT `fk_agencia_banco`
    FOREIGN KEY (`id_banco`)
    REFERENCES `jdbc`.`banco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jdbc`.`conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jdbc`.`conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `limite` DOUBLE NOT NULL,
  `saldo` DOUBLE NOT NULL,
  `id_agencia` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_conta_agencia1_idx` (`id_agencia` ASC) VISIBLE,
  CONSTRAINT `fk_conta_agencia1`
    FOREIGN KEY (`id_agencia`)
    REFERENCES `jdbc`.`agencia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jdbc`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jdbc`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jdbc`.`cliente_conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jdbc`.`cliente_conta` (
  `id_conta` INT NOT NULL,
  `id_cliente` INT NOT NULL,
  PRIMARY KEY (`id_conta`, `id_cliente`),
  INDEX `fk_conta_has_cliente_cliente1_idx` (`id_cliente` ASC) VISIBLE,
  INDEX `fk_conta_has_cliente_conta1_idx` (`id_conta` ASC) VISIBLE,
  CONSTRAINT `fk_conta_has_cliente_conta1`
    FOREIGN KEY (`id_conta`)
    REFERENCES `jdbc`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conta_has_cliente_cliente1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `jdbc`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
