-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2025 às 15:09
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u750204740_gestaoestagio`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `curso` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome`, `matricula`, `contato`, `curso`, `email`, `endereco`, `senha`) VALUES
(9, 'Felipe Gomes', 3036826, '85982363240', 'Informática', 'fgmss0907@gmail.com', 'Rua, Capitão José Marques - Itapebussu-Ce', '12345678'),
(11, 'ramon', 11111111, '12345678910', 'informatica', 'tiomotel@hotmart.com', 'ATRAS DO HOSPITAL', '1234');

-- --------------------------------------------------------

--
-- Estrutura para tabela `concedentes`
--

CREATE TABLE `concedentes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `perfil` varchar(100) DEFAULT NULL,
  `numero_vagas` int(11) DEFAULT NULL,
  `perfis` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`perfis`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `concedentes`
--

INSERT INTO `concedentes` (`id`, `nome`, `contato`, `endereco`, `perfil`, `numero_vagas`, `perfis`) VALUES
(15, 'Mix Mateus', '40028922', 'seila ', NULL, 4, '[\"desenvolvimento\"]'),
(16, 'itau ', '23456234', 'ATRAS DO HOSPITAL', NULL, 4, '[\"desenvolvimento\",\"suporte\"]');

-- --------------------------------------------------------

--
-- Estrutura para tabela `selecao`
--

CREATE TABLE `selecao` (
  `id` int(11) NOT NULL,
  `hora` datetime DEFAULT NULL,
  `local` varchar(100) DEFAULT NULL,
  `id_concedente` int(11) DEFAULT NULL,
  `data_inscriçao` date DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `perfis_selecionados` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`perfis_selecionados`)),
  `id_vaga` int(11) DEFAULT NULL,
  `status` enum('pendente','alocado') DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `selecao`
--

INSERT INTO `selecao` (`id`, `hora`, `local`, `id_concedente`, `data_inscriçao`, `id_aluno`, `perfis_selecionados`, `id_vaga`, `status`) VALUES
(8, '2025-06-12 14:00:00', 'ATRAS DO HOSPITAL', 16, NULL, 11, '[\"suporte\"]', NULL, 'alocado'),
(9, '2025-06-12 14:00:00', 'ATRAS DO HOSPITAL', 16, NULL, NULL, '[\"desenvolvimento\"]', NULL, 'alocado'),
(10, '2025-06-12 14:00:00', 'ATRAS DO HOSPITAL', 16, NULL, 9, '[\"desenvolvimento\"]', NULL, 'alocado'),
(11, '2025-06-18 14:00:00', 'seila', 15, NULL, NULL, NULL, NULL, 'pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `tipo_usuario` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `tipo_usuario`, `email`, `senha`) VALUES
(1, 'professor', 'prof@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vaga`
--

CREATE TABLE `vaga` (
  `id` int(11) NOT NULL,
  `numero_vagas` int(11) DEFAULT NULL,
  `id_concedente` int(11) DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `concedentes`
--
ALTER TABLE `concedentes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `selecao`
--
ALTER TABLE `selecao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_concedente` (`id_concedente`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_concedente` (`id_concedente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `concedentes`
--
ALTER TABLE `concedentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `selecao`
--
ALTER TABLE `selecao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vaga`
--
ALTER TABLE `vaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `selecao`
--
ALTER TABLE `selecao`
  ADD CONSTRAINT `selecao_ibfk_1` FOREIGN KEY (`id_concedente`) REFERENCES `concedentes` (`id`);

--
-- Restrições para tabelas `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `vaga_ibfk_1` FOREIGN KEY (`id_concedente`) REFERENCES `concedentes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
