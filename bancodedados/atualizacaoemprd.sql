-- MySQL Workbench Synchronization
-- Generated: 2020-07-21 16:43
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE IF NOT EXISTS `fesper35_deputados`.`t_emendas` (
  `idt_emendas` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo_emenda` VARCHAR(45) NULL DEFAULT NULL,
  `numDoc` VARCHAR(45) NULL DEFAULT NULL,
  `solicitante` VARCHAR(45) NULL DEFAULT NULL,
  `beneficiario` VARCHAR(45) NULL DEFAULT NULL,
  `nome_de_contato` VARCHAR(45) NULL DEFAULT NULL,
  `valor` VARCHAR(45) NULL DEFAULT NULL,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `data_cad_doc` VARCHAR(45) NULL DEFAULT NULL,
  `descricao` VARCHAR(450) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NOT NULL,
  PRIMARY KEY (`idt_emendas`),
  INDEX `fk_t_emendas_t_emendas_orcamentarias1_idx` (`t_emendas_orcamentarias_idt_emendas_orcamentarias` ASC) ,
  CONSTRAINT `fk_t_emendas_t_emendas_orcamentarias1`
    FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
    REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `fesper35_deputados`.`t_arquivos_emendas` (
  `idarquivos` INT(11) NOT NULL AUTO_INCREMENT,
  `arquivo_caminho` VARCHAR(45) NULL DEFAULT NULL,
  `nome_arquivo` VARCHAR(45) NULL DEFAULT NULL,
  `t_emendas_idt_emendas` INT(11) NOT NULL,
  PRIMARY KEY (`idarquivos`),
  INDEX `fk_t_arquivos_emendas_t_emendas1_idx` (`t_emendas_idt_emendas` ASC) ,
  CONSTRAINT `fk_t_arquivos_emendas_t_emendas1`
    FOREIGN KEY (`t_emendas_idt_emendas`)
    REFERENCES `fesper35_deputados`.`t_emendas` (`idt_emendas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;




-- MySQL Workbench Synchronization
-- Generated: 2020-07-21 16:57
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `fesper35_deputados`.`t_emendas` 
DROP FOREIGN KEY `fk_t_emendas_t_emendas_orcamentarias1`;

ALTER TABLE `fesper35_deputados`.`t_emendas` 
CHANGE COLUMN `t_emendas_orcamentarias_idt_emendas_orcamentarias` `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `fesper35_deputados`.`t_emendas` 
ADD CONSTRAINT `fk_t_emendas_t_emendas_orcamentarias1`
  FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
  REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;










-- MySQL Workbench Synchronization
-- Generated: 2020-07-21 17:06
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE IF NOT EXISTS `fesper35_deputados`.`t_comentarios_emendas` (
  `idt_comentarios_emendas` INT(11) NOT NULL AUTO_INCREMENT,
  `comentario` VARCHAR(450) NULL DEFAULT NULL,
  `data` DATETIME NULL DEFAULT NULL,
  `t_emendas_idt_emendas` INT(11) NOT NULL,
  PRIMARY KEY (`idt_comentarios_emendas`),
  INDEX `fk_t_comentarios_emendas_t_emendas1_idx` (`t_emendas_idt_emendas` ASC) ,
  CONSTRAINT `fk_t_comentarios_emendas_t_emendas1`
    FOREIGN KEY (`t_emendas_idt_emendas`)
    REFERENCES `fesper35_deputados`.`t_emendas` (`idt_emendas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;







ALTER TABLE `fesper35_deputados`.`t_arquivos_emendas` 
DROP FOREIGN KEY `fk_t_arquivos_emendas_t_emendas1`;
ALTER TABLE `fesper35_deputados`.`t_arquivos_emendas` 
ADD CONSTRAINT `fk_t_arquivos_emendas_t_emendas1`
  FOREIGN KEY (`t_emendas_idt_emendas`)
  REFERENCES `fesper35_deputados`.`t_emendas` (`idt_emendas`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;




ALTER TABLE `fesper35_deputados`.`t_comentarios_emendas` 
DROP FOREIGN KEY `fk_t_comentarios_emendas_t_emendas1`;
ALTER TABLE `fesper35_deputados`.`t_comentarios_emendas` 
ADD CONSTRAINT `fk_t_comentarios_emendas_t_emendas1`
  FOREIGN KEY (`t_emendas_idt_emendas`)
  REFERENCES `fesper35_deputados`.`t_emendas` (`idt_emendas`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;




-- MySQL Workbench Synchronization
-- Generated: 2020-08-17 14:46
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `fesper35_deputados`.`t_requerimentos` 
ADD COLUMN `data_insert` DATETIME NULL DEFAULT NULL AFTER `t_emendas_orcamentarias_idt_emendas_orcamentarias`,
ADD COLUMN `data_update` DATETIME NULL DEFAULT NULL AFTER `data_insert`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- MySQL Workbench Synchronization
-- Generated: 2020-08-17 14:52
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `fesper35_deputados`.`t_emendas` 
ADD COLUMN `data_insert` DATETIME NULL DEFAULT NULL AFTER `t_emendas_orcamentarias_idt_emendas_orcamentarias`;

ALTER TABLE `fesper35_deputados`.`t_oficios` 
ADD COLUMN `data_insert` DATETIME NULL DEFAULT NULL AFTER `t_emendas_orcamentarias_idt_emendas_orcamentarias`;

ALTER TABLE `fesper35_deputados`.`t_projetosdelei` 
ADD COLUMN `data_insert` DATETIME NULL DEFAULT NULL AFTER `t_emendas_orcamentarias_idt_emendas_orcamentarias`,
ADD COLUMN `t_projetosdeleicol` VARCHAR(45) NULL DEFAULT NULL AFTER `data_insert`;

ALTER TABLE `fesper35_deputados`.`t_requerimentos` 
CHANGE COLUMN `data_insert` `data_insert` DATETIME NULL DEFAULT NULL ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
