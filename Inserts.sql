SELECT * FROM Funcionario;

INSERT INTO Funcionario (funcionario_nome, funcionario_cpf, funcionario_senha, funcionario_rg, funcionario_dataNascimento, funcionario_sexo, funcionario_logradouro, funcionario_numero, funcionario_bairro, funcionario_cidade, funcionario_cep, funcionario_telefone, funcionario_celular, funcionario_ativo)
	VALUES ('Tio Administrador', '000.000.000-00', '123', '62.000.003-0', '1994-06-11', 'M', 'Seila', '000', 'Centro', 'Presidente Epitacio', '19470-000', '0', '0', 1);
    
INSERT INTO Funcionario (funcionario_nome, funcionario_cpf, funcionario_senha, funcionario_rg, funcionario_dataNascimento, funcionario_sexo, funcionario_logradouro, funcionario_numero, funcionario_bairro, funcionario_cidade, funcionario_cep, funcionario_telefone, funcionario_celular, funcionario_ativo)
	VALUES ('Tio Atendente', '111.111.111-11', '123', '62.000.003-0', '1994-06-11', 'M', 'Seila', '000', 'Centro', 'Presidente Epitacio', '19470-000', '0', '0', 1);
    
INSERT INTO Funcionario (funcionario_nome, funcionario_cpf, funcionario_senha, funcionario_rg, funcionario_dataNascimento, funcionario_sexo, funcionario_logradouro, funcionario_numero, funcionario_bairro, funcionario_cidade, funcionario_cep, funcionario_telefone, funcionario_celular, funcionario_ativo)
	VALUES ('Tio Medico', '222.222.222-22', '123', '62.000.003-0', '1990-01-01', 'M', 'Seila', '000', 'Centro', 'Presidente Epitacio', '19470-000', '0', '0', 1);
    
INSERT INTO Administrador (funcionario_id, administrador_nivel, administrador_ativo) VALUES(1, 10, 1);
INSERT INTO Atendente (funcionario_id, atendente_ativo) VALUES(2, 1);
INSERT INTO Medico (funcionario_id, medico_ativo, medico_crm) VALUES(3, 1, '54312');


INSERT INTO Paciente (paciente_nome, paciente_cpf, paciente_senha, paciente_rg, paciente_dataNascimento, paciente_sexo, paciente_logradouro, paciente_numero, paciente_bairro, paciente_cidade, paciente_cep, paciente_telefone, paciente_celular, paciente_nomeMae, paciente_nomePai, paciente_cartaoSus, paciente_ativo)
	VALUES('Cobaia_1','000.000.000-00', '123', '62.000.003-0', '1997-05-05', 'F', '123', '123', 'Centro', 'Presidente Epitacio', '19470000', '123', '132', 'Tia', 'Tio', '12352',1);
    
    
INSERT INTO Paciente (paciente_nome, paciente_cpf, paciente_senha, paciente_rg, paciente_dataNascimento, paciente_sexo, paciente_logradouro, paciente_numero, paciente_bairro, paciente_cidade, paciente_cep, paciente_telefone, paciente_celular, paciente_nomeMae, paciente_nomePai, paciente_cartaoSus, paciente_ativo)
	VALUES('Cobaia_2','100.000.000-00', '123', '62.000.003-0', '1997-05-05', 'F', '123', '123', 'Centro', 'Presidente Epitacio', '19470000', '123', '132', 'Tia', 'Tio', '12352',1);
    