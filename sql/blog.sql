-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/11/2024 às 00:31
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
-- Banco de dados: `blog`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `ultima_acao` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `usuario_id`, `token`) VALUES
(348, 0, '2024-11-05 23:10:51', 1, '672a9af153c02');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.usuarios`
--

CREATE TABLE `tb_admin.usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cargo` int(1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `logado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `nome`, `senha`, `cargo`, `img`, `logado`, `status`) VALUES
(1, 'Aldomar', 'Aldomar Assolin', '1234565', 2, 'uploads/671850b784eb1.png', 1, NULL),
(2, 'CSCarlos', 'Carlos Siqueira da Silva', '123Teste', 1, 'uploads/671850aa40d86.png', 0, NULL),
(3, 'davipereira', 'Davi Pereira', '123Teste', 1, 'uploads/671850a130f72.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `dia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`) VALUES
(1, 0, '2024-10-22 01:31:58'),
(2, 0, '2024-10-22 01:32:52'),
(3, 0, '2024-10-22 01:34:14'),
(4, 0, '2024-10-22 01:34:15'),
(5, 0, '2024-10-22 01:34:19'),
(6, 0, '2024-10-22 01:34:24'),
(7, 0, '2024-10-22 01:34:24'),
(8, 0, '2024-10-22 01:34:31'),
(9, 0, '2024-10-22 01:35:09'),
(10, 0, '2024-10-22 01:38:19'),
(11, 0, '2024-10-22 01:38:20'),
(12, 0, '2024-10-22 01:38:59'),
(13, 0, '2024-10-22 01:39:19'),
(14, 0, '2024-10-22 01:39:20'),
(15, 0, '2024-10-22 01:39:21'),
(16, 0, '2024-10-22 01:39:21'),
(17, 0, '2024-10-22 01:39:21'),
(18, 0, '2024-10-22 01:39:21'),
(19, 0, '2024-10-22 01:39:21'),
(20, 0, '2024-10-22 01:39:22'),
(21, 0, '2024-10-22 01:39:22'),
(22, 0, '2024-10-22 01:39:49'),
(23, 0, '2024-10-22 01:40:13'),
(24, 0, '2024-10-22 01:40:13'),
(25, 0, '2024-10-22 01:40:24'),
(26, 0, '2024-10-22 01:40:25'),
(27, 0, '2024-10-21 03:00:00'),
(28, 0, '2024-10-21 03:00:00'),
(29, 0, '2024-10-21 03:00:00'),
(30, 0, '2024-10-21 03:00:00'),
(31, 0, '2024-10-21 03:00:00'),
(32, 0, '2024-10-21 03:00:00'),
(33, 0, '2024-10-21 03:00:00'),
(34, 0, '2024-10-21 03:00:00'),
(35, 0, '2024-10-21 03:00:00'),
(36, 0, '2024-10-21 03:00:00'),
(37, 0, '2024-10-22 03:00:00'),
(38, 0, '2024-10-24 00:09:06'),
(39, 0, '2024-10-24 16:02:19'),
(40, 0, '2024-10-24 16:02:20'),
(41, 0, '2024-10-24 16:02:21'),
(42, 0, '2024-10-24 16:02:53'),
(43, 0, '2024-10-24 16:04:03'),
(44, 0, '2024-10-24 16:04:04'),
(45, 0, '2024-10-24 16:05:38'),
(46, 0, '2024-10-24 16:05:39'),
(47, 0, '2024-10-24 16:05:40'),
(48, 0, '2024-10-24 16:07:53'),
(49, 0, '2024-10-24 16:10:03'),
(50, 0, '2024-10-24 16:10:04'),
(51, 0, '2024-10-24 16:10:45'),
(52, 0, '2024-10-24 16:10:46'),
(53, 0, '2024-10-24 16:14:21'),
(54, 0, '2024-10-24 16:14:21'),
(55, 0, '2024-10-24 16:15:13'),
(56, 0, '2024-10-24 16:15:14'),
(57, 0, '2024-10-24 16:15:38'),
(58, 0, '2024-10-24 16:15:38'),
(59, 0, '2024-10-24 16:16:22'),
(60, 0, '2024-10-24 16:16:23'),
(61, 0, '2024-10-24 16:16:55'),
(62, 0, '2024-10-24 16:16:56'),
(63, 0, '2024-10-24 16:17:11'),
(64, 0, '2024-10-24 16:17:11'),
(65, 0, '2024-10-24 16:17:32'),
(66, 0, '2024-10-24 16:17:33'),
(67, 0, '2024-10-24 16:17:41'),
(68, 0, '2024-10-24 16:17:42'),
(69, 0, '2024-10-24 16:30:53'),
(70, 0, '2024-10-24 16:31:29'),
(71, 0, '2024-10-24 16:32:32'),
(72, 0, '2024-10-24 16:32:33'),
(73, 0, '2024-10-24 16:32:50'),
(74, 0, '2024-10-24 16:32:50'),
(75, 0, '2024-10-24 16:33:10'),
(76, 0, '2024-10-24 16:34:03'),
(77, 0, '2024-10-31 17:36:56'),
(78, 1270, '2024-10-31 17:40:41'),
(79, 0, '2024-11-03 20:55:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.artigos`
--

CREATE TABLE `tb_site.artigos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` enum('mundo','brasil','ti','programação','curiosidades') NOT NULL,
  `tipo` enum('artigo','paper','notícias','outros') NOT NULL,
  `conteudo` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_atualizacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.artigos`
--

INSERT INTO `tb_site.artigos` (`id`, `titulo`, `subtitulo`, `descricao`, `categoria`, `tipo`, `conteudo`, `img`, `usuario_id`, `data_criacao`, `data_atualizacao`) VALUES
(8, 'Atualizando Artigo', 'Definindo nova atualização', 'isto é apenas um teste de atualização..', 'programação', 'paper', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\', 'uploads/67250c6c1e1c2.png', 1, '2024-10-22', '2024-11-01'),
(11, 'O que são Artigos?', 'Aprendendo sobre artigos', 'Os artigos acompanham substantivos, podendo torná-los determinados ou indeterminados. São classificados em definidos ou indefinidos e variam em gênero e número.', 'programação', 'paper', '                \"O artigo é uma classe de palavras que acompanham substantivos, aparecendo antes deles para indicar se esses substantivos são determinados e específicos ou indeterminados e genéricos. Assim, os artigos podem ser classificados como definidos ou indefinidos, variando em gênero (masculino ou feminino) e em número (singular ou plural) de acordo com o termo que acompanham.\"\r\n\r\nVeja mais sobre \"Artigo\" em: https://brasilescola.uol.com.br/gramatica/artigo-.htm            ', 'uploads/671ad3098ec45.png', 2, '2024-10-22', '2024-10-24'),
(12, 'Tipos de letras para títulos', 'Escolha fontes bonitas para seus projetos pensando nas necessidades da sua marca.', 'Escolha fontes bonitas para seus projetos pensando nas necessidades da sua marca.', 'programação', 'paper', '                                A tipografia é considerada um elemento crucial no design: não só gera um impacto visual no leitor, mas também desperta o interesse pela mensagem que a marca quer transmitir. O título tem função semelhante em relação ao conteúdo, já que prende o leitor e o provoca para querer saber mais.\r\n\r\nSe você quer que suas publicações chamem a atenção do leitor, é importante que você aproveite as duas ferramentas e escolha bem o tipo de fonte que vai usar nos títulos. Neste artigo trazemos algumas ideias de fontes atrativas que você pode aplicar nos títulos.                        ', 'uploads/671ad32b74848.jpeg', 3, '2024-10-24', '2024-10-24'),

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.categorias`
--

CREATE TABLE `tb_site.categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.categorias`
--

INSERT INTO `tb_site.categorias` (`id`, `nome`, `slug`, `order_id`) VALUES
(10, 'nome da categoria', 'nome-da-categoria', 0),
(11, 'Atualizando categoria', 'atualizando-categoria', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.comentarios`
--

CREATE TABLE `tb_site.comentarios` (
  `id` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `artigo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.comentarios`
--

INSERT INTO `tb_site.comentarios` (`id`, `comentario`, `status`, `data_criacao`, `usuario_id`, `artigo_id`) VALUES
(1, 'qacqacdc', 1, '2024-11-03', 1, 10),
(2, 'Este artigo é ótimo!', 1, '2024-11-03', 3, 11),
(3, 'Gostei muito deste artigo!', 1, '2024-11-03', 1, 11),
(4, 'Artigo muito bom!!!', 1, '2024-11-03', 3, 15),
(5, 'Artigo muito bom!!!', 1, '2024-11-03', 3, 15),
(6, 'Outro comentário', 1, '2024-11-03', 1, 15),
(7, 'Testando comentários', 1, '2024-11-03', 10, 10),
(8, 'Testando comentários.', 1, '2024-11-05', 1, 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.slides`
--

CREATE TABLE `tb_site.slides` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.slides`
--

INSERT INTO `tb_site.slides` (`id`, `titulo`, `descricao`, `link`, `imagem`) VALUES
(1, 'Atualizando sem Imagem', 'Tempo limitado para desenvolvimento (prazo determinado pela faculdade).\r\n', 'https://github.com/AldomarAssolin/noticias', 'uploads/671bfc29dbc25.png'),
(2, 'Venha me conhecer!', 'Conheça meu github e descubra como resolvo problemas de forma criativa e prática com software que atendem suas necessidades.', 'https://github.com/AldomarAssolin', 'uploads/671be707610ca.PNG'),
(3, 'Atu Imagem', 'Este projeto é um site de notícias desenvolvido para fornecer as últimas atualizações e artigos sobre diversos tópicos. O objetivo é criar uma plataforma informativa e fácil de usar para os leitores.', 'https://github.com/AldomarAssolin/noticias', 'uploads/6723c0e03c14f.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Índices de tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_site.artigos`
--
ALTER TABLE `tb_site.artigos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_artigo_usuarios` (`usuario_id`);

--
-- Índices de tabela `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_site.comentarios`
--
ALTER TABLE `tb_site.comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comentario_usuario` (`usuario_id`),
  ADD KEY `fk_comentario_artigo` (`artigo_id`);

--
-- Índices de tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `tb_site.artigos`
--
ALTER TABLE `tb_site.artigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_site.comentarios`
--
ALTER TABLE `tb_site.comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_site.artigos`
--
ALTER TABLE `tb_site.artigos`
  ADD CONSTRAINT `fk_artigo_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `tb_admin.usuarios` (`id`);

--
-- Restrições para tabelas `tb_site.comentarios`
--
ALTER TABLE `tb_site.comentarios`
  ADD CONSTRAINT `fk_comentario_artigo` FOREIGN KEY (`artigo_id`) REFERENCES `tb_site.artigos` (`id`),
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `tb_admin.usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
