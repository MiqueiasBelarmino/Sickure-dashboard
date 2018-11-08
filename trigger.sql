CREATE DEFINER=`root`@`localhost` TRIGGER `sickure`.`carteiravacinacao_AFTER_INSERT` AFTER INSERT ON `carteiravacinacao` FOR EACH ROW
BEGIN
	IF (new.cvac_tipo = 1) THEN
		UPDATE LoteVacina SET vlote_qtd=vlote_qtd-1 WHERE vlote_codigo = new.vlote_codigo;
    END IF;
END