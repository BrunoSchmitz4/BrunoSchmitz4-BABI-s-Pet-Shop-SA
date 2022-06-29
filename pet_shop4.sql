-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jun-2022 às 21:56
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pet_shop4`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ceps`
--

CREATE TABLE `ceps` (
  `id` int(11) NOT NULL,
  `cep` varchar(11) NOT NULL,
  `logradouro` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ceps`
--

INSERT INTO `ceps` (`id`, `cep`, `logradouro`, `created`, `modified`) VALUES
(1, '88010-300', 'Rua Tenente Silveira', '2022-04-20 15:46:21', '2022-06-22 16:27:42'),
(2, '89010-150', 'Praça Victor Konder', '2022-04-20 15:46:21', '2022-06-22 16:27:42'),
(3, '88010-000', 'Rua Felipe Shmidt', '2022-04-18 14:09:41', '2022-06-22 16:27:42'),
(4, '89010-016', 'Alameda Rio Branco', '2022-04-18 14:09:41', '2022-06-22 16:27:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modifield` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`id`, `nome`, `created`, `modifield`) VALUES
(1, 'Blumenau', '2022-04-18 16:46:30', NULL),
(2, 'Florianópolis ', '2022-04-18 16:46:30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `especies`
--

CREATE TABLE `especies` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `especies`
--

INSERT INTO `especies` (`id`, `nome`, `created`, `modified`) VALUES
(1, 'Cão', '2022-05-06 14:57:28', '2022-05-06 19:57:28'),
(2, 'Gato', '2022-05-06 14:57:28', '2022-05-06 19:57:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis_acessos`
--

CREATE TABLE `niveis_acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `niveis_acessos`
--

INSERT INTO `niveis_acessos` (`id`, `nome`, `created`, `modified`) VALUES
(1, 'Cliente', '2022-04-18 14:06:36', NULL),
(2, 'Colaborador', '2022-04-18 14:05:46', NULL),
(3, 'Administrador', '2022-04-18 14:05:46', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `especie_id` int(11) NOT NULL,
  `porte_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pets`
--

INSERT INTO `pets` (`id`, `nome`, `especie_id`, `porte_id`, `created`, `modified`) VALUES
(1, 'Bean', 1, 1, '2022-05-06 14:59:05', NULL),
(2, 'Bobby', 1, 2, '2022-05-06 14:59:58', NULL),
(3, 'Bolt', 1, 2, '2022-05-06 14:59:58', NULL),
(4, 'Mel', 1, 1, '2022-05-06 14:59:58', NULL),
(5, 'Steve', 2, 2, '2022-05-06 15:02:13', NULL),
(6, 'Luck', 1, 3, '2022-05-06 15:02:26', NULL),
(7, 'Marley', 1, 3, '2022-06-24 16:09:51', NULL),
(8, 'Twice', 2, 2, '2022-06-24 16:11:00', NULL),
(9, 'Marley', 1, 3, '2022-06-25 15:28:28', NULL),
(10, 'Bean', 1, 1, '2022-06-26 11:14:46', NULL),
(12, 'Bean', 1, 1, '2022-06-26 11:22:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `portes`
--

CREATE TABLE `portes` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `portes`
--

INSERT INTO `portes` (`id`, `nome`, `created`, `modified`) VALUES
(1, 'Pequeno', '2022-05-06 14:40:14', '2022-05-06 19:40:14'),
(2, 'Médio', '2022-05-06 19:40:14', '2022-05-06 19:40:14'),
(3, 'Grande', '2022-05-06 19:40:14', '2022-05-06 19:40:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `precos`
--

CREATE TABLE `precos` (
  `id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `portes_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `precos`
--

INSERT INTO `precos` (`id`, `valor`, `portes_id`, `created`, `modified`) VALUES
(1, 40, 1, '2022-05-06 14:42:24', '2022-05-06 19:42:24'),
(2, 80, 2, '2022-05-06 14:44:54', '2022-05-06 19:42:24'),
(3, 100, 3, '2022-05-06 14:44:54', '2022-05-06 19:42:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `tipo_servico` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `tipo_servico`, `descricao`, `imagem`, `created`, `modified`) VALUES
(1, 'Banho', 'Nós nos encarregaremos de dar o banho necessário e adequado para seu pet, utilizando produtos como shampoos e condicionadores dedicados à espécie.', 'img_banho.png', '2022-05-23 19:06:42', NULL),
(2, 'Tosa', 'Faremos uma tosa, dado o pelo do pet, trazendo conforto e uma higienização adequada para seu pet.', 'img_tosa.jpg', '2022-05-23 19:07:14', NULL),
(3, 'Cuidados Especiais', 'Iremos nos certificar que todo e qualquer cuidado especial necessário seja devidamente atendido sem retirar o conforto do pet no meio do processo.', 'img_cuidadosespeciais.png', '2022-05-23 19:07:39', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos_prestados`
--

CREATE TABLE `servicos_prestados` (
  `id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `preco_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao_tosadores`
--

CREATE TABLE `situacao_tosadores` (
  `id` int(11) NOT NULL,
  `disponibilidade` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `situacao_tosadores`
--

INSERT INTO `situacao_tosadores` (`id`, `disponibilidade`, `created`, `modified`) VALUES
(1, 'Livre', '2022-05-05 16:31:58', '2022-05-05 21:31:57'),
(2, 'Ocupado', '2022-05-05 21:31:57', '2022-05-05 21:31:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tosadores`
--

CREATE TABLE `tosadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `situacao_tosador_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tosadores`
--

INSERT INTO `tosadores` (`id`, `nome`, `situacao_tosador_id`, `created`, `modified`) VALUES
(1, 'Arthur Augusto Dias Alves de Lima', 1, '2022-05-06 14:36:22', '2022-05-06 19:36:22'),
(2, 'Bruno Schmitz da Silva', 2, '2022-05-06 14:37:19', '2022-05-06 19:37:19'),
(3, 'Iasmin Westphal de Amorim', 1, '2022-05-06 14:37:31', '2022-05-06 19:37:31'),
(4, 'Beatriz Riscarolli Gamba', 2, '2022-05-06 14:37:49', '2022-05-06 19:37:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(145) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `recuperar_senha` varchar(250) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `complemento` varchar(45) NOT NULL,
  `nivel_acesso_id` int(11) NOT NULL,
  `cep_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `recuperar_senha`, `telefone`, `complemento`, `nivel_acesso_id`, `cep_id`, `created`, `modified`) VALUES
(1, 'Maria Fernanda', 'mariaf@gmail.com', '123', NULL, '(47) 98381-5679', 'Casa', 2, 2, '2022-04-20 15:07:07', '2022-06-22 18:48:41'),
(2, 'Lucas Teixeira', 'lucas2@gmail.com', '123', NULL, '(47) 99722-2544', 'Apto 68', 3, 3, '2022-05-18 16:13:50', '2022-06-22 18:48:41'),
(3, 'Bernado Souza', 'bernado@hotmail.com', '123', NULL, '(47) 99231-8569', 'Apto 25', 2, 2, '2022-05-20 15:25:35', '2022-06-22 18:48:41'),
(4, 'Larissa Tavares', 'lari_tavares@gmail.com', '123', NULL, '(48) 98865-1024', 'Casa', 3, 4, '2022-05-24 15:19:41', '2022-06-22 18:48:41'),
(5, 'Igor Pereira da Silva\r\n', 'igorSilva@gmail.com', '123', NULL, '(47) 99124-4169', 'Apto 17', 1, 4, '2022-05-27 14:34:04', '2022-06-22 18:48:41'),
(6, 'Bianca Rocha', 'bia.rocha@hotmail.com', '123', NULL, '(48) 98635-2406', 'Casa', 1, 4, '2022-06-20 17:03:05', '2022-06-22 18:48:41'),
(31, 'Bruno', 'bruno@gmail.com', '$2y$10$QbBli.4WGRVzAvgcQlIUqergs7T0FtKh7BGEvIAAdLn.2OSFeIcMG', 'NULL', '12345678', 'Apto bnuaguaverde', 1, 3, '2022-06-27 14:37:45', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ceps`
--
ALTER TABLE `ceps`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `niveis_acessos`
--
ALTER TABLE `niveis_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pets_portes1_idx` (`porte_id`),
  ADD KEY `fk_pets_racas1_idx` (`especie_id`);

--
-- Índices para tabela `portes`
--
ALTER TABLE `portes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `precos`
--
ALTER TABLE `precos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_precos_portes1_idx` (`portes_id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servicos_prestados`
--
ALTER TABLE `servicos_prestados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicos_prestados_usuarios1_idx` (`usuario_id`),
  ADD KEY `fk_servicos_prestados_pets1_idx` (`pet_id`),
  ADD KEY `fk_servicos_prestados_precos1_idx` (`preco_id`),
  ADD KEY `servico_id` (`servico_id`);

--
-- Índices para tabela `situacao_tosadores`
--
ALTER TABLE `situacao_tosadores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tosadores`
--
ALTER TABLE `tosadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tanques_status_tanques1_idx` (`situacao_tosador_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_ceps_idx` (`cep_id`),
  ADD KEY `fk_usuarios_niveis_acessos1_idx` (`nivel_acesso_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ceps`
--
ALTER TABLE `ceps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `especies`
--
ALTER TABLE `especies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `niveis_acessos`
--
ALTER TABLE `niveis_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `portes`
--
ALTER TABLE `portes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `precos`
--
ALTER TABLE `precos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `servicos_prestados`
--
ALTER TABLE `servicos_prestados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `situacao_tosadores`
--
ALTER TABLE `situacao_tosadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tosadores`
--
ALTER TABLE `tosadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `fk_pets_portes1` FOREIGN KEY (`porte_id`) REFERENCES `portes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pets_racas1` FOREIGN KEY (`especie_id`) REFERENCES `especies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `precos`
--
ALTER TABLE `precos`
  ADD CONSTRAINT `fk_precos_portes1` FOREIGN KEY (`portes_id`) REFERENCES `portes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servicos_prestados`
--
ALTER TABLE `servicos_prestados`
  ADD CONSTRAINT `fk_servicos_prestados_pets1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicos_prestados_precos1` FOREIGN KEY (`preco_id`) REFERENCES `precos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicos_prestados_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicos_prestados_ibfk_1` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`);

--
-- Limitadores para a tabela `tosadores`
--
ALTER TABLE `tosadores`
  ADD CONSTRAINT `fk_tanques_status_tanques1` FOREIGN KEY (`situacao_tosador_id`) REFERENCES `situacao_tosadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_ceps` FOREIGN KEY (`cep_id`) REFERENCES `ceps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_niveis_acessos1` FOREIGN KEY (`nivel_acesso_id`) REFERENCES `niveis_acessos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
