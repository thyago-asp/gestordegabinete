-- MySQL Workbench Synchronization
-- Generated: 2020-07-02 20:47
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `fesper35_deputados`.`t_oficios` 
ADD COLUMN `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NOT NULL AFTER `status`,
ADD INDEX `fk_t_oficios_t_emendas_orcamentarias1_idx` (`t_emendas_orcamentarias_idt_emendas_orcamentarias` ASC) ;
;

ALTER TABLE `fesper35_deputados`.`t_projetosdelei` 
ADD COLUMN `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NOT NULL AFTER `status`,
ADD INDEX `fk_t_projetosdelei_t_emendas_orcamentarias1_idx` (`t_emendas_orcamentarias_idt_emendas_orcamentarias` ASC) ;
;

ALTER TABLE `fesper35_deputados`.`t_requerimentos` 
ADD COLUMN `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NOT NULL AFTER `status`,
ADD INDEX `fk_t_requerimentos_t_emendas_orcamentarias1_idx` (`t_emendas_orcamentarias_idt_emendas_orcamentarias` ASC) ;
;

ALTER TABLE `fesper35_deputados`.`t_oficios` 
ADD CONSTRAINT `fk_t_oficios_t_emendas_orcamentarias1`
  FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
  REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `fesper35_deputados`.`t_projetosdelei` 
ADD CONSTRAINT `fk_t_projetosdelei_t_emendas_orcamentarias1`
  FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
  REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `fesper35_deputados`.`t_requerimentos` 
ADD CONSTRAINT `fk_t_requerimentos_t_emendas_orcamentarias1`
  FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
  REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



--------------------

-- MySQL Workbench Synchronization
-- Generated: 2020-07-02 21:39
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Thyago

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `fesper35_deputados`.`t_oficios` 
DROP FOREIGN KEY `fk_t_oficios_t_emendas_orcamentarias1`;

ALTER TABLE `fesper35_deputados`.`t_projetosdelei` 
DROP FOREIGN KEY `fk_t_projetosdelei_t_emendas_orcamentarias1`;

ALTER TABLE `fesper35_deputados`.`t_requerimentos` 
DROP FOREIGN KEY `fk_t_requerimentos_t_emendas_orcamentarias1`;

ALTER TABLE `fesper35_deputados`.`t_oficios` 
CHANGE COLUMN `t_emendas_orcamentarias_idt_emendas_orcamentarias` `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `fesper35_deputados`.`t_projetosdelei` 
CHANGE COLUMN `t_emendas_orcamentarias_idt_emendas_orcamentarias` `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `fesper35_deputados`.`t_requerimentos` 
CHANGE COLUMN `t_emendas_orcamentarias_idt_emendas_orcamentarias` `t_emendas_orcamentarias_idt_emendas_orcamentarias` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `fesper35_deputados`.`t_oficios` 
ADD CONSTRAINT `fk_t_oficios_t_emendas_orcamentarias1`
  FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
  REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `fesper35_deputados`.`t_projetosdelei` 
ADD CONSTRAINT `fk_t_projetosdelei_t_emendas_orcamentarias1`
  FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
  REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `fesper35_deputados`.`t_requerimentos` 
ADD CONSTRAINT `fk_t_requerimentos_t_emendas_orcamentarias1`
  FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
  REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
