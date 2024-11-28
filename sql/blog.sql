-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2024 às 22:15
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
-- Estrutura para tabela `tb_admin.formacao`
--

CREATE TABLE `tb_admin.formacao` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `instituicao` varchar(255) NOT NULL,
  `nivel` varchar(100) DEFAULT NULL,
  `data_inicio` date NOT NULL,
  `conclusao` date NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.formacao`
--

INSERT INTO `tb_admin.formacao` (`id`, `nome`, `instituicao`, `nivel`, `data_inicio`, `conclusao`, `logo`, `cidade`, `uf`, `usuario_id`) VALUES
(5, 'Análise e Desenvolvimento de Sistemas', 'Uniasselvi', 'Graduação', '2022-09-10', '2025-07-10', 'http://localhost/noticias/uploads/67445293eff4d.png', 'Santa Maria', 'RS', 48),
(6, 'Soldagem', 'Colégio Técnico Industrial', 'Técnico', '2018-05-03', '2019-12-12', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMv3A3zL2JFnTSX-rNJXWIfr9bjhILQwkBxA&s', 'Santa Maria', 'RS', 48),
(9, 'Tecnologia da Informação', 'Uniasselvi', 'Graduação', '2025-09-10', '2028-12-10', 'http://localhost/noticias/uploads/67444de3c92e3.png', 'Santa Maria', 'RS', 48),
(10, 'Técnico em Enfermagem', 'Colégio Técnico Santa', 'Técnico', '2020-10-10', '2022-12-10', 'http://localhost/noticias/uploads/674550a23d49d.jpeg', 'santa maria', 'rs', 84);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.interesses`
--

CREATE TABLE `tb_admin.interesses` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.interesses`
--

INSERT INTO `tb_admin.interesses` (`id`, `nome`, `descricao`, `imagem`, `area`, `usuario_id`) VALUES
(7, 'Programação', 'Desenvolvimento de software, algoritmos, linguagens de programação', 'https://www.pexels.com/pt-br/foto/tela-monitor-codificacao-linguagem-de-programacao-6424586/', 'Tecnologia', 48),
(8, 'Inteligência Artificial', 'Aprendizado de máquina, redes neurais, processamento de linguagem natural', 'https://aldomar-assolin.imgbb.com/', 'Tecnologia', 48),
(9, 'Cibersegurança', 'Proteção de dados, hacking ético, segurança da informação', 'https://aldomar-assolin.imgbb.com/', 'Tecnologia', 48),
(10, 'Hiking', 'Trilhas, montanhismo, contato com a natureza', 'https://get.pxhere.com/photo/tree-nature-forest-grass-walking-hiking-trail-meadow-adventure-recreation-walk-idyllic-green-sports-woodland-away-outdoor-recreation-572794.jpg', 'Natureza', 48),
(11, 'Jardinagem', 'Plantas, flores, paisagismo', 'https://media.gazetadopovo.com.br/2022/09/13123238/Shutterstock_1557706064-960x540.jpg', 'Natureza', 48),
(12, 'Astronomia', 'Estrelas, planetas, universo', 'https://c.pxhere.com/photos/29/84/photo-1410557.jpg!d', 'Natureza', 48),
(21, 'Andar de moto', 'Viajar de moto, conhecer novos lugares e pessoas, participar de encontros de motos', 'Array', 'Hobbies', 48),
(22, 'Aldomar Assolin', 'Desta forma, quando o usuário submeter o formulário de atualização, a função atualizarInteresse será chamada, enviando uma requisição AJAX para o servidor. ', 'Array', 'Hobbies', 48),
(23, 'Programacao', 'Desta forma, você estará salvando o caminho do arquivo no banco de dados, e não o array $_FILES[\'imagem\'].', 'Array', 'Hobbies', 48),
(24, 'NOme', '$imagem', 'Array', 'nova area', 48),
(25, 'novo interesse', 'Meu nome é Aldomar Assolin, meu apelido é Manex, fui soldador por 15 anos, Hoje', 'http://localhost/noticias/uploads/67472a05ef5b6.png', 'nova area', 48);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `ultima_acao` timestamp NOT NULL DEFAULT current_timestamp(),
  `local` varchar(10) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `local`, `usuario_id`, `token`) VALUES
(461, 0, '2024-11-27 14:48:34', 'site', 48, '6746f0c67bafd');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.perfil`
--

CREATE TABLE `tb_admin.perfil` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `sobre` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `capa` varchar(255) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` varchar(3) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.perfil`
--

INSERT INTO `tb_admin.perfil` (`id`, `nome`, `sobrenome`, `data_nasc`, `bio`, `sobre`, `avatar`, `capa`, `cidade`, `uf`, `usuario_id`) VALUES
(21, 'Aldomar', 'Assolin', '1984-02-27', 'Meu nome é Aldomar Assolin, meu apelido é Manex, fui soldador por 15 anos, Hoje faço Análise e Desenvolvimento de Sistemas, estou no 5° semestre.', 'Olá, meu nome é Aldomar Assolin. Tenho uma trajetória profissional rica e diversificada, começando como soldador, onde trabalhei por 15 anos. Posteriormente, me formei como Técnico em Soldagem e atualmente estou cursando o quarto semestre de Análise e Desenvolvimento de Sistemas na UNIASSELVI. Minha jornada no campo da tecnologia me levou a desenvolver uma paixão intensa por programação e desenvolvimento de software. \r\nEmbora eu ainda não tenha experiência profissional direta na área de desenvolvimento de software, minha formação, paixão pela tecnologia e habilidades adquiridas ao longo do curso me prepararam para enfrentar novos desafios e contribuir de forma significativa para a empresa.\r\nFrontend Development: Tenho conhecimento em HTML, CSS e JavaScript, além de experiência com o framework React. Esses conhecimentos me permitem criar interfaces de usuário interativas e responsivas.\r\nBackend: Estudei Node.js, Java, PHP e Python, o que me permite trabalhar no desenvolvimento de servidores e APIs RESTful.\r\nBancos de Dados: Possuo um bom entendimento de bancos de dados relacionais (SQL) e não relacionais (NoSQL), permitindo-me modelar e gerenciar dados de maneira eficiente.\r\nMetodologias Ágeis: Aprendi sobre Scrum e Kanban, o que me dá uma boa base para trabalhar em equipes ágeis e colaborar de maneira eficiente.\r\nSegurança da Informação: Estudei práticas de segurança em desenvolvimento de aplicações web, essencial para garantir a proteção dos dados e a integridade das aplicações.', 'http://localhost/noticias/uploads/6744448437c3c.jpg', 'http://localhost/noticias/uploads/6740f1f80ee74.PNG', 'Santa Maria', 'RS', 48),
(27, 'Pedro', 'Assolin', '2000-10-10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'http://localhost/noticias/uploads/67437569e51bc.jpg', 'http://localhost/noticias/uploads/67437569e54fb.jpeg', 'Porto Alegre', 'rs', 83),
(28, 'Aline', 'Santos', '2000-10-10', 'Meu nome é Aline Santos. Hoje faço Análise e Desenvolvimento de Sistemas, estou no 5° semestre.', 'Acredito que minha experiência anterior como soldador me proporcionou habilidades valiosas, como entendimento de parâmetros e atenção aos detalhes, que aplico no desenvolvimento de software. Estou sempre em busca de novos desafios e ansioso para contribuir com projetos inovadores na área de tecnologia1.\r\nQuando não estou codando, você pode me encontrar curtindo um bom rock (especialmente Metallica) ou planejando minha próxima viagem de moto para Santa Catarina. Vamos conectar e trocar ideias sobre tecnologia, música ou viagens!', 'http://localhost/noticias/uploads/674527797376e.png', 'http://localhost/noticias/uploads/6745277973cd3.jpg', 'santa maria', 'rs', 84);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.redes_sociais`
--

CREATE TABLE `tb_admin.redes_sociais` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `cor` varchar(100) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.redes_sociais`
--

INSERT INTO `tb_admin.redes_sociais` (`id`, `nome`, `link`, `imagem`, `cor`, `usuario_id`) VALUES
(6, 'linkedin', 'https://www.linkedin.com/in/aldomarassolin', 'http://localhost/noticias/uploads/67412c5bad2e2.jpeg', 'primary', 48),
(7, 'facebook', 'https://www.facebook.com/aldomarassolin', 'http://localhost/noticias/uploads/67412b9bbd3d9.png', 'info', 48),
(8, 'instagram', 'https://www.instagram.com/aldomarassolin/', 'http://localhost/noticias/uploads/67412c9e0a923.jpeg', 'danger', 48),
(9, 'you tube', 'https://www.youtube.com/channel/UCdtn2Ngyvowq4bl3WhERGuw', 'http://localhost/noticias/uploads/67412ce057c3c.png', 'danger', 48),
(52, 'facebook', 'https://www.facebook.com/aldomarassolin', 'http://localhost/noticias/uploads/674375d9b0552.png', 'primary', 83),
(53, 'instagram', 'https://www.instagram.com/aldomarassolin/', 'http://localhost/noticias/uploads/6743760e271f0.png', 'danger', 83),
(54, 'linkedin', 'https://www.linkedin.com/in/aldomarassolin', 'http://localhost/noticias/uploads/67437da29350b.png', 'primary', 84),
(55, 'github', 'https://github.com/AldomarAssolin', 'http://localhost/noticias/uploads/67437dde34ae2.png', 'secondary', 84),
(56, 'facebook', 'https://www.facebook.com/aldomarassolin', 'http://localhost/noticias/uploads/67437e145d256.png', 'primary', 84),
(58, 'portfolio', 'https://cardapio-manex.vercel.app/', 'http://localhost/noticias/uploads/6744453b9ec30.PNG', 'warning', 48);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.usuarios`
--

CREATE TABLE `tb_admin.usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo` int(1) DEFAULT 0,
  `logado` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `email`, `senha`, `cargo`, `logado`, `status`) VALUES
(48, 'assolin@gmail.com', '$2y$10$rVdNb0EV9KJWxcR3.qaX1O5R8GBM8iWNJINyC.UT918oDJWYiV7EC', 2, 1, 1),
(83, 'pedroassolin@gmail.com', '$2y$10$XPPjG3VozAPvNBa5kNvvseEcY7QGacx1CHd7vckUWchXAKMedlEeS', 0, 1, 1),
(84, 'aldomartech@gmail.com', '$2y$10$ZH8lb2vq5AUvyukWQVnzn.cmUYlp7eZZZLgB8Fx3Y2xaPf1hjKciK', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `dia` timestamp NOT NULL DEFAULT current_timestamp(),
  `hora` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`, `hora`) VALUES
(1, 0, '2024-10-22 01:31:58', NULL),
(2, 0, '2024-10-22 01:32:52', NULL),
(3, 0, '2024-10-22 01:34:14', NULL),
(4, 0, '2024-10-22 01:34:15', NULL),
(5, 0, '2024-10-22 01:34:19', NULL),
(6, 0, '2024-10-22 01:34:24', NULL),
(7, 0, '2024-10-22 01:34:24', NULL),
(8, 0, '2024-10-22 01:34:31', NULL),
(9, 0, '2024-10-22 01:35:09', NULL),
(10, 0, '2024-10-22 01:38:19', NULL),
(11, 0, '2024-10-22 01:38:20', NULL),
(12, 0, '2024-10-22 01:38:59', NULL),
(13, 0, '2024-10-22 01:39:19', NULL),
(14, 0, '2024-10-22 01:39:20', NULL),
(15, 0, '2024-10-22 01:39:21', NULL),
(16, 0, '2024-10-22 01:39:21', NULL),
(17, 0, '2024-10-22 01:39:21', NULL),
(18, 0, '2024-10-22 01:39:21', NULL),
(19, 0, '2024-10-22 01:39:21', NULL),
(20, 0, '2024-10-22 01:39:22', NULL),
(21, 0, '2024-10-22 01:39:22', NULL),
(22, 0, '2024-10-22 01:39:49', NULL),
(23, 0, '2024-10-22 01:40:13', NULL),
(24, 0, '2024-10-22 01:40:13', NULL),
(25, 0, '2024-10-22 01:40:24', NULL),
(26, 0, '2024-10-22 01:40:25', NULL),
(27, 0, '2024-10-21 03:00:00', NULL),
(28, 0, '2024-10-21 03:00:00', NULL),
(29, 0, '2024-10-21 03:00:00', NULL),
(30, 0, '2024-10-21 03:00:00', NULL),
(31, 0, '2024-10-21 03:00:00', NULL),
(32, 0, '2024-10-21 03:00:00', NULL),
(33, 0, '2024-10-21 03:00:00', NULL),
(34, 0, '2024-10-21 03:00:00', NULL),
(35, 0, '2024-10-21 03:00:00', NULL),
(36, 0, '2024-10-21 03:00:00', NULL),
(37, 0, '2024-10-22 03:00:00', NULL),
(38, 0, '2024-10-24 00:09:06', NULL),
(39, 0, '2024-10-24 16:02:19', NULL),
(40, 0, '2024-10-24 16:02:20', NULL),
(41, 0, '2024-10-24 16:02:21', NULL),
(42, 0, '2024-10-24 16:02:53', NULL),
(43, 0, '2024-10-24 16:04:03', NULL),
(44, 0, '2024-10-24 16:04:04', NULL),
(45, 0, '2024-10-24 16:05:38', NULL),
(46, 0, '2024-10-24 16:05:39', NULL),
(47, 0, '2024-10-24 16:05:40', NULL),
(48, 0, '2024-10-24 16:07:53', NULL),
(49, 0, '2024-10-24 16:10:03', NULL),
(50, 0, '2024-10-24 16:10:04', NULL),
(51, 0, '2024-10-24 16:10:45', NULL),
(52, 0, '2024-10-24 16:10:46', NULL),
(53, 0, '2024-10-24 16:14:21', NULL),
(54, 0, '2024-10-24 16:14:21', NULL),
(55, 0, '2024-10-24 16:15:13', NULL),
(56, 0, '2024-10-24 16:15:14', NULL),
(57, 0, '2024-10-24 16:15:38', NULL),
(58, 0, '2024-10-24 16:15:38', NULL),
(59, 0, '2024-10-24 16:16:22', NULL),
(60, 0, '2024-10-24 16:16:23', NULL),
(61, 0, '2024-10-24 16:16:55', NULL),
(62, 0, '2024-10-24 16:16:56', NULL),
(63, 0, '2024-10-24 16:17:11', NULL),
(64, 0, '2024-10-24 16:17:11', NULL),
(65, 0, '2024-10-24 16:17:32', NULL),
(66, 0, '2024-10-24 16:17:33', NULL),
(67, 0, '2024-10-24 16:17:41', NULL),
(68, 0, '2024-10-24 16:17:42', NULL),
(69, 0, '2024-10-24 16:30:53', NULL),
(70, 0, '2024-10-24 16:31:29', NULL),
(71, 0, '2024-10-24 16:32:32', NULL),
(72, 0, '2024-10-24 16:32:33', NULL),
(73, 0, '2024-10-24 16:32:50', NULL),
(74, 0, '2024-10-24 16:32:50', NULL),
(75, 0, '2024-10-24 16:33:10', NULL),
(76, 0, '2024-10-24 16:34:03', NULL),
(77, 0, '2024-10-31 17:36:56', NULL),
(78, 1270, '2024-10-31 17:40:41', NULL),
(79, 0, '2024-11-03 20:55:30', NULL),
(80, 0, '2024-11-09 20:57:32', NULL),
(81, 1270, '2024-11-09 21:00:08', NULL),
(82, 0, '2024-11-14 15:39:58', NULL),
(83, 1270, '2024-11-15 17:41:31', NULL),
(84, 0, '2024-11-18 12:50:58', NULL),
(85, 1270, '2024-11-18 14:58:54', NULL),
(86, 0, '2024-11-21 17:01:31', NULL),
(87, 1270, '2024-11-23 22:07:34', NULL),
(88, 0, '2024-11-25 22:22:59', NULL),
(89, 0, '2024-11-25 22:23:32', NULL),
(90, 0, '2024-11-25 22:23:36', NULL),
(91, 1270, '2024-11-25 22:23:52', NULL),
(92, 0, '2024-11-25 22:25:36', NULL),
(93, 0, '2024-11-25 22:25:36', NULL),
(94, 0, '2024-11-25 22:25:36', NULL),
(95, 0, '2024-11-25 22:25:36', NULL),
(96, 0, '2024-11-25 22:37:05', NULL),
(97, 0, '2024-11-25 22:38:49', NULL),
(98, 0, '2024-11-25 22:38:50', NULL),
(99, 0, '2024-11-25 22:38:51', NULL),
(100, 0, '2024-11-25 22:38:51', NULL),
(101, 0, '2024-11-25 22:38:51', NULL),
(102, 0, '2024-11-25 22:38:52', NULL),
(103, 0, '2024-11-25 22:38:52', NULL),
(104, 0, '2024-11-25 22:38:52', NULL),
(105, 0, '2024-11-25 22:38:52', NULL),
(106, 0, '2024-11-25 22:38:52', NULL),
(107, 0, '2024-11-25 22:38:53', NULL),
(108, 0, '2024-11-25 22:38:53', NULL),
(109, 0, '2024-11-25 22:38:53', NULL),
(110, 0, '2024-11-25 22:38:53', NULL),
(111, 0, '2024-11-25 22:39:06', NULL),
(112, 0, '2024-11-25 22:39:20', NULL),
(113, 0, '2024-11-25 03:00:00', '20:17:52'),
(114, 0, '2024-11-25 03:00:00', '20:17:54'),
(115, 0, '2024-11-25 03:00:00', '20:18:11'),
(116, 0, '2024-11-25 03:00:00', '20:19:15'),
(117, 0, '2024-11-25 03:00:00', '20:21:05'),
(118, 0, '2024-11-25 03:00:00', '20:21:05'),
(119, 0, '2024-11-25 03:00:00', '20:21:06'),
(120, 0, '2024-11-25 03:00:00', '20:21:07'),
(121, 0, '2024-11-25 03:00:00', '20:21:07'),
(122, 0, '2024-11-25 03:00:00', '20:21:07'),
(123, 0, '2024-11-25 03:00:00', '20:21:46'),
(124, 0, '2024-11-25 03:00:00', '20:23:04'),
(125, 0, '2024-11-25 03:00:00', '20:23:05'),
(126, 0, '2024-11-25 03:00:00', '20:23:25'),
(127, 0, '2024-11-25 03:00:00', '20:23:26'),
(128, 0, '2024-11-25 03:00:00', '20:23:27'),
(129, 0, '2024-11-25 03:00:00', '20:23:27'),
(130, 0, '2024-11-25 03:00:00', '20:23:27'),
(131, 0, '2024-11-25 03:00:00', '20:23:27'),
(132, 0, '2024-11-25 03:00:00', '20:23:28'),
(133, 0, '2024-11-25 03:00:00', '20:23:28'),
(134, 0, '2024-11-25 03:00:00', '20:23:28'),
(135, 1270, '2024-11-25 03:00:00', '20:26:55'),
(136, 1270, '2024-11-25 03:00:00', '20:30:55'),
(137, 1270, '2024-11-25 03:00:00', '20:32:26'),
(138, 1270, '2024-11-25 03:00:00', '20:32:27'),
(139, 1270, '2024-11-25 03:00:00', '20:42:38'),
(140, 1270, '2024-11-25 03:00:00', '20:43:22'),
(141, 1270, '2024-11-25 03:00:00', '20:43:26'),
(142, 1270, '2024-11-25 03:00:00', '20:43:27'),
(143, 1270, '2024-11-25 03:00:00', '20:45:36');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.artigos`
--

CREATE TABLE `tb_site.artigos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_atualizacao` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.artigos`
--

INSERT INTO `tb_site.artigos` (`id`, `titulo`, `subtitulo`, `descricao`, `categoria`, `conteudo`, `img`, `usuario_id`, `data_criacao`, `data_atualizacao`, `status`) VALUES
(28, 'Titulo alterado', 'Documentação e exemplos para exibir imagens e textos relacionados com o componente de figura no Bootstrap.', 'Sempre que você precisar exibir um conteúdo, como uma imagem com uma legenda opcional, considere usar um &#60;figure&#62;.', 'programacao', 'Alterando conteudo direto noDB', 'http://localhost/noticias/uploads/674620f1e379b.jpeg', 48, '2024-11-23', '2024-11-27', 1),
(29, 'BLOG - Análise Orientada a Objetos', 'Estruturando objetos e modelando as tabelas para a aplicação do blog', 'Vamos estruturar a análise orientada a objeto e a modelagem das tabelas para a aplicação do blog. Vamos criar as classes principais e o modelo das tabelas no banco de dados.', 'tutorial', '<p><img src=\"static/uploads/AOO.PNG\" alt=\"Analise orientada a objetos\" width=\"100%\" height=\"100%\"></p>\r\n<h3>An&aacute;lise Orientada a Objeto</h3>\r\n<p><strong>1. Classes Principais:</strong></p>\r\n<ul>\r\n<li><strong>Usu&aacute;rio (User):</strong> Representa os usu&aacute;rios do sistema com diferentes pap&eacute;is (ADM, Autor, Usu&aacute;rio Normal).</li>\r\n<li><strong>Artigo (Article):</strong> Representa os posts, artigos e not&iacute;cias publicados no blog.</li>\r\n<li><strong>Categoria (Category):</strong> Classifica os artigos por t&oacute;picos ou temas.</li>\r\n<li><strong>Coment&aacute;rio (Comment):</strong> Representa os coment&aacute;rios que os usu&aacute;rios podem fazer nos artigos.</li>\r\n</ul>\r\n<h4>Classe Usu&aacute;rio (User)</h4>\r\n<p>Atributos:</p>\r\n<ul>\r\n<li><code>id</code>: Identificador &uacute;nico do usu&aacute;rio (int).</li>\r\n<li><code>nome</code>: Nome do usu&aacute;rio (string).</li>\r\n<li><code>email</code>: Email do usu&aacute;rio (string).</li>\r\n<li><code>senha</code>: Senha do usu&aacute;rio (string).</li>\r\n<li><code>cargo</code>: Cargo do usu&aacute;rio (ADM, Autor, Normal).</li>\r\n<li><code>dataCadastro</code>: Data de cria&ccedil;&atilde;o do usu&aacute;rio.</li>\r\n</ul>\r\n<p>M&eacute;todos:</p>\r\n<ul>\r\n<li><code>fazerLogin()</code>: Verifica as credenciais do usu&aacute;rio.</li>\r\n<li><code>criarArtigo()</code>: Permite ao Autor criar um novo artigo.</li>\r\n<li><code>gerenciarUsuarios()</code>: Permite ao ADM gerenciar usu&aacute;rios.</li>\r\n</ul>\r\n<h4>Classe Artigo (Article)</h4>\r\n<p>Atributos:</p>\r\n<ul>\r\n<li><code>id</code>: Identificador &uacute;nico do artigo (int).</li>\r\n<li><code>titulo</code>: T&iacute;tulo do artigo (string).</li>\r\n<li><code>conteudo</code>: Conte&uacute;do do artigo (text).</li>\r\n<li><code>autor</code>: Autor do artigo (refer&ecirc;ncia para a classe User).</li>\r\n<li><code>dataPublicacao</code>: Data de publica&ccedil;&atilde;o.</li>\r\n<li><code>categoria</code>: Categoria do artigo (refer&ecirc;ncia para a classe Categoria).</li>\r\n</ul>\r\n<p>M&eacute;todos:</p>\r\n<ul>\r\n<li><code>publicar()</code>: Publica o artigo.</li>\r\n<li><code>editar()</code>: Permite a edi&ccedil;&atilde;o do artigo.</li>\r\n</ul>\r\n<h4>Classe Categoria (Category)</h4>\r\n<p>Atributos:</p>\r\n<ul>\r\n<li><code>id</code>: Identificador &uacute;nico da categoria (int).</li>\r\n<li><code>nome</code>: Nome da categoria (string).</li>\r\n</ul>\r\n<p>M&eacute;todos:</p>\r\n<ul>\r\n<li><code>adicionarCategoria()</code>: Permite criar novas categorias.</li>\r\n<li><code>editarCategoria()</code>: Permite editar categorias existentes.</li>\r\n</ul>\r\n<h4>Classe Coment&aacute;rio (Comment)</h4>\r\n<p>Atributos:</p>\r\n<ul>\r\n<li><code>id</code>: Identificador &uacute;nico do coment&aacute;rio (int).</li>\r\n<li><code>conteudo</code>: Conte&uacute;do do coment&aacute;rio (text).</li>\r\n<li><code>autor</code>: Autor do coment&aacute;rio (refer&ecirc;ncia para a classe User).</li>\r\n<li><code>artigo</code>: Artigo relacionado ao coment&aacute;rio (refer&ecirc;ncia para a classe Artigo).</li>\r\n</ul>\r\n<p>M&eacute;todos:</p>\r\n<ul>\r\n<li><code>adicionarComentario()</code>: Permite adicionar um coment&aacute;rio a um artigo.</li>\r\n</ul>\r\n<hr>\r\n<h3>Modelagem do Banco de Dados (Tabelas)</h3>\r\n<h4>Tabela <code>users</code></h4>\r\n<pre><code class=\"language-sql\">CREATE TABLE users (\r\n    id INT AUTO_INCREMENT PRIMARY KEY,\r\n    nome VARCHAR(100) NOT NULL,\r\n    email VARCHAR(100) UNIQUE NOT NULL,\r\n    senha VARCHAR(255) NOT NULL,\r\n    cargo ENUM(\'ADM\', \'Autor\', \'Normal\') DEFAULT \'Normal\',\r\n    dataCadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP\r\n);\r\n</code></pre>\r\n<h4><img src=\"static/uploads/table-users.PNG\" alt=\"table-users\" width=\"100%\" height=\"100%\"></h4>\r\n<h4>Tabela&nbsp;<code>articles</code></h4>\r\n<pre><code class=\"language-sql\">CREATE TABLE articles (\r\n    id INT AUTO_INCREMENT PRIMARY KEY,\r\n    titulo VARCHAR(255) NOT NULL,\r\n    conteudo TEXT NOT NULL,\r\n    autor_id INT,\r\n    categoria_id INT,\r\n    dataPublicacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\r\n    FOREIGN KEY (autor_id) REFERENCES users(id),\r\n    FOREIGN KEY (categoria_id) REFERENCES categories(id)\r\n);\r\n</code></pre>\r\n<h4><img src=\"static/uploads/table-articles.PNG\" alt=\"table-articles\" width=\"100%\" height=\"100%\"></h4>\r\n<h4>Tabela&nbsp;<code>categories</code></h4>\r\n<pre><code class=\"language-sql\">CREATE TABLE categories (\r\n    id INT AUTO_INCREMENT PRIMARY KEY,\r\n    nome VARCHAR(100) NOT NULL\r\n);\r\n</code></pre>\r\n<h4><img src=\"static/uploads/table-categories.PNG\" alt=\"table-categories\" width=\"100%\" height=\"100%\"></h4>\r\n<h4>Tabela&nbsp;<code>comments</code></h4>\r\n<pre><code class=\"language-sql\">CREATE TABLE comments (\r\n    id INT AUTO_INCREMENT PRIMARY KEY,\r\n    conteudo TEXT NOT NULL,\r\n    autor_id INT,\r\n    artigo_id INT,\r\n    dataComentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\r\n    FOREIGN KEY (autor_id) REFERENCES users(id),\r\n    FOREIGN KEY (artigo_id) REFERENCES articles(id)\r\n);<br><img src=\"static/uploads/table-comments.PNG\" alt=\"table-comments\" width=\"100%\" height=\"100%\">\r\n</code></pre>\r\n<hr>\r\n<h3>Relacionamentos:</h3>\r\n<ul>\r\n<li>Um <strong>usu&aacute;rio</strong> pode criar v&aacute;rios <strong>artigos</strong>.</li>\r\n<li>Um <strong>artigo</strong> pertence a uma &uacute;nica <strong>categoria</strong>, mas pode ter v&aacute;rios <strong>coment&aacute;rios</strong>.</li>\r\n<li>Um <strong>coment&aacute;rio</strong> &eacute; feito por um <strong>usu&aacute;rio</strong> e est&aacute; relacionado a um <strong>artigo</strong>.</li>\r\n</ul>\r\n<p>Essa estrutura proporciona flexibilidade e facilita a manuten&ccedil;&atilde;o do sistema, al&eacute;m de permitir expans&otilde;es futuras, como adi&ccedil;&atilde;o de mais funcionalidades e integra&ccedil;&atilde;o com APIs.</p>\r\n<p>Se precisar de mais detalhes ou ajustes, me avise!</p>', 'http://localhost/noticias/uploads/674245a67ca5d.PNG', 48, '2024-11-23', '2024-11-27', 1),
(30, 'Desenvolvimento de uma API', 'Principais funcionalidades', 'Garantindo o desenvolvimnento de API de forma organizada e eficiente', 'dicas', '                <p><img src=\"static/uploads/BG_StackJava.png\" alt=\"BG_StackJava\" width=\"100%\" height=\"100%\"></p>\r\n<h3><strong>Revisão das Respostas</strong></h3>\r\n<h4><strong>1.1. Principais Funcionalidades da API</strong></h4>\r\n<p>Você detalhou seis funcionalidades essenciais para o blog, abrangendo desde a autenticação de usuários até a interação com favoritos. Isso proporciona uma base sólida para o desenvolvimento da API, garantindo que todas as necessidades principais sejam atendidas.</p>\r\n<h4><strong>1.2. Stakeholders Envolvidos e Expectativas</strong></h4>\r\n<p>Identificou claramente os principais stakeholders:</p>\r\n<ul>\r\n<li><strong>Usuários Finais:</strong> Esperam acesso rápido e seguro ao conteúdo.</li>\r\n<li><strong>Equipe de Frontend:</strong> Necessita de uma API estável e bem documentada.</li>\r\n</ul>\r\n<h4><strong>1.3. Riscos Potenciais</strong></h4>\r\n<p>Você apontou riscos relevantes:</p>\r\n<ul>\r\n<li><strong>Falhas de Segurança</strong></li>\r\n<li><strong>Problemas de Performance</strong></li>\r\n<li><strong>Dificuldades na Integração com o Frontend</strong></li>\r\n<li><strong>Dificuldades no Deploy</strong></li>\r\n</ul>\r\n<h4><strong><img src=\"static/uploads/processovsProjeto.png\" alt=\"processovsProjeto\" width=\"100%\" height=\"100%\"></strong></h4>\r\n<h4><strong>1.4. Escopo Inicial do Projeto</strong></h4>\r\n<p>Definiu um escopo claro:</p>\r\n<ul>\r\n<li><strong>Prioridades:</strong> CRUD de artigos e autenticação de usuários.</li>\r\n<li><strong>Futuras Iterações:</strong> Comentários e gestão de categorias.</li>\r\n</ul>\r\n<h4><strong>1.5. Estimativas de Custo e Prazo</strong></h4>\r\n<ul>\r\n<li><strong>Infraestrutura:</strong> Considera usar Heroku, preferencialmente gratuito.</li>\r\n<li><strong>Prazo:</strong> 6 semanas para a API completa.</li>\r\n</ul>\r\n<h3><strong>Aprofundando nas Estimativas de Custo e Prazo</strong></h3>\r\n<p>Vamos refinar um pouco mais suas estimativas para garantir que sejam realistas e alinhadas com seus objetivos.</p>\r\n<h4><strong>Custo:</strong></h4>\r\n<ol>\r\n<li>\r\n<p><strong>Infraestrutura:</strong></p>\r\n<ul>\r\n<li><strong>Heroku (Gratuito):</strong> Ideal para começar, mas lembre-se das limitações, como o tempo de hibernação dos aplicativos gratuitos após 30 minutos de inatividade.</li>\r\n<li><strong>Alternativas:</strong>\r\n<ul>\r\n<li><strong>AWS Free Tier:</strong> Oferece mais recursos gratuitamente por um período limitado.</li>\r\n<li><strong>DigitalOcean:</strong> Planos acessíveis que podem ser escalados conforme necessário.</li>\r\n<li><strong>Vercel ou Netlify:</strong> Excelentes para deploys rápidos e podem ser integrados com backend via serverless functions.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Ferramentas e Licenças:</strong></p>\r\n<ul>\r\n<li><strong>Editor WYSIWYG (TinyMCE):</strong> Versão gratuita disponível, mas verifique se atende todas as suas necessidades ou se será necessário um plano pago.</li>\r\n<li><strong>Outras Ferramentas:</strong> Verifique se todas as ferramentas que planeja usar são gratuitas ou se possuem planos dentro do seu orçamento.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Recursos Humanos:</strong></p>\r\n<ul>\r\n<li><strong>Seu Tempo:</strong> Estime quantas horas por semana você pode dedicar ao projeto. Por exemplo, se você puder dedicar 20 horas por semana, o total seria 120 horas em 6 semanas.</li>\r\n<li><strong>Aprendizado e Capacitação:</strong> Reserve tempo para aprender novas tecnologias ou aprofundar conhecimentos necessários.</li>\r\n</ul>\r\n</li>\r\n</ol>\r\n<h4><strong>Prazo:</strong></h4>\r\n<p>6 semanas para a API completa é um prazo desafiador, mas factível se bem planejado. Aqui está uma sugestão de como dividir as tarefas:</p>\r\n<ul>\r\n<li>\r\n<p><strong>Semana 1-2:</strong> Sistema de Login e Cadastro de Usuários</p>\r\n<ul>\r\n<li><strong>Tarefas:</strong> Configuração do ambiente, implementação de endpoints de cadastro e login, integração com o banco de dados.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Semana 3:</strong> Interface de Administração para Publicação de Artigos</p>\r\n<ul>\r\n<li><strong>Tarefas:</strong> Desenvolvimento do dashboard administrativo, criação de endpoints para CRUD de artigos e categorias.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Semana 4:</strong> Publicação e Formatação de Artigos</p>\r\n<ul>\r\n<li><strong>Tarefas:</strong> Implementação do editor de texto rich text, upload de imagens, categorização e tagging.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Semana 5:</strong> Busca e Filtragem de Artigos</p>\r\n<ul>\r\n<li><strong>Tarefas:</strong> Desenvolvimento de funcionalidades de busca, filtragem por categorias e tags, ordenação de resultados.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Semana 6:</strong> Sistema de Comentários e Favoritos</p>\r\n<ul>\r\n<li><strong>Tarefas:</strong> Implementação do sistema de comentários, respostas, notificações e funcionalidades de favoritos.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Semana Extra (Opcional):</strong> Testes, Documentação e Deploy</p>\r\n<ul>\r\n<li><strong>Tarefas:</strong> Testes finais, ajustes, finalização da documentação e deploy para produção.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<h3><strong><img src=\"static/uploads/AOO.PNG\" alt=\"AOO\" width=\"100%\" height=\"100%\"></strong></h3>\r\n<h3><strong>Próximos Passos na Fase de Concepção / Iniciação</strong></h3>\r\n<ol>\r\n<li>\r\n<p><strong>Documentação Final:</strong></p>\r\n<ul>\r\n<li>Compile todas as informações em um documento de visão do projeto. Isso servirá como guia durante o desenvolvimento e facilitará a comunicação com stakeholders.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Análise Detalhada de Riscos:</strong></p>\r\n<ul>\r\n<li>Para cada risco identificado, desenvolva estratégias de mitigação. Por exemplo:\r\n<ul>\r\n<li><strong>Falhas de Segurança:</strong> Implementar autenticação robusta (JWT), validar todas as entradas, utilizar HTTPS.</li>\r\n<li><strong>Problemas de Performance:</strong> Otimizar consultas ao banco de dados, implementar caching onde necessário.</li>\r\n<li><strong>Dificuldades na Integração com Frontend:</strong> Manter comunicação constante com a equipe de frontend, definir contratos de API claros.</li>\r\n<li><strong>Dificuldades no Deploy:</strong> Automatizar o processo de deploy, utilizar ferramentas de CI/CD.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Definição Detalhada do Escopo:</strong></p>\r\n<ul>\r\n<li>Especifique claramente quais funcionalidades serão desenvolvidas em cada sprint ou semana. Isso ajuda a manter o foco e a organizar melhor o tempo.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Planejamento Detalhado:</strong></p>\r\n<ul>\r\n<li>Utilize ferramentas como Trello, Asana ou Jira para organizar as tarefas.</li>\r\n<li>Defina milestones semanais para acompanhar o progresso e ajustar o plano conforme necessário.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Reunião com Stakeholders (se aplicável):</strong></p>\r\n<ul>\r\n<li>Se houver outros stakeholders além de você, organize uma reunião para revisar o plano e obter feedback.</li>\r\n</ul>\r\n</li>\r\n</ol>\r\n<h3><strong>Iniciando a Próxima Etapa: Análise de Riscos e Mitigação</strong></h3>\r\n<p>Agora que você já identificou os riscos potenciais, vamos detalhar cada um e definir estratégias de mitigação para garantir que o projeto avance sem grandes obstáculos.</p>\r\n<h4><strong>1.3. Análise de Riscos Detalhada</strong></h4>\r\n<p>Para cada risco identificado, considere:</p>\r\n<ul>\r\n<li><strong>Probabilidade:</strong> Alta, Média, Baixa</li>\r\n<li><strong>Impacto:</strong> Alto, Médio, Baixo</li>\r\n<li><strong>Estratégias de Mitigação:</strong></li>\r\n</ul>\r\n<table>\r\n<thead>\r\n<tr>\r\n<th><strong>Risco</strong></th>\r\n<th><strong>Probabilidade</strong></th>\r\n<th><strong>Impacto</strong></th>\r\n<th><strong>Mitigação</strong></th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>Falhas de Segurança</td>\r\n<td>Alta</td>\r\n<td>Alto</td>\r\n<td>Implementar autenticação robusta (JWT), validar entradas, usar HTTPS, realizar auditorias regulares.</td>\r\n</tr>\r\n<tr>\r\n<td>Problemas de Performance</td>\r\n<td>Média</td>\r\n<td>Alto</td>\r\n<td>Otimizar consultas, implementar caching, monitorar performance continuamente.</td>\r\n</tr>\r\n<tr>\r\n<td>Dificuldades na Integração Frontend</td>\r\n<td>Média</td>\r\n<td>Médio</td>\r\n<td>Definir contratos de API claros, manter comunicação constante com a equipe de frontend.</td>\r\n</tr>\r\n<tr>\r\n<td>Dificuldades no Deploy</td>\r\n<td>Baixa</td>\r\n<td>Médio</td>\r\n<td>Automatizar deploy com CI/CD, utilizar contêineres (Docker), testar em ambientes de staging.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3><strong>Resumo da Fase de Concepção / Iniciação</strong></h3>\r\n<ul>\r\n<li><strong>Funcionalidades Definidas:</strong> ✔️</li>\r\n<li><strong>Stakeholders Identificados:</strong> ✔️</li>\r\n<li><strong>Riscos Identificados e Analisados:</strong> ✔️</li>\r\n<li><strong>Escopo Inicial Definido:</strong> ✔️</li>\r\n<li><strong>Estimativas de Custo e Prazo Refinadas:</strong> ✔️</li>\r\n<li><strong>Planejamento e Documentação:</strong> Em andamento</li>\r\n</ul>\r\n<h3><strong>Próxima Fase: Elaboração</strong></h3>\r\n<p>Com a <strong>Fase de Concepção / Iniciação</strong> bem estabelecida, estamos prontos para avançar para a <strong>Fase de Elaboração</strong>, onde desenvolveremos um modelo mais detalhado do projeto, incluindo a arquitetura da API, modelagem de dados e estratégias para mitigar os riscos identificados.</p>\r\n<h4><strong>O que Vamos Abordar na Fase de Elaboração:</strong></h4>\r\n<ol>\r\n<li>\r\n<p><strong>Modelagem de Dados:</strong></p>\r\n<ul>\r\n<li>Criação de diagramas de Entidade-Relacionamento (ER) para definir as tabelas e relações no banco de dados.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Desenho da Arquitetura da API:</strong></p>\r\n<ul>\r\n<li>Definição do padrão arquitetural (RESTful), escolha de frameworks (Spring Boot), e estruturação dos endpoints.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Prototipagem:</strong></p>\r\n<ul>\r\n<li>Desenvolvimento de um protótipo com alguns endpoints-chave para validar a abordagem e identificar possíveis problemas.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Mitigação de Riscos:</strong></p>\r\n<ul>\r\n<li>Implementação inicial das estratégias de mitigação para os riscos identificados.</li>\r\n</ul>\r\n</li>\r\n</ol>\r\n<h3><strong>Como Proceder:</strong></h3>\r\n<ol>\r\n<li>\r\n<p><strong>Modelagem de Dados:</strong></p>\r\n<ul>\r\n<li>Vamos começar criando o diagrama ER para o banco de dados da sua API. Você pode descrever as principais entidades e seus relacionamentos?</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Desenho da Arquitetura:</strong></p>\r\n<ul>\r\n<li>Definir como os componentes da API se relacionarão. Por exemplo, quais serão os principais módulos ou serviços?</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Prototipagem:</strong></p>\r\n<ul>\r\n<li>Identificar quais endpoints serão desenvolvidos primeiro para o protótipo.</li>\r\n</ul>\r\n</li>\r\n</ol>\r\n<p>Escolha onde gostaria de começar ou se precisa de ajuda em alguma dessas áreas específicas para a <strong>Fase de Elaboração</strong>.</p>\r\n<p>Estou aqui para ajudar em cada etapa do processo. Vamos continuar avançando para garantir que sua API seja robusta, eficiente e atenda a todas as necessidades do seu blog!</p>            ', 'http://localhost/noticias/uploads/6743731ce706d.png', 48, '2024-11-23', '2024-11-27', 1),
(31, 'MVC (Model-View-Controller)', 'Estrutura MVC em PHP', 'A estrutura MVC (Model-View-Controller) é um padrão de arquitetura de software amplamente utilizado no desenvolvimento de aplicações web, incluindo aquelas feitas em PHP. Vamos explorar cada componente e como você poderia aplicá-lo no seu blog.', 'tutorial', 'A estrutura MVC (Model-View-Controller) é um padrão de arquitetura de software amplamente utilizado no desenvolvimento de aplicações web, incluindo aquelas feitas em PHP. Vamos explorar cada componente e como você poderia aplicá-lo no seu blog.\r\n\r\n## Estrutura MVC em PHP\r\n\r\n### Model (Modelo)\r\n\r\nO Model é responsável pela lógica de negócios e pela interação com o banco de dados. No contexto de um blog, ele lidaria com operações como:\r\n\r\n- Recuperar posts do banco de dados\r\n- Salvar novos posts\r\n- Atualizar posts existentes\r\n- Gerenciar comentários\r\n\r\nExemplo de um Model para posts:\r\n\r\n```php\r\nclass Post {\r\n    private $id;\r\n    private $titulo;\r\n    private $conteudo;\r\n\r\n    public function save() {\r\n        // Lógica para salvar o post no banco de dados\r\n    }\r\n\r\n    public function update() {\r\n        // Lógica para atualizar o post no banco de dados\r\n    }\r\n\r\n    public function delete() {\r\n        // Lógica para remover o post do banco de dados\r\n    }\r\n\r\n    public function getAll() {\r\n        // Lógica para listar todos os posts\r\n    }\r\n}\r\n```\r\n\r\n### View (Visão)\r\n\r\nA View é responsável pela apresentação dos dados ao usuário. Em um blog, ela incluiria:\r\n\r\n- Página inicial com lista de posts\r\n- Página individual de post\r\n- Formulário para criar/editar posts\r\n\r\nExemplo de uma View para listar posts:\r\n\r\n```php\r\n<h1>Meu Blog</h1>\r\n<ul>\r\n<?php foreach ($posts as $post): ?>\r\n    <li>\r\n        <h2><?php echo $post->getTitulo(); ?></h2>\r\n        <p><?php echo substr($post->getConteudo(), 0, 200); ?>...</p>\r\n        <a href=\"post.php?id=<?php echo $post->getId(); ?>\">Ler mais</a>\r\n    </li>\r\n<?php endforeach; ?>\r\n</ul>\r\n```\r\n\r\n### Controller (Controlador)\r\n\r\nO Controller atua como intermediário entre o Model e a View. Ele processa as requisições do usuário, interage com o Model e seleciona a View apropriada. Para um blog, o Controller poderia:\r\n\r\n- Lidar com a criação de novos posts\r\n- Gerenciar a exibição de posts\r\n- Processar comentários\r\n\r\nExemplo de um Controller para posts:\r\n\r\n```php\r\nclass PostController {\r\n    public function listarPosts() {\r\n        $post = new Post();\r\n        $posts = $post->getAll();\r\n        require_once \'views/lista_posts.php\';\r\n    }\r\n\r\n    public function criarPost() {\r\n        if ($_SERVER[\'REQUEST_METHOD\'] === \'POST\') {\r\n            $post = new Post();\r\n            $post->setTitulo($_POST[\'titulo\']);\r\n            $post->setConteudo($_POST[\'conteudo\']);\r\n            $post->save();\r\n            header(\'Location: index.php\');\r\n        } else {\r\n            require_once \'views/criar_post.php\';\r\n        }\r\n    }\r\n}\r\n```\r\n\r\n## Aplicando MVC no seu Blog\r\n\r\nPara aplicar a estrutura MVC no seu blog, siga estes passos:\r\n\r\n1. **Organize a estrutura de diretórios:**\r\n   - /models\r\n   - /views\r\n   - /controllers\r\n   - /public (para arquivos CSS, JavaScript, imagens)\r\n\r\n2. **Crie Models para entidades principais:**\r\n   - Post.php\r\n   - Comentario.php\r\n   - Usuario.php\r\n\r\n3. **Desenvolva Views para diferentes páginas:**\r\n   - lista_posts.php\r\n   - post_individual.php\r\n   - criar_post.php\r\n   - editar_post.php\r\n\r\n4. **Implemente Controllers para gerenciar a lógica:**\r\n   - PostController.php\r\n   - ComentarioController.php\r\n   - UsuarioController.php\r\n\r\n5. **Configure um sistema de rotas:**\r\n   Crie um arquivo index.php na raiz do projeto para gerenciar as rotas:\r\n\r\n```php\r\n<?php\r\n$action = $_GET[\'action\'] ?? \'home\';\r\n\r\nswitch ($action) {\r\n    case \'home\':\r\n        $controller = new PostController();\r\n        $controller->listarPosts();\r\n        break;\r\n    case \'criar_post\':\r\n        $controller = new PostController();\r\n        $controller->criarPost();\r\n        break;\r\n    // Adicione mais casos conforme necessário\r\n}\r\n```\r\n\r\n6. **Implemente um autoloader:**\r\n   Para carregar automaticamente as classes quando necessário.\r\n\r\n7. **Utilize um template engine:**\r\n   Como Twig ou Smarty para melhorar a separação entre lógica e apresentação nas Views.\r\n\r\nAo aplicar essa estrutura, seu blog terá uma organização clara, facilitando a manutenção e expansão futura. Cada componente terá responsabilidades bem definidas, tornando o código mais limpo e modular[1][2][3][4][5].\r\n\r\nCitations:\r\n[1] https://www.devmedia.com.br/conceito-de-mvc-e-sua-funcionalidade-usando-o-php/22324\r\n[2] https://blog.ironlinux.com.br/entendendo-mvc/\r\n[3] https://satellasoft.com/artigo/php/blog-com-php-mysql-usando-mvc\r\n[4] https://www.vivaolinux.com.br/artigo/MVC-Conceito-e-exemplo-em-PHP/\r\n[5] https://blog.betrybe.com/php/mvc-php/', 'http://localhost/noticias/uploads/674342e593956.jpeg', 48, '2024-11-24', '2024-11-27', 1),
(32, 'Descrição da Aplicação - BLOG', 'Sistema de gerenciamento de artigos - BLOG', 'Utilizando github copilot para verificação de código', 'carros e motos', '                Digite seu conteúdo aqui            ', 'http://localhost/noticias/static/images/no-image.jpeg', 48, '2024-11-25', '2024-11-27', 1),
(33, 'Frameworks PHP', 'Laravel', 'O Laravel é um dos frameworks PHP mais populares e poderosos para o desenvolvimento web atualmente. Ele oferece uma série de recursos e funcionalidades que facilitam a criação de aplicações web robustas e seguras', 'programacao', '<p><img src=\"static/uploads/o-que-e-laravel.jpeg\" alt=\"o que &eacute; laravel\" width=\"100%\" height=\"100%\"></p>\r\n<p class=\"mb-2 mt-6 text-lg first:mt-3\">O Laravel &eacute; um dos frameworks PHP mais populares e poderosos para o desenvolvimento web atualmente. Ele oferece uma s&eacute;rie de recursos e funcionalidades que facilitam a cria&ccedil;&atilde;o de aplica&ccedil;&otilde;es web robustas e seguras. Vamos explorar os principais aspectos do Laravel para voc&ecirc; iniciar seus estudos:</p>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Caracter&iacute;sticas Principais</h2>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Arquitetura MVC</h2>\r\n<p>O Laravel utiliza a arquitetura Model-View-Controller (MVC), que separa a l&oacute;gica da aplica&ccedil;&atilde;o em tr&ecirc;s componentes principais:</p>\r\n<ul class=\"marker:text-textOff list-disc pl-8\">\r\n<li><strong>Model</strong>: Respons&aacute;vel pela manipula&ccedil;&atilde;o dos dados e l&oacute;gica de neg&oacute;cios.</li>\r\n<li><strong>View</strong>: Cuida da apresenta&ccedil;&atilde;o dos dados ao usu&aacute;rio.</li>\r\n<li><strong>Controller</strong>: Atua como intermedi&aacute;rio entre o Model e a View<span class=\"whitespace-nowrap\"><br></span></li>\r\n</ul>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Eloquent ORM</h2>\r\n<p>O Laravel inclui o Eloquent ORM, que simplifica a intera&ccedil;&atilde;o com o banco de dados. Com ele, voc&ecirc; pode manipular dados usando c&oacute;digo PHP em vez de escrever consultas SQL diretamente</p>\r\n<p>&nbsp;</p>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Sistema de Template Blade</h2>\r\n<p>O Blade &eacute; o motor de template do Laravel, que facilita a cria&ccedil;&atilde;o de interfaces de usu&aacute;rio din&acirc;micas e reutiliz&aacute;veis</p>\r\n<p>&nbsp;</p>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Artisan CLI</h2>\r\n<p>O Artisan &eacute; uma interface de linha de comando que oferece comandos &uacute;teis para automatizar tarefas comuns de desenvolvimento</p>\r\n<p>&nbsp;</p>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Vantagens do Laravel</h2>\r\n<ol class=\"marker:text-textOff list-decimal pl-8\">\r\n<li><strong>Facilidade de uso</strong>: O Laravel &eacute; conhecido por sua sintaxe elegante e expressiva<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Documenta&ccedil;&atilde;o completa</strong>: Possui uma documenta&ccedil;&atilde;o abrangente e bem organizada<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Comunidade ativa</strong>: H&aacute; uma grande comunidade de desenvolvedores que contribuem e oferecem suporte<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Seguran&ccedil;a</strong>: Inclui recursos de seguran&ccedil;a integrados, como prote&ccedil;&atilde;o contra SQL injection e CSRF<span class=\"whitespace-nowrap\"><br></span></li>\r\n</ol>\r\n<p><img src=\"static/uploads/laravel.png\" alt=\"laravel code\" width=\"100%\" height=\"100%\"></p>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Como Come&ccedil;ar</h2>\r\n<p>Para iniciar seus estudos em Laravel, siga estes passos:</p>\r\n<ol class=\"marker:text-textOff list-decimal pl-8\">\r\n<li><strong>Configure o ambiente de desenvolvimento</strong>: Instale o PHP, Composer e um servidor web local<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Instale o Laravel</strong>: Use o Composer para instalar o Laravel globalmente com o comando:\r\n<div class=\"w-full max-w-[90vw]\">\r\n<div class=\"codeWrapper text-textMainDark selection:!text-superDark selection:bg-superDuper/10 bg-offset dark:bg-offsetDark my-md relative flex flex-col rounded font-mono text-sm font-thin\">\r\n<div>\r\n<div class=\"text-textOff dark:text-textOffDark bg-offsetPlus dark:bg-offsetPlusDark py-xs px-sm z-10 inline-block rounded-br rounded-tl-[3px] font-thin\">&nbsp;</div>\r\n</div>\r\n<div class=\"sc-gtLWhw kqHiRG\"><code>composer global require laravel/installer</code></div>\r\n<div class=\"sc-gtLWhw kqHiRG\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li><strong>Crie seu primeiro projeto</strong>: Utilize o comando:\r\n<div class=\"w-full max-w-[90vw]\">\r\n<div class=\"codeWrapper text-textMainDark selection:!text-superDark selection:bg-superDuper/10 bg-offset dark:bg-offsetDark my-md relative flex flex-col rounded font-mono text-sm font-thin\">\r\n<div>\r\n<div class=\"text-textOff dark:text-textOffDark bg-offsetPlus dark:bg-offsetPlusDark py-xs px-sm z-10 inline-block rounded-br rounded-tl-[3px] font-thin\">&nbsp;</div>\r\n</div>\r\n<div class=\"sc-gtLWhw kqHiRG\"><code>laravel new nome-do-projeto</code></div>\r\n<div class=\"sc-gtLWhw kqHiRG\">&nbsp;</div>\r\n</div>\r\n</div>\r\n<strong>Explore a estrutura do projeto</strong>: Familiarize-se com os diret&oacute;rios e arquivos principais do Laravel<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Aprenda os conceitos b&aacute;sicos</strong>: Estude rotas, controllers, models e views para entender o fluxo de uma aplica&ccedil;&atilde;o Laravel<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Pratique</strong>: Comece com projetos simples e v&aacute; aumentando a complexidade &agrave; medida que ganha confian&ccedil;a<span class=\"whitespace-nowrap\"><br></span></li>\r\n</ol>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Recursos de Aprendizagem</h2>\r\n<ul class=\"marker:text-textOff list-disc pl-8\">\r\n<li><strong>Documenta&ccedil;&atilde;o oficial</strong>: A documenta&ccedil;&atilde;o do Laravel &eacute; um excelente ponto de partida<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Tutoriais online</strong>: Sites como Laravel News e Laracasts oferecem tutoriais gratuitos e pagos<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Cursos em v&iacute;deo</strong>: Plataformas como YouTube t&ecirc;m diversos cursos gratuitos de Laravel<span class=\"whitespace-nowrap\"><br></span></li>\r\n</ul>', 'http://localhost/noticias/uploads/674441121ad31.jpeg', 48, '2024-11-25', '2024-11-27', 1),
(34, 'MVC (Model-View-Controller) no Laravel', 'O Laravel é um dos frameworks PHP mais populares e poderosos para o desenvolvimento web atualmente. Ele oferece uma série de recursos e funcionalidades que facilitam a criação de aplicações web robustas e seguras. Vamos explorar os principais aspectos do ', 'A arquitetura MVC (Model-View-Controller) no Laravel é uma estrutura fundamental que organiza o código de forma lógica e eficiente. Vamos explorar como cada componente funciona no contexto do Laravel:', 'tecnologia da informação', '<p><img src=\"static/uploads/capa-laravel.jpeg\" alt=\"capa-laravel\" width=\"100%\" height=\"100%\"></p>\r\n<p>A arquitetura MVC (Model-View-Controller) no Laravel &eacute; uma estrutura fundamental que organiza o c&oacute;digo de forma l&oacute;gica e eficiente. Vamos explorar como cada componente funciona no contexto do Laravel:</p>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Model (Modelo)</h2>\r\n<p>O Model representa a camada de dados e l&oacute;gica de neg&oacute;cios da aplica&ccedil;&atilde;o</p>\r\n<p>No Laravel:</p>\r\n<p>&nbsp;</p>\r\n<ul class=\"marker:text-textOff list-disc pl-8\">\r\n<li>&Eacute; respons&aacute;vel pela manipula&ccedil;&atilde;o dos dados e intera&ccedil;&atilde;o com o banco de dados.</li>\r\n<li>Utiliza o Eloquent ORM, que simplifica as opera&ccedil;&otilde;es de banco de dados.</li>\r\n<li>Geralmente, cada Model corresponde a uma tabela no banco de dados.</li>\r\n</ul>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">View (Vis&atilde;o)</h2>\r\n<p>A View &eacute; respons&aacute;vel pela apresenta&ccedil;&atilde;o dos dados ao usu&aacute;rio</p>\r\n<p>No Laravel:</p>\r\n<p>&nbsp;</p>\r\n<ul class=\"marker:text-textOff list-disc pl-8\">\r\n<li>Utiliza o sistema de template Blade para criar interfaces din&acirc;micas.</li>\r\n<li>Os arquivos de View s&atilde;o geralmente armazenados no diret&oacute;rio&nbsp;<code>resources/views</code>.</li>\r\n<li>Permitem a mistura de HTML e PHP de forma elegante e organizada.</li>\r\n</ul>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Controller (Controlador)</h2>\r\n<p>O Controller atua como intermedi&aacute;rio entre o Model e a View</p>\r\n<p>No Laravel:</p>\r\n<p>&nbsp;</p>\r\n<ul class=\"marker:text-textOff list-disc pl-8\">\r\n<li>Recebe as requisi&ccedil;&otilde;es HTTP do usu&aacute;rio.</li>\r\n<li>Processa essas requisi&ccedil;&otilde;es, interagindo com o Model quando necess&aacute;rio.</li>\r\n<li>Retorna a resposta apropriada, geralmente renderizando uma View.</li>\r\n</ul>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Fluxo de Funcionamento</h2>\r\n<ol class=\"marker:text-textOff list-decimal pl-8\">\r\n<li><strong>Rota</strong>: O usu&aacute;rio acessa uma URL, que &eacute; mapeada para um m&eacute;todo espec&iacute;fico em um Controller<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Controller</strong>: O m&eacute;todo do Controller &eacute; executado, podendo interagir com o Model para buscar ou manipular dados<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Model</strong>: Se necess&aacute;rio, o Model realiza opera&ccedil;&otilde;es no banco de dados<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>View</strong>: O Controller passa os dados para a View, que renderiza o HTML final<span class=\"whitespace-nowrap\"><br></span></li>\r\n<li><strong>Resposta</strong>: O HTML &eacute; enviado de volta ao navegador do usu&aacute;rio<span class=\"whitespace-nowrap\"><br></span></li>\r\n</ol>\r\n<h2 class=\"mb-2 mt-6 text-lg first:mt-3\">Exemplo Pr&aacute;tico</h2>\r\n<div class=\"w-full max-w-[90vw]\">\r\n<div class=\"codeWrapper text-textMainDark selection:!text-superDark selection:bg-superDuper/10 bg-offset dark:bg-offsetDark my-md relative flex flex-col rounded font-mono text-sm font-thin\">\r\n<div>&nbsp;</div>\r\n<div class=\"sc-gtLWhw kqHiRG\"><img src=\"static/uploads/controller-laravel.PNG\" alt=\"controller-laravel\" width=\"100%\" height=\"100%\"></div>\r\n</div>\r\n</div>\r\n<p>Este exemplo demonstra como uma simples listagem de posts seria implementada seguindo a arquitetura MVC no Laravel</p>\r\n<p>A arquitetura MVC no Laravel promove a separa&ccedil;&atilde;o de responsabilidades, tornando o c&oacute;digo mais organizado, manuten&iacute;vel e escal&aacute;vel. Cada componente tem uma fun&ccedil;&atilde;o clara, facilitando o desenvolvimento e a manuten&ccedil;&atilde;o de aplica&ccedil;&otilde;es web complexas.</p>\r\n<p>&nbsp;</p>', 'http://localhost/noticias/uploads/6744434839bbf.jpeg', 48, '2024-11-25', '2024-11-27', 1),
(35, 'Projetos vs. Processos', 'A cláusula WHERE é a ferramenta fundamental para filtrar dados', 'A cláusula WHERE é a ferramenta fundamental para filtrar dados em consultas MySQL. Ela permite especificar condições que as linhas recuperadas devem atender12. Sintaxe básica:', 'tecnologia da informação', '                Digite seu conteúdo aqui            ', 'http://localhost/noticias/uploads/674623d0e1002.jpeg', 84, '2024-11-25', '2024-11-27', 1),
(36, 'Novo titulo', 'Subtitulo is simply dummy text of the', 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'dicas', 'Vou refatorar o método editarArtigo para melhorar sua estrutura, segurança e legibilidade. Aqui está a versão refatorada:', 'http://localhost/noticias/uploads/6746f3c422dfe.png', 48, '2024-11-26', '2024-11-27', 1);

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
(15, 'tecnologia da informação', 'tecnologia+da+informaçao', 0),
(24, 'programacao', 'programacao', 0),
(25, 'tutorial', 'tutorial', 0),
(26, 'dicas', 'dicas', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.comentarios`
--

CREATE TABLE `tb_site.comentarios` (
  `id` int(11) NOT NULL,
  `comentario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_atualizacao` date DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `artigo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.comentarios`
--

INSERT INTO `tb_site.comentarios` (`id`, `comentario`, `status`, `data_criacao`, `data_atualizacao`, `usuario_id`, `artigo_id`) VALUES
(16, 'Testando comentários', 1, '2024-11-24', NULL, 84, 30),
(17, 'outro comentario', 1, '2024-11-24', NULL, 84, 30),
(18, 'outro comentario', 1, '2024-11-24', NULL, 84, 30),
(19, 'mais um teste', 1, '2024-11-24', NULL, 84, 30),
(20, 'mais', 1, '2024-11-24', NULL, 84, 30),
(21, 'mais', 1, '2024-11-24', NULL, 84, 30),
(22, 'outro comentario', 1, '2024-11-24', NULL, 84, 30),
(23, 'comentando', 1, '2024-11-24', NULL, 84, 30),
(24, 'Teste de comentario 1', 1, '2024-11-24', NULL, 83, 29),
(29, 'comentando!!!', 1, '2024-11-24', NULL, 48, 29);

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
(1, 'Em breve!', 'Em breve teremos novidades!', 'http://localhost/noticias', 'http://localhost/noticias/uploads/6743a5dcb59e1.png'),
(2, 'Conheça nosso BLOG', 'Este é o BLOG NEWS sua fonte de informação!', 'http://locahost/noticias/sobre', 'http://localhost/noticias/uploads/6741ebe2d5fa5.PNG'),
(9, 'Venha me conhecer!', 'A arquitetura MVC (Model-View-Controller) no Laravel é uma estrutura fundamental que organiza', 'https://www.youtube.com/channel/UCdtn2Ngyvowq4bl3WhERGuw', 'http://localhost/noticias/uploads/674445c2a5239.jpeg');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_usuarios_artigos_cards`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_usuarios_artigos_cards` (
`id` int(11)
,`email` varchar(100)
,`cargo` int(1)
,`logado` tinyint(1)
,`nome_completo` varchar(201)
,`avatar` varchar(255)
,`artigo_id` int(11)
,`titulo` varchar(255)
,`descricao` text
,`categoria` varchar(255)
,`status` int(1)
,`imagem_artigo` varchar(255)
,`data_criacao` date
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_usuarios_perfil`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_usuarios_perfil` (
`id` int(11)
,`email` varchar(100)
,`cargo` int(1)
,`status` tinyint(1)
,`logado` tinyint(1)
,`nome` varchar(201)
,`data_nasc` date
,`bio` text
,`sobre` text
,`avatar` varchar(255)
,`capa` varchar(255)
,`cidade` varchar(100)
,`uf` varchar(3)
,`curso` varchar(255)
,`instituicao` varchar(255)
,`nivel` varchar(100)
,`data_inicio` date
,`conclusao` date
,`logo` varchar(255)
,`interesse` varchar(255)
,`descricao` text
,`imagem` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_usuarios_artigos_cards`
--
DROP TABLE IF EXISTS `vw_usuarios_artigos_cards`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_usuarios_artigos_cards`  AS SELECT `u`.`id` AS `id`, `u`.`email` AS `email`, `u`.`cargo` AS `cargo`, `u`.`logado` AS `logado`, concat(coalesce(`p`.`nome`,''),' ',coalesce(`p`.`sobrenome`,'')) AS `nome_completo`, coalesce(`p`.`avatar`,'static/uploads/avatar.jpg') AS `avatar`, `a`.`id` AS `artigo_id`, `a`.`titulo` AS `titulo`, `a`.`descricao` AS `descricao`, `a`.`categoria` AS `categoria`, `a`.`status` AS `status`, coalesce(`a`.`img`,'static/uploads/capa.jpeg') AS `imagem_artigo`, `a`.`data_criacao` AS `data_criacao` FROM ((`tb_admin.usuarios` `u` left join `tb_admin.perfil` `p` on(`u`.`id` = `p`.`usuario_id`)) left join `tb_site.artigos` `a` on(`u`.`id` = `a`.`usuario_id`)) ORDER BY `u`.`id` ASC, `a`.`data_criacao` DESC ;

-- --------------------------------------------------------

--
-- Estrutura para view `vw_usuarios_perfil`
--
DROP TABLE IF EXISTS `vw_usuarios_perfil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_usuarios_perfil`  AS SELECT `u`.`id` AS `id`, `u`.`email` AS `email`, `u`.`cargo` AS `cargo`, `u`.`status` AS `status`, `u`.`logado` AS `logado`, concat(`p`.`nome`,' ',`p`.`sobrenome`) AS `nome`, `p`.`data_nasc` AS `data_nasc`, `p`.`bio` AS `bio`, `p`.`sobre` AS `sobre`, `p`.`avatar` AS `avatar`, `p`.`capa` AS `capa`, `p`.`cidade` AS `cidade`, `p`.`uf` AS `uf`, `f`.`nome` AS `curso`, `f`.`instituicao` AS `instituicao`, `f`.`nivel` AS `nivel`, `f`.`data_inicio` AS `data_inicio`, `f`.`conclusao` AS `conclusao`, `f`.`logo` AS `logo`, `i`.`nome` AS `interesse`, `i`.`descricao` AS `descricao`, `i`.`imagem` AS `imagem` FROM (((`tb_admin.usuarios` `u` join `tb_admin.perfil` `p` on(`u`.`id` = `p`.`usuario_id`)) join `tb_admin.formacao` `f` on(`u`.`id` = `f`.`usuario_id`)) join `tb_admin.interesses` `i` on(`u`.`id` = `i`.`usuario_id`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_admin.formacao`
--
ALTER TABLE `tb_admin.formacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_formacao_usuario` (`usuario_id`);

--
-- Índices de tabela `tb_admin.interesses`
--
ALTER TABLE `tb_admin.interesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_interesses_usuario` (`usuario_id`);

--
-- Índices de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.perfil`
--
ALTER TABLE `tb_admin.perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_perfil_usuarios` (`usuario_id`);

--
-- Índices de tabela `tb_admin.redes_sociais`
--
ALTER TABLE `tb_admin.redes_sociais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_redes_sociais_usuarios` (`usuario_id`);

--
-- Índices de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

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
-- AUTO_INCREMENT de tabela `tb_admin.formacao`
--
ALTER TABLE `tb_admin.formacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_admin.interesses`
--
ALTER TABLE `tb_admin.interesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;

--
-- AUTO_INCREMENT de tabela `tb_admin.perfil`
--
ALTER TABLE `tb_admin.perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `tb_admin.redes_sociais`
--
ALTER TABLE `tb_admin.redes_sociais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT de tabela `tb_site.artigos`
--
ALTER TABLE `tb_site.artigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `tb_site.comentarios`
--
ALTER TABLE `tb_site.comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_admin.formacao`
--
ALTER TABLE `tb_admin.formacao`
  ADD CONSTRAINT `fk_formacao_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `tb_admin.usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_admin.interesses`
--
ALTER TABLE `tb_admin.interesses`
  ADD CONSTRAINT `fk_interesses_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `tb_admin.usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_admin.perfil`
--
ALTER TABLE `tb_admin.perfil`
  ADD CONSTRAINT `fk_perfil_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `tb_admin.usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_admin.redes_sociais`
--
ALTER TABLE `tb_admin.redes_sociais`
  ADD CONSTRAINT `fk_redes_sociais_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `tb_admin.usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_site.artigos`
--
ALTER TABLE `tb_site.artigos`
  ADD CONSTRAINT `fk_artigo_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `tb_admin.usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_site.comentarios`
--
ALTER TABLE `tb_site.comentarios`
  ADD CONSTRAINT `fk_comentario_artigo` FOREIGN KEY (`artigo_id`) REFERENCES `tb_site.artigos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `tb_admin.usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
