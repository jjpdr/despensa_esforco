-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Dez-2020 às 18:12
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `despensa_esforco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra_automatica`
--

CREATE TABLE `compra_automatica` (
  `id` int(11) NOT NULL,
  `nome_supermercado` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `prioridade` varchar(255) NOT NULL,
  `valor_maximo` int(10) NOT NULL,
  `metodo_pagamento` varchar(255) NOT NULL,
  `endereco_entrega` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco_entrega`
--

CREATE TABLE `endereco_entrega` (
  `id` int(11) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `nro_casa` varchar(10) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `horario_preferencial` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `metodo_pagamento`
--

CREATE TABLE `metodo_pagamento` (
  `id` int(10) NOT NULL,
  `nome_titular` varchar(255) NOT NULL,
  `numero_cartao` varchar(255) NOT NULL,
  `data_validade_cartao` date NOT NULL,
  `codigo_seguranca` int(3) NOT NULL,
  `cpf_titular` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `metodo_pagamento`
--

INSERT INTO `metodo_pagamento` (`id`, `nome_titular`, `numero_cartao`, `data_validade_cartao`, `codigo_seguranca`, `cpf_titular`) VALUES
(1, 'teste nome cartao selenium', '1111-2222-3333-4444', '2025-03-12', 999, '111.222.333-44'),
(2, 'teste nome cartao selenium', '1111-2222-3333-4444', '2028-03-15', 999, '111.222.333-44'),
(3, 'teste nome cartao selenium', '1111-2222-3333-4444', '2028-03-15', 999, '111.222.333-44'),
(4, 'teste nome cartao selenium', '1111-2222-3333-4444', '2028-03-15', 999, '111.222.333-44'),
(5, 'teste nome cartao selenium', '1111-2222-3333-4444', '2028-03-15', 999, '111.222.333-44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(10) NOT NULL,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `data_validade` date NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `prioridade` varchar(255) NOT NULL,
  `qtd_minima` int(10) NOT NULL,
  `qtd_maxima` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `data_validade`, `categoria`, `prioridade`, `qtd_minima`, `qtd_maxima`) VALUES
(8, 'teste produto selenium', '2021-03-10', 'teste categoria', 'teste prioridade', 1, 100),
(9, 'teste produto selenium', '2021-05-05', 'teste categoria', 'teste prioridade', 1, 100),
(10, 'teste produto selenium', '2021-05-05', 'teste categoria', 'teste prioridade', 1, 100),
(11, 'teste produto selenium', '2021-06-09', 'teste categoria', 'teste prioridade', 1, 100),
(12, 'teste produto selenium', '2021-06-09', 'teste categoria', 'teste prioridade', 1, 100),
(13, 'teste produto selenium', '2021-06-09', 'teste categoria', 'teste prioridade', 1, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `supermercado_favorito`
--

CREATE TABLE `supermercado_favorito` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `data_ultima_compra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `compra_automatica`
--
ALTER TABLE `compra_automatica`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `endereco_entrega`
--
ALTER TABLE `endereco_entrega`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `supermercado_favorito`
--
ALTER TABLE `supermercado_favorito`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `compra_automatica`
--
ALTER TABLE `compra_automatica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `endereco_entrega`
--
ALTER TABLE `endereco_entrega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `supermercado_favorito`
--
ALTER TABLE `supermercado_favorito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
