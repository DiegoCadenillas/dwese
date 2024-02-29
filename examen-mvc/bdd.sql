-- MySQL Workbench Forward Engineering
-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP DATABASE IF EXISTS `mydb`;

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8;

USE `mydb`;

-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
    `idusuario` INT NOT NULL,
    `nombre` VARCHAR(45) NULL,
    `apellido` VARCHAR(45) NULL,
    `sexo` VARCHAR(1) NULL,
    `edad` INT NULL,
    `complexion` VARCHAR(45) NULL,
    `telefono` VARCHAR(45) NULL,
    PRIMARY KEY (`idusuario`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`lugar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`lugar` (
    `idlugar` INT NOT NULL,
    `nombre` VARCHAR(45) NULL,
    `descripcion` VARCHAR(45) NULL,
    `tipo` INT NULL,
    `provincia` VARCHAR(45) NULL,
    `localidad` VARCHAR(45) NULL,
    `direccion` VARCHAR(45) NULL,
    PRIMARY KEY (`idlugar`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`review` (
    `idreview` INT NOT NULL,
    `Descripcion` VARCHAR(45) NULL,
    `puntuacion` INT NULL,
    `usuario_idusuario` INT NOT NULL,
    PRIMARY KEY (`idreview`),
    CONSTRAINT `fk_review_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `mydb`.`usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE INDEX `fk_review_usuario1_idx` ON `mydb`.`review` (`usuario_idusuario` ASC) VISIBLE;

-- -----------------------------------------------------
-- Table `mydb`.`cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cita` (
    `usuario_propone` INT NOT NULL,
    `usuario_acepta` INT NOT NULL,
    `fecha` DATE NULL,
    `descripcion` VARCHAR(45) NULL,
    `lugar_idlugar` INT NOT NULL,
    `review_idreviewpropone` INT NOT NULL,
    `review_idreview` INT NOT NULL,
    `idcita` INT NOT NULL,
    PRIMARY KEY (`lugar_idlugar`, `idcita`),
    CONSTRAINT `fk_usuario_has_usuario_usuario` FOREIGN KEY (`usuario_propone`) REFERENCES `mydb`.`usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_usuario_has_usuario_usuario1` FOREIGN KEY (`usuario_acepta`) REFERENCES `mydb`.`usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_cita_lugar1` FOREIGN KEY (`lugar_idlugar`) REFERENCES `mydb`.`lugar` (`idlugar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_cita_review2` FOREIGN KEY (`review_idreview`) REFERENCES `mydb`.`review` (`idreview`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE INDEX `fk_usuario_has_usuario_usuario1_idx` ON `mydb`.`cita` (`usuario_acepta` ASC) VISIBLE;

CREATE INDEX `fk_usuario_has_usuario_usuario_idx` ON `mydb`.`cita` (`usuario_propone` ASC) VISIBLE;

CREATE INDEX `fk_cita_lugar1_idx` ON `mydb`.`cita` (`lugar_idlugar` ASC) VISIBLE;

CREATE INDEX `fk_cita_review2_idx` ON `mydb`.`cita` (`review_idreview` ASC) VISIBLE;