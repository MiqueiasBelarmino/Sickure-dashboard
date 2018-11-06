SELECT * FROM Funcionario;

DELETE FROM Funcionario WHERE funcionario_id=5;

INSERT INTO Medico (funcionario_id, medico_crm) VALUES (1,"32131");

SELECT *, 
	(SELECT medico_ativo FROM Medico WHERE funcionario_id=1) AS medico,
    (SELECT administrador_ativo FROM Administrador WHERE funcionario_id=1) AS administrador,
    (SELECT atendente_ativo FROM Atendente WHERE funcionario_id=1) AS atendente
    FROM Funcionario WHERE funcionario_id=1;


SELECT * FROM Funcionario NATURAL LEFT OUTER JOIN Administrador NATURAL LEFT OUTER JOIN Medico NATURAL LEFT OUTER JOIN Atendente;


SELECT * FROM Funcionario NATURAL JOIN Medico;