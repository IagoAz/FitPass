<<<<<<< HEAD
-- Database: `aap_fitpass`
CREATE DATABASE aap_fitpass;
USE aap_fitpass;
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CARACTERISTICAS_SELECTbyid` (IN `p_USU_INT_ID` INT)   BEGIN
    SELECT 
		U.USU_INT_ID,
		U.USU_STR_NOME,
        C.CAR_INT_ID,
        C.CAR_DOU_PESO,
		C.CAR_DOU_ALTURA,
		C.CAR_STR_GENERO,
		C.CAR_INT_IDADE 
	FROM usuario AS U INNER JOIN caracteristicas AS C ON C.CAR_INT_ID = U.CAR_INT_ID
    WHERE USU_INT_ID = p_USU_INT_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_DEL` (IN `p_USU_INT_ID` INT)   BEGIN 
    -- Excluir registros da tabela 'usuario'
    DELETE FROM usuario WHERE USU_INT_ID = p_USU_INT_ID;

    -- Excluir registros da tabela 'endereco'
    DELETE FROM endereco WHERE END_INT_ID = p_USU_INT_ID;

    -- Excluir registros da tabela 'cidade'
    DELETE FROM cidade WHERE CID_INT_ID = p_USU_INT_ID;

    -- Excluir registros da tabela 'estado'
    DELETE FROM estado WHERE EST_INT_ID = p_USU_INT_ID;

	-- Excluir registros da tabela 'caracteristicas'
    DELETE FROM caracteristicas WHERE CAR_INT_ID = p_USU_INT_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_INSERT` (IN `p_EST_STR_DESCRICAO` VARCHAR(255), IN `p_EST_STR_SIGLA` CHAR(2), IN `p_CID_STR_DESCRICAO` VARCHAR(255), IN `p_END_STR_RUA` VARCHAR(255), IN `p_END_STR_NUMERO` CHAR(4), IN `p_END_STR_BAIRRO` VARCHAR(255), IN `p_END_STR_COMPLEMENTO` VARCHAR(255), IN `p_END_STR_CEP` CHAR(9), IN `p_USU_INT_ID` INT, IN `p_USU_STR_NOME` VARCHAR(255), IN `p_USU_STR_SENHA` CHAR(70), IN `p_USU_STR_EMAIL` VARCHAR(70), IN `p_USU_STR_CPF` CHAR(14))   BEGIN
    DECLARE usuario_existente INT;

    -- Verificar se o email ou CPF já existem
    SELECT COUNT(*) INTO usuario_existente
    FROM usuario
    WHERE USU_STR_EMAIL = p_USU_STR_EMAIL OR USU_STR_CPF = p_USU_STR_CPF;

    -- Se já existir, retornar um código de erro
    IF usuario_existente > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Email ou CPF já cadastrado';
    ELSE
        -- Se não existir, proceder com as inserções
        INSERT INTO estado (EST_STR_DESCRICAO, EST_STR_SIGLA) VALUES (p_EST_STR_DESCRICAO, p_EST_STR_SIGLA);
               
        INSERT INTO cidade (CID_STR_DESCRICAO, EST_INT_ID)
        VALUES (p_CID_STR_DESCRICAO, p_USU_INT_ID);

        INSERT INTO endereco (END_STR_RUA, END_STR_NUMERO, END_STR_BAIRRO, END_STR_COMPLEMENTO, END_STR_CEP, CID_INT_ID)
        VALUES (p_END_STR_RUA, p_END_STR_NUMERO, p_END_STR_BAIRRO, p_END_STR_COMPLEMENTO, p_END_STR_CEP, p_USU_INT_ID);

        INSERT INTO usuario (USU_STR_NOME, USU_STR_SENHA, USU_STR_EMAIL, USU_STR_CPF, END_INT_ID, USU_INT_ID, CAR_INT_ID)
        VALUES (p_USU_STR_NOME, p_USU_STR_SENHA, p_USU_STR_EMAIL, p_USU_STR_CPF, p_USU_INT_ID, p_USU_INT_ID, p_USU_INT_ID);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_SELECTbyID` (IN `p_USU_INT_ID` INT)   BEGIN
    SELECT 
		U.USU_INT_ID,
		U.USU_STR_NOME,
        C.CAR_INT_ID,
        C.CAR_DOU_PESO,
		C.CAR_DOU_ALTURA,
		C.CAR_STR_GENERO,
		C.CAR_INT_IDADE 
	FROM usuario AS U INNER JOIN caracteristicas AS C ON C.CAR_INT_ID = U.CAR_INT_ID
    WHERE USU_INT_ID = p_USU_INT_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_UPDATE` (IN `p_EST_STR_DESCRICAO` VARCHAR(255), IN `p_EST_STR_SIGLA` CHAR(2), IN `p_CID_STR_DESCRICAO` VARCHAR(255), IN `p_END_STR_RUA` VARCHAR(255), IN `p_END_STR_NUMERO` CHAR(4), IN `p_END_STR_BAIRRO` VARCHAR(255), IN `p_END_STR_COMPLEMENTO` VARCHAR(255), IN `p_END_STR_CEP` CHAR(9), IN `p_USU_INT_ID` INT, IN `p_USU_STR_NOME` VARCHAR(255), IN `p_USU_STR_SENHA` CHAR(70), IN `p_USU_STR_EMAIL` VARCHAR(70))   BEGIN
    -- Verificar se o novo e-mail já existe em outro registro
    IF NOT EXISTS (SELECT 1 FROM usuario WHERE USU_STR_EMAIL = p_USU_STR_EMAIL) THEN
        UPDATE estado
        SET EST_STR_DESCRICAO = p_EST_STR_DESCRICAO,
            EST_STR_SIGLA = p_EST_STR_SIGLA
        WHERE EST_INT_ID = p_USU_INT_ID;

        UPDATE cidade
        SET CID_STR_DESCRICAO = p_CID_STR_DESCRICAO,
            EST_INT_ID = p_USU_INT_ID
        WHERE CID_INT_ID = p_USU_INT_ID;

        UPDATE endereco
        SET END_STR_RUA = p_END_STR_RUA,
            END_STR_NUMERO = p_END_STR_NUMERO,
            END_STR_BAIRRO = p_END_STR_BAIRRO,
            END_STR_COMPLEMENTO = p_END_STR_COMPLEMENTO,
            END_STR_CEP = p_END_STR_CEP,
            CID_INT_ID = p_USU_INT_ID
        WHERE END_INT_ID = p_USU_INT_ID;

        UPDATE usuario
        SET USU_STR_NOME = p_USU_STR_NOME,
            USU_STR_EMAIL = p_USU_STR_EMAIL,
            USU_STR_SENHA = p_USU_STR_SENHA,
            END_INT_ID = p_USU_INT_ID,
            CAR_INT_ID = p_USU_INT_ID
        WHERE USU_INT_ID = p_USU_INT_ID;
    ELSE
   SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Email ou CPF já cadastrado';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE `administrador` (
  `ADM_INT_ID` int(11) NOT NULL,
  `ADM_STR_NOME` varchar(70) NOT NULL,
  `ADM_STR_SENHA` varchar(50) NOT NULL,
  `ADM_STR_EMAIL` varchar(70) NOT NULL,
  `ADM_STR_CPF` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`ADM_INT_ID`, `ADM_STR_NOME`, `ADM_STR_SENHA`, `ADM_STR_EMAIL`, `ADM_STR_CPF`) VALUES
(1, 'Admin', 'admin', 'admin@admin.com', '123.456.789');

-- --------------------------------------------------------

--
-- Table structure for table `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `CAR_INT_ID` int(11) NOT NULL,
  `CAR_DOU_PESO` float NOT NULL,
  `CAR_DOU_ALTURA` float NOT NULL,
  `CAR_INT_IDADE` int(11) NOT NULL,
  `CAR_STR_GENERO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `caracteristicas`
--

INSERT INTO `caracteristicas` (`CAR_INT_ID`, `CAR_DOU_PESO`, `CAR_DOU_ALTURA`, `CAR_INT_IDADE`, `CAR_STR_GENERO`) VALUES
(1, 75, 183, 25, 'Masculino');

-- --------------------------------------------------------

--
-- Table structure for table `cidade`
--

CREATE TABLE `cidade` (
  `CID_INT_ID` int(11) NOT NULL,
  `EST_INT_ID` int(11) NOT NULL,
  `CID_STR_DESCRICAO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cidade`
--

INSERT INTO `cidade` (`CID_INT_ID`, `EST_INT_ID`, `CID_STR_DESCRICAO`) VALUES
(1, 1, 'Cidade Teste');

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE `endereco` (
  `END_INT_ID` int(11) NOT NULL,
  `CID_INT_ID` int(11) NOT NULL,
  `END_STR_CEP` varchar(9) NOT NULL,
  `END_STR_RUA` varchar(70) NOT NULL,
  `END_STR_NUMERO` varchar(4) NOT NULL,
  `END_STR_BAIRRO` varchar(50) NOT NULL,
  `END_STR_COMPLEMENTO` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`END_INT_ID`, `CID_INT_ID`, `END_STR_CEP`, `END_STR_RUA`, `END_STR_NUMERO`, `END_STR_BAIRRO`, `END_STR_COMPLEMENTO`) VALUES
(1, 1, '12312-312', 'Rua Teste', '123', 'Bairro Teste', 'apto.Teste');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `EST_INT_ID` int(11) NOT NULL,
  `EST_STR_DESCRICAO` varchar(50) NOT NULL,
  `EST_STR_SIGLA` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`EST_INT_ID`, `EST_STR_DESCRICAO`, `EST_STR_SIGLA`) VALUES
(1, 'São Paulo', 'SP');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `USU_INT_ID` int(11) NOT NULL,
  `END_INT_ID` int(11) NOT NULL,
  `CAR_INT_ID` int(11) NOT NULL,
  `USU_STR_NOME` varchar(70) NOT NULL,
  `USU_STR_EMAIL` varchar(70) NOT NULL,
  `USU_STR_SENHA` varchar(50) NOT NULL,
  `USU_STR_CPF` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`USU_INT_ID`, `END_INT_ID`, `CAR_INT_ID`, `USU_STR_NOME`, `USU_STR_EMAIL`, `USU_STR_SENHA`, `USU_STR_CPF`) VALUES
(1, 1, 1, 'Teste 123', 'teste@email.com', '12341234', '123.123.123-12');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_administrador`
--

CREATE TABLE `usuario_administrador` (
  `USU_INT_ID` int(11) NOT NULL,
  `ADM_INT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ADM_INT_ID`),
  ADD UNIQUE KEY `UK_ADMINISTRADOR_CPF` (`ADM_STR_CPF`);

--
-- Indexes for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`CAR_INT_ID`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`CID_INT_ID`),
  ADD KEY `FK_CIDADE_ESTADO` (`EST_INT_ID`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`END_INT_ID`),
  ADD KEY `FK_ENDERECO_CIDADE` (`CID_INT_ID`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`EST_INT_ID`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`USU_INT_ID`),
  ADD UNIQUE KEY `UK_USUARIO_CPF` (`USU_STR_CPF`),
  ADD UNIQUE KEY `UK_USUARIO_EMAIL` (`USU_STR_EMAIL`) USING BTREE,
  ADD KEY `FK_USUSARIO_ENDERECO` (`END_INT_ID`),
  ADD KEY `FK_USUSARIO_CARACTERISTICAS` (`CAR_INT_ID`);

--
-- Indexes for table `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  ADD KEY `FK_USUARIO_ADMINISTRADOR_USUARIO` (`USU_INT_ID`),
  ADD KEY `FK_USUARIO_ADMINISTRADOR_ADMINISTRADOR` (`ADM_INT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ADM_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `CAR_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `CID_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `END_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `EST_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `USU_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `FK_CIDADE_ESTADO` FOREIGN KEY (`EST_INT_ID`) REFERENCES `estado` (`EST_INT_ID`);

--
-- Constraints for table `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `FK_ENDERECO_CIDADE` FOREIGN KEY (`CID_INT_ID`) REFERENCES `cidade` (`CID_INT_ID`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_USUSARIO_CARACTERISTICAS` FOREIGN KEY (`CAR_INT_ID`) REFERENCES `caracteristicas` (`CAR_INT_ID`),
  ADD CONSTRAINT `FK_USUSARIO_ENDERECO` FOREIGN KEY (`END_INT_ID`) REFERENCES `endereco` (`END_INT_ID`);

--
-- Constraints for table `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  ADD CONSTRAINT `FK_USUARIO_ADMINISTRADOR_ADMINISTRADOR` FOREIGN KEY (`ADM_INT_ID`) REFERENCES `administrador` (`ADM_INT_ID`),
  ADD CONSTRAINT `FK_USUARIO_ADMINISTRADOR_USUARIO` FOREIGN KEY (`USU_INT_ID`) REFERENCES `usuario` (`USU_INT_ID`);
COMMIT;
=======


--
-- Database: `aap_fitpass`
CREATE DATABASE aap_fitpass;
USE aap_fitpass;
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CARACTERISTICAS_SELECTbyid` (IN `p_USU_INT_ID` INT)   BEGIN
    SELECT 
		U.USU_INT_ID,
		U.USU_STR_NOME,
        C.CAR_INT_ID,
        C.CAR_DOU_PESO,
		C.CAR_DOU_ALTURA,
		C.CAR_STR_GENERO,
		C.CAR_INT_IDADE 
	FROM usuario AS U INNER JOIN caracteristicas AS C ON C.CAR_INT_ID = U.CAR_INT_ID
    WHERE USU_INT_ID = p_USU_INT_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_DEL` (IN `p_USU_INT_ID` INT)   BEGIN 
    -- Excluir registros da tabela 'usuario'
    DELETE FROM usuario WHERE USU_INT_ID = p_USU_INT_ID;

    -- Excluir registros da tabela 'endereco'
    DELETE FROM endereco WHERE END_INT_ID = p_USU_INT_ID;

    -- Excluir registros da tabela 'cidade'
    DELETE FROM cidade WHERE CID_INT_ID = p_USU_INT_ID;

    -- Excluir registros da tabela 'estado'
    DELETE FROM estado WHERE EST_INT_ID = p_USU_INT_ID;

	-- Excluir registros da tabela 'caracteristicas'
    DELETE FROM caracteristicas WHERE CAR_INT_ID = p_USU_INT_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_INSERT` (IN `p_EST_STR_DESCRICAO` VARCHAR(255), IN `p_EST_STR_SIGLA` CHAR(2), IN `p_CID_STR_DESCRICAO` VARCHAR(255), IN `p_END_STR_RUA` VARCHAR(255), IN `p_END_STR_NUMERO` CHAR(4), IN `p_END_STR_BAIRRO` VARCHAR(255), IN `p_END_STR_COMPLEMENTO` VARCHAR(255), IN `p_END_STR_CEP` CHAR(9), IN `p_USU_INT_ID` INT, IN `p_USU_STR_NOME` VARCHAR(255), IN `p_USU_STR_SENHA` CHAR(70), IN `p_USU_STR_EMAIL` VARCHAR(70), IN `p_USU_STR_CPF` CHAR(14))   BEGIN
    DECLARE usuario_existente INT;

    -- Verificar se o email ou CPF já existem
    SELECT COUNT(*) INTO usuario_existente
    FROM usuario
    WHERE USU_STR_EMAIL = p_USU_STR_EMAIL OR USU_STR_CPF = p_USU_STR_CPF;

    -- Se já existir, retornar um código de erro
    IF usuario_existente > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Email ou CPF já cadastrado';
    ELSE
        -- Se não existir, proceder com as inserções
        INSERT INTO estado (EST_STR_DESCRICAO, EST_STR_SIGLA) VALUES (p_EST_STR_DESCRICAO, p_EST_STR_SIGLA);
               
        INSERT INTO cidade (CID_STR_DESCRICAO, EST_INT_ID)
        VALUES (p_CID_STR_DESCRICAO, p_USU_INT_ID);

        INSERT INTO endereco (END_STR_RUA, END_STR_NUMERO, END_STR_BAIRRO, END_STR_COMPLEMENTO, END_STR_CEP, CID_INT_ID)
        VALUES (p_END_STR_RUA, p_END_STR_NUMERO, p_END_STR_BAIRRO, p_END_STR_COMPLEMENTO, p_END_STR_CEP, p_USU_INT_ID);

        INSERT INTO usuario (USU_STR_NOME, USU_STR_SENHA, USU_STR_EMAIL, USU_STR_CPF, END_INT_ID, USU_INT_ID, CAR_INT_ID)
        VALUES (p_USU_STR_NOME, p_USU_STR_SENHA, p_USU_STR_EMAIL, p_USU_STR_CPF, p_USU_INT_ID, p_USU_INT_ID, p_USU_INT_ID);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_SELECTbyID` (IN `p_USU_INT_ID` INT)   BEGIN
    SELECT 
		U.USU_INT_ID,
		U.USU_STR_NOME,
        C.CAR_INT_ID,
        C.CAR_DOU_PESO,
		C.CAR_DOU_ALTURA,
		C.CAR_STR_GENERO,
		C.CAR_INT_IDADE 
	FROM usuario AS U INNER JOIN caracteristicas AS C ON C.CAR_INT_ID = U.CAR_INT_ID
    WHERE USU_INT_ID = p_USU_INT_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_UPDATE` (IN `p_EST_STR_DESCRICAO` VARCHAR(255), IN `p_EST_STR_SIGLA` CHAR(2), IN `p_CID_STR_DESCRICAO` VARCHAR(255), IN `p_END_STR_RUA` VARCHAR(255), IN `p_END_STR_NUMERO` CHAR(4), IN `p_END_STR_BAIRRO` VARCHAR(255), IN `p_END_STR_COMPLEMENTO` VARCHAR(255), IN `p_END_STR_CEP` CHAR(9), IN `p_USU_INT_ID` INT, IN `p_USU_STR_NOME` VARCHAR(255), IN `p_USU_STR_SENHA` CHAR(70), IN `p_USU_STR_EMAIL` VARCHAR(70))   BEGIN
    -- Verificar se o novo e-mail já existe em outro registro
    IF NOT EXISTS (SELECT 1 FROM usuario WHERE USU_STR_EMAIL = p_USU_STR_EMAIL) THEN
        UPDATE estado
        SET EST_STR_DESCRICAO = p_EST_STR_DESCRICAO,
            EST_STR_SIGLA = p_EST_STR_SIGLA
        WHERE EST_INT_ID = p_USU_INT_ID;

        UPDATE cidade
        SET CID_STR_DESCRICAO = p_CID_STR_DESCRICAO,
            EST_INT_ID = p_USU_INT_ID
        WHERE CID_INT_ID = p_USU_INT_ID;

        UPDATE endereco
        SET END_STR_RUA = p_END_STR_RUA,
            END_STR_NUMERO = p_END_STR_NUMERO,
            END_STR_BAIRRO = p_END_STR_BAIRRO,
            END_STR_COMPLEMENTO = p_END_STR_COMPLEMENTO,
            END_STR_CEP = p_END_STR_CEP,
            CID_INT_ID = p_USU_INT_ID
        WHERE END_INT_ID = p_USU_INT_ID;

        UPDATE usuario
        SET USU_STR_NOME = p_USU_STR_NOME,
            USU_STR_EMAIL = p_USU_STR_EMAIL,
            USU_STR_SENHA = p_USU_STR_SENHA,
            END_INT_ID = p_USU_INT_ID,
            CAR_INT_ID = p_USU_INT_ID
        WHERE USU_INT_ID = p_USU_INT_ID;
    ELSE
   SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Email ou CPF já cadastrado';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE `administrador` (
  `ADM_INT_ID` int(11) NOT NULL,
  `ADM_STR_NOME` varchar(70) NOT NULL,
  `ADM_STR_SENHA` varchar(50) NOT NULL,
  `ADM_STR_EMAIL` varchar(70) NOT NULL,
  `ADM_STR_CPF` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`ADM_INT_ID`, `ADM_STR_NOME`, `ADM_STR_SENHA`, `ADM_STR_EMAIL`, `ADM_STR_CPF`) VALUES
(1, 'Admin', 'admin', 'admin@admin.com', '123.456.789');

-- --------------------------------------------------------

--
-- Table structure for table `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `CAR_INT_ID` int(11) NOT NULL,
  `CAR_DOU_PESO` float NOT NULL,
  `CAR_DOU_ALTURA` float NOT NULL,
  `CAR_INT_IDADE` int(11) NOT NULL,
  `CAR_STR_GENERO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `caracteristicas`
--

INSERT INTO `caracteristicas` (`CAR_INT_ID`, `CAR_DOU_PESO`, `CAR_DOU_ALTURA`, `CAR_INT_IDADE`, `CAR_STR_GENERO`) VALUES
(1, 75, 183, 25, 'Masculino');

-- --------------------------------------------------------

--
-- Table structure for table `cidade`
--

CREATE TABLE `cidade` (
  `CID_INT_ID` int(11) NOT NULL,
  `EST_INT_ID` int(11) NOT NULL,
  `CID_STR_DESCRICAO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cidade`
--

INSERT INTO `cidade` (`CID_INT_ID`, `EST_INT_ID`, `CID_STR_DESCRICAO`) VALUES
(1, 1, 'Cidade Teste');

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE `endereco` (
  `END_INT_ID` int(11) NOT NULL,
  `CID_INT_ID` int(11) NOT NULL,
  `END_STR_CEP` varchar(9) NOT NULL,
  `END_STR_RUA` varchar(70) NOT NULL,
  `END_STR_NUMERO` varchar(4) NOT NULL,
  `END_STR_BAIRRO` varchar(50) NOT NULL,
  `END_STR_COMPLEMENTO` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`END_INT_ID`, `CID_INT_ID`, `END_STR_CEP`, `END_STR_RUA`, `END_STR_NUMERO`, `END_STR_BAIRRO`, `END_STR_COMPLEMENTO`) VALUES
(1, 1, '12312-312', 'Rua Teste', '123', 'Bairro Teste', 'apto.Teste');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `EST_INT_ID` int(11) NOT NULL,
  `EST_STR_DESCRICAO` varchar(50) NOT NULL,
  `EST_STR_SIGLA` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`EST_INT_ID`, `EST_STR_DESCRICAO`, `EST_STR_SIGLA`) VALUES
(1, 'São Paulo', 'SP');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `USU_INT_ID` int(11) NOT NULL,
  `END_INT_ID` int(11) NOT NULL,
  `CAR_INT_ID` int(11) NOT NULL,
  `USU_STR_NOME` varchar(70) NOT NULL,
  `USU_STR_EMAIL` varchar(70) NOT NULL,
  `USU_STR_SENHA` varchar(50) NOT NULL,
  `USU_STR_CPF` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`USU_INT_ID`, `END_INT_ID`, `CAR_INT_ID`, `USU_STR_NOME`, `USU_STR_EMAIL`, `USU_STR_SENHA`, `USU_STR_CPF`) VALUES
(1, 1, 1, 'Teste 123', 'teste@email.com', '12341234', '123.123.123-12');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_administrador`
--

CREATE TABLE `usuario_administrador` (
  `USU_INT_ID` int(11) NOT NULL,
  `ADM_INT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ADM_INT_ID`),
  ADD UNIQUE KEY `UK_ADMINISTRADOR_CPF` (`ADM_STR_CPF`);

--
-- Indexes for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`CAR_INT_ID`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`CID_INT_ID`),
  ADD KEY `FK_CIDADE_ESTADO` (`EST_INT_ID`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`END_INT_ID`),
  ADD KEY `FK_ENDERECO_CIDADE` (`CID_INT_ID`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`EST_INT_ID`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`USU_INT_ID`),
  ADD UNIQUE KEY `UK_USUARIO_CPF` (`USU_STR_CPF`),
  ADD UNIQUE KEY `UK_USUARIO_EMAIL` (`USU_STR_EMAIL`) USING BTREE,
  ADD KEY `FK_USUSARIO_ENDERECO` (`END_INT_ID`),
  ADD KEY `FK_USUSARIO_CARACTERISTICAS` (`CAR_INT_ID`);

--
-- Indexes for table `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  ADD KEY `FK_USUARIO_ADMINISTRADOR_USUARIO` (`USU_INT_ID`),
  ADD KEY `FK_USUARIO_ADMINISTRADOR_ADMINISTRADOR` (`ADM_INT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ADM_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `CAR_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `CID_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `END_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `EST_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `USU_INT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `FK_CIDADE_ESTADO` FOREIGN KEY (`EST_INT_ID`) REFERENCES `estado` (`EST_INT_ID`);

--
-- Constraints for table `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `FK_ENDERECO_CIDADE` FOREIGN KEY (`CID_INT_ID`) REFERENCES `cidade` (`CID_INT_ID`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_USUSARIO_CARACTERISTICAS` FOREIGN KEY (`CAR_INT_ID`) REFERENCES `caracteristicas` (`CAR_INT_ID`),
  ADD CONSTRAINT `FK_USUSARIO_ENDERECO` FOREIGN KEY (`END_INT_ID`) REFERENCES `endereco` (`END_INT_ID`);

--
-- Constraints for table `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  ADD CONSTRAINT `FK_USUARIO_ADMINISTRADOR_ADMINISTRADOR` FOREIGN KEY (`ADM_INT_ID`) REFERENCES `administrador` (`ADM_INT_ID`),
  ADD CONSTRAINT `FK_USUARIO_ADMINISTRADOR_USUARIO` FOREIGN KEY (`USU_INT_ID`) REFERENCES `usuario` (`USU_INT_ID`);
COMMIT;

>>>>>>> 6b1f07f (Update README and aap_fitpass.sql)
