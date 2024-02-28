-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Fev-2024 às 10:27
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sgdrh`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateGoalStatuses` ()   BEGIN
    UPDATE sgdrh.metas
    SET idEstadoMeta = '3'
    WHERE idEstadoMeta = '2' AND data_conclusao < NOW();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `senha` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliadors`
--

CREATE TABLE `avaliadors` (
  `idAvaliador` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tituloCargo` varchar(191) NOT NULL,
  `descricao` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `tituloCargo`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'Tello', 'Telleiro', '2023-07-28 18:05:31', '2023-07-28 18:05:31'),
(2, 'Teste', 'teste', '2023-08-01 11:02:27', '2023-08-01 11:02:27'),
(3, 'Designer', 'Web designer', '2023-08-22 14:34:10', '2023-08-22 14:34:10'),
(4, 'Engenheiro DevOps', 'Trabalhar na automação e otimização dos processos de desenvolvimento e operações.', '2023-08-22 15:04:32', '2023-08-22 15:05:16'),
(5, 'Engenheiro de Garantia de Qualidade', 'Responsável por verificar e testar o software para identificar bugs, problemas de usabilidade e outras falhas.', '2023-08-22 15:05:59', '2023-08-22 15:05:59'),
(6, 'Gerente de Projeto', 'Supervisiona o planejamento, execução e monitoramento de projetos.', '2023-08-22 15:06:49', '2023-08-22 15:06:49'),
(7, 'Designer UX/UI', 'Encarregado de criar interfaces e experiências de usuário eficazes e agradáveis para o produto.', '2023-08-22 15:07:24', '2023-08-22 15:07:24'),
(8, 'Desenvolvedor de Software', 'Responsável por escrever, testar e implementar código para criar novos recursos ou melhorar os existentes no produto da startup.', '2023-08-22 15:07:59', '2023-08-22 15:07:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ch_favorites`
--

INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
('5c875a6c-b502-4178-b6c8-f1103f749e6c', 6, 2, '2023-08-05 16:17:44', '2023-08-05 16:17:44'),
('5efe3a38-ac6f-4068-995d-33ff31eed857', 6, 9, '2023-08-05 20:34:34', '2023-08-05 20:34:34'),
('f9dc4983-1b04-464e-b3a9-cdbecebf740d', 2, 6, '2023-08-05 16:10:23', '2023-08-05 16:10:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('032b1eb2-b27b-4804-97a8-95fa3b4a4158', 6, 7, 'ola', NULL, 0, '2023-08-05 16:52:00', '2023-08-05 16:52:00'),
('040a05a5-612f-4fd3-9c16-79f0d6a99b2b', 2, 6, 'a reuni&atilde;o vai se passar na manh&atilde; de segunda feira', NULL, 1, '2023-08-05 16:04:06', '2023-08-05 16:04:28'),
('128851db-193b-4338-9376-037267f729d3', 2, 6, 'hola', NULL, 1, '2023-08-05 15:59:35', '2023-08-05 16:01:16'),
('132a0dea-d93e-4727-8e0b-acd4e8421559', 2, 6, '😐', NULL, 1, '2023-08-05 16:01:34', '2023-08-05 16:01:39'),
('173f273a-d4ea-4d2e-abea-16cf12b016da', 7, 2, 'yo', NULL, 1, '2023-08-27 11:00:52', '2023-08-27 11:01:44'),
('20fcb759-9b4c-4993-bc21-f2f0aebb64ee', 6, 2, 'eu sou o lirio', NULL, 1, '2023-08-05 16:05:16', '2023-08-05 16:05:19'),
('252ead64-ea4c-4340-bf90-cbf32b739d3c', 2, 9, '', '{\"new_name\":\"2115283a-a058-4927-88d0-5db72c26c036.txt\",\"old_name\":\"Novo Documento de Texto.txt\"}', 1, '2023-08-30 11:50:28', '2023-08-30 11:50:51'),
('25a0bb2b-1538-490c-8488-974ebd9b2356', 6, 9, 'hola', NULL, 0, '2023-08-05 16:04:53', '2023-08-05 16:04:53'),
('2a4f1173-b360-4ff4-a54c-891f2c3a7e4a', 6, 7, '', '{\"new_name\":\"fc50823b-631c-451c-a4dd-d5d0ba6e7649.jpg\",\"old_name\":\"170162.jpg\"}', 0, '2023-08-05 16:52:37', '2023-08-05 16:52:37'),
('3f390b8e-da25-48d5-9bda-2b39355182a4', 6, 2, 'hola', NULL, 1, '2023-08-05 16:01:21', '2023-08-05 16:01:27'),
('41bef6de-ba32-415d-88a4-e57bf30312ea', 7, 2, 'obrigado~', NULL, 0, '2023-08-30 13:36:36', '2023-08-30 13:36:36'),
('55d18d46-b0a2-48fd-8193-44cc480d7586', 6, 2, '', '{\"new_name\":\"546379e0-09cb-445d-9c3c-3ab352f71939.txt\",\"old_name\":\"temaAD.txt\"}', 1, '2023-08-05 17:22:43', '2023-08-05 17:22:47'),
('628145fc-abf6-4b26-a07a-8a3f2cf2bfe7', 6, 7, '', '{\"new_name\":\"8034a1b8-c2ae-4810-b682-522088c38476.txt\",\"old_name\":\"Ansewer.txt\"}', 0, '2023-08-05 17:22:11', '2023-08-05 17:22:11'),
('71f0bc30-d9f9-4989-b1a8-50890dec80fe', 9, 2, 'onde fa&ccedil;o o deploy', NULL, 1, '2023-08-22 16:14:04', '2023-08-22 16:14:38'),
('7a86bc9e-229f-43e9-9055-705dad4fb4b9', 2, 7, 'hola', NULL, 1, '2023-08-27 11:01:53', '2023-08-27 11:01:55'),
('8a8ab6f3-5c02-43e6-afe5-dac438792f01', 2, 9, 'no horaku', NULL, 1, '2023-08-22 16:15:10', '2023-08-22 16:15:13'),
('8a8da398-4721-48e9-b4cd-9c2d689f0fe0', 6, 2, 'eu sou o lirio', NULL, 1, '2023-08-05 16:16:18', '2023-08-05 16:20:05'),
('9f0a0cf3-2a74-4abc-a057-5b6e7e62bcb1', 2, 7, 'gg', NULL, 1, '2023-08-05 22:21:44', '2023-08-27 11:00:44'),
('ac46b363-f1e5-4a0a-8d69-4ae0eccf341d', 6, 2, 'N&atilde;o deu', NULL, 1, '2023-08-05 16:44:52', '2023-08-05 17:22:21'),
('b5445be8-861c-45a4-99b0-43faa9edc33f', 2, 7, '', '{\"new_name\":\"d61e479f-d914-47cb-a6dd-067ce05c7a5c.txt\",\"old_name\":\"Novo Documento de Texto.txt\"}', 1, '2023-08-30 11:50:08', '2023-08-30 13:36:05'),
('bb8f5c79-744f-478c-9ada-d6ddac3fbe0e', 2, 6, '', '{\"new_name\":\"6548948b-56a8-4c96-8bd7-0d5fd9d92d8b.jpg\",\"old_name\":\"7309681.jpg\"}', 1, '2023-08-05 17:41:53', '2023-08-05 20:29:55'),
('c7aeb002-898a-4de0-9c2a-5b87965ac48c', 2, 7, 'Ola', NULL, 1, '2023-08-05 16:24:09', '2023-08-27 11:00:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `criterios`
--

CREATE TABLE `criterios` (
  `idCriterio` bigint(20) UNSIGNED NOT NULL,
  `criterio` varchar(191) NOT NULL,
  `classificacao` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `criterios`
--

INSERT INTO `criterios` (`idCriterio`, `criterio`, `classificacao`, `created_at`, `updated_at`) VALUES
(1, 'Preserver', NULL, '2023-08-02 23:27:39', '2023-08-02 23:49:52'),
(2, 'Liderança', NULL, '2023-08-02 23:31:26', '2023-08-02 23:31:26'),
(3, 'Trabalho em equipa', NULL, '2023-08-02 23:51:07', '2023-08-08 10:53:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamentos`
--

CREATE TABLE `departamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(191) NOT NULL,
  `descricao` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `departamentos`
--

INSERT INTO `departamentos` (`id`, `nome`, `descricao`, `created_at`, `updated_at`) VALUES
(5, 'Desenvolvimento', 'Desenvolvedores de software, engenheiros e programadores que projetam, codificam, testam e mantêm os produtos ou aplicativos de software.', '2023-08-22 15:41:28', '2023-08-22 15:41:28'),
(6, 'Gestão de Produtos', 'Departamento de gestão de produtos é responsável por definir a estratégia do produto, o roteiro e os recursos.', '2023-08-22 15:42:10', '2023-08-22 15:42:10'),
(7, 'Design/Experiência do Usuário (UX/UI)', 'Departamento concentra-se em criar interfaces amigáveis e visualmente atraentes', '2023-08-22 15:42:56', '2023-08-22 15:42:56'),
(8, 'Garantia de Qualidade (QA)', 'O departamento de QA garante a qualidade do software projetando e executando testes para identificar bugs, vulnerabilidades e problemas de usabilidade.', '2023-08-22 15:43:26', '2023-08-22 15:43:26'),
(9, 'DevOps', 'Responsável por otimizar os processos de desenvolvimento e operações. Melhorar a velocidade, confiabilidade e escalabilidade das implantações.', '2023-08-22 15:45:06', '2023-08-22 15:45:06'),
(10, 'Vendas e Marketing', 'Promover produtos de software para potenciais clientes. Desenvolver estratégias para alcançar o público-alvo.', '2023-08-22 15:46:09', '2023-08-22 15:46:09'),
(11, 'Finanças e Operações', 'Este departamento lida com a gestão financeira, orçamentação, contabilidade e tarefas operacionais do dia a dia para manter o funcionamento do negócio.', '2023-08-22 15:46:38', '2023-08-22 15:46:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emails`
--

CREATE TABLE `emails` (
  `idEmail` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `emails`
--

INSERT INTO `emails` (`idEmail`, `email`, `created_at`, `updated_at`) VALUES
(3, 'sob@gmail.com', '2023-08-01 10:57:12', '2023-08-01 10:57:12'),
(4, 'ged@email.com', '2023-08-01 11:00:37', '2023-08-01 11:00:37'),
(5, 'ree@email.com', '2023-08-01 11:03:10', '2023-08-01 14:13:51'),
(6, 'joaty@email.com', '2023-08-01 11:31:13', '2023-08-01 11:31:13'),
(7, 'mam@gmail.com', '2023-08-06 23:19:08', '2023-08-06 23:19:08'),
(8, 'and@email.com', '2023-08-22 14:35:18', '2023-08-22 14:35:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipas`
--

CREATE TABLE `equipas` (
  `idEquipa` bigint(20) UNSIGNED NOT NULL,
  `nome_equipa` varchar(191) NOT NULL,
  `descricao` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `equipas`
--

INSERT INTO `equipas` (`idEquipa`, `nome_equipa`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'Alphateste', 'Equipa responsavel pelos testes de software', '2023-08-26 22:26:32', '2023-08-29 21:25:38'),
(3, 'Desi', 'Equipa de design', '2023-08-26 23:05:15', '2023-08-29 21:22:23'),
(6, 'Prog', 'Equipa de programação', '2023-08-27 10:31:04', '2023-08-27 10:31:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `idEstado` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`idEstado`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'ativo', NULL, NULL),
(2, 'não ativo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado_metas`
--

CREATE TABLE `estado_metas` (
  `idEstadoMeta` bigint(20) UNSIGNED NOT NULL,
  `estado_meta` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estado_metas`
--

INSERT INTO `estado_metas` (`idEstadoMeta`, `estado_meta`, `created_at`, `updated_at`) VALUES
(1, 'concluida', NULL, NULL),
(2, 'em progresso', NULL, NULL),
(3, 'não concluida', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo_feedback` varchar(191) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `descricao` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `feedback_respostas`
--

CREATE TABLE `feedback_respostas` (
  `idResposta` bigint(20) UNSIGNED NOT NULL,
  `comentario` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `nome_completo` varchar(191) NOT NULL,
  `sobrenome` varchar(191) DEFAULT NULL,
  `foto` varchar(191) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `idTelefone` int(11) DEFAULT NULL,
  `idEmail` int(11) DEFAULT NULL,
  `idEstado` int(11) NOT NULL,
  `idGenero` int(11) NOT NULL,
  `idEquipa` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `id_departamento`, `id_cargo`, `nome_completo`, `sobrenome`, `foto`, `data_nascimento`, `idTelefone`, `idEmail`, `idEstado`, `idGenero`, `idEquipa`, `created_at`, `updated_at`) VALUES
(4, 7, 7, 'Trry', 'Jerome', '1690907689.jpg', '1990-08-15', 4, 4, 2, 1, NULL, '2023-08-01 11:00:37', '2023-08-22 15:50:22'),
(5, 8, 5, 'Rees', 'terry', '1690905292.jpg', '1995-08-07', 5, 5, 2, 1, NULL, '2023-08-01 11:03:10', '2023-08-22 15:50:06'),
(6, 9, 4, 'Joaty', 'Timóteo João', '1691312956.jpg', '2002-08-14', 6, 6, 1, 2, NULL, '2023-08-01 11:31:13', '2023-08-22 15:49:47'),
(7, 5, 8, 'Jason', 'Mambo', '1691367548.jpg', '2000-08-29', 7, 7, 1, 1, NULL, '2023-08-06 23:19:08', '2023-08-23 12:20:45'),
(8, 5, 8, 'Andrea', 'Da Silva', '1692718518.jpg', '1990-08-14', 8, 8, 1, 2, NULL, '2023-08-22 14:35:18', '2023-08-22 15:52:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `generos`
--

CREATE TABLE `generos` (
  `idGenero` bigint(20) UNSIGNED NOT NULL,
  `genero` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `generos`
--

INSERT INTO `generos` (`idGenero`, `genero`, `created_at`, `updated_at`) VALUES
(1, 'masculino', NULL, NULL),
(2, 'femenino', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `metas`
--

CREATE TABLE `metas` (
  `idMeta` bigint(20) UNSIGNED NOT NULL,
  `atribuir_para` varchar(191) DEFAULT NULL,
  `atribuido_por` varchar(191) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_conclusao` date NOT NULL,
  `descricao_meta` varchar(191) DEFAULT NULL,
  `idTitulo` int(11) DEFAULT NULL,
  `idEstadoMeta` int(11) DEFAULT 2,
  `idEquipa` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `metas`
--

INSERT INTO `metas` (`idMeta`, `atribuir_para`, `atribuido_por`, `data_criacao`, `data_conclusao`, `descricao_meta`, `idTitulo`, `idEstadoMeta`, `idEquipa`, `created_at`, `updated_at`) VALUES
(1, '6', 'PedroLoaz', '2020-07-01', '2020-08-05', 'O botão vermelho e as mensagens em verde.', 1, 1, NULL, '2023-07-30 21:46:00', '2023-08-31 15:08:08'),
(2, '4', 'PedroLoaz', '2020-05-06', '2020-10-07', 'DDDDD', 2, 1, NULL, '2023-07-30 22:03:33', '2023-08-07 00:56:41'),
(3, '5', 'PedroLoaz', '2020-09-01', '2020-11-04', 'mamma', 2, 1, NULL, '2023-07-30 22:48:32', '2023-08-18 00:09:16'),
(4, '5', 'lirio', '2021-04-01', '2021-09-08', 'gerryyyyyyyyyyyyyyyy', 1, 3, NULL, '2023-07-30 22:52:12', '2023-08-18 00:38:47'),
(5, '6', 'rery', '2022-08-01', '2022-08-10', 'yeaaaaaaaaaaaaaaaaah', 2, 1, NULL, '2023-08-01 23:15:06', '2023-08-06 02:19:06'),
(6, '6', 'PedroLoaz', '2023-08-22', '2023-08-31', 'aaaaaaaa', 2, 1, NULL, '2023-08-03 16:09:25', '2023-08-31 13:31:21'),
(14, '4', 'PedroLoaz', '2023-08-01', '2023-12-13', 'Na plataforma de treinamento', 11, 1, NULL, '2023-08-08 18:49:44', '2023-08-31 18:13:42'),
(15, '4', 'PedroLoaz', '2023-08-07', '2023-08-09', 'Tens que vender 20 carros', 12, 1, NULL, '2023-08-08 20:53:10', '2023-08-09 14:52:24'),
(16, '4', 'PedroLoaz', '2023-08-07', '2023-08-10', 'Publicitar usando a pagina', 13, 3, NULL, '2023-08-08 21:19:52', '2023-08-08 21:19:52'),
(17, '6', 'PedroLoaz', '2023-08-14', '2023-09-22', 'Implementar um módulo de bate-papo em tempo real', 14, 3, NULL, '2023-08-22 16:05:34', '2023-08-31 14:04:25'),
(19, '8', 'PedroLoaz', '2023-08-13', '2023-09-07', 'Criar um blog de musica do estilo R&B.', 16, 1, NULL, '2023-08-22 17:21:45', '2023-08-22 17:22:01'),
(20, '7', 'PedroLoaz', '2023-08-14', '2023-08-31', 'Publicar a marca da empresa no facebook', 17, 1, NULL, '2023-08-22 20:49:19', '2023-08-22 20:49:49'),
(21, '4', 'PedroLoaz', '2023-08-22', '2023-08-24', 'A tela tem que ser feita usando cores frias.', 18, 3, NULL, '2023-08-22 22:13:34', '2023-08-22 22:13:34'),
(22, '4', 'PedroLoaz', '2023-08-22', '2023-08-24', 'A tela tem que ser feita usando cores frias.', 19, 1, NULL, '2023-08-22 22:15:09', '2023-08-22 22:36:26'),
(23, '7', 'PedroLoaz', '2023-08-23', '2023-08-26', '<sssssssssss', 23, 3, NULL, '2023-08-23 08:13:52', '2023-08-27 12:30:00'),
(24, '7', 'PedroLoaz', '2023-08-22', '2023-08-26', 'dsdsdsdsdsd', 24, 3, NULL, '2023-08-23 08:31:25', '2023-08-23 08:31:25'),
(25, '7', 'PedroLoaz', '2023-08-22', '2023-08-26', 'dsdsdsdsdsd', 25, 1, NULL, '2023-08-23 08:33:40', '2023-08-23 12:18:04'),
(26, '7', 'PedroLoaz', '2023-08-21', '2023-08-26', 'assssssssssssss', 26, 3, NULL, '2023-08-23 08:39:23', '2023-08-23 08:39:23'),
(27, '7', 'PedroLoaz', '2023-08-20', '2023-08-25', 'aaaaaaaaaaaaaaaaaa', 27, 3, NULL, '2023-08-23 11:38:35', '2023-08-23 11:38:35'),
(28, '8', 'PedroLoaz', '2023-08-14', '2023-09-09', 'paaaaaaaaaaaaaaaaaaaaa', 28, 1, NULL, '2023-08-23 11:41:51', '2023-08-30 11:06:58'),
(29, '8', 'PedroLoaz', '2023-08-23', '2023-09-07', 'aaaaaaaaaaaaaaa', 29, 2, NULL, '2023-08-23 11:55:26', '2023-08-23 11:55:26'),
(30, '8', 'PedroLoaz', '2023-08-23', '2023-08-26', 'aaaaaaaaaaaaa', 30, 1, NULL, '2023-08-23 11:58:30', '2023-08-23 14:21:28'),
(31, '7', 'PedroLoaz', '2023-08-23', '2023-08-26', 'aaaaaaaa', 31, 3, NULL, '2023-08-23 12:02:48', '2023-08-23 12:02:48'),
(32, '6', 'PedroLoaz', '2023-08-13', '2023-08-24', 'aaaaaaaaaaaaa', 32, 3, NULL, '2023-08-23 14:25:26', '2023-08-23 14:25:26'),
(33, '4', 'Query', '2023-08-20', '2023-08-26', 'teste', 33, 3, NULL, '2023-08-23 15:02:20', '2023-08-23 15:05:18'),
(34, NULL, 'PedroLoaz', '2023-08-28', '2023-08-31', 'Alguma coisa', 34, 3, 3, '2023-08-29 15:35:08', '2023-08-29 18:32:17'),
(35, NULL, 'PedroLoaz', '2023-08-28', '2023-08-29', 'Teste', 35, 3, 6, '2023-08-29 15:36:48', '2023-08-29 15:36:48'),
(36, NULL, 'PedroLoaz', '2023-08-20', '2023-09-08', 'aaaaaaaaaaaa', 36, 1, 1, '2023-08-29 15:49:24', '2023-08-29 20:17:11'),
(37, NULL, 'PedroLoaz', '2023-08-29', '2023-08-29', 'ccccccccccccccc', 37, 1, 1, '2023-08-29 16:01:07', '2023-08-29 22:27:45'),
(39, NULL, 'PedroLoaz', '2023-08-27', '2023-09-09', 'aaaaaaaaaa', 39, 1, 3, '2023-08-30 10:06:01', '2023-08-30 10:24:31'),
(41, NULL, 'PedroLoaz', '2023-08-28', '2023-09-09', 'terminar a app, seguindo o guia enviado. 1', 41, 2, 6, '2023-08-30 10:26:32', '2023-08-31 14:41:51'),
(42, NULL, 'PedroLoaz', '2023-08-28', '2023-09-09', 'terminar a app, seguindo o guia enviado.', 42, 1, 3, '2023-08-30 10:28:00', '2023-08-31 13:52:09'),
(43, '8', 'PedroLoaz', '2023-08-28', '2023-09-02', 'teste', 43, 2, NULL, '2023-08-30 10:28:57', '2023-08-30 10:28:57'),
(44, '8', 'PedroLoaz', '2023-08-27', '2023-09-02', 'os botoes têm que ser vermelhos', 44, 2, NULL, '2023-08-30 10:41:39', '2023-08-30 10:41:39'),
(45, NULL, 'PedroLoaz', '2023-08-27', '2023-09-02', 'aaaaaaaaaaa', 45, 2, 3, '2023-08-30 10:54:50', '2023-08-30 10:54:50'),
(46, '6', 'PedroLoaz', '2023-08-29', '2023-09-02', 'Criar e fazer o upload no huroku', 46, 1, NULL, '2023-08-31 15:20:40', '2023-08-31 15:21:36'),
(47, '8', 'PedroLoaz', '2023-08-29', '2023-09-02', 'Criar de forma breve e concisa, tudo cor verde', 47, 2, NULL, '2023-08-31 18:10:46', '2023-08-31 18:10:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '2014_10_12_000000_create_users_table', 1),
(20, '2014_10_12_100000_create_password_resets_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(23, '2022_09_29_213922_create_admins_table', 1),
(24, '2022_09_30_200446_create_departamentos_table', 1),
(25, '2022_10_01_201648_create_funcionarios_table', 1),
(26, '2022_10_04_102124_create_cargos_table', 1),
(27, '2023_05_28_214906_create_telefones_table', 2),
(28, '2023_05_28_215223_create_emails_table', 2),
(29, '2023_05_28_215256_create_feedback_table', 2),
(30, '2023_05_28_220227_create_metas_table', 3),
(31, '2023_05_28_220304_create_titulos_table', 3),
(32, '2023_05_28_220329_create_equipas_table', 3),
(33, '2023_05_28_220354_create_avaliadors_table', 3),
(34, '2023_05_28_220427_create_feedback_respostas_table', 3),
(35, '2023_05_28_220455_create_criterios_table', 3),
(36, '2023_07_29_152823_tipo', 4),
(37, '2023_07_30_214201_create_generos_table', 5),
(38, '2023_07_30_214426_create_estados_table', 6),
(39, '2023_07_30_214507_create_estado_metas_table', 6),
(40, '2023_08_05_999999_add_active_status_to_users', 6),
(41, '2023_08_05_999999_add_avatar_to_users', 6),
(42, '2023_08_05_999999_add_dark_mode_to_users', 6),
(43, '2023_08_05_999999_add_messenger_color_to_users', 6),
(44, '2023_08_05_999999_create_chatify_favorites_table', 6),
(45, '2023_08_05_999999_create_chatify_messages_table', 6),
(46, '2023_08_22_230704_create_notifications_table', 7),
(47, '2023_08_27_143429_equipa_funcionario', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefones`
--

CREATE TABLE `telefones` (
  `idTelefone` int(11) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `telefone2` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `telefones`
--

INSERT INTO `telefones` (`idTelefone`, `telefone`, `telefone2`, `created_at`, `updated_at`) VALUES
(3, '88888888888', '77777777777', '2023-08-01 10:57:12', '2023-08-01 10:57:12'),
(4, '8888888', '77777777777', '2023-08-01 11:00:37', '2023-08-01 14:37:46'),
(5, '454545', '545454', '2023-08-01 11:03:10', '2023-08-01 14:13:51'),
(6, '923123123', '932123123', '2023-08-01 11:31:13', '2023-08-01 11:31:13'),
(7, '6666666666', '6666666667', '2023-08-06 23:19:08', '2023-08-06 23:19:08'),
(8, '985665623', '365996633', '2023-08-22 14:35:18', '2023-08-22 14:35:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos`
--

CREATE TABLE `tipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(191) NOT NULL,
  `descricao` varchar(191) DEFAULT NULL,
  `ativo` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tipos`
--

INSERT INTO `tipos` (`id`, `titulo`, `descricao`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'Sim', NULL, NULL),
(2, 'normal', 'normal', 'Não', NULL, '2023-08-06 08:18:38'),
(22, 'Rest', 'Api2', NULL, '2023-08-20 21:25:13', '2023-08-20 21:25:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `titulos`
--

CREATE TABLE `titulos` (
  `idTitulo` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `titulos`
--

INSERT INTO `titulos` (`idTitulo`, `titulo`, `created_at`, `updated_at`) VALUES
(1, 'Criar o centro de mensagens do TRELO', NULL, '2023-08-31 15:07:33'),
(2, 'Aumentar a produção em 50%', NULL, NULL),
(3, 'Atualizar o website', '2023-08-06 22:27:33', '2023-08-06 22:27:33'),
(4, 'COMPLETAR O SEMINARIO DE FALA', '2023-08-06 22:35:44', '2023-08-06 22:35:44'),
(5, 'COMPLETAR O SEMINARIO DE FALA', '2023-08-06 22:48:21', '2023-08-06 22:48:21'),
(6, 'COMPLETAR O SEMINARIO DE FALA', '2023-08-06 22:49:09', '2023-08-06 22:49:09'),
(7, 'COMPLETAR O SEMINARIO DE FALA', '2023-08-06 22:53:06', '2023-08-06 22:53:06'),
(8, 'COMPLETAR O SEMINARIO DE FALA', '2023-08-06 22:53:51', '2023-08-06 22:53:51'),
(9, 'COMPLETAR O SEMINARIO DE FALA', '2023-08-06 22:54:47', '2023-08-06 22:54:47'),
(10, 'vender 100 carros', '2023-08-06 23:01:25', '2023-08-06 23:01:25'),
(11, 'Completar o curso de liderança', '2023-08-08 18:49:44', '2023-08-08 18:49:44'),
(12, 'Vender 20 carros', '2023-08-08 20:53:10', '2023-08-08 20:53:10'),
(13, 'Publicitar a marca no facebook', '2023-08-08 21:19:52', '2023-08-08 21:19:52'),
(14, 'Desenvolver um novo recurso para o aplicativo.', '2023-08-22 16:05:34', '2023-08-22 16:05:34'),
(15, 'Desenvolver um novo recurso para o aplicativo.', '2023-08-22 16:05:59', '2023-08-22 16:05:59'),
(16, 'Criar um blog de musica', '2023-08-22 17:21:45', '2023-08-22 17:21:45'),
(17, 'Publicitar a marca no facebook', '2023-08-22 20:49:19', '2023-08-22 20:49:19'),
(18, 'fazer a tela de login do SGDRH', '2023-08-22 22:13:34', '2023-08-22 22:13:34'),
(19, 'fazer a tela de login do SGDRH', '2023-08-22 22:15:09', '2023-08-22 22:15:09'),
(20, 'Criar uma campanha', '2023-08-23 08:09:13', '2023-08-23 08:09:13'),
(21, 'Criar uma campanha', '2023-08-23 08:11:17', '2023-08-23 08:11:17'),
(22, 'Criar uma campanha', '2023-08-23 08:12:04', '2023-08-23 08:12:04'),
(23, 'Criar uma campanha', '2023-08-23 08:13:52', '2023-08-23 08:13:52'),
(24, 'deploy a aplicação', '2023-08-23 08:31:25', '2023-08-23 08:31:25'),
(25, 'deploy a aplicação', '2023-08-23 08:33:40', '2023-08-23 08:33:40'),
(26, 'fazer a analise de requisitos do AppLoa', '2023-08-23 08:39:23', '2023-08-23 08:39:23'),
(27, 'Criar Panfletos', '2023-08-23 11:38:35', '2023-08-23 11:38:35'),
(28, 'Trazer 20 clientes para sgdrh', '2023-08-23 11:41:51', '2023-08-23 11:41:51'),
(29, 'por ao ar a aplicação', '2023-08-23 11:55:26', '2023-08-23 11:55:26'),
(30, 'Publicitar a marca no facebook', '2023-08-23 11:58:30', '2023-08-23 11:58:30'),
(31, 'Cuidar dos panfletos', '2023-08-23 12:02:48', '2023-08-23 12:02:48'),
(32, 'Ciar app', '2023-08-23 14:25:26', '2023-08-23 14:25:26'),
(33, 'Cuidar do teste', '2023-08-23 15:02:20', '2023-08-23 15:02:20'),
(34, 'Comprar Pão', '2023-08-29 15:35:08', '2023-08-29 15:35:08'),
(35, 'AAA', '2023-08-29 15:36:48', '2023-08-29 15:36:48'),
(36, 'Teste2', '2023-08-29 15:49:24', '2023-08-29 15:49:24'),
(37, 'aaaaaaaaaaaaa', '2023-08-29 16:01:07', '2023-08-29 16:01:07'),
(38, 'testeDesi', '2023-08-30 10:01:21', '2023-08-30 10:01:21'),
(39, 'Trocar a licensa do OOPu', '2023-08-30 10:06:01', '2023-08-31 14:47:24'),
(40, 'Terminar a app- SGD', '2023-08-30 10:26:10', '2023-08-30 10:26:10'),
(41, 'Terminar a app- SGDD', '2023-08-30 10:26:32', '2023-08-31 14:41:31'),
(42, 'Terminar a app- SGD', '2023-08-30 10:28:00', '2023-08-30 10:28:00'),
(43, 'Terminar a app - JDF', '2023-08-30 10:28:57', '2023-08-30 10:28:57'),
(44, 'fazer a tela de login do SGDRH', '2023-08-30 10:41:39', '2023-08-30 10:41:39'),
(45, 'Desenhar o layout do jogo - monckeybranch', '2023-08-30 10:54:50', '2023-08-30 10:54:50'),
(46, 'Criar um blog de musica', '2023-08-31 15:20:40', '2023-08-31 15:20:40'),
(47, 'Criar Panfletos', '2023-08-31 18:10:46', '2023-08-31 18:10:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `avatar` text DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT '0',
  `idEstado` int(11) NOT NULL DEFAULT 1,
  `idFuncionario` tinyint(4) DEFAULT NULL,
  `id_tipo` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `idEstado`, `idFuncionario`, `id_tipo`, `created_at`, `updated_at`, `active_status`, `dark_mode`, `messenger_color`) VALUES
(2, 'PedroLoaz', '1692647940.jpg', 'r@yahoo.com', NULL, '$2y$10$8lNiCFb5Dl/LvXpyHZpx5Ov9j39HWRbV30WZIvIRHI83uKYOU9aUC', 'Clzv5PyceBmSrJA71wBPbg7ZERK0SJ0TxavBCXm2Ja2I5RFw3aVjo3g2W6QW', 'admin', 1, 4, 0, '2023-07-28 18:55:02', '2023-08-30 15:31:10', 1, 1, '#FFC107'),
(6, 'Jason Correa', '1692320941.png', 'li@email.com', NULL, '$2y$10$14Okh8BEoKpFfbpP67F5V.xe/KqvW.QVh.HK8TXrt1993j90gQ.oS', 'XjCsiUSjW5uxn4uzTECdrHTVTFfGkKCvwhGhDK0UOVMDgBRMuKFfJpvIdGCT', 'normal', 1, 7, 0, '2023-07-29 14:13:18', '2023-08-23 14:23:25', 1, 1, '#FFC107'),
(7, 'Joaty João', '1693498699.jpg', 're@email.com', NULL, '$2y$10$/MUmd8bvLomTgXCB2eJ0Lutpf61EyaYoBTI0Va0iiycl4ctp2/BIa', '2CmPA4wm0IbHwifYxvjisFy5YfYN1CHvsgTzNq1FM1Zetvn7QzG2988vDlgB', 'normal', 1, 6, 0, '2023-08-01 22:03:24', '2023-08-31 15:18:19', 0, 0, '#2180f3'),
(9, 'andrea sellina', '1690935470.jpg', 'sell@email.com', NULL, '$2y$10$rbISqyJsvwFXpySooMGWFusvuLVpeFs.Rmqsrw10LAtDHVFEsqwgC', 'CS4Teb87mrRtrs4KoVwF67E9wg8zw3345HpUjrKU9A3gsigX6RU1Z9pmpGEj', 'normal', 1, 8, 0, '2023-08-01 23:17:50', '2023-08-22 16:40:37', 1, 0, NULL),
(10, 'Tellor Hub', '1691316118.jpg', 'tellor@email.com', NULL, '$2y$10$IHJKMgrXM2xMHCty9NdB5OAJDaqL/uJ2Dk4H3HGr2S8vh256PAzB.', '4AFglPBiGPS00hG85lFBsprQUdiuGgdAzdIO9J2z4Qm1m7J0rKj4DReTmDUV', 'normal', 1, 5, 0, '2023-08-06 09:01:58', '2023-08-06 09:07:33', 0, 0, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `avaliadors`
--
ALTER TABLE `avaliadors`
  ADD PRIMARY KEY (`idAvaliador`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `criterios`
--
ALTER TABLE `criterios`
  ADD PRIMARY KEY (`idCriterio`);

--
-- Índices para tabela `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`idEmail`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `equipas`
--
ALTER TABLE `equipas`
  ADD PRIMARY KEY (`idEquipa`);

--
-- Índices para tabela `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Índices para tabela `estado_metas`
--
ALTER TABLE `estado_metas`
  ADD PRIMARY KEY (`idEstadoMeta`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `feedback_respostas`
--
ALTER TABLE `feedback_respostas`
  ADD PRIMARY KEY (`idResposta`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`idGenero`);

--
-- Índices para tabela `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`idMeta`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `telefones`
--
ALTER TABLE `telefones`
  ADD PRIMARY KEY (`idTelefone`),
  ADD UNIQUE KEY `telefone` (`telefone`,`telefone2`);

--
-- Índices para tabela `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `titulos`
--
ALTER TABLE `titulos`
  ADD PRIMARY KEY (`idTitulo`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliadors`
--
ALTER TABLE `avaliadors`
  MODIFY `idAvaliador` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `criterios`
--
ALTER TABLE `criterios`
  MODIFY `idCriterio` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `emails`
--
ALTER TABLE `emails`
  MODIFY `idEmail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `equipas`
--
ALTER TABLE `equipas`
  MODIFY `idEquipa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estado_metas`
--
ALTER TABLE `estado_metas`
  MODIFY `idEstadoMeta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `feedback_respostas`
--
ALTER TABLE `feedback_respostas`
  MODIFY `idResposta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `generos`
--
ALTER TABLE `generos`
  MODIFY `idGenero` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `metas`
--
ALTER TABLE `metas`
  MODIFY `idMeta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `telefones`
--
ALTER TABLE `telefones`
  MODIFY `idTelefone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `titulos`
--
ALTER TABLE `titulos`
  MODIFY `idTitulo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `update_meta_status` ON SCHEDULE EVERY 1 DAY STARTS '2023-08-23 09:24:04' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE sgdrh.metas
    SET idEstadoMeta = '3'
    WHERE idEstadoMeta = '2' AND data_conclusao < NOW()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
