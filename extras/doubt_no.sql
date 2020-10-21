-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Out-2020 às 04:07
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `doubt_no`
--
CREATE DATABASE IF NOT EXISTS `doubt_no` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `doubt_no`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comment`
--

CREATE TABLE `comment` (
  `id` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `commentDad` varchar(255) DEFAULT NULL,
  `date_comment` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `comment`
--

INSERT INTO `comment` (`id`, `content`, `user`, `post`, `commentDad`, `date_comment`) VALUES
('5f682dda7c969', 'é uma pergunta muito subjetiva, uma resposta definitiva não é possível dar. Mas sei que o corpo docente da faculdade onde estudo é um dos melhores!', '5f682d89801ce', '5f682ccf6606e', NULL, '2020-09-21 04:36:42'),
('5f682df99318f', 'Acredito que o BRILHADOR pode te ajudar', '5f682d89801ce', '5f682cb964dc7', NULL, '2020-09-21 04:37:13'),
('5f682e03a84f2', 'S2', '5f682d89801ce', '5f682cb964dc7', '5f682df99318f', '2020-09-21 04:37:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `id` varchar(255) NOT NULL,
  `doubt` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `date_post` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`id`, `doubt`, `user`, `date_post`) VALUES
('5f682cb964dc7', 'Alguém pode me ajudar em PHP?', '5f682ca585d74', '2020-09-21 04:31:53'),
('5f682ccf6606e', 'Qual é o melhor professor da Faculdade?', '5f682ca585d74', '2020-09-21 04:32:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `avatar`) VALUES
('5f682ca585d74', 'Matheus', 'mathues@a.com', '$2y$08$3O3QUg4P8T51eUu.WkJNaeynmj4Ii9gByvoCLGf.FtMbHMGP.PPoC', NULL),
('5f682d89801ce', 'Jon Doe', 'jon@doe.com', '$2y$08$mK5hXyKYeqyL9aJkfsiW.eKh6BK/rOj7xNodNsgypD3n.DeUl/xjC', NULL),
('5f8f7dc2e9125', 'Jece B', 'jece@b.com', '$2y$08$5YJJN1QwimkaHCgpll/UcOC1LamvkJGq.Pqpi29.YVCxKburf6xhO', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doubt` (`post`),
  ADD KEY `ownerComment` (`user`),
  ADD KEY `commentDad` (`commentDad`);

--
-- Índices para tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`user`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`commentDad`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doubt` FOREIGN KEY (`post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ownerComment` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `owner` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
