ALTER TABLE `fesper35_deputados`.`t_comentarios_oficios` 
DROP FOREIGN KEY `fk_t_comentarios_oficios_t_oficios1`;
ALTER TABLE `fesper35_deputados`.`t_comentarios_oficios` 
ADD CONSTRAINT `fk_t_comentarios_oficios_t_oficios1`
  FOREIGN KEY (`t_oficios_idt_oficios`)
  REFERENCES `fesper35_deputados`.`t_oficios` (`idt_oficios`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `fesper35_deputados`.`t_comentarios_emenda` 
DROP FOREIGN KEY `fk_t_comentarios_emenda_t_emendas_orcamentarias1`;
ALTER TABLE `fesper35_deputados`.`t_comentarios_emenda` 
ADD CONSTRAINT `fk_t_comentarios_emenda_t_emendas_orcamentarias1`
  FOREIGN KEY (`t_emendas_orcamentarias_idt_emendas_orcamentarias`)
  REFERENCES `fesper35_deputados`.`t_emendas_orcamentarias` (`idt_emendas_orcamentarias`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `fesper35_deputados`.`t_comentarios_requerimentos` 
DROP FOREIGN KEY `fk_t_comentarios_requerimentos_t_requerimentos1`;
ALTER TABLE `fesper35_deputados`.`t_comentarios_requerimentos` 
ADD CONSTRAINT `fk_t_comentarios_requerimentos_t_requerimentos1`
  FOREIGN KEY (`t_requerimentos_idt_requerimentos`)
  REFERENCES `fesper35_deputados`.`t_requerimentos` (`idt_requerimentos`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `fesper35_deputados`.`t_comentarios_projetosdelei` 
DROP FOREIGN KEY `fk_t_comentarios_projetosdelei_t_projetosdelei1`;
ALTER TABLE `fesper35_deputados`.`t_comentarios_projetosdelei` 
ADD CONSTRAINT `fk_t_comentarios_projetosdelei_t_projetosdelei1`
  FOREIGN KEY (`t_projetosdelei_idt_projetosdelei`)
  REFERENCES `fesper35_deputados`.`t_projetosdelei` (`idt_projetosdelei`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
