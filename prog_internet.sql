-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 21/08/2026 às 23:50
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `prog_internet`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Categorias`
--

CREATE TABLE `Categorias` (
  `idCategorias` int NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `Categorias`
--

INSERT INTO `Categorias` (`idCategorias`, `categoria`) VALUES
(1, 'Carros F1'),
(2, 'Acessórios'),
(3, 'Roupas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Produtos`
--

CREATE TABLE `Produtos` (
  `idProdutos` int NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text,
  `preco` decimal(10,2) NOT NULL,
  `disponibilidade` enum('Disponível','Indisponível') NOT NULL,
  `idCategoria` int NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `Produtos`
--

INSERT INTO `Produtos` (`idProdutos`, `nome`, `descricao`, `preco`, `disponibilidade`, `idCategoria`, `imagem`) VALUES
(2, 'Camiseta Mercedes - AMG Petronas F1 Team DNA', 'Camiseta oficial da equipe Mercedes-AMG Petronas de Fórmula 1, desenvolvida pela adidas. Possui design na cor preta, gola redonda e detalhes inspirados na equipe, com o logotipo Mercedes-AMG Petronas e as Três Listras da adidas. Confeccionada em 100% algodão, com estrutura de malha simples.', 199.00, 'Indisponível', 3, 'Camisa Mercedes.jpg'),
(3, 'Anel F1 ', 'Anel inspirado no automobilismo e na Fórmula 1, com design de carro de corrida em metal prateado. Acessório para fãs de automobilismo e colecionadores.', 150.00, 'Disponível', 2, 'Anel F1.jpeg'),
(4, 'Mercedes AMG Petronas F1 W15', 'Modelo em miniatura do carro Mercedes-AMG Petronas F1 W15, inspirado no monoposto utilizado pela equipe Mercedes na temporada de Fórmula 1 de 2024.', 750.00, 'Disponível', 1, 'Carro Mercedes.jpeg'),
(5, 'Red Bull Racing F1 RB16B', 'Modelo de carro de Fórmula 1 da equipe Red Bull Racing, com pintura característica da equipe e motor Honda. Inspirado no monoposto utilizado pela equipe na temporada de 2021.', 28000.00, 'Indisponível', 1, 'Carro Red Bull.jpeg'),
(7, 'Capacete Audi F1 Gabriel Bortoleto', 'Capacete inspirado no design utilizado por Gabriel Bortoleto, com cores verde, amarelo e branco, além de detalhes de patrocinadores e referências ao Brasil. Produto colecionável para fãs de Fórmula 1 e automobilismo.', 2200.00, 'Disponível', 2, 'capacete gabriela.jpeg'),
(8, 'Moletom Red Bull Racing F1', 'Moletom oficial inspirado na equipe Red Bull Racing de Fórmula 1. Possui design esportivo na cor azul, logos da equipe e detalhes inspirados no automobilismo. Ideal para fãs da Fórmula 1 e colecionadores.', 350.00, 'Indisponível', 3, 'Moletom Canguru Max Verstappen Red Bull 2025 Azul Marinho.jpeg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuario`
--

CREATE TABLE `Usuario` (
  `idUsuario` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `email`, `senha`) VALUES
(1, 'jasminibecker2@gmail.com', '1234');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`idCategorias`);

--
-- Índices de tabela `Produtos`
--
ALTER TABLE `Produtos`
  ADD PRIMARY KEY (`idProdutos`),
  ADD KEY `fk_categoria` (`idCategoria`);

--
-- Índices de tabela `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `idCategorias` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `Produtos`
--
ALTER TABLE `Produtos`
  MODIFY `idProdutos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Produtos`
--
ALTER TABLE `Produtos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `Categorias` (`idCategorias`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
