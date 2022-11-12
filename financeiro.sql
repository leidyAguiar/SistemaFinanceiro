-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 02:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `financeiro`
--

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--
CREATE DATABASE financeiro;

USE financeiro;

CREATE TABLE `endereco` (
  `end_id` int(11) NOT NULL,
  `uso_id` int(11) NOT NULL,
  `end_num` int(11) NOT NULL,
  `end_bairro` varchar(50) NOT NULL,
  `end_logradouro` varchar(50) NOT NULL,
  `end_cep` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_transacao`
--

CREATE TABLE `tipo_transacao` (
  `tipo_id` int(11) NOT NULL,
  `tipo_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transacao`
--

CREATE TABLE `transacao` (
  `tran_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `uso_id` int(11) NOT NULL,
  `tran_data` datetime NOT NULL,
  `tran_valor` double NOT NULL,
  `tran_descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `uso_id` int(50) NOT NULL,
  `uso_nome` varchar(50) NOT NULL,
  `uso_email` varchar(50) NOT NULL,
  `uso_senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`end_id`),
  ADD KEY `uso_id` (`uso_id`);

--
-- Indexes for table `tipo_transacao`
--
ALTER TABLE `tipo_transacao`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indexes for table `transacao`
--
ALTER TABLE `transacao`
  ADD PRIMARY KEY (`tran_id`),
  ADD KEY `tipo_id` (`tipo_id`),
  ADD KEY `transacao_ibfk_1` (`uso_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`uso_id`),
  ADD UNIQUE KEY `uso_nome` (`uso_nome`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `end_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_transacao`
--
ALTER TABLE `tipo_transacao`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transacao`
--
ALTER TABLE `transacao`
  MODIFY `tran_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `uso_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`uso_id`) REFERENCES `usuario` (`uso_id`);

--
-- Constraints for table `transacao`
--
ALTER TABLE `transacao`
  ADD CONSTRAINT `transacao_ibfk_1` FOREIGN KEY (`uso_id`) REFERENCES `usuario` (`uso_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
