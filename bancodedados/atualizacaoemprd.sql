-- MySQL Workbench Synchronization
-- Generated: 2020-03-26 22:31
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

-- MySQL Workbench Synchronization
-- Generated: 2020-05-21 22:38
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE IF NOT EXISTS `fesper35_deputados`.`t_emendas_orcamentarias` (
  `idt_emendas_orcamentarias` INT(11) NOT NULL AUTO_INCREMENT,
  `cidade` VARCHAR(45) NULL DEFAULT NULL,
  `distancia_capital` VARCHAR(45) NULL DEFAULT NULL,
  `regiao` VARCHAR(45) NULL DEFAULT NULL,
  `prefeito` VARCHAR(45) NULL DEFAULT NULL,
  `vice_prefeito` VARCHAR(45) NULL DEFAULT NULL,
  `populacao` VARCHAR(45) NULL DEFAULT NULL,
  `votos2018` VARCHAR(45) NULL DEFAULT NULL,
  `eleitores` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idt_emendas_orcamentarias`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `fesper35_deputados`.`t_recursos` (
  `idt_recursos` INT(11) NOT NULL AUTO_INCREMENT,
  `ano` VARCHAR(45) NULL DEFAULT NULL,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  `destino` VARCHAR(45) NULL DEFAULT NULL,
  `protocolo` VARCHAR(45) NULL DEFAULT NULL,
  `valor` VARCHAR(45) NULL DEFAULT NULL,
  `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NOT NULL,
  PRIMARY KEY (`idt_recursos`),
  INDEX `fk_t_recursos_t_emendas_orcamentarias1_idx` (`t_emendas_orcamentarias_idt_emendas_orcamentarias` ASC) ,
  CONSTRAINT `fk_t_recursos_t_emendas_orcamentarias1`
    FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
    REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `fesper35_deputados`.`t_visitas` (
  `idt_visitas` INT(11) NOT NULL AUTO_INCREMENT,
  `data` VARCHAR(45) NULL DEFAULT NULL,
  `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NOT NULL,
  PRIMARY KEY (`idt_visitas`),
  INDEX `fk_t_visitas_t_emendas_orcamentarias1_idx` (`t_emendas_orcamentarias_idt_emendas_orcamentarias` ASC) ,
  CONSTRAINT `fk_t_visitas_t_emendas_orcamentarias1`
    FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
    REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `fesper35_deputados`.`t_estrutura_partido` (
  `idt_estrutura_partido` INT(11) NOT NULL AUTO_INCREMENT,
  `presidente` VARCHAR(45) NULL DEFAULT NULL,
  `vice_prefeito` VARCHAR(45) NULL DEFAULT NULL,
  `secretario` VARCHAR(45) NULL DEFAULT NULL,
  `segundo_secretario` VARCHAR(45) NULL DEFAULT NULL,
  `tesoureiro` VARCHAR(45) NULL DEFAULT NULL,
  `segundo_tesoureiro` VARCHAR(45) NULL DEFAULT NULL,
  `vogal` VARCHAR(45) NULL DEFAULT NULL,
  `contato_presidente` VARCHAR(45) NULL DEFAULT NULL,
  `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NOT NULL,
  PRIMARY KEY (`idt_estrutura_partido`),
  INDEX `fk_t_estrutura_partido_t_emendas_orcamentarias1_idx` (`t_emendas_orcamentarias_idt_emendas_orcamentarias` ASC) ,
  CONSTRAINT `fk_t_estrutura_partido_t_emendas_orcamentarias1`
    FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
    REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `fesper35_deputados`.`t_apoiadores` (
  `idt_apoiadores` INT(11) NOT NULL AUTO_INCREMENT,
  `epoca` VARCHAR(45) NULL DEFAULT NULL,
  `ano` VARCHAR(45) NULL DEFAULT NULL,
  `nomes` VARCHAR(45) NULL DEFAULT NULL,
  `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NOT NULL,
  PRIMARY KEY (`idt_apoiadores`),
  INDEX `fk_t_apoiadores_t_emendas_orcamentarias1_idx` (`t_emendas_orcamentarias_idt_emendas_orcamentarias` ASC) ,
  CONSTRAINT `fk_t_apoiadores_t_emendas_orcamentarias1`
    FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
    REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
