SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `multiserviciosurbano_web` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `multiserviciosurbano_web` ;

-- -----------------------------------------------------
-- Table `multiserviciosurbano_web`.`universidades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `multiserviciosurbano_web`.`universidades` (
  `id_universidad` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre_universidad` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id_universidad`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiserviciosurbano_web`.`carreras`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `multiserviciosurbano_web`.`carreras` (
  `id_carrera` INT UNSIGNED NOT NULL ,
  `nombre_carrera` VARCHAR(200) NULL ,
  `id_universidad` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_carrera`) ,
  INDEX `fk_carreras_universidades_idx` (`id_universidad` ASC) ,
  CONSTRAINT `fk_carreras_universidades`
    FOREIGN KEY (`id_universidad` )
    REFERENCES `multiserviciosurbano_web`.`universidades` (`id_universidad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiserviciosurbano_web`.`materias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `multiserviciosurbano_web`.`materias` (
  `id_materia` INT UNSIGNED NOT NULL ,
  `nombre_materia` VARCHAR(200) NOT NULL ,
  `id_carrera` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_materia`) ,
  INDEX `fk_materias_carreras1_idx` (`id_carrera` ASC) ,
  CONSTRAINT `fk_materias_carreras1`
    FOREIGN KEY (`id_carrera` )
    REFERENCES `multiserviciosurbano_web`.`carreras` (`id_carrera` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiserviciosurbano_web`.`documentos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `multiserviciosurbano_web`.`documentos` (
  `id_documento` INT UNSIGNED NOT NULL ,
  `documento_nombre_archivo` VARCHAR(200) NOT NULL ,
  `documento_fecha` DATE NOT NULL ,
  `documento_nro_paginas` INT NULL ,
  `id_materia` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_documento`) ,
  INDEX `fk_documentos_materias1_idx` (`id_materia` ASC) ,
  CONSTRAINT `fk_documentos_materias1`
    FOREIGN KEY (`id_materia` )
    REFERENCES `multiserviciosurbano_web`.`materias` (`id_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiserviciosurbano_web`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE `multiserviciosurbano_web`.`usuarios` (
  `id_usuario` INT UNSIGNED NOT NULL ,
  `nombre_usuario` VARCHAR(45) NOT NULL ,
  `password_usuario` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_usuario`) );




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
