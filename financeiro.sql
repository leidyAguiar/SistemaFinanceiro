-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Nov-2022 às 01:24
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--
CREATE DATABASE financeiro;

USE financeiro;

--
-- Estrutura da tabela `contatos`
--

CREATE TABLE `contatos` (
  `con_id` int(11) NOT NULL,
  `uso_id` int(11) NOT NULL,
  `con_msg` varchar(255) NOT NULL,
  `con_titulo` varchar(50) NOT NULL,
  `con_lida` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contatos`
--

INSERT INTO `contatos` (`con_id`, `uso_id`, `con_msg`, `con_titulo`, `con_lida`) VALUES
(7, 3, 'Olá, Boa noite, testando mensagem.', 'Dúvidas', 1),
(8, 3, 'Tive Dúvidas nas despesas! Me ajuda!!!!', 'Despesas', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `end_id` int(11) NOT NULL,
  `uso_id` int(11) NOT NULL,
  `end_num` int(11) NOT NULL,
  `end_bairro` varchar(50) NOT NULL,
  `end_logradouro` varchar(50) NOT NULL,
  `end_cep` varchar(9) NOT NULL,
  `end_cidade` varchar(50) NOT NULL,
  `end_uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`end_id`, `uso_id`, `end_num`, `end_bairro`, `end_logradouro`, `end_cep`, `end_cidade`, `end_uf`) VALUES
(1, 1, 75, 'Vila Paulo Roberto', 'Rua Teresina', '19046-230', 'Presidente Prudente', 'sp'),
(3, 3, 102, 'São Francisco', 'Rua dos Baianos', '19160-000', 'ÁLVARES MACHADO', 'sp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_transacao`
--

CREATE TABLE `tipo_transacao` (
  `tipo_id` int(11) NOT NULL,
  `tipo_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_transacao`
--

INSERT INTO `tipo_transacao` (`tipo_id`, `tipo_nome`) VALUES
(1, 'despesa'),
(2, 'receita');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `tus_id` int(11) NOT NULL,
  `tus_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`tus_id`, `tus_nome`) VALUES
(1, 'admin'),
(2, 'comum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacao`
--

CREATE TABLE `transacao` (
  `tran_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `uso_id` int(11) NOT NULL,
  `tran_data` datetime NOT NULL,
  `tran_valor` double NOT NULL,
  `tran_descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transacao`
--

INSERT INTO `transacao` (`tran_id`, `tipo_id`, `uso_id`, `tran_data`, `tran_valor`, `tran_descricao`) VALUES
(1, 2, 1, '2022-11-25 00:00:00', 1000, 'Estágio'),
(2, 2, 1, '2022-12-01 00:00:00', 1000, 'Salário'),
(3, 1, 1, '2022-11-25 00:00:00', 100, 'Amazon Prime'),
(4, 1, 1, '2022-12-01 00:00:00', 20, 'Uber'),
(5, 1, 1, '2022-12-03 00:00:00', 80, 'mercantil'),
(6, 1, 1, '2022-12-02 00:00:00', 100, 'aaa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `uso_id` int(50) NOT NULL,
  `uso_nome` varchar(50) NOT NULL,
  `uso_email` varchar(50) NOT NULL,
  `uso_senha` varchar(255) NOT NULL,
  `tus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`uso_id`, `uso_nome`, `uso_email`, `uso_senha`, `tus_id`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$EEgGRPcfKYZPGTtxpVo6VeIXfdT.iiByVvq39xTi.TO.//XNTlqcu', 1),
(3, 'usuario', 'usuario@gmail.com', '$2y$10$5DK0L3hZoXbEvYpcOxwsDOPMVoF4W7YjS13wixvzAYzk96WPm9sW.', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `uso_id` (`uso_id`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`end_id`),
  ADD KEY `uso_id` (`uso_id`);

--
-- Índices para tabela `tipo_transacao`
--
ALTER TABLE `tipo_transacao`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Índices para tabela `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`tus_id`);

--
-- Índices para tabela `transacao`
--
ALTER TABLE `transacao`
  ADD PRIMARY KEY (`tran_id`),
  ADD KEY `tipo_id` (`tipo_id`),
  ADD KEY `transacao_ibfk_1` (`uso_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`uso_id`),
  ADD UNIQUE KEY `uso_nome` (`uso_nome`),
  ADD KEY `tus_id` (`tus_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `end_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo_transacao`
--
ALTER TABLE `tipo_transacao`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `tus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `transacao`
--
ALTER TABLE `transacao`
  MODIFY `tran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `uso_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `contatos`
--
ALTER TABLE `contatos`
  ADD CONSTRAINT `contatos_ibfk_1` FOREIGN KEY (`uso_id`) REFERENCES `usuario` (`uso_id`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`uso_id`) REFERENCES `usuario` (`uso_id`);

--
-- Limitadores para a tabela `transacao`
--
ALTER TABLE `transacao`
  ADD CONSTRAINT `transacao_ibfk_1` FOREIGN KEY (`uso_id`) REFERENCES `usuario` (`uso_id`),
  ADD CONSTRAINT `transacao_ibfk_2` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_transacao` (`tipo_id`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tus_id`) REFERENCES `tipo_usuario` (`tus_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;