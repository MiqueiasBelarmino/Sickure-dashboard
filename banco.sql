

CREATE DATABASE SicKure;

USE SicKure;

CREATE TABLE Paciente
(
	paciente_id INT PRIMARY KEY AUTO_INCREMENT,
    paciente_nome VARCHAR(40) NOT NULL,
    paciente_cpf CHAR(14) UNIQUE NOT NULL,
    paciente_senha VARCHAR(25),
    paciente_rg VARCHAR(14) NOT NULL,
    paciente_dataNascimento DATE NOT NULL,
    paciente_sexo CHAR(1) NOT NULL,
    paciente_logradouro VARCHAR(50) NOT NULL,
    paciente_numero VARCHAR(6) NOT NULL,
    paciente_bairro VARCHAR(20) NOT NULL,
    paciente_cidade VARCHAR(40) NOT NULL,
    paciente_cep VARCHAR(11) NOT NULL,
    paciente_telefone VARCHAR(14),
    paciente_celular VARCHAR(14),
    paciente_nomeMae VARCHAR(50) NOT NULL,
    paciente_nomePai VARCHAR(50),
    paciente_cartaoSus VARCHAR(30) NOT NULL,
    paciente_ativo BOOLEAN DEFAULT TRUE
);

CREATE TABLE Funcionario
(
	funcionario_id INT PRIMARY KEY AUTO_INCREMENT,
    funcionario_nome VARCHAR(40) NOT NULL,
    funcionario_cpf CHAR(14) UNIQUE NOT NULL,
    funcionario_senha VARCHAR(25),
    funcionario_cargo INT DEFAULT 1,
    funcionario_rg VARCHAR(14) NOT NULL,
    funcionario_dataNascimento DATE NOT NULL,
    funcionario_sexo CHAR(1) NOT NULL,
    funcionario_logradouro VARCHAR(50) NOT NULL,
    funcionario_numero VARCHAR(6) NOT NULL,
    funcionario_bairro VARCHAR(20) NOT NULL,
    funcionario_cidade VARCHAR(40) NOT NULL,
    funcionario_cep VARCHAR(11) NOT NULL,
    funcionario_telefone VARCHAR(14),
    funcionario_celular VARCHAR(14),
    funcionario_ativo BOOLEAN DEFAULT TRUE
);

CREATE TABLE Medico
(
	funcionario_id INT NOT NULL,
    medico_crm VARCHAR(13) NOT NULL,
    medico_ativo BOOLEAN DEFAULT TRUE,
    PRIMARY KEY(funcionario_id),
    FOREIGN KEY(funcionario_id) REFERENCES Funcionario(funcionario_id)
);

CREATE TABLE Atendente
(
	funcionario_id INT NOT NULL,
    atendente_ativo BOOLEAN DEFAULT TRUE,
    PRIMARY KEY(funcionario_id),
    FOREIGN KEY(funcionario_id) REFERENCES Funcionario(funcionario_id)
);

CREATE TABLE Administrador
(
	funcionario_id INT NOT NULL,
    administrador_ativo BOOLEAN DEFAULT TRUE,
    administrador_nivel INT DEFAULT 1,
    PRIMARY KEY(funcionario_id),
    FOREIGN KEY(funcionario_id) REFERENCES Funcionario(funcionario_id)
);

CREATE TABLE Medicamento
(
	medicamento_id INT PRIMARY KEY AUTO_INCREMENT,
	medicamento_nome VARCHAR(40) NOT NULL,
    #medicamento_posologia VARCHAR(40) NOT NULL, #encontrar genericos?
    medicamento_ativo BOOLEAN DEFAULT TRUE
    
);

CREATE TABLE LoteMedicamento
(
	mlote_codigo INT NOT NULL,
	medicamento_id INT NOT NULL,
    mlote_chegada DATE NOT NULL,
    mlote_vencimento DATE NOT NULL,
    mlote_qtd INT NOT NULL,
    mlote_ativo INT DEFAULT 1,
    FOREIGN KEY(medicamento_id) REFERENCES Medicamento(medicamento_id),
    PRIMARY KEY(mlote_codigo, medicamento_id)
);

CREATE TABLE Vacina
(
	vacina_id INT PRIMARY KEY AUTO_INCREMENT,
    vacina_nome VARCHAR(40) NOT NULL,
    vacina_ativo BOOLEAN DEFAULT TRUE
    #vacina_topologia ?? (para buscar semelhantes?)
);

CREATE TABLE LoteVacina
(
	vlote_codigo INT NOT NULL,
	vacina_id INT NOT NULL,
    vlote_chegada DATE NOT NULL,
    vlote_vencimento DATE NOT NULL,
    vlote_qtd INT NOT NULL,
    vlote_ativo INT DEFAULT 1,
    FOREIGN KEY(vacina_id) REFERENCES Vacina(vacina_id),
    PRIMARY KEY(vlote_codigo, vacina_id)
);

CREATE TABLE CarteiraVacinacao
(
	paciente_id INT NOT NULL,
    funcionario_id INT NOT NULL,
    vacina_id INT NOT NULL,
    vlote_codigo INT,
	cvac_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cvac_tipo INT DEFAULT 1, #1 = vacina realizada, 2 = agendamento, 0 = faltou agendamento, 3 = preenchido
    #cvac_dose (? necessairo ? )
    FOREIGN KEY(paciente_id) REFERENCES Paciente(paciente_id),
    FOREIGN KEY(funcionario_id) REFERENCES Funcionario(funcionario_id),
    FOREIGN KEY(vacina_id) REFERENCES Vacina(vacina_id),
    PRIMARY KEY(paciente_id, vacina_id, cvac_data)
    
);

CREATE TABLE Consulta
(
	consulta_id INT PRIMARY KEY AUTO_INCREMENT, #permitir varias consultas no mesmo dia
	paciente_id INT NOT NULL,
    funcionario_id INT NOT NULL,
    consulta_tipo INT DEFAULT 1, #1 = consulta realizada, 2 = agendamento, 0 = faltou agendamento
    consulta_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(paciente_id) REFERENCES Paciente(paciente_id),
    FOREIGN KEY(funcionario_id) REFERENCES Funcionario(funcionario_id)
);

CREATE TABLE Receita
(
	consulta_id INT NOT NULL,
	medicamento_id INT NOT NULL,
    receita_quantidade INT NOT NULL,
    receita_desc VARCHAR(40),
    FOREIGN KEY(consulta_id) REFERENCES Consulta(consulta_id),
    FOREIGN KEY(medicamento_id) REFERENCES Medicamento(medicamento_id)
);

CREATE TABLE DetalhesConsulta
(
	consulta_id INT NOT NULL,
	dconsulta_ordem INT NOT NULL,
    dconsulta_detalhes VARCHAR(60),
    FOREIGN KEY(consulta_id) REFERENCES Consulta(consulta_id),
    PRIMARY KEY(consulta_id, dconsulta_ordem)
);

CREATE TABLE Fila
(
	fila_posicao INT PRIMARY KEY AUTO_INCREMENT,
	paciente_id INT NOT NULL,
    funcionario_id INT NOT NULL,
    fila_texto VARCHAR(60) NOT NULL,
    fila_datainclusao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fila_saidasaida TIMESTAMP,
    fila_tiposaida INT DEFAULT 0, #0 = em fila, 1 = vez executada, 2 = desistencia
    FOREIGN KEY(paciente_id) REFERENCES Paciente(paciente_id),
    FOREIGN KEY(funcionario_id) REFERENCES Funcionario(funcionario_id)
);