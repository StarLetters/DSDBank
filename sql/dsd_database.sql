-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-dsd.alwaysdata.net
-- Generation Time: Feb 16, 2024 at 09:20 AM
-- Server version: 10.6.16-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsd_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `ClientFinal`
--

CREATE TABLE `ClientFinal` (
  `idClient` int(11) NOT NULL,
  `numCarteClient` char(16) NOT NULL,
  `reseauClient` enum('CB','VS','MC') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ClientFinal`
--

INSERT INTO `ClientFinal` (`idClient`, `numCarteClient`, `reseauClient`) VALUES
(1, '1456********6874', 'MC'),
(2, '8957********9752', 'CB'),
(3, '4812********3951', 'VS'),
(4, '8714********5467', 'CB'),
(5, '1056********9547', 'CB'),
(6, '2683********7295', 'VS'),
(7, '7943********7553', 'MC'),
(8, '8042********1483', 'VS'),
(9, '0428********8974', 'CB'),
(10, '6484********°984', 'MC'),
(11, '5454********2857', 'CB'),
(12, '7452********6593', 'MC'),
(13, '5482********8529', 'CB'),
(14, '7924********0954', 'CB'),
(15, '2850********5720', 'VS'),
(16, '6597********8407', 'MC');

-- --------------------------------------------------------

--
-- Table structure for table `Entreprise`
--

CREATE TABLE `Entreprise` (
  `idUtilisateur` int(11) NOT NULL,
  `numSiren` char(9) NOT NULL,
  `raisonSociale` char(20) NOT NULL,
  `verifier` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Entreprise`
--

INSERT INTO `Entreprise` (`idUtilisateur`, `numSiren`, `raisonSociale`, `verifier`) VALUES
(33, '654685145', 'Apple Lognes', 1),
(34, '549187354', 'Amazon Torcy', 1),
(35, '156441456', 'KFC Noisy', 1),
(36, '999999999', 'Fnac Noisy', 1),
(37, '111111111', 'Action Noisy', 1),
(40, '100111111', 'Sushibar Noisy', 1),
(43, '654181783', 'Mochi SARL', 1),
(53, '872418465', 'mochi', 0),
(54, '854987221', 'yoooluucas', 0),
(55, '787454569', 'lucaslebossss', 0),
(56, '987654328', 'tessssst', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Impaye`
--

CREATE TABLE `Impaye` (
  `numDossierImpaye` char(5) NOT NULL,
  `libelleImpaye` enum('fraude à la carte','compte à découvert','compte clôturé','compte bloqué','provision insuffisante','opération contestée','titulaire décédé','raison non communiquée') NOT NULL,
  `idTransaction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Impaye`
--

INSERT INTO `Impaye` (`numDossierImpaye`, `libelleImpaye`, `idTransaction`) VALUES
('00001', 'compte à découvert', 9),
('00002', 'compte bloqué', 14),
('00003', 'compte à découvert', 19),
('00004', 'raison non communiquée', 23),
('00005', 'opération contestée', 87),
('00006', 'provision insuffisante', 85),
('00007', 'provision insuffisante', 94),
('00008', 'titulaire décédé', 81),
('00009', 'provision insuffisante', 90),
('00011', 'compte bloqué', 89),
('00012', 'provision insuffisante', 91),
('00013', 'fraude à la carte', 27),
('00014', 'provision insuffisante', 82),
('00015', 'compte clôturé', 156),
('00016', 'compte clôturé', 157),
('00017', 'titulaire décédé', 158),
('00018', 'raison non communiquée', 159),
('00019', 'compte à découvert', 160),
('00020', 'compte à découvert', 161),
('00021', 'provision insuffisante', 162),
('00022', 'compte à découvert', 163),
('00023', 'opération contestée', 164),
('00024', 'opération contestée', 165),
('00025', 'compte à découvert', 166),
('00026', 'provision insuffisante', 167),
('00027', 'provision insuffisante', 168),
('00028', 'compte bloqué', 169),
('00029', 'opération contestée', 170),
('00030', 'compte clôturé', 171),
('00031', 'raison non communiquée', 172),
('00032', 'fraude à la carte', 173),
('00033', 'opération contestée', 174),
('00034', 'provision insuffisante', 175),
('00035', 'compte clôturé', 176),
('00036', 'compte bloqué', 177),
('00037', 'opération contestée', 178),
('00038', 'compte bloqué', 179),
('00039', 'titulaire décédé', 180),
('00040', 'raison non communiquée', 181),
('00041', 'fraude à la carte', 182),
('00042', 'compte clôturé', 183),
('00043', 'compte bloqué', 184),
('00044', 'provision insuffisante', 185),
('05979', 'raison non communiquée', 319),
('06056', 'compte à découvert', 329),
('07057', 'raison non communiquée', 317),
('07302', 'compte à découvert', 321),
('07428', 'compte clôturé', 315),
('10981', 'provision insuffisante', 306),
('11502', 'compte clôturé', 334),
('12069', 'compte clôturé', 324),
('12548', 'compte clôturé', 356),
('13794', 'opération contestée', 353),
('14624', 'titulaire décédé', 355),
('15506', 'opération contestée', 354),
('16659', 'titulaire décédé', 350),
('18562', 'provision insuffisante', 320),
('19811', 'fraude à la carte', 308),
('20804', 'compte clôturé', 312),
('26576', 'compte bloqué', 325),
('26908', 'raison non communiquée', 331),
('26978', 'titulaire décédé', 352),
('27088', 'compte clôturé', 341),
('29231', 'compte bloqué', 310),
('30234', 'compte à découvert', 360),
('33158', 'compte clôturé', 323),
('33687', 'provision insuffisante', 332),
('43853', 'compte clôturé', 333),
('44789', 'titulaire décédé', 318),
('45648', 'provision insuffisante', 361),
('46120', 'compte à découvert', 326),
('48677', 'compte bloqué', 348),
('53902', 'fraude à la carte', 311),
('54198', 'compte clôturé', 338),
('56670', 'compte à découvert', 364),
('58118', 'fraude à la carte', 363),
('62405', 'provision insuffisante', 345),
('62491', 'titulaire décédé', 346),
('62877', 'compte bloqué', 314),
('65117', 'compte à découvert', 313),
('68298', 'compte bloqué', 340),
('69116', 'opération contestée', 328),
('69364', 'raison non communiquée', 359),
('76772', 'compte clôturé', 309),
('76817', 'compte bloqué', 330),
('78121', 'titulaire décédé', 358),
('80658', 'opération contestée', 336),
('82117', 'opération contestée', 351),
('82425', 'provision insuffisante', 335),
('82804', 'raison non communiquée', 316),
('85242', 'opération contestée', 347),
('86135', 'titulaire décédé', 349),
('86649', 'raison non communiquée', 357),
('87340', 'compte bloqué', 307),
('91304', 'opération contestée', 343),
('92738', 'compte à découvert', 362),
('96059', 'compte bloqué', 337),
('97093', 'titulaire décédé', 322),
('97521', 'compte à découvert', 365);

-- --------------------------------------------------------

--
-- Table structure for table `POrequete`
--

CREATE TABLE `POrequete` (
  `idRequete` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type_requete` enum('suppression','inscription') NOT NULL,
  `date_requete` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `POrequete`
--

INSERT INTO `POrequete` (`idRequete`, `email`, `type_requete`, `date_requete`) VALUES
(5, 'action.noisy@gmail.com', 'suppression', '2023-12-07 13:00:34'),
(7, 'fnac.noisy@gmail.com', 'suppression', '2023-11-04 17:03:50'),
(16, 'merlin.lucas99@gmail.com', 'inscription', '2023-12-14 13:28:45'),
(17, 'lucas@gmail.com', 'inscription', '2023-12-14 15:20:26'),
(18, 'tt@gmail.com', 'inscription', '2023-12-20 22:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `Remise`
--

CREATE TABLE `Remise` (
  `numRemise` char(19) NOT NULL,
  `dateRemise` date NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Remise`
--

INSERT INTO `Remise` (`numRemise`, `dateRemise`, `idUtilisateur`) VALUES
('1', '2022-01-01', 33),
('10', '2023-10-25', 35),
('11', '2023-11-07', 33),
('12', '2023-11-17', 34),
('13', '2023-11-30', 35),
('14', '2023-12-09', 33),
('15', '2020-09-01', 34),
('16', '2021-02-25', 34),
('2', '2021-12-15', 33),
('3', '2022-09-15', 35),
('4', '2023-07-06', 35),
('5', '2023-09-09', 33),
('6', '2023-09-20', 34),
('7', '2023-09-28', 35),
('8', '2023-10-01', 33),
('9', '2023-10-12', 34);

-- --------------------------------------------------------

--
-- Table structure for table `Token`
--

CREATE TABLE `Token` (
  `idToken` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` char(16) NOT NULL,
  `date_valid` date NOT NULL,
  `type` enum('verification','reinitialisation','connexion') NOT NULL,
  `etat` enum('off','on','used') NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Token`
--

INSERT INTO `Token` (`idToken`, `email`, `token`, `date_valid`, `type`, `etat`) VALUES
(171, 'elae.dsd@gmail.com', '2b368650b7272c22', '2023-11-19', 'connexion', 'off'),
(172, 'po@gmail.com', '2b5a47b60ec60ad8', '2023-11-19', 'connexion', 'off'),
(173, 'po@gmail.com', '55e9c461e55850e8', '2023-11-19', 'connexion', 'off'),
(174, 'kfc.noisy@gmail.com', '70124565d527062d', '2023-11-19', 'connexion', 'off'),
(175, 'kfc.noisy@gmail.com', '2833bc82ca3a9fdb', '2023-11-20', 'connexion', 'off'),
(176, 'kfc.noisy@gmail.com', 'b8743b65f573b2b0', '2023-11-20', 'connexion', 'off'),
(177, 'po@gmail.com', '13231040fcd271b8', '2023-11-20', 'connexion', 'off'),
(178, 'po@gmail.com', 'a731d9bd1e152606', '2023-11-20', 'connexion', 'off'),
(179, 'kfc.noisy@gmail.com', '943136921f0ce0c9', '2023-11-20', 'connexion', 'off'),
(180, 'kfc.noisy@gmail.com', '381ee1989f9be6d2', '2023-11-20', 'connexion', 'off'),
(181, 'po@gmail.com', 'f7604677aa34f1ca', '2023-11-20', 'connexion', 'off'),
(182, 'kfc.noisy@gmail.com', '21e99dd2e4ccbe54', '2023-11-20', 'connexion', 'off'),
(183, 'kfc.noisy@gmail.com', '222f2e794eb27ead', '2023-11-22', 'connexion', 'off'),
(184, 'kfc.noisy@gmail.com', '154845361d946ec9', '2023-11-23', 'connexion', 'off'),
(185, 'kfc.noisy@gmail.com', 'ab0decde58c15c1d', '2023-11-23', 'connexion', 'off'),
(186, 'kfc.noisy@gmail.com', 'e4fc3f350203053f', '2023-11-23', 'connexion', 'off'),
(187, 'kfc.noisy@gmail.com', '5cf0ec2e41b80c5a', '2023-11-23', 'connexion', 'off'),
(188, 'po@gmail.com', '649532f188d6bf52', '2023-11-23', 'connexion', 'off'),
(189, 'kfc.noisy@gmail.com', '8081cfb46059e65f', '2023-11-23', 'connexion', 'off'),
(190, 'po@gmail.com', '33fe4897cab95550', '2023-11-24', 'connexion', 'off'),
(191, 'kfc.noisy@gmail.com', '47ccf005fe1c679c', '2023-11-24', 'connexion', 'off'),
(192, 'kfc.noisy@gmail.com', 'bd2a886ebb822351', '2023-11-25', 'connexion', 'off'),
(193, 'po@gmail.com', '7ea7729639f50a9d', '2023-11-26', 'connexion', 'off'),
(194, 'kfc.noisy@gmail.com', '88d2e653976c84d4', '2023-11-26', 'connexion', 'off'),
(195, 'elae.dsd@gmail.com', '12587b01125c3e7d', '2023-11-26', 'connexion', 'off'),
(196, 'kfc.noisy@gmail.com', 'a5bbd71c2fa16109', '2023-11-27', 'connexion', 'off'),
(197, 'kfc.noisy@gmail.com', '5bfb6bd7e1faced3', '2023-11-27', 'connexion', 'off'),
(198, 'kfc.noisy@gmail.com', '4575da81ccba8774', '2023-11-27', 'connexion', 'off'),
(199, 'kfc.noisy@gmail.com', '67ff211fd1d80621', '2023-11-27', 'connexion', 'off'),
(200, 'po@gmail.com', 'f9d485ee08f35e0f', '2023-11-27', 'connexion', 'off'),
(201, 'kfc.noisy@gmail.com', 'd0b39cac2711095e', '2023-11-27', 'connexion', 'off'),
(202, 'kfc.noisy@gmail.com', '6b6f0f3095cd51de', '2023-11-27', 'connexion', 'off'),
(203, 'po@gmail.com', '5285a6e6c4dad65d', '2023-11-27', 'connexion', 'off'),
(204, 'kfc.noisy@gmail.com', '5db1e8bd725f730e', '2023-11-27', 'connexion', 'off'),
(205, 'po@gmail.com', '7a7dda0604ceca4f', '2023-11-27', 'connexion', 'off'),
(206, 'kfc.noisy@gmail.com', '9fbad61507896045', '2023-11-28', 'connexion', 'off'),
(207, 'po@gmail.com', 'ef21fb5d0ab2e457', '2023-11-28', 'connexion', 'off'),
(208, 'po@gmail.com', '9ed46a4761c50122', '2023-11-28', 'connexion', 'off'),
(209, 'kfc.noisy@gmail.com', '6a29cb569d9e7ad7', '2023-11-28', 'connexion', 'off'),
(210, 'kfc.noisy@gmail.com', '05f2bc07c0e9e760', '2023-11-28', 'connexion', 'off'),
(211, 'elae.dsd@gmail.com', 'b15bb7bb8e9d3de5', '2023-12-02', 'connexion', 'off'),
(212, 'kfc.noisy@gmail.com', 'd7ca184710643a4e', '2023-12-02', 'connexion', 'off'),
(213, 'kfc.noisy@gmail.com', '81ba7fe55f05eefb', '2023-12-02', 'connexion', 'off'),
(214, 'elae.dsd@gmail.com', 'e11e29f84011d320', '2023-12-02', 'connexion', 'off'),
(215, 'kfc.noisy@gmail.com', '8eb71908431d722c', '2023-12-02', 'connexion', 'off'),
(216, 'kfc.noisy@gmail.com', '742f739b1e746959', '2023-12-03', 'connexion', 'off'),
(217, 'po@gmail.com', '14e7a745ddbe3cba', '2023-12-03', 'connexion', 'off'),
(218, 'kfc.noisy@gmail.com', '61e256d8900d39e9', '2023-12-03', 'connexion', 'off'),
(219, 'kfc.noisy@gmail.com', '558a7dbb89e7b0bf', '2023-12-04', 'connexion', 'off'),
(220, 'po@gmail.com', '46f87cb678fdd018', '2023-12-04', 'connexion', 'off'),
(221, 'po@gmail.com', 'e3c685d17cacfe38', '2023-12-04', 'connexion', 'off'),
(222, 'kfc.noisy@gmail.com', '3e89579917ef8665', '2023-12-04', 'connexion', 'off'),
(223, 'po@gmail.com', 'bb9a3d1a6a46cc84', '2023-12-05', 'connexion', 'off'),
(224, 'po@gmail.com', 'e32b1a392d64cdd2', '2023-12-05', 'connexion', 'off'),
(225, 'po@gmail.com', '142aa6ccdddb8941', '2023-12-05', 'connexion', 'off'),
(226, 'kfc.noisy@gmail.com', '6e0c1033e51d3695', '2023-12-05', 'connexion', 'off'),
(227, 'kfc.noisy@gmail.com', 'd15b9c18ad05f4a3', '2023-12-05', 'connexion', 'off'),
(228, 'po@gmail.com', '2266988f1318a154', '2023-12-05', 'connexion', 'off'),
(229, 'po@gmail.com', '365f1e42a1121bc1', '2023-12-05', 'connexion', 'off'),
(230, 'kfc.noisy@gmail.com', '33e1e8150b37ff2a', '2023-12-06', 'connexion', 'off'),
(231, 'po@gmail.com', '0586b378ea5a81dd', '2023-12-06', 'connexion', 'off'),
(232, 'po@gmail.com', '27482bd8fd0d7cc6', '2023-12-06', 'connexion', 'off'),
(233, 'po@gmail.com', '3e07d2a4b4f0204d', '2023-12-06', 'connexion', 'off'),
(234, 'kfc.noisy@gmail.com', '09ddf4d2b4af1e3c', '2023-12-10', 'connexion', 'off'),
(235, 'kfc.noisy@gmail.com', '6382e49c64a9ebbe', '2023-12-10', 'connexion', 'off'),
(236, 'kfc.noisy@gmail.com', 'a654a03aa745246d', '2023-12-11', 'connexion', 'off'),
(237, 'po@gmail.com', '86189e78319ab957', '2023-12-11', 'connexion', 'off'),
(238, 'kfc.noisy@gmail.com', '8e330624487dcbe2', '2023-12-11', 'connexion', 'off'),
(239, 'po@gmail.com', 'ad327a1bd4fa3f0e', '2023-12-11', 'connexion', 'off'),
(240, 'po@gmail.com', 'f74b4cac36b57f72', '2023-12-11', 'connexion', 'off'),
(241, 'po@gmail.com', '0489ce00a9165cc5', '2023-12-11', 'connexion', 'off'),
(242, 'po@gmail.com', '27094d74ab7e6f78', '2023-12-12', 'connexion', 'off'),
(243, 'kfc.noisy@gmail.com', '541503822f3c3f60', '2023-12-12', 'connexion', 'off'),
(244, 'po@gmail.com', '9d3d8cf36fa8ac0a', '2023-12-12', 'connexion', 'off'),
(245, 'po@gmail.com', 'f5ead9a9c13acad5', '2023-12-12', 'connexion', 'off'),
(246, 'po@gmail.com', '2a45f551edbc8cd6', '2023-12-12', 'connexion', 'off'),
(247, 'po@gmail.com', '930777f8e971cf2e', '2023-12-12', 'connexion', 'off'),
(248, 'kfc.noisy@gmail.com', '2ca74e4ae1360a79', '2023-12-12', 'connexion', 'off'),
(249, 'po@gmail.com', '6f57b338353aee24', '2023-12-12', 'connexion', 'off'),
(250, 'kfc.noisy@gmail.com', '9335c4059bbcae33', '2023-12-12', 'connexion', 'off'),
(251, 'po@gmail.com', 'bbd3dd7aaefc6ca0', '2023-12-12', 'connexion', 'off'),
(252, 'kfc.noisy@gmail.com', '7c612c1fcce57e31', '2023-12-12', 'connexion', 'off'),
(253, 'po@gmail.com', '3b302220ebecccf4', '2023-12-12', 'connexion', 'off'),
(254, 'kfc.noisy@gmail.com', 'd33f94f406566006', '2023-12-12', 'connexion', 'off'),
(255, 'po@gmail.com', 'f5682d20099ae074', '2023-12-12', 'connexion', 'off'),
(256, 'kfc.noisy@gmail.com', '21f74897418d0cfc', '2023-12-12', 'connexion', 'off'),
(257, 'po@gmail.com', '9fa177a7a95f32b1', '2023-12-12', 'connexion', 'off'),
(258, 'po@gmail.com', 'ad96b025bd4b0644', '2023-12-12', 'connexion', 'off'),
(259, 'po@gmail.com', '552ad20a0cec378f', '2023-12-13', 'connexion', 'off'),
(260, 'po@gmail.com', 'c7e4c0c78206ba14', '2023-12-13', 'connexion', 'off'),
(261, 'po@gmail.com', '3915e55748dda5de', '2023-12-13', 'connexion', 'off'),
(262, 'po@gmail.com', 'e7d7ee84ccd3e69c', '2023-12-13', 'connexion', 'off'),
(263, 'kfc.noisy@gmail.com', '4fe2bc8e091266ef', '2023-12-13', 'connexion', 'off'),
(264, 'po@gmail.com', 'd69d17f58b5b984c', '2023-12-13', 'connexion', 'off'),
(265, 'po@gmail.com', 'd6ad9242fdd7b7a7', '2023-12-13', 'connexion', 'off'),
(266, 'kfc.noisy@gmail.com', '25832feed978e274', '2023-12-13', 'connexion', 'off'),
(267, 'po@gmail.com', 'd11868aa1223a413', '2023-12-13', 'connexion', 'off'),
(268, 'elae.dsd@gmail.com', 'ac8423336d87de7a', '2023-12-13', 'connexion', 'off'),
(269, 'po@gmail.com', '79da021d4beb8a1c', '2023-12-13', 'connexion', 'off'),
(270, 'po@gmail.com', '763ba70233e06756', '2023-12-13', 'connexion', 'off'),
(271, 'po@gmail.com', '908f2d76b1d85c30', '2023-12-13', 'connexion', 'off'),
(272, 'elae.dsd@gmail.com', 'c73e5a3d9e47ea7b', '2023-12-13', 'connexion', 'off'),
(273, 'kfc.noisy@gmail.com', '9a07830587c236c0', '2023-12-13', 'connexion', 'off'),
(274, 'elae.dsd@gmail.com', '7d9d896679af9443', '2023-12-13', 'connexion', 'off'),
(275, 'po@gmail.com', 'b590102ab7647158', '2023-12-13', 'connexion', 'off'),
(276, 'po@gmail.com', 'e0b1fa4fac9eb7a1', '2023-12-13', 'connexion', 'off'),
(277, 'elae.dsd@gmail.com', '17460c3cef7816d7', '2023-12-13', 'connexion', 'off'),
(278, 'po@gmail.com', '323b3fad66a480a6', '2023-12-13', 'connexion', 'off'),
(279, 'kfc.noisy@gmail.com', 'd56a7eb1ffeed5f2', '2023-12-13', 'connexion', 'off'),
(280, 'po@gmail.com', '4acacda41882dc41', '2023-12-13', 'connexion', 'off'),
(281, 'po@gmail.com', '031cac55d1bd2030', '2023-12-13', 'connexion', 'off'),
(282, 'po@gmail.com', '772c2babb5a1c8d5', '2023-12-13', 'connexion', 'off'),
(283, 'elae.dsd@gmail.com', 'fccd552504fe96b2', '2023-12-13', 'connexion', 'off'),
(284, 'kfc.noisy@gmail.com', 'e9e9a2b1b83ef06a', '2023-12-13', 'connexion', 'off'),
(286, 'po@gmail.com', 'c3a14a82e2b67128', '2023-12-13', 'connexion', 'off'),
(287, 'po@gmail.com', 'edc4bcfeb088c450', '2023-12-13', 'connexion', 'off'),
(289, 'po@gmail.com', '15b0429ed52e8868', '2023-12-13', 'connexion', 'off'),
(290, 'po@gmail.com', '358860981d9b961d', '2023-12-13', 'connexion', 'off'),
(291, 'po@gmail.com', '37187c6029b6c4d7', '2023-12-13', 'connexion', 'off'),
(292, 'po@gmail.com', '4ad493c3cc2e9978', '2023-12-13', 'connexion', 'off'),
(293, 'kfc.noisy@gmail.com', '4cde5d9918d59549', '2023-12-13', 'connexion', 'off'),
(294, 'po@gmail.com', '857d9cecd1aa3291', '2023-12-13', 'connexion', 'off'),
(295, 'kfc.noisy@gmail.com', '28a65e939dbc414c', '2023-12-13', 'connexion', 'off'),
(296, 'po@gmail.com', 'bc47fb84513b01e2', '2023-12-13', 'connexion', 'off'),
(297, 'po@gmail.com', 'e670ba70747c55c0', '2023-12-13', 'connexion', 'off'),
(298, 'kfc.noisy@gmail.com', '9dc86d16d0f42fcb', '2023-12-13', 'connexion', 'off'),
(299, 'kfc.noisy@gmail.com', '036ce18269cc4882', '2023-12-13', 'connexion', 'off'),
(301, 'po@gmail.com', 'cc23b763cb97ffb7', '2023-12-13', 'connexion', 'off'),
(302, 'po@gmail.com', '86fa45057705b9eb', '2023-12-13', 'connexion', 'off'),
(303, 'kfc.noisy@gmail.com', '4e58b9e3414d5f4e', '2023-12-13', 'connexion', 'off'),
(304, 'kfc.noisy@gmail.com', '7ed7555ae8b0ac8e', '2023-12-13', 'connexion', 'off'),
(306, 'elae.dsd@gmail.com', '77c580e17ee52cc4', '2023-12-13', 'connexion', 'off'),
(307, 'po@gmail.com', '277800ad27cdb9a2', '2023-12-13', 'connexion', 'off'),
(308, 'po@gmail.com', '04549fd6da199460', '2023-12-13', 'connexion', 'off'),
(309, 'kfc.noisy@gmail.com', 'b29f962e1a1f5aba', '2023-12-13', 'connexion', 'off'),
(310, 'kfc.noisy@gmail.com', 'fa04f3b9ff2fb787', '2023-12-13', 'connexion', 'off'),
(311, 'po@gmail.com', 'f484e63ad323af8a', '2023-12-13', 'connexion', 'off'),
(312, 'po@gmail.com', '5ee1a9b58043b739', '2023-12-13', 'connexion', 'off'),
(313, 'kfc.noisy@gmail.com', '22699a97291b9ae2', '2023-12-13', 'connexion', 'off'),
(314, 'kfc.noisy@gmail.com', 'cd1aa4612f599aa4', '2023-12-13', 'connexion', 'off'),
(315, 'kfc.noisy@gmail.com', 'dcdce50df4b333a9', '2023-12-13', 'connexion', 'off'),
(316, 'elae.dsd@gmail.com', 'c74827a80f4acbd9', '2023-12-13', 'connexion', 'off'),
(317, 'kfc.noisy@gmail.com', '03dea42dd1d5d9cd', '2023-12-13', 'connexion', 'off'),
(319, 'po@gmail.com', 'e738c8db5fba5a60', '2023-12-13', 'connexion', 'off'),
(320, 'po@gmail.com', '875c30012384c379', '2023-12-13', 'connexion', 'off'),
(321, 'kfc.noisy@gmail.com', 'ff6888955440b45c', '2023-12-13', 'connexion', 'off'),
(322, 'kfc.noisy@gmail.com', 'd0cd57589d0c400f', '2023-12-13', 'connexion', 'off'),
(323, 'po@gmail.com', 'f5e4078ae7fd37e5', '2023-12-13', 'connexion', 'off'),
(324, 'po@gmail.com', 'cebc85b07466d902', '2023-12-13', 'connexion', 'off'),
(325, 'kfc.noisy@gmail.com', '8aa6c2c21d97f561', '2023-12-13', 'connexion', 'off'),
(326, 'kfc.noisy@gmail.com', '61a6ea5c0d33ec11', '2023-12-13', 'connexion', 'off'),
(327, 'po@gmail.com', '5b6025348eb57682', '2023-12-13', 'connexion', 'off'),
(328, 'kfc.noisy@gmail.com', 'cce47bcbdab9b5e1', '2023-12-13', 'connexion', 'off'),
(329, 'po@gmail.com', 'bbda14c316f4d0b9', '2023-12-14', 'connexion', 'off'),
(330, 'kfc.noisy@gmail.com', '6c1a2c68ab802692', '2023-12-14', 'connexion', 'off'),
(334, 'kfc.noisy@gmail.com', 'd2358de2609cba02', '2023-12-14', 'connexion', 'off'),
(335, 'po@gmail.com', 'b2d0c348ff9ae8c9', '2023-12-14', 'connexion', 'off'),
(336, 'kfc.noisy@gmail.com', 'bf133835e67b56a1', '2023-12-14', 'connexion', 'off'),
(337, 'po@gmail.com', '68be9fc72ecc9aea', '2023-12-14', 'connexion', 'off'),
(338, 'kfc.noisy@gmail.com', '4d8fc7130f18cf81', '2023-12-14', 'connexion', 'off'),
(339, 'po@gmail.com', '3738e42965f64c42', '2023-12-14', 'connexion', 'off'),
(340, 'kfc.noisy@gmail.com', 'cd5b6ce76eb55b25', '2023-12-14', 'connexion', 'off'),
(341, 'po@gmail.com', '3a7ac9bd9ab0bacb', '2023-12-14', 'connexion', 'off'),
(342, 'po@gmail.com', 'cdce0024e954bf26', '2023-12-14', 'connexion', 'off'),
(343, 'kfc.noisy@gmail.com', 'cf6ae18a84e23d4e', '2023-12-14', 'connexion', 'off'),
(344, 'kfc.noisy@gmail.com', 'd0368a7f96916eac', '2023-12-14', 'connexion', 'off'),
(347, 'kfc.noisy@gmail.com', '4875a832830e264d', '2023-12-14', 'connexion', 'off'),
(348, 'kfc.noisy@gmail.com', '94dd4815c6f9b848', '2023-12-14', 'connexion', 'off'),
(349, 'po@gmail.com', '46c240f0cb285a7f', '2023-12-14', 'connexion', 'off'),
(350, 'kfc.noisy@gmail.com', 'a95b6570ee4945a3', '2023-12-14', 'connexion', 'off'),
(351, 'kfc.noisy@gmail.com', 'c0a0930baad96959', '2023-12-14', 'connexion', 'off'),
(352, 'po@gmail.com', '69ff2eedba8c1797', '2023-12-14', 'connexion', 'off'),
(353, 'po@gmail.com', '6d518da84085c451', '2023-12-14', 'connexion', 'off'),
(354, 'kfc.noisy@gmail.com', 'f45258bf4657593b', '2023-12-14', 'connexion', 'off'),
(355, 'po@gmail.com', '4d351e7dab8769aa', '2023-12-14', 'connexion', 'off'),
(356, 'elae.dsd@gmail.com', '5e3a377ff9ad73a5', '2023-12-14', 'connexion', 'off'),
(357, 'po@gmail.com', '09705950fc2ba9de', '2023-12-14', 'connexion', 'off'),
(358, 'kfc.noisy@gmail.com', '201b69f7736bd8aa', '2023-12-15', 'connexion', 'off'),
(359, 'po@gmail.com', 'fcd4ecc4b5fe2141', '2023-12-15', 'connexion', 'off'),
(360, 'po@gmail.com', '59bfa76c746a282d', '2023-12-15', 'connexion', 'off'),
(361, 'po@gmail.com', '5ad7465bf72e2010', '2023-12-15', 'connexion', 'off'),
(362, 'kfc.noisy@gmail.com', '2e2adb02e620e6db', '2023-12-15', 'connexion', 'off'),
(363, 'elae.dsd@gmail.com', 'd0a8f70b29e30ad4', '2023-12-15', 'connexion', 'off'),
(365, 'houangkeo@gmail.com', '129d761449a52c00', '2023-12-15', 'verification', 'off'),
(366, 'houangkeo@gmail.com', 'b7d1428899598c41', '2023-12-15', 'reinitialisation', 'used'),
(367, 'elae.dsd@gmail.com', '79bec6dfc84f4264', '2023-12-15', 'connexion', 'off'),
(368, 'po@gmail.com', '15cea1d2a432ecec', '2023-12-15', 'connexion', 'off'),
(369, 'houangkeo@gmail.com', 'ef0d012ba206c0c7', '2023-12-15', 'connexion', 'off'),
(370, 'elae.dsd@gmail.com', 'a1d27d6462813d63', '2023-12-15', 'connexion', 'off'),
(371, 'merlin.lucas99@gmail.com', '09e1bf621b963b24', '2023-12-15', 'verification', 'off'),
(372, 'merlin.lucas99@gmail.com', '6bd08b11663a7330', '2023-12-15', 'reinitialisation', 'used'),
(373, 'po@gmail.com', 'bb022813405427ef', '2023-12-15', 'connexion', 'off'),
(374, 'kfc.noisy@gmail.com', 'f432d30ed0e056c8', '2023-12-15', 'connexion', 'off'),
(375, 'elae.dsd@gmail.com', '0e0fc5ab29c1b146', '2023-12-15', 'connexion', 'off'),
(376, 'lucas@gmail.com', 'd95db4d550fca0a6', '2023-12-15', 'verification', 'off'),
(377, 'kfc.noisy@gmail.com', '1921016442b32a52', '2023-12-15', 'connexion', 'off'),
(378, 'po@gmail.com', 'e0c8b29c28adf5ac', '2023-12-15', 'connexion', 'off'),
(379, 'kfc.noisy@gmail.com', 'f52cff938d668bda', '2023-12-15', 'connexion', 'off'),
(380, 'po@gmail.com', '17b9ebd999f9963d', '2023-12-15', 'connexion', 'off'),
(381, 'po@gmail.com', '7bf777019440cde7', '2023-12-15', 'connexion', 'off'),
(382, 'po@gmail.com', '4a1562eb844e48ae', '2023-12-15', 'connexion', 'off'),
(383, 'kfc.noisy@gmail.com', 'a2fbf66152da08d1', '2023-12-15', 'connexion', 'off'),
(384, 'kfc.noisy@gmail.com', '9e9f911255cccbcb', '2023-12-15', 'connexion', 'off'),
(385, 'po@gmail.com', 'ae259d204a57fbcc', '2023-12-15', 'connexion', 'off'),
(386, 'po@gmail.com', '9a9e691e27a72e77', '2023-12-15', 'connexion', 'off'),
(387, 'kfc.noisy@gmail.com', 'e079ff9394aacc66', '2023-12-15', 'connexion', 'off'),
(388, 'kfc.noisy@gmail.com', '0d7386d8cd79bae8', '2023-12-15', 'connexion', 'off'),
(389, 'kfc.noisy@gmail.com', '8755d69cdc7a8f1d', '2023-12-15', 'connexion', 'off'),
(390, 'kfc.noisy@gmail.com', 'b9d2a4dc77a91cfe', '2023-12-15', 'connexion', 'off'),
(391, 'kfc.noisy@gmail.com', '721e3da2ae72a785', '2023-12-15', 'connexion', 'off'),
(392, 'po@gmail.com', '3135f206c4d81858', '2023-12-15', 'connexion', 'off'),
(393, 'po@gmail.com', '7baa209f5ad55929', '2023-12-15', 'connexion', 'off'),
(394, 'kfc.noisy@gmail.com', 'dde06629da536328', '2023-12-15', 'connexion', 'off'),
(395, 'kfc.noisy@gmail.com', 'bf3ae8b756e16f68', '2023-12-15', 'connexion', 'off'),
(396, 'po@gmail.com', '84a56dc7e56337e5', '2023-12-15', 'connexion', 'off'),
(397, 'po@gmail.com', '0948a8e4db841ae2', '2023-12-15', 'connexion', 'off'),
(398, 'kfc.noisy@gmail.com', '1fb945d67b242bb6', '2023-12-15', 'connexion', 'off'),
(399, 'kfc.noisy@gmail.com', '34b1361714599552', '2023-12-15', 'connexion', 'off'),
(400, 'po@gmail.com', 'e016f60ab343556f', '2023-12-15', 'connexion', 'off'),
(401, 'po@gmail.com', '6bbce808ec504e53', '2023-12-15', 'connexion', 'off'),
(402, 'kfc.noisy@gmail.com', '3ff8c53264e03232', '2023-12-15', 'connexion', 'off'),
(403, 'kfc.noisy@gmail.com', '4c2f560c71eec307', '2023-12-15', 'connexion', 'off'),
(404, 'po@gmail.com', '69587224fff12253', '2023-12-15', 'connexion', 'off'),
(405, 'kfc.noisy@gmail.com', '8566c336e684cf7a', '2023-12-15', 'connexion', 'off'),
(406, 'po@gmail.com', '27eca5dadd86146e', '2023-12-15', 'connexion', 'off'),
(407, 'kfc.noisy@gmail.com', '203085232d4af8ba', '2023-12-15', 'connexion', 'off'),
(408, 'kfc.noisy@gmail.com', 'e4bc809b13cb4055', '2023-12-15', 'connexion', 'off'),
(409, 'po@gmail.com', '35e24565f8ab697a', '2023-12-15', 'connexion', 'off'),
(410, 'po@gmail.com', '9d9f371e22857ec0', '2023-12-15', 'connexion', 'off'),
(411, 'kfc.noisy@gmail.com', '62111e77ffc6aa0f', '2023-12-15', 'connexion', 'off'),
(412, 'kfc.noisy@gmail.com', 'eeb50359c5192003', '2023-12-15', 'connexion', 'off'),
(413, 'po@gmail.com', '24b3dded1f218b9a', '2023-12-15', 'connexion', 'off'),
(414, 'po@gmail.com', '639bdd26696c59f9', '2023-12-15', 'connexion', 'off'),
(415, 'po@gmail.com', '364b4ff3f3680ed5', '2023-12-15', 'connexion', 'off'),
(416, 'kfc.noisy@gmail.com', 'bef245184f473112', '2023-12-16', 'connexion', 'off'),
(417, 'kfc.noisy@gmail.com', 'd00045663412bb3a', '2023-12-16', 'connexion', 'off'),
(418, 'kfc.noisy@gmail.com', '11ede45b8b1fd2a8', '2023-12-16', 'connexion', 'off'),
(419, 'kfc.noisy@gmail.com', '06688ef98b0e5141', '2023-12-16', 'connexion', 'off'),
(420, 'po@gmail.com', '4057d89ce1db7bcf', '2023-12-16', 'connexion', 'off'),
(421, 'po@gmail.com', '647faa5ce2cd3140', '2023-12-16', 'connexion', 'off'),
(422, 'kfc.noisy@gmail.com', '68d5b27abd69cb06', '2023-12-16', 'connexion', 'off'),
(423, 'po@gmail.com', '86d6807a42bc7e2e', '2023-12-16', 'connexion', 'off'),
(424, 'po@gmail.com', 'eeccf04554552094', '2023-12-16', 'connexion', 'off'),
(425, 'kfc.noisy@gmail.com', '74898b6c5fe47911', '2023-12-16', 'connexion', 'off'),
(426, 'kfc.noisy@gmail.com', 'd54b5ccbe282f77d', '2023-12-16', 'connexion', 'off'),
(427, 'po@gmail.com', '9bdb41db1645e0e4', '2023-12-16', 'connexion', 'off'),
(428, 'po@gmail.com', 'ab65b9bf45b5b8a8', '2023-12-16', 'connexion', 'off'),
(429, 'po@gmail.com', '5bb726b68d0d64f9', '2023-12-16', 'connexion', 'off'),
(430, 'po@gmail.com', '865e32cafe805215', '2023-12-16', 'connexion', 'off'),
(431, 'kfc.noisy@gmail.com', 'ae26764dbf228533', '2023-12-16', 'connexion', 'off'),
(432, 'po@gmail.com', 'd508424479168f7d', '2023-12-16', 'connexion', 'off'),
(433, 'elae.dsd@gmail.com', 'a80bd936eb9e8c17', '2023-12-16', 'connexion', 'off'),
(434, 'kfc.noisy@gmail.com', '19ce7d5dc5b8bb37', '2023-12-16', 'connexion', 'off'),
(435, 'kfc.noisy@gmail.com', 'c9ae9b95c8306b23', '2023-12-16', 'connexion', 'off'),
(436, 'po@gmail.com', '18b3c1366d4f6e81', '2023-12-16', 'connexion', 'off'),
(437, 'po@gmail.com', '9128d13dec10abc1', '2023-12-16', 'connexion', 'off'),
(438, 'po@gmail.com', '92d4f70cc4e773f2', '2023-12-16', 'connexion', 'off'),
(439, 'kfc.noisy@gmail.com', 'cb621b95b5b33354', '2023-12-16', 'connexion', 'off'),
(440, 'kfc.noisy@gmail.com', 'f51c53e44954872a', '2023-12-16', 'connexion', 'off'),
(441, 'kfc.noisy@gmail.com', 'e5e14e9be456faa2', '2023-12-16', 'connexion', 'off'),
(442, 'po@gmail.com', '82fff098b33eb7cb', '2023-12-16', 'connexion', 'off'),
(443, 'kfc.noisy@gmail.com', '2b0f997e4fa4147f', '2023-12-16', 'connexion', 'off'),
(444, 'po@gmail.com', 'ba916b2061455a9e', '2023-12-16', 'connexion', 'off'),
(445, 'po@gmail.com', '57c4f80a95ca6164', '2023-12-16', 'connexion', 'off'),
(446, 'po@gmail.com', 'a71d56181200385b', '2023-12-16', 'connexion', 'off'),
(447, 'po@gmail.com', '89805a16e19f21f0', '2023-12-16', 'connexion', 'off'),
(448, 'kfc.noisy@gmail.com', '1df9dba5029327a0', '2023-12-16', 'connexion', 'off'),
(449, 'kfc.noisy@gmail.com', 'b1aa4af8ea24a98b', '2023-12-16', 'connexion', 'off'),
(450, 'kfc.noisy@gmail.com', '706c8382fee125eb', '2023-12-16', 'connexion', 'off'),
(451, 'kfc.noisy@gmail.com', '2a6060031ccdce8e', '2023-12-16', 'connexion', 'off'),
(452, 'po@gmail.com', '5b5ea7d61bcbb8c4', '2023-12-16', 'connexion', 'off'),
(453, 'kfc.noisy@gmail.com', '38207cb3bc3446bd', '2023-12-16', 'connexion', 'off'),
(454, 'po@gmail.com', 'c63b2ff596ed4fa1', '2023-12-16', 'connexion', 'off'),
(455, 'kfc.noisy@gmail.com', '9582e8b64ed8d07b', '2023-12-16', 'connexion', 'off'),
(456, 'po@gmail.com', '22028e4da3608ce3', '2023-12-16', 'connexion', 'off'),
(457, 'kfc.noisy@gmail.com', '013133e2888b040c', '2023-12-16', 'connexion', 'off'),
(458, 'po@gmail.com', 'ccb58eec7663054c', '2023-12-16', 'connexion', 'off'),
(459, 'kfc.noisy@gmail.com', '8413ffbbadcf0955', '2023-12-17', 'connexion', 'off'),
(460, 'po@gmail.com', '81c2d0986e1079fe', '2023-12-17', 'connexion', 'off'),
(461, 'kfc.noisy@gmail.com', '987f04a3ecf738ab', '2023-12-17', 'connexion', 'off'),
(462, 'kfc.noisy@gmail.com', 'c711a5171b2936a1', '2023-12-17', 'connexion', 'off'),
(463, 'kfc.noisy@gmail.com', 'bfa1ed6d3daf4c51', '2023-12-17', 'connexion', 'off'),
(464, 'po@gmail.com', 'c73bb24d3f53b120', '2023-12-17', 'connexion', 'off'),
(465, 'po@gmail.com', '14518e122010a5d5', '2023-12-17', 'connexion', 'off'),
(466, 'po@gmail.com', 'e93d8f64e3f4f47d', '2023-12-17', 'connexion', 'off'),
(467, 'po@gmail.com', 'f1c5a2b4bda9cc55', '2023-12-17', 'connexion', 'off'),
(468, 'kfc.noisy@gmail.com', '63229cea9a50c8ef', '2023-12-17', 'connexion', 'off'),
(469, 'po@gmail.com', '7230a224fa05b0e2', '2023-12-18', 'connexion', 'off'),
(470, 'po@gmail.com', '0460475631479cb7', '2023-12-18', 'connexion', 'off'),
(471, 'po@gmail.com', 'ef291d0ba76edc70', '2023-12-18', 'connexion', 'off'),
(472, 'po@gmail.com', 'cafe6b46600552ca', '2023-12-18', 'connexion', 'off'),
(473, 'po@gmail.com', 'c6050b5d135760bb', '2023-12-18', 'connexion', 'off'),
(474, 'kfc.noisy@gmail.com', '8889e7ef50cc209a', '2023-12-18', 'connexion', 'off'),
(475, 'po@gmail.com', '183d04eb9dd2c136', '2023-12-18', 'connexion', 'off'),
(476, 'kfc.noisy@gmail.com', 'e1c8ac10403632bf', '2023-12-18', 'connexion', 'off'),
(477, 'kfc.noisy@gmail.com', '307268d33eacee56', '2023-12-18', 'connexion', 'off'),
(478, 'po@gmail.com', '466c4a1c1282bbd2', '2023-12-18', 'connexion', 'off'),
(479, 'kfc.noisy@gmail.com', '5e2f560407d2b9e0', '2023-12-18', 'connexion', 'off'),
(480, 'kfc.noisy@gmail.com', '21ac73173cf8b508', '2023-12-18', 'connexion', 'off'),
(481, 'po@gmail.com', 'e1345365bcf3e34a', '2023-12-18', 'connexion', 'off'),
(482, 'kfc.noisy@gmail.com', '5550aa9400d76338', '2023-12-18', 'connexion', 'off'),
(483, 'po@gmail.com', 'a8dbd19f9d02f883', '2023-12-18', 'connexion', 'off'),
(484, 'kfc.noisy@gmail.com', '954279b48be5d9ec', '2023-12-18', 'connexion', 'off'),
(485, 'kfc.noisy@gmail.com', 'f1e256cd3f406b70', '2023-12-18', 'connexion', 'off'),
(486, 'kfc.noisy@gmail.com', 'e298e0e91fccf4ff', '2023-12-18', 'connexion', 'off'),
(487, 'kfc.noisy@gmail.com', 'e448defbf6203b41', '2023-12-18', 'connexion', 'off'),
(488, 'kfc.noisy@gmail.com', 'c13907752e32b2fc', '2023-12-18', 'connexion', 'off'),
(489, 'kfc.noisy@gmail.com', 'd341818a431780dc', '2023-12-18', 'connexion', 'off'),
(490, 'kfc.noisy@gmail.com', 'c072b945dfd075b8', '2023-12-18', 'connexion', 'off'),
(491, 'po@gmail.com', '88acc42d9c32b62f', '2023-12-18', 'connexion', 'off'),
(492, 'kfc.noisy@gmail.com', 'b26485c08d781a42', '2023-12-18', 'connexion', 'off'),
(493, 'po@gmail.com', '09c3522d23d141d8', '2023-12-18', 'connexion', 'off'),
(494, 'po@gmail.com', '2e9defb1cb7ce9e1', '2023-12-18', 'connexion', 'off'),
(495, 'po@gmail.com', 'd850fa4c423cb254', '2023-12-18', 'connexion', 'off'),
(496, 'po@gmail.com', '17e35b2ac4896135', '2023-12-18', 'connexion', 'off'),
(497, 'kfc.noisy@gmail.com', '040067c7a4198eeb', '2023-12-18', 'connexion', 'off'),
(498, 'kfc.noisy@gmail.com', '77ac5d92577f2983', '2023-12-18', 'connexion', 'off'),
(499, 'kfc.noisy@gmail.com', '0e29ee5a47980e3d', '2023-12-18', 'connexion', 'off'),
(500, 'elae.dsd@gmail.com', '820756241e8a25e6', '2023-12-18', 'connexion', 'off'),
(501, 'po@gmail.com', 'bd4f42bfacca1186', '2023-12-18', 'connexion', 'off'),
(502, 'kfc.noisy@gmail.com', '04bbe75490fe9285', '2023-12-18', 'connexion', 'off'),
(503, 'po@gmail.com', 'a0023f28bc147131', '2023-12-18', 'connexion', 'off'),
(504, 'elae.dsd@gmail.com', 'fd5cfe6ce5e58470', '2023-12-18', 'connexion', 'off'),
(505, 'apple.lognes@gmail.com', '724ee512ab60b615', '2023-12-18', 'connexion', 'off'),
(506, 'kfc.noisy@gmail.com', '4ce9b205c1b7f513', '2023-12-18', 'connexion', 'off'),
(507, 'kfc.noisy@gmail.com', '89a5f2b7f32ebdbf', '2023-12-18', 'connexion', 'off'),
(508, 'apple.lognes@gmail.com', '2abe26a7889ba831', '2023-12-18', 'connexion', 'off'),
(509, 'kfc.noisy@gmail.com', 'e1ddd82d0fc260de', '2023-12-18', 'connexion', 'off'),
(510, 'apple.lognes@gmail.com', '94f9258c50075558', '2023-12-18', 'connexion', 'off'),
(511, 'kfc.noisy@gmail.com', '81e3eeba46925d46', '2023-12-19', 'connexion', 'off'),
(512, 'kfc.noisy@gmail.com', 'acea46dcdcf21956', '2023-12-19', 'connexion', 'off'),
(513, 'po@gmail.com', '87119ab7676c9aa3', '2023-12-19', 'connexion', 'off'),
(514, 'kfc.noisy@gmail.com', 'da163235df3a55b8', '2023-12-19', 'connexion', 'off'),
(515, 'po@gmail.com', '5cc32510762e4d28', '2023-12-19', 'connexion', 'off'),
(516, 'kfc.noisy@gmail.com', 'cc00881032d489d3', '2023-12-19', 'connexion', 'off'),
(517, 'kfc.noisy@gmail.com', '340880227812d122', '2023-12-19', 'connexion', 'off'),
(518, 'kfc.noisy@gmail.com', '3b169c82ca52a6d8', '2023-12-19', 'connexion', 'off'),
(519, 'po@gmail.com', '04d8eda3357465b3', '2023-12-19', 'connexion', 'off'),
(520, 'kfc.noisy@gmail.com', '493b3c36ed3c8c47', '2023-12-19', 'connexion', 'off'),
(521, 'kfc.noisy@gmail.com', '8c9871f57a08c714', '2023-12-19', 'connexion', 'off'),
(522, 'Po@gmail.com', '4d36f0274e03a600', '2023-12-19', 'connexion', 'off'),
(523, 'kfc.noisy@gmail.com', '52a0a3e1d4faeb4f', '2023-12-19', 'connexion', 'off'),
(524, 'kfc.noisy@gmail.com', '165884a293f80b79', '2023-12-19', 'connexion', 'off'),
(525, 'kfc.noisy@gmail.com', '224aa9f22e1059ac', '2023-12-19', 'connexion', 'off'),
(526, 'elae.dsd@gmail.com', '378a802ac8fa651c', '2023-12-19', 'connexion', 'off'),
(527, 'elae.dsd@gmail.com', '7a16d43c852f9518', '2023-12-19', 'connexion', 'off'),
(528, 'kfc.noisy@gmail.com', '9446a3b2589b696c', '2023-12-19', 'connexion', 'off'),
(529, 'kfc.noisy@gmail.com', '39dd1d9a4cadae4b', '2023-12-19', 'connexion', 'off'),
(530, 'po@gmail.com', 'f8717972baa375cc', '2023-12-19', 'connexion', 'off'),
(531, 'kfc.noisy@gmail.com', 'accb333ffcd0f6d0', '2023-12-19', 'connexion', 'off'),
(532, 'kfc.noisy@gmail.com', '2eb4c6fe816e8fe4', '2023-12-19', 'connexion', 'off'),
(533, 'po@gmail.com', '90a55246500e6ab6', '2023-12-19', 'connexion', 'off'),
(534, 'po@gmail.com', 'b84a1aa545ed95c0', '2023-12-19', 'connexion', 'off'),
(535, 'apple.lognes@gmail.com', '4c873227b151b1a8', '2023-12-20', 'connexion', 'off'),
(536, 'kfc.noisy@gmail.com', '07ac14d7a7be371e', '2023-12-20', 'connexion', 'off'),
(537, 'apple.lognes@gmail.com', '1e93f5e5b3a1be81', '2023-12-20', 'connexion', 'off'),
(538, 'kfc.noisy@gmail.com', '55def8000814fb6e', '2023-12-20', 'connexion', 'off'),
(539, 'kfc.noisy@gmail.com', '9b2b8bd50890d49b', '2023-12-20', 'connexion', 'off'),
(540, 'elae.dsd@gmail.com', '47370850457c8a44', '2023-12-20', 'connexion', 'off'),
(541, 'kfc.noisy@gmail.com', '150e25f4d9f659de', '2023-12-20', 'connexion', 'off'),
(542, 'kfc.noisy@gmail.com', 'b97c408dd4de7f2a', '2023-12-21', 'connexion', 'off'),
(543, 'apple.lognes@gmail.com', '1541d34597c52258', '2023-12-21', 'connexion', 'off'),
(544, 'po@gmail.com', 'e89bbe31d4bd4138', '2023-12-21', 'connexion', 'off'),
(545, 'kfc.noisy@gmail.com', '90380a0a2cb70101', '2023-12-21', 'connexion', 'off'),
(546, 'po@gmail.com', 'fd932d81db169a5a', '2023-12-21', 'connexion', 'off'),
(547, 'apple.lognes@gmail.com', '24411cbb11097d90', '2023-12-21', 'connexion', 'off'),
(548, 'apple.lognes@gmail.com', 'e75103c4b9559161', '2023-12-21', 'connexion', 'off'),
(549, 'kfc.noisy@gmail.com', 'a7e858a2cbb96e16', '2023-12-21', 'connexion', 'off'),
(550, 'apple.lognes@gmail.com', 'f14f2ecef4d2bc9d', '2023-12-21', 'connexion', 'off'),
(551, 'apple.lognes@gmail.com', '4c17ae5a63b5c38a', '2023-12-21', 'connexion', 'off'),
(552, 'kfc.noisy@gmail.com', '886e3b770375423b', '2023-12-21', 'connexion', 'off'),
(553, 'po@gmail.com', 'dbcb0cd0524ce65f', '2023-12-21', 'connexion', 'off'),
(554, 'po@gmail.com', 'f3e79d6312b96c0f', '2023-12-21', 'connexion', 'off'),
(555, 'po@gmail.com', '8d78f258ebc3b401', '2023-12-21', 'connexion', 'off'),
(556, 'po@gmail.com', '0f6fad643444c285', '2023-12-21', 'connexion', 'off'),
(557, 'kfc.noisy@gmail.com', 'a8d9601c1e05069e', '2023-12-21', 'connexion', 'off'),
(558, 'apple.lognes@gmail.com', 'aee4994591d53b43', '2023-12-21', 'connexion', 'off'),
(559, 'kfc.noisy@gmail.com', '4ba2d5052275ce02', '2023-12-21', 'connexion', 'off'),
(560, 'kfc.noisy@gmail.com', 'aa8a6e4c6cfa727c', '2023-12-21', 'connexion', 'off'),
(561, 'kfc.noisy@gmail.com', 'f66def3fc322666d', '2023-12-21', 'connexion', 'off'),
(562, 'kfc.noisy@gmail.com', 'dc6a981a574cc2fb', '2023-12-21', 'connexion', 'off'),
(563, 'kfc.noisy@gmail.com', '253a5f235b37621b', '2023-12-21', 'connexion', 'off'),
(564, 'kfc.noisy@gmail.com', '264ce61b520fe9b4', '2023-12-21', 'connexion', 'off'),
(565, 'kfc.noisy@gmail.com', '9018f13c8b2a39bf', '2023-12-21', 'connexion', 'off'),
(566, 'kfc.noisy@gmail.com', '3b4419247bef4e2d', '2023-12-21', 'connexion', 'off'),
(567, 'kfc.noisy@gmail.com', 'a03448076d512b0b', '2023-12-21', 'connexion', 'off'),
(568, 'kfc.noisy@gmail.com', '50b69aec82ffb7c9', '2023-12-21', 'connexion', 'off'),
(569, 'apple.lognes@gmail.com', '2261e48a9064bfa2', '2023-12-21', 'connexion', 'off'),
(570, 'apple.lognes@gmail.com', '42391a97ffa8d251', '2023-12-21', 'connexion', 'off'),
(571, 'po@gmail.com', '792091ff1a753002', '2023-12-21', 'connexion', 'off'),
(572, 'po@gmail.com', '3043183421df1871', '2023-12-21', 'connexion', 'off'),
(573, 'kfc.noisy@gmail.com', 'c1895727b53cbc2b', '2023-12-21', 'connexion', 'off'),
(574, 'elae.dsd@gmail.com', '560147df946cc6d3', '2023-12-21', 'connexion', 'off'),
(575, 'tt@gmail.com', 'cf54fca708410946', '2023-12-21', 'verification', 'off'),
(576, 'po@gmail.com', 'bea973276243b450', '2023-12-21', 'connexion', 'off'),
(577, 'po@gmail.com', '85385769fa7df9d1', '2023-12-21', 'connexion', 'off'),
(578, 'kfc.noisy@gmail.com', 'd3795a36db9b8cff', '2023-12-21', 'connexion', 'off'),
(579, 'po@gmail.com', 'ff1903ea89c12fb7', '2023-12-22', 'connexion', 'off'),
(580, 'po@gmail.com', 'f5d8174d076e6c1c', '2023-12-22', 'connexion', 'off'),
(581, 'kfc.noisy@gmail.com', '8f326677273b6b13', '2023-12-22', 'connexion', 'off'),
(582, 'po@gmail.com', 'de26cecf7eb8f4fe', '2023-12-22', 'connexion', 'off'),
(583, 'po@gmail.com', '00c7235d90925a55', '2023-12-22', 'connexion', 'off'),
(584, 'po@gmail.com', 'b214165d07b84b00', '2023-12-22', 'connexion', 'off'),
(585, 'apple.lognes@gmail.com', 'c17e43786e77c745', '2023-12-22', 'connexion', 'off'),
(586, 'apple.lognes@gmail.com', '54500e90a14e0276', '2023-12-22', 'connexion', 'off'),
(587, 'elae.dsd@gmail.com', '0a9f889471ddb976', '2023-12-22', 'connexion', 'off'),
(588, 'po@gmail.com', '7f607443823cc02e', '2023-12-22', 'connexion', 'off'),
(589, 'apple.lognes@gmail.com', 'a3592163a6a506f1', '2023-12-22', 'connexion', 'off'),
(590, 'po@gmail.com', '88c035d4afa28f7f', '2023-12-22', 'connexion', 'off'),
(591, 'apple.lognes@gmail.com', '611b8dadc4a80ac0', '2023-12-22', 'connexion', 'off'),
(592, 'po@gmail.com', 'a3c742d483188ff2', '2023-12-22', 'connexion', 'off'),
(593, 'elae.dsd@gmail.com', 'b52ad5540380e2df', '2023-12-22', 'connexion', 'off'),
(594, 'apple.lognes@gmail.com', '30282951242ace70', '2023-12-22', 'connexion', 'off'),
(595, 'kfc.noisy@gmail.com', '11ab9bfce5410b7e', '2023-12-22', 'connexion', 'off'),
(596, 'kfc.noisy@gmail.com', '2e5cdfd3a7d7fcfb', '2023-12-23', 'connexion', 'off'),
(597, 'po@gmail.com', '3a417101225770a8', '2023-12-23', 'connexion', 'off'),
(598, 'Po@gmail.com', '556b3dfd285f75ae', '2023-12-23', 'connexion', 'off'),
(599, 'Apple.lognes@gmail.com', 'e0c9ea531f7479a6', '2023-12-23', 'connexion', 'off'),
(600, 'po@gmail.com', '1b56c06d8e029dca', '2023-12-23', 'connexion', 'off'),
(601, 'kfc.noisy@gmail.com', '3b344dd1833d697b', '2023-12-23', 'connexion', 'off'),
(602, 'apple.lognes@gmail.com', '268623422ce44670', '2023-12-23', 'connexion', 'off'),
(603, 'po@gmail.com', '40429b421bfd9476', '2023-12-23', 'connexion', 'off'),
(604, 'kfc.noisy@gmail.com', 'b003731975484050', '2023-12-23', 'connexion', 'off'),
(605, 'apple.lognes@gmail.com', 'eb2855a8c81157d1', '2023-12-23', 'connexion', 'off'),
(606, 'po@gmail.com', 'a6e038da61e53a01', '2023-12-23', 'connexion', 'off'),
(607, 'po@gmail.com', '4f0c72e3d76a131e', '2023-12-23', 'connexion', 'off'),
(608, 'po@gmail.com', '88fee5d137ba452f', '2023-12-23', 'connexion', 'off'),
(609, 'po@gmail.com', 'f3138fc8cddc3347', '2023-12-23', 'connexion', 'off'),
(610, 'apple.lognes@gmail.com', '1e91a2d2baff0839', '2023-12-23', 'connexion', 'off'),
(611, 'po@gmail.com', '3d7a125557925269', '2023-12-23', 'connexion', 'off'),
(612, 'po@gmail.com', '89f019c9bc9ff04c', '2023-12-23', 'connexion', 'off'),
(613, 'apple.lognes@gmail.com', 'da3500525b374031', '2023-12-23', 'connexion', 'off'),
(614, 'apple.lognes@gmail.com', 'a7dcf8ee1781c2e9', '2023-12-23', 'connexion', 'off'),
(615, 'apple.lognes@gmail.com', '17af0ded802f9f73', '2023-12-23', 'connexion', 'off'),
(616, 'po@gmail.com', 'ac3f45899bd3cb3b', '2023-12-23', 'connexion', 'off'),
(617, 'apple.lognes@gmail.com', 'c28e68ea84cae22f', '2023-12-23', 'connexion', 'off'),
(618, 'kfc.noisy@gmail.com', 'e1110ed702b31169', '2023-12-23', 'connexion', 'off'),
(619, 'kfc.noisy@gmail.com', '7f42be6476812a74', '2023-12-23', 'connexion', 'off'),
(620, 'po@gmail.com', '4edb6c705a6fa9b2', '2023-12-24', 'connexion', 'off'),
(621, 'kfc.noisy@gmail.com', '4ac36e418543c578', '2023-12-24', 'connexion', 'off'),
(622, 'kfc.noisy@gmail.com', '30d8f32184217ca9', '2023-12-24', 'connexion', 'off'),
(623, 'kfc.noisy@gmail.com', 'd06548c3fdd0169f', '2023-12-24', 'connexion', 'off'),
(624, 'po@gmail.com', 'e30e189b0aa7a474', '2023-12-23', 'connexion', 'off'),
(625, 'elae.dsd@gmail.com', 'b0cae46bdd9aec92', '2023-12-23', 'connexion', 'off'),
(626, 'elae.dsd@gmail.com', 'ec23df6d9d3bd4bc', '2023-12-23', 'connexion', 'off'),
(627, 'po@gmail.com', 'f6cba041b47584c5', '2023-12-23', 'connexion', 'off'),
(628, 'po@gmail.com', '6d1925fc6bd71460', '2023-12-23', 'connexion', 'off'),
(629, 'po@gmail.com', '552ba7e4e258764b', '2023-12-24', 'connexion', 'off'),
(630, 'po@gmail.com', '7ab718173209d8f5', '2023-12-24', 'connexion', 'off'),
(631, 'kfc.noisy@gmail.com', '3594b29144c0b6a1', '2023-12-24', 'connexion', 'off'),
(632, 'po@gmail.com', '8226bef2a715a5cb', '2023-12-24', 'connexion', 'off'),
(633, 'kfc.noisy@gmail.com', 'b2414df93f51d9e3', '2023-12-24', 'connexion', 'off'),
(634, 'kfc.noisy@gmail.com', '0649e1ce162684ca', '2023-12-24', 'connexion', 'off'),
(635, 'kfc.noisy@gmail.com', 'afe7641d5daaea68', '2023-12-23', 'connexion', 'off'),
(636, 'apple.lognes@gmail.com', 'fdd5fe960da44971', '2023-12-24', 'connexion', 'off'),
(637, 'elae.dsd@gmail.com', 'de89aad1ed6faefc', '2023-12-24', 'connexion', 'off'),
(638, 'po@gmail.com', 'c87949967eb8b3cb', '2023-12-24', 'connexion', 'off'),
(639, 'po@gmail.com', '0ea9996505c7acb7', '2023-12-24', 'connexion', 'off'),
(640, 'apple.lognes@gmail.com', 'a70e93bed50c141f', '2023-12-24', 'connexion', 'off'),
(641, 'elae.dsd@gmail.com', '85de848d2bb25da3', '2023-12-24', 'connexion', 'off'),
(642, 'apple.lognes@gmail.com', '796eb640cff777e0', '2023-12-24', 'connexion', 'off'),
(643, 'po@gmail.com', '3de2136c54f2dac9', '2023-12-24', 'connexion', 'off'),
(644, 'kfc.noisy@gmail.com', 'fdd6464d57d32cf7', '2023-12-24', 'reinitialisation', 'used'),
(645, 'kfc.noisy@gmail.com', '425bc3fefc78b7e1', '2023-12-24', 'connexion', 'off'),
(646, 'apple.lognes@gmail.com', '6e8603b2708817ed', '2023-12-24', 'reinitialisation', 'used'),
(647, 'elae.dsd@gmail.com', '1fbc662c6fd06310', '2023-12-24', 'reinitialisation', 'used'),
(648, 'po@gmail.com', 'b9fb2238a9e0bcc9', '2023-12-24', 'reinitialisation', 'off'),
(649, 'po@gmail.com', '307248f868e8a568', '2023-12-24', 'reinitialisation', 'used'),
(650, 'po@gmail.com', '2371d527e8e700ef', '2023-12-24', 'connexion', 'off'),
(651, 'po@gmail.com', 'd929b6f8ddbdddb7', '2023-12-26', 'connexion', 'off'),
(652, 'po@gmail.com', '0e53f1a7442afd5d', '2023-12-26', 'connexion', 'off'),
(653, 'kfc.noisy@gmail.com', 'd393d9b6aaa69471', '2023-12-26', 'connexion', 'off'),
(654, 'kfc.noisy@gmail.com', '7b128da723cac4a9', '2023-12-26', 'connexion', 'off'),
(655, 'po@gmail.com', '6a553b33bd81bc1c', '2024-01-06', 'connexion', 'off'),
(656, 'kfc.noisy@gmail.com', '6d197606231230a8', '2024-01-06', 'connexion', 'off'),
(657, 'po@gmail.com', '22a2395f0faf0b4e', '2024-01-15', 'connexion', 'off'),
(658, 'apple.lognes@gmail.com', '6741c700e3efcb18', '2024-01-16', 'connexion', 'off'),
(659, 'elae.dsd@gmail.com', '07ca37d6eda43389', '2024-01-18', 'connexion', 'off'),
(660, 'apple.lognes@gmail.com', '3db62554c99d3d92', '2024-01-19', 'connexion', 'off'),
(661, 'apple.lognes@gmail.com', '4cbd9363ee3e2582', '2024-01-19', 'connexion', 'off'),
(662, 'apple.lognes@gmail.com', '96093de4f056d475', '2024-01-19', 'connexion', 'off'),
(663, 'po@gmail.com', '513c8bed8d81e979', '2024-01-20', 'connexion', 'off'),
(664, 'elae.dsd@gmail.com', '3fd2011358d70702', '2024-01-20', 'connexion', 'off'),
(665, 'po@gmail.com', '0165fe4dbdcf19e1', '2024-01-23', 'connexion', 'off'),
(666, 'po@gmail.com', '288dc88f054d69fb', '2024-01-23', 'connexion', 'off'),
(667, 'apple.lognes@gmail.com', '0ff909ab2e997a92', '2024-02-03', 'connexion', 'off'),
(668, 'po@gmail.com', '37d88d6706685d4f', '2024-02-04', 'connexion', 'off'),
(669, 'po@gmail.com', 'cb13e69eda56e5e5', '2024-02-11', 'connexion', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE `Transaction` (
  `idTransaction` int(11) NOT NULL,
  `numAutorisation` char(6) DEFAULT NULL,
  `montant` decimal(12,2) NOT NULL,
  `sens` enum('+','-') NOT NULL,
  `devise` enum('EUR') NOT NULL,
  `dateVente` date NOT NULL,
  `numRemise` char(19) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Transaction`
--

INSERT INTO `Transaction` (`idTransaction`, `numAutorisation`, `montant`, `sens`, `devise`, `dateVente`, `numRemise`, `idUtilisateur`, `idClient`) VALUES
(4, '796538', 101.00, '+', 'EUR', '2021-06-16', '2', 33, 8),
(5, '117868', 9.00, '+', 'EUR', '2020-08-20', '15', 34, 1),
(6, '846635', 4.00, '+', 'EUR', '2020-08-12', '15', 34, 2),
(7, '464645', 50.00, '+', 'EUR', '2020-08-08', '15', 34, 3),
(9, '676172', 201.00, '-', 'EUR', '2020-08-28', '15', 34, 5),
(10, '477648', 201.00, '+', 'EUR', '2021-12-20', '1', 33, 4),
(11, '519478', 201.00, '+', 'EUR', '2021-12-20', '1', 33, 3),
(12, '815721', 9.00, '+', 'EUR', '2021-12-11', '2', 33, 2),
(13, '578519', 200.00, '+', 'EUR', '2021-12-04', '2', 33, 2),
(14, '879846', 201.00, '-', 'EUR', '2021-12-24', '1', 33, 5),
(16, '478494', 25.50, '+', 'EUR', '2022-06-16', '3', 35, 3),
(17, '719486', 101.00, '+', 'EUR', '2022-06-08', '3', 35, 1),
(18, '573883', 101.00, '+', 'EUR', '2020-09-16', '16', 34, 14),
(19, '796428', 5.00, '-', 'EUR', '2020-08-21', '15', 34, 11),
(20, '0469I4', 201.00, '+', 'EUR', '2020-11-11', '16', 34, 15),
(21, '685857', 10.00, '+', 'EUR', '2020-12-31', '16', 34, 15),
(22, '475389', 7.00, '+', 'EUR', '2021-01-14', '16', 34, 12),
(23, '537568', 201.00, '-', 'EUR', '2021-04-01', '2', 33, 6),
(24, '350720', 100.99, '+', 'EUR', '2021-08-12', '6', 34, 10),
(25, '624692', 81.00, '+', 'EUR', '2021-08-25', '2', 33, 9),
(26, '548642', 101.00, '+', 'EUR', '2021-09-15', '2', 33, 15),
(27, '385270', 201.00, '-', 'EUR', '2021-10-26', '2', 33, 16),
(81, '476462', 250.00, '-', 'EUR', '2021-08-18', '2', 33, 12),
(82, '516615', 101.00, '-', 'EUR', '2021-10-13', '2', 33, 15),
(85, '654651', 11.00, '-', 'EUR', '2022-12-13', '4', 35, 15),
(86, '174636', 66.00, '+', 'EUR', '2021-09-14', '2', 33, 7),
(87, '466121', 150.00, '-', 'EUR', '2021-12-23', '1', 33, 9),
(89, '143487', 5.00, '-', 'EUR', '2022-04-22', '3', 35, 5),
(90, '746462', 201.00, '-', 'EUR', '2022-04-01', '3', 35, 9),
(91, '864412', 101.00, '-', 'EUR', '2022-05-11', '3', 35, 11),
(92, '764641', 101.00, '+', 'EUR', '2022-06-25', '3', 35, 5),
(93, '418646', 281.00, '+', 'EUR', '2023-08-17', '7', 35, 8),
(94, '167411', 101.00, '-', 'EUR', '2022-11-23', '4', 35, 2),
(100, '148896', 151.50, '+', 'EUR', '2023-09-04', '7', 35, 6),
(101, '874852', 6.00, '+', 'EUR', '2023-09-06', '7', 35, 10),
(102, '254387', 41.00, '+', 'EUR', '2023-10-09', '10', 35, 12),
(103, '974522', 13.00, '+', 'EUR', '2023-09-13', '7', 35, 14),
(104, '267527', 21.00, '+', 'EUR', '2023-10-17', '10', 35, 1),
(105, '434352', 181.00, '+', 'EUR', '2023-09-22', '7', 35, 8),
(106, '174867', 201.00, '+', 'EUR', '2023-09-29', '10', 35, 2),
(107, '975674', 203.00, '+', 'EUR', '2023-10-04', '10', 35, 13),
(108, '846741', 211.00, '+', 'EUR', '2023-10-20', '10', 35, 16),
(109, '467487', 241.00, '+', 'EUR', '2023-10-31', '13', 35, 8),
(110, '847684', 44.00, '+', 'EUR', '2023-11-04', '13', 35, 13),
(111, '674655', 111.00, '+', 'EUR', '2023-11-11', '13', 35, 10),
(112, '874156', 48.00, '+', 'EUR', '2023-11-16', '13', 35, 14),
(113, '841366', 286.00, '+', 'EUR', '2023-11-23', '13', 35, 13),
(114, '815727', 271.00, '+', 'EUR', '2023-11-29', '13', 35, 10),
(115, '985721', 158.00, '+', 'EUR', '2023-12-05', NULL, 35, 16),
(116, '595774', 146.00, '+', 'EUR', '2023-12-08', NULL, 35, 12),
(117, '971524', 128.00, '+', 'EUR', '2023-12-14', NULL, 35, 8),
(118, '016450', 155.00, '+', 'EUR', '2023-09-01', '6', 34, 15),
(119, '052015', 71.00, '+', 'EUR', '2023-09-08', '6', 34, 14),
(120, '684510', 226.00, '+', 'EUR', '2023-09-14', '6', 34, 9),
(121, '841457', 275.00, '+', 'EUR', '2023-09-20', '9', 34, 7),
(122, '164654', 11.00, '+', 'EUR', '2023-09-28', '9', 34, 16),
(123, '431641', 184.00, '+', 'EUR', '2023-10-05', '9', 34, 11),
(124, '841375', 276.00, '+', 'EUR', '2023-10-12', '9', 34, 4),
(125, '841451', 181.00, '+', 'EUR', '2023-10-17', '12', 34, 5),
(126, '441976', 272.00, '+', 'EUR', '2023-10-22', '12', 34, 6),
(127, '923705', 21.00, '+', 'EUR', '2023-10-30', '12', 34, 12),
(128, '011800', 283.00, '+', 'EUR', '2023-11-02', '12', 34, 7),
(129, '695320', 295.00, '+', 'EUR', '2023-11-08', '12', 34, 15),
(130, '210440', 236.00, '+', 'EUR', '2023-11-14', '12', 34, 9),
(131, '436903', 120.00, '+', 'EUR', '2023-11-20', NULL, 34, 13),
(132, '555950', 164.00, '+', 'EUR', '2023-11-29', NULL, 34, 12),
(133, '381044', 121.00, '+', 'EUR', '2023-12-03', NULL, 34, 10),
(134, '508913', 63.00, '+', 'EUR', '2023-12-08', NULL, 34, 1),
(135, '250661', 84.00, '+', 'EUR', '2023-12-13', NULL, 34, 11),
(136, '405606', 15.00, '+', 'EUR', '2023-12-15', NULL, 34, 8),
(137, '244230', 152.00, '+', 'EUR', '2023-09-04', '5', 33, 9),
(138, '322313', 199.00, '+', 'EUR', '2023-09-10', '8', 33, 3),
(139, '928485', 82.00, '+', 'EUR', '2023-09-14', '8', 33, 12),
(140, '680182', 9.00, '+', 'EUR', '2023-12-20', '8', 33, 15),
(141, '298951', 298.00, '+', 'EUR', '2023-09-27', '8', 33, 6),
(142, '706358', 164.00, '+', 'EUR', '2023-10-05', '11', 33, 13),
(143, '637610', 243.00, '+', 'EUR', '2023-10-14', '11', 33, 10),
(144, '542351', 221.00, '+', 'EUR', '2023-10-19', '11', 33, 8),
(145, '041075', 268.00, '+', 'EUR', '2023-10-24', '11', 33, 12),
(146, '610329', 26.00, '+', 'EUR', '2023-10-31', '11', 33, 4),
(147, '272282', 31.00, '+', 'EUR', '2023-11-06', '11', 33, 16),
(148, '216409', 174.00, '+', 'EUR', '2023-11-15', '14', 33, 7),
(149, '475553', 97.00, '+', 'EUR', '2023-11-21', '14', 33, 12),
(150, '263948', 2.00, '+', 'EUR', '2023-11-28', '14', 33, 7),
(151, '285121', 290.00, '+', 'EUR', '2023-12-01', '14', 33, 4),
(152, '523419', 150.00, '+', 'EUR', '2023-12-07', '14', 33, 6),
(153, '940047', 64.00, '+', 'EUR', '2023-12-16', NULL, 33, 4),
(154, '272423', 100.00, '-', 'EUR', '2023-12-02', '14', 33, 12),
(156, '883073', 263.00, '-', 'EUR', '2023-09-10', '7', 35, 12),
(157, '152330', 225.00, '-', 'EUR', '2023-10-13', '10', 35, 6),
(158, '691740', 232.00, '-', 'EUR', '2023-09-13', '7', 35, 14),
(159, '486997', 189.00, '-', 'EUR', '2023-11-15', '13', 35, 11),
(160, '404772', 121.00, '-', 'EUR', '2023-10-22', '10', 35, 7),
(161, '798231', 95.00, '-', 'EUR', '2023-10-17', '10', 35, 7),
(162, '330174', 228.00, '-', 'EUR', '2023-11-29', '13', 35, 8),
(163, '390080', 174.00, '-', 'EUR', '2023-10-22', '10', 35, 10),
(164, '027972', 255.00, '-', 'EUR', '2023-09-02', '7', 35, 10),
(165, '357261', 255.00, '-', 'EUR', '2023-11-18', '13', 35, 16),
(166, '876146', 8.00, '-', 'EUR', '2023-09-17', '6', 34, 7),
(167, '724787', 160.00, '-', 'EUR', '2023-10-24', '12', 34, 12),
(168, '962032', 86.00, '-', 'EUR', '2023-10-09', '9', 34, 7),
(169, '941785', 135.00, '-', 'EUR', '2023-10-10', '9', 34, 13),
(170, '726349', 117.00, '-', 'EUR', '2023-09-03', '6', 34, 12),
(171, '254627', 82.00, '-', 'EUR', '2023-11-01', '12', 34, 15),
(172, '805605', 260.00, '-', 'EUR', '2023-10-24', '9', 34, 15),
(173, '940689', 165.00, '-', 'EUR', '2023-09-09', '6', 34, 10),
(174, '726975', 32.00, '-', 'EUR', '2023-09-16', '6', 34, 14),
(175, '328953', 1.00, '-', 'EUR', '2023-03-17', '6', 34, 14),
(176, '055604', 172.00, '-', 'EUR', '2023-11-28', '14', 33, 5),
(177, '441209', 262.00, '-', 'EUR', '2023-11-06', '11', 33, 12),
(178, '060823', 165.00, '-', 'EUR', '2023-09-14', '8', 33, 4),
(179, '659869', 73.00, '-', 'EUR', '2023-09-28', '8', 33, 2),
(180, '423270', 171.00, '-', 'EUR', '2023-12-06', '14', 33, 14),
(181, '901880', 207.00, '-', 'EUR', '2023-12-02', '14', 33, 1),
(182, '112210', 265.00, '-', 'EUR', '2023-10-10', '11', 33, 3),
(183, '508059', 154.00, '-', 'EUR', '2023-09-22', '8', 33, 10),
(184, '224309', 105.00, '-', 'EUR', '2023-09-07', '5', 33, 7),
(185, '907756', 166.00, '-', 'EUR', '2023-11-03', '11', 33, 1),
(256, '592533', 172.01, '+', 'EUR', '2023-11-08', NULL, 33, 9),
(257, '828439', 112.35, '+', 'EUR', '2023-11-02', NULL, 33, 13),
(258, '285447', 190.53, '+', 'EUR', '2023-12-05', NULL, 33, 9),
(259, '147934', 77.79, '+', 'EUR', '2023-11-19', NULL, 33, 15),
(260, '879138', 45.37, '+', 'EUR', '2023-11-26', NULL, 33, 10),
(261, '443944', 236.18, '+', 'EUR', '2023-11-08', NULL, 33, 4),
(262, '388432', 260.60, '+', 'EUR', '2023-10-30', NULL, 33, 1),
(263, '677916', 124.76, '+', 'EUR', '2023-09-25', NULL, 33, 12),
(264, '235541', 225.52, '+', 'EUR', '2023-10-30', NULL, 33, 10),
(265, '019443', 3.90, '+', 'EUR', '2023-09-30', NULL, 33, 15),
(266, '434199', 67.55, '+', 'EUR', '2023-11-04', NULL, 33, 9),
(267, '145243', 57.67, '+', 'EUR', '2023-12-15', NULL, 33, 5),
(268, '232085', 64.02, '+', 'EUR', '2023-09-04', NULL, 33, 9),
(269, '414299', 30.62, '+', 'EUR', '2023-09-28', NULL, 33, 16),
(270, '139956', 179.01, '+', 'EUR', '2023-09-11', NULL, 33, 6),
(271, '682115', 18.56, '+', 'EUR', '2023-11-14', NULL, 33, 14),
(272, '027144', 244.55, '+', 'EUR', '2023-09-25', NULL, 33, 14),
(273, '418379', 183.76, '+', 'EUR', '2023-10-31', NULL, 33, 8),
(274, '292782', 145.71, '+', 'EUR', '2023-10-10', NULL, 33, 1),
(275, '538226', 85.58, '+', 'EUR', '2023-11-04', NULL, 33, 7),
(276, '481078', 117.44, '+', 'EUR', '2023-12-06', NULL, 33, 9),
(277, '772687', 265.06, '+', 'EUR', '2023-10-05', NULL, 33, 7),
(278, '336972', 250.25, '+', 'EUR', '2023-10-24', NULL, 33, 8),
(279, '284517', 289.24, '+', 'EUR', '2023-12-02', NULL, 33, 3),
(280, '836971', 55.58, '+', 'EUR', '2023-12-12', NULL, 33, 1),
(281, '631877', 14.57, '+', 'EUR', '2023-11-05', NULL, 33, 14),
(282, '224878', 6.69, '+', 'EUR', '2023-10-03', NULL, 33, 6),
(283, '098913', 95.67, '+', 'EUR', '2023-10-31', NULL, 33, 7),
(284, '439412', 3.73, '+', 'EUR', '2023-10-18', NULL, 33, 14),
(285, '965059', 125.92, '+', 'EUR', '2023-10-30', NULL, 33, 9),
(286, '661509', 268.26, '+', 'EUR', '2023-09-18', NULL, 33, 12),
(287, '053553', 62.59, '+', 'EUR', '2023-12-04', NULL, 33, 4),
(288, '271698', 95.87, '+', 'EUR', '2023-10-05', NULL, 33, 11),
(289, '660662', 61.40, '+', 'EUR', '2023-12-06', NULL, 33, 12),
(290, '226336', 86.64, '+', 'EUR', '2023-12-15', NULL, 33, 8),
(291, '205692', 259.34, '+', 'EUR', '2023-09-15', NULL, 33, 3),
(292, '180054', 274.74, '+', 'EUR', '2023-12-15', NULL, 33, 1),
(293, '020984', 56.44, '+', 'EUR', '2023-12-05', NULL, 33, 7),
(294, '781179', 146.12, '+', 'EUR', '2023-09-15', NULL, 33, 4),
(295, '821137', 280.01, '+', 'EUR', '2023-12-05', NULL, 33, 10),
(296, '888826', 249.78, '+', 'EUR', '2023-12-06', NULL, 33, 3),
(297, '619711', 153.18, '+', 'EUR', '2023-10-15', NULL, 33, 12),
(298, '545102', 100.36, '+', 'EUR', '2023-12-01', NULL, 33, 11),
(299, '111425', 6.79, '+', 'EUR', '2023-11-20', NULL, 33, 1),
(300, '725574', 28.58, '+', 'EUR', '2023-09-02', NULL, 33, 6),
(301, '318552', 170.01, '+', 'EUR', '2023-10-03', NULL, 33, 12),
(302, '561966', 120.82, '+', 'EUR', '2023-10-20', NULL, 33, 1),
(303, '929244', 175.83, '+', 'EUR', '2023-12-04', NULL, 33, 3),
(304, '532316', 214.48, '+', 'EUR', '2023-09-18', NULL, 33, 12),
(305, '317130', 50.23, '+', 'EUR', '2023-10-24', NULL, 33, 4),
(306, '595371', 85.02, '-', 'EUR', '2023-04-07', NULL, 33, 10),
(307, '445459', 147.39, '-', 'EUR', '2023-07-09', NULL, 33, 16),
(308, '855896', 127.49, '-', 'EUR', '2023-01-07', NULL, 33, 1),
(309, '980466', 237.28, '-', 'EUR', '2023-02-11', NULL, 33, 11),
(310, '767363', 97.89, '-', 'EUR', '2023-06-14', NULL, 33, 11),
(311, '198690', 72.31, '-', 'EUR', '2023-05-06', NULL, 33, 4),
(312, '015042', 60.11, '-', 'EUR', '2023-03-13', NULL, 33, 4),
(313, '560482', 58.32, '-', 'EUR', '2023-06-01', NULL, 33, 7),
(314, '789359', 145.67, '-', 'EUR', '2023-08-27', NULL, 33, 1),
(315, '376657', 249.45, '-', 'EUR', '2023-03-13', NULL, 33, 16),
(316, '582751', 262.10, '-', 'EUR', '2023-08-01', NULL, 33, 11),
(317, '226521', 37.14, '-', 'EUR', '2023-01-12', NULL, 33, 7),
(318, '355096', 217.19, '-', 'EUR', '2022-12-19', NULL, 33, 9),
(319, '115209', 2.13, '-', 'EUR', '2023-04-17', NULL, 33, 1),
(320, '149486', 230.21, '-', 'EUR', '2022-12-27', NULL, 33, 15),
(321, '497334', 222.95, '-', 'EUR', '2023-07-12', NULL, 33, 16),
(322, '974243', 47.84, '-', 'EUR', '2023-08-23', NULL, 33, 6),
(323, '626944', 106.71, '-', 'EUR', '2022-12-13', NULL, 33, 2),
(324, '473851', 299.08, '-', 'EUR', '2023-06-20', NULL, 33, 3),
(325, '749946', 77.18, '-', 'EUR', '2023-03-18', NULL, 33, 4),
(326, '109038', 259.40, '-', 'EUR', '2023-01-03', NULL, 34, 16),
(328, '030466', 31.71, '-', 'EUR', '2023-02-08', NULL, 34, 1),
(329, '212109', 93.27, '-', 'EUR', '2023-08-28', NULL, 34, 14),
(330, '098962', 85.30, '-', 'EUR', '2023-06-20', NULL, 34, 4),
(331, '871733', 89.44, '-', 'EUR', '2023-05-18', NULL, 34, 3),
(332, '156340', 16.13, '-', 'EUR', '2023-03-09', NULL, 34, 15),
(333, '498401', 210.70, '-', 'EUR', '2023-05-14', NULL, 34, 1),
(334, '175371', 283.11, '-', 'EUR', '2023-08-17', NULL, 34, 13),
(335, '014017', 178.14, '-', 'EUR', '2023-05-12', NULL, 34, 8),
(336, '694166', 113.58, '-', 'EUR', '2023-08-20', NULL, 34, 4),
(337, '710663', 227.59, '-', 'EUR', '2023-04-28', NULL, 34, 6),
(338, '549296', 152.86, '-', 'EUR', '2023-05-04', NULL, 34, 13),
(340, '160232', 106.52, '-', 'EUR', '2023-01-29', NULL, 34, 14),
(341, '248182', 57.70, '-', 'EUR', '2023-04-17', NULL, 34, 10),
(343, '120170', 256.13, '-', 'EUR', '2023-03-06', NULL, 34, 15),
(345, '243620', 29.36, '-', 'EUR', '2022-12-27', NULL, 34, 12),
(346, '079174', 182.15, '-', 'EUR', '2023-07-14', NULL, 35, 14),
(347, '034049', 5.55, '-', 'EUR', '2023-01-19', NULL, 35, 6),
(348, '339047', 218.78, '-', 'EUR', '2023-05-10', NULL, 35, 8),
(349, '653188', 79.00, '-', 'EUR', '2023-02-02', NULL, 35, 13),
(350, '965048', 80.77, '-', 'EUR', '2023-08-16', NULL, 35, 5),
(351, '593181', 27.58, '-', 'EUR', '2023-04-22', NULL, 35, 8),
(352, '492652', 119.62, '-', 'EUR', '2023-02-16', NULL, 35, 4),
(353, '375676', 91.69, '-', 'EUR', '2023-07-25', NULL, 35, 2),
(354, '208832', 262.16, '-', 'EUR', '2023-01-12', NULL, 35, 14),
(355, '892567', 6.87, '-', 'EUR', '2023-05-08', NULL, 35, 10),
(356, '464502', 201.62, '-', 'EUR', '2023-01-05', NULL, 35, 7),
(357, '613091', 135.93, '-', 'EUR', '2023-05-19', NULL, 35, 10),
(358, '348352', 10.94, '-', 'EUR', '2023-03-03', NULL, 35, 10),
(359, '182232', 11.61, '-', 'EUR', '2023-04-24', NULL, 35, 9),
(360, '663903', 77.89, '-', 'EUR', '2023-04-17', NULL, 35, 15),
(361, '826709', 106.38, '-', 'EUR', '2023-01-28', NULL, 35, 13),
(362, '654885', 248.50, '-', 'EUR', '2023-08-25', NULL, 35, 2),
(363, '226843', 68.86, '-', 'EUR', '2023-01-11', NULL, 35, 4),
(364, '975065', 294.74, '-', 'EUR', '2023-08-08', NULL, 35, 13),
(365, '541274', 106.05, '-', 'EUR', '2023-04-10', NULL, 35, 3),
(366, '613855', 144.76, '+', 'EUR', '2023-08-20', NULL, 33, 15),
(367, '030258', 135.52, '+', 'EUR', '2023-04-12', NULL, 33, 16),
(368, '984507', 193.18, '+', 'EUR', '2023-02-02', NULL, 33, 12),
(369, '631334', 220.92, '+', 'EUR', '2023-01-24', NULL, 33, 1),
(370, '069766', 275.92, '+', 'EUR', '2023-04-06', NULL, 33, 8),
(371, '376488', 266.75, '+', 'EUR', '2023-03-14', NULL, 33, 14),
(372, '578330', 7.27, '+', 'EUR', '2022-12-20', NULL, 33, 5),
(373, '225275', 93.03, '+', 'EUR', '2023-04-18', NULL, 33, 15),
(374, '792093', 43.87, '+', 'EUR', '2023-01-18', NULL, 33, 3),
(375, '273254', 282.79, '+', 'EUR', '2023-08-13', NULL, 33, 10),
(376, '973883', 175.20, '+', 'EUR', '2023-03-22', NULL, 33, 2),
(377, '603446', 128.04, '+', 'EUR', '2023-01-18', NULL, 33, 2),
(378, '639857', 9.75, '+', 'EUR', '2023-07-25', NULL, 33, 3),
(379, '966826', 58.70, '+', 'EUR', '2022-12-25', NULL, 33, 3),
(380, '697002', 56.95, '+', 'EUR', '2022-12-12', NULL, 33, 8),
(381, '177568', 118.48, '+', 'EUR', '2023-05-21', NULL, 33, 15),
(382, '401470', 29.48, '+', 'EUR', '2023-02-23', NULL, 33, 5),
(383, '959948', 218.73, '+', 'EUR', '2023-07-03', NULL, 33, 7),
(384, '710638', 10.49, '+', 'EUR', '2023-08-06', NULL, 33, 2),
(385, '344426', 194.95, '+', 'EUR', '2023-04-10', NULL, 33, 14),
(386, '643400', 31.82, '+', 'EUR', '2023-01-09', NULL, 33, 12),
(387, '500566', 268.32, '+', 'EUR', '2023-02-01', NULL, 33, 12),
(388, '171004', 211.54, '+', 'EUR', '2023-05-05', NULL, 33, 11),
(389, '851479', 12.58, '+', 'EUR', '2023-08-27', NULL, 33, 13),
(390, '149291', 104.84, '+', 'EUR', '2023-08-19', NULL, 33, 11),
(391, '705568', 220.87, '+', 'EUR', '2023-04-29', NULL, 33, 13),
(392, '063767', 28.05, '+', 'EUR', '2022-12-27', NULL, 33, 4),
(393, '952703', 229.08, '+', 'EUR', '2022-12-14', NULL, 33, 3),
(394, '716924', 185.30, '+', 'EUR', '2023-03-17', NULL, 33, 15),
(395, '521920', 176.78, '+', 'EUR', '2023-02-17', NULL, 33, 14),
(396, '460214', 99.08, '+', 'EUR', '2023-04-10', NULL, 33, 11),
(397, '216969', 21.87, '+', 'EUR', '2023-01-30', NULL, 33, 7),
(398, '516209', 226.13, '+', 'EUR', '2023-07-28', NULL, 33, 2),
(399, '422731', 18.97, '+', 'EUR', '2023-03-13', NULL, 33, 10),
(400, '792884', 292.93, '+', 'EUR', '2023-05-21', NULL, 33, 8),
(401, '340398', 81.09, '+', 'EUR', '2023-08-11', NULL, 33, 12),
(402, '473446', 199.81, '+', 'EUR', '2022-12-19', NULL, 33, 1),
(403, '438262', 142.72, '+', 'EUR', '2023-02-02', NULL, 33, 11),
(404, '575937', 43.38, '+', 'EUR', '2022-12-22', NULL, 33, 15),
(405, '578188', 37.90, '+', 'EUR', '2023-08-28', NULL, 33, 9),
(406, '574300', 266.64, '+', 'EUR', '2022-12-04', NULL, 33, 11),
(407, '994827', 250.45, '+', 'EUR', '2023-07-14', NULL, 33, 7),
(408, '509001', 219.97, '+', 'EUR', '2023-04-12', NULL, 33, 8),
(409, '744469', 32.98, '+', 'EUR', '2022-12-04', NULL, 33, 12),
(410, '077942', 202.06, '+', 'EUR', '2023-07-12', NULL, 33, 5),
(411, '445769', 92.59, '+', 'EUR', '2022-12-30', NULL, 33, 3),
(412, '148640', 177.52, '+', 'EUR', '2023-04-30', NULL, 33, 9),
(413, '444026', 138.70, '+', 'EUR', '2023-02-12', NULL, 33, 11),
(414, '728148', 92.15, '+', 'EUR', '2023-07-09', NULL, 33, 13),
(415, '166147', 226.54, '+', 'EUR', '2023-02-10', NULL, 33, 2),
(416, '299241', 19.74, '+', 'EUR', '2023-07-30', NULL, 33, 10),
(417, '685838', 204.64, '+', 'EUR', '2022-12-31', NULL, 34, 4),
(418, '032274', 220.11, '+', 'EUR', '2023-01-17', NULL, 34, 14),
(419, '720984', 4.69, '+', 'EUR', '2023-04-27', NULL, 34, 6),
(420, '381047', 93.79, '+', 'EUR', '2022-12-09', NULL, 34, 13),
(421, '976048', 17.98, '+', 'EUR', '2023-01-01', NULL, 34, 2),
(422, '142951', 261.94, '+', 'EUR', '2023-02-22', NULL, 34, 4),
(423, '302138', 247.27, '+', 'EUR', '2023-06-25', NULL, 34, 4),
(424, '303332', 235.32, '+', 'EUR', '2023-01-10', NULL, 34, 9),
(425, '905179', 211.37, '+', 'EUR', '2023-05-27', NULL, 34, 5),
(426, '126905', 203.54, '+', 'EUR', '2023-08-11', NULL, 34, 1),
(427, '039446', 3.14, '+', 'EUR', '2023-05-20', NULL, 34, 16),
(428, '661000', 209.35, '+', 'EUR', '2022-12-22', NULL, 34, 8),
(429, '215954', 49.93, '+', 'EUR', '2023-04-13', NULL, 34, 6),
(430, '117520', 201.07, '+', 'EUR', '2023-01-12', NULL, 34, 9),
(431, '354246', 100.07, '+', 'EUR', '2023-08-15', NULL, 34, 14),
(432, '152673', 254.33, '+', 'EUR', '2023-06-17', NULL, 34, 15),
(433, '640509', 185.44, '+', 'EUR', '2022-12-13', NULL, 34, 4),
(434, '288429', 222.65, '+', 'EUR', '2023-06-05', NULL, 34, 12),
(435, '543887', 208.39, '+', 'EUR', '2023-01-05', NULL, 34, 16),
(436, '467119', 104.07, '+', 'EUR', '2023-03-04', NULL, 34, 8),
(437, '063010', 226.95, '+', 'EUR', '2023-01-30', NULL, 34, 4),
(438, '845789', 10.44, '+', 'EUR', '2023-07-20', NULL, 34, 3),
(439, '105841', 292.35, '+', 'EUR', '2023-07-17', NULL, 34, 8),
(440, '367999', 226.51, '+', 'EUR', '2022-12-01', NULL, 34, 15),
(441, '686523', 150.28, '+', 'EUR', '2023-07-12', NULL, 34, 12),
(442, '668009', 115.32, '+', 'EUR', '2023-03-01', NULL, 34, 11),
(443, '379865', 238.55, '+', 'EUR', '2023-07-30', NULL, 34, 10),
(444, '652490', 213.85, '+', 'EUR', '2023-01-10', NULL, 34, 5),
(445, '961614', 267.77, '+', 'EUR', '2023-03-20', NULL, 34, 9),
(446, '706413', 68.36, '+', 'EUR', '2023-06-04', NULL, 34, 16),
(447, '071218', 235.08, '+', 'EUR', '2023-03-02', NULL, 34, 11),
(448, '450293', 230.89, '+', 'EUR', '2023-03-01', NULL, 34, 12),
(449, '253143', 121.68, '+', 'EUR', '2023-02-16', NULL, 34, 14),
(450, '895470', 248.15, '+', 'EUR', '2023-03-12', NULL, 34, 13),
(451, '291119', 165.42, '+', 'EUR', '2023-08-30', NULL, 34, 3),
(452, '252778', 95.36, '+', 'EUR', '2022-12-15', NULL, 34, 10),
(453, '592043', 192.62, '+', 'EUR', '2023-02-05', NULL, 34, 12),
(454, '410220', 262.86, '+', 'EUR', '2023-07-21', NULL, 34, 12),
(455, '922952', 18.67, '+', 'EUR', '2023-01-16', NULL, 34, 8),
(456, '071514', 52.29, '+', 'EUR', '2023-04-10', NULL, 34, 12),
(457, '214484', 107.47, '+', 'EUR', '2023-06-15', NULL, 34, 6),
(458, '068134', 298.59, '+', 'EUR', '2023-08-08', NULL, 34, 16),
(459, '847311', 207.66, '+', 'EUR', '2022-12-14', NULL, 34, 8),
(460, '334323', 201.92, '+', 'EUR', '2023-04-19', NULL, 34, 5),
(461, '909767', 147.18, '+', 'EUR', '2023-01-11', NULL, 34, 7),
(462, '117949', 67.09, '+', 'EUR', '2023-06-03', NULL, 34, 2),
(463, '482057', 54.13, '+', 'EUR', '2023-04-10', NULL, 34, 8),
(464, '028248', 42.70, '+', 'EUR', '2023-05-19', NULL, 34, 5),
(465, '932701', 121.55, '+', 'EUR', '2023-06-30', NULL, 34, 4),
(467, '3VhUki', 37.94, '+', 'EUR', '2021-11-13', NULL, 33, 15),
(468, 'yxszbZ', 17.63, '+', 'EUR', '2021-11-20', NULL, 33, 8),
(470, '5TA4op', 21.07, '+', 'EUR', '2021-07-17', NULL, 33, 5),
(471, 'xga803', 20.91, '+', 'EUR', '2023-03-11', NULL, 33, 11),
(472, '8eI7Pe', 10.77, '+', 'EUR', '2022-12-13', NULL, 33, 7),
(473, '7GLsEs', 35.45, '+', 'EUR', '2022-03-10', NULL, 33, 11),
(474, '0sDcTS', 42.94, '+', 'EUR', '2023-03-09', NULL, 33, 5),
(475, '8WK2O9', 35.41, '+', 'EUR', '2022-08-09', NULL, 33, 10),
(476, 'r4H1xJ', 41.44, '+', 'EUR', '2023-01-28', NULL, 33, 16),
(477, 'lc4mOY', 33.18, '+', 'EUR', '2021-08-17', NULL, 33, 3),
(478, '8fR77H', 45.81, '+', 'EUR', '2021-05-05', NULL, 33, 9),
(479, 'S32404', 36.48, '+', 'EUR', '2021-05-19', NULL, 33, 16),
(480, 'd227f6', 30.89, '+', 'EUR', '2022-04-02', NULL, 33, 13),
(481, 'z8V85e', 14.75, '+', 'EUR', '2022-11-05', NULL, 33, 3),
(482, 'rCQbpK', 45.16, '+', 'EUR', '2023-06-22', NULL, 33, 8),
(483, '6310zr', 17.05, '+', 'EUR', '2022-07-10', NULL, 33, 2),
(484, 'M0Dz2p', 17.23, '+', 'EUR', '2023-07-24', NULL, 33, 4),
(485, 'd0KNKE', 37.05, '+', 'EUR', '2023-06-12', NULL, 33, 12),
(486, '88h59W', 41.36, '+', 'EUR', '2022-09-29', NULL, 33, 4),
(487, 'U10oAt', 12.29, '+', 'EUR', '2021-07-03', NULL, 33, 3),
(488, '7bBXtr', 25.04, '+', 'EUR', '2022-12-24', NULL, 33, 15),
(489, 'GFv9pU', 25.41, '+', 'EUR', '2021-04-08', NULL, 33, 16),
(490, 'f7t2xl', 49.22, '+', 'EUR', '2021-08-06', NULL, 33, 11),
(491, 'KC1Ozu', 25.91, '+', 'EUR', '2021-11-08', NULL, 33, 16),
(492, 'eAjK4s', 14.95, '+', 'EUR', '2023-08-08', NULL, 33, 13),
(493, 'gBtl8W', 30.26, '+', 'EUR', '2022-11-07', NULL, 33, 7),
(494, 'tV0rUp', 46.22, '+', 'EUR', '2021-11-21', NULL, 33, 4),
(495, '59j783', 48.77, '+', 'EUR', '2021-11-20', NULL, 33, 5),
(496, 'PQjfO3', 32.33, '+', 'EUR', '2022-08-04', NULL, 33, 10),
(497, '1o9xc6', 13.68, '+', 'EUR', '2021-06-25', NULL, 33, 15),
(498, '4ZN4s3', 46.61, '+', 'EUR', '2023-02-02', NULL, 33, 8),
(499, 'Eya53B', 12.15, '+', 'EUR', '2021-10-02', NULL, 33, 5),
(500, 't42bPh', 35.99, '+', 'EUR', '2023-03-09', NULL, 33, 9),
(501, 'iXO583', 35.96, '+', 'EUR', '2021-11-26', NULL, 33, 4),
(502, 'E3AG9P', 25.12, '+', 'EUR', '2023-01-21', NULL, 33, 9),
(503, 'bpnrlU', 35.92, '+', 'EUR', '2021-06-29', NULL, 33, 5),
(504, 'r1S2Zt', 27.56, '+', 'EUR', '2023-03-07', NULL, 33, 13),
(505, '2G4AsR', 17.22, '+', 'EUR', '2022-01-23', NULL, 33, 1),
(506, 'rGdz8F', 45.71, '+', 'EUR', '2021-04-14', NULL, 33, 2),
(507, '6d90DJ', 36.75, '+', 'EUR', '2023-06-20', NULL, 33, 11),
(508, 'cCamdV', 46.23, '+', 'EUR', '2021-09-10', NULL, 33, 9),
(509, '76Z3Dx', 42.65, '+', 'EUR', '2021-05-24', NULL, 33, 6),
(510, '30U7Jy', 44.24, '+', 'EUR', '2022-05-23', NULL, 33, 13),
(511, 'l6kEvC', 27.41, '+', 'EUR', '2023-03-02', NULL, 33, 4),
(512, '14tief', 44.60, '+', 'EUR', '2021-08-06', NULL, 33, 9),
(513, 'g4th1j', 10.43, '+', 'EUR', '2021-04-20', NULL, 33, 7),
(514, 'Ruitg0', 20.74, '+', 'EUR', '2022-04-28', NULL, 33, 13),
(515, 'WCBM88', 48.59, '+', 'EUR', '2022-03-03', NULL, 33, 13),
(516, 'YSuyt6', 36.89, '+', 'EUR', '2022-05-16', NULL, 33, 13),
(517, 'wrVaae', 16.47, '+', 'EUR', '2022-07-28', NULL, 33, 8),
(518, 'VR3Nbw', 25.82, '+', 'EUR', '2021-08-27', NULL, 33, 12),
(519, 'U5DRwq', 33.80, '+', 'EUR', '2022-05-10', NULL, 33, 6),
(520, '790139', 115.72, '+', 'EUR', '2023-01-19', NULL, 35, 6),
(521, '165718', 294.35, '+', 'EUR', '2023-03-16', NULL, 35, 8),
(522, '161203', 232.67, '+', 'EUR', '2023-07-23', NULL, 35, 2),
(523, '636665', 94.53, '+', 'EUR', '2023-08-30', NULL, 35, 6),
(524, '473768', 276.40, '+', 'EUR', '2023-06-02', NULL, 35, 1),
(525, '988694', 33.20, '+', 'EUR', '2023-03-04', NULL, 35, 16),
(526, '471583', 75.72, '+', 'EUR', '2023-06-17', NULL, 35, 7),
(527, '351318', 76.24, '+', 'EUR', '2023-05-18', NULL, 35, 9),
(528, '811091', 6.63, '+', 'EUR', '2023-02-02', NULL, 35, 13),
(529, '736818', 107.59, '+', 'EUR', '2023-07-09', NULL, 35, 7),
(530, '281990', 285.55, '+', 'EUR', '2023-04-24', NULL, 35, 2),
(531, '495848', 182.99, '+', 'EUR', '2023-08-14', NULL, 35, 9),
(532, '685144', 141.81, '+', 'EUR', '2023-01-03', NULL, 35, 2),
(533, '408390', 58.03, '+', 'EUR', '2023-05-31', NULL, 35, 5),
(534, '498865', 250.83, '+', 'EUR', '2023-07-09', NULL, 35, 14),
(535, '758825', 5.66, '+', 'EUR', '2023-07-05', NULL, 35, 13),
(536, '580392', 36.74, '+', 'EUR', '2023-03-19', NULL, 35, 2),
(537, '588393', 70.26, '+', 'EUR', '2023-02-19', NULL, 35, 10),
(538, '984356', 294.49, '+', 'EUR', '2023-04-06', NULL, 35, 16),
(539, '785954', 203.41, '+', 'EUR', '2023-08-10', NULL, 35, 15),
(540, '400508', 2.35, '+', 'EUR', '2023-07-13', NULL, 35, 9),
(541, '980352', 277.60, '+', 'EUR', '2023-08-07', NULL, 35, 11),
(542, '001418', 26.75, '+', 'EUR', '2023-07-09', NULL, 35, 15),
(543, '783066', 135.47, '+', 'EUR', '2023-03-02', NULL, 35, 1),
(544, '941362', 104.50, '+', 'EUR', '2023-05-13', NULL, 35, 3),
(545, '230010', 236.97, '+', 'EUR', '2023-01-25', NULL, 35, 9),
(546, '933384', 117.88, '+', 'EUR', '2023-07-21', NULL, 35, 10),
(547, '058505', 135.05, '+', 'EUR', '2023-07-02', NULL, 35, 12),
(548, '612604', 38.43, '+', 'EUR', '2023-03-10', NULL, 35, 10),
(549, '532755', 96.68, '+', 'EUR', '2023-05-17', NULL, 35, 8),
(550, '644345', 99.66, '+', 'EUR', '2023-08-17', NULL, 35, 6),
(551, '302785', 22.95, '+', 'EUR', '2023-07-16', NULL, 35, 3),
(552, '208624', 210.15, '+', 'EUR', '2023-08-09', NULL, 35, 16),
(553, '108332', 246.17, '+', 'EUR', '2022-12-06', NULL, 35, 12),
(554, '439743', 84.10, '+', 'EUR', '2023-05-30', NULL, 35, 7),
(555, '505494', 44.36, '+', 'EUR', '2022-12-03', NULL, 35, 15),
(556, '393444', 69.99, '+', 'EUR', '2023-04-25', NULL, 35, 8),
(557, '216267', 226.86, '+', 'EUR', '2023-03-03', NULL, 35, 2),
(558, '904157', 177.10, '+', 'EUR', '2023-05-05', NULL, 35, 9),
(559, '405138', 46.94, '+', 'EUR', '2023-01-16', NULL, 35, 8),
(560, '234591', 177.98, '+', 'EUR', '2023-07-02', NULL, 35, 15),
(561, '139845', 137.38, '+', 'EUR', '2023-03-12', NULL, 35, 1),
(562, '434762', 88.99, '+', 'EUR', '2023-01-04', NULL, 35, 8),
(563, '648029', 187.90, '+', 'EUR', '2023-03-23', NULL, 35, 8),
(564, '641279', 125.51, '+', 'EUR', '2023-05-09', NULL, 35, 15),
(565, '993518', 181.43, '+', 'EUR', '2023-03-05', NULL, 35, 14),
(566, '737823', 163.13, '+', 'EUR', '2022-12-21', NULL, 35, 8),
(567, '051188', 122.60, '+', 'EUR', '2022-12-01', NULL, 35, 11),
(568, '315696', 196.36, '+', 'EUR', '2023-04-13', NULL, 35, 7),
(569, '798496', 112.58, '+', 'EUR', '2023-04-15', NULL, 35, 12);

-- --------------------------------------------------------

--
-- Table structure for table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `inscriptionDate` date NOT NULL DEFAULT current_timestamp(),
  `role` enum('Administrateur','PO','Client') NOT NULL,
  `numTel` varchar(10) DEFAULT NULL,
  `verifier` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUtilisateur`, `email`, `mdp`, `inscriptionDate`, `role`, `numTel`, `verifier`) VALUES
(1, 'elae.dsd@gmail.com', 'a3e604a28c9d7be2ea627dc2d66fcc773d7002b458c8605e8c6301da29ff8918', '2023-09-29', 'Administrateur', NULL, 1),
(2, 'po@gmail.com', '9fe48fa62fc90db8f54fdca303f493699e80cd30b1d0c5808b748272efa058af', '2023-10-22', 'PO', NULL, 1),
(33, 'apple.lognes@gmail.com', '557b35b102fc23e035932e6db9b9d9f4585f91cf150683f44a0e515fd6e86a40', '2023-10-22', 'Client', NULL, 1),
(34, 'amazon.torcy@gmail.com', 'cbc62794911ff31b2864ecd3dbbbee7ebcb7ea41c5a42e2cba377f3cfdb42811', '2023-10-22', 'Client', '0642165712', 0),
(35, 'kfc.noisy@gmail.com', 'd0b45e12780f3f7d579d3e8ab80ee1b4ac66f1376d2e1fc127be67cbad3e11a2', '2023-10-22', 'Client', '0657572967', 1),
(36, 'fnac.noisy@gmail.com', 'baa7125ffe88403e8d37699b67bc9dda2daf8ce8b3a6f210a04c86c62a953fe5', '2023-10-31', 'Client', '4444444444', 1),
(37, 'action.noisy@gmail.com', '4a4792817ab320bc3442ef51d1799d7d91b1e2bf0f85a725eed43d5a58bef82a', '2023-10-31', 'Client', '5666666666', 1),
(38, 'carrefour.noisy@gmail.com', '8e335e00474da0a70ee8ae1c53566429db87f39b24a6155bacd1d7e57edb59e5', '2023-10-31', 'Client', '7777777777', 1),
(40, 'sushibar.noisy@gmail.com', '2035f230e23f3df94e43992c7f8a1181265ed3533b336672ad10f45cc2c952af', '2023-11-01', 'Client', '7862969696', 1),
(43, 'mochi.sarl@gmail.com', '2035f230e23f3df94e43992c7f8a1181265ed3533b336672ad10f45cc2c952af', '2023-11-01', 'Client', '1418414446', 1),
(53, 'houangkeo@gmail.com', 'ca4503477a9f9e7be9e16713ab6b830d4b8a12b0380918b71841399e9632af04', '2023-12-14', 'Client', '8724184658', 1),
(54, 'merlin.lucas99@gmail.com', 'bdababc15df035b1ab54c8a4ddc6c34a892625540b96316d0809d6db6eb59162', '2023-12-14', 'Client', '8549872218', 1),
(55, 'lucas@gmail.com', 'bdababc15df035b1ab54c8a4ddc6c34a892625540b96316d0809d6db6eb59162', '2023-12-14', 'Client', '7874545697', 0),
(56, 'tt@gmail.com', '42e3c834f89167d7838864160a749a58d4cacba0cfc08019ed0c1e6dacc3f6f5', '2023-12-20', 'Client', '0678909876', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ClientFinal`
--
ALTER TABLE `ClientFinal`
  ADD PRIMARY KEY (`idClient`),
  ADD UNIQUE KEY `numCarteClient` (`numCarteClient`);

--
-- Indexes for table `Entreprise`
--
ALTER TABLE `Entreprise`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `numSiren` (`numSiren`);

--
-- Indexes for table `Impaye`
--
ALTER TABLE `Impaye`
  ADD PRIMARY KEY (`numDossierImpaye`),
  ADD UNIQUE KEY `idTransaction` (`idTransaction`);

--
-- Indexes for table `POrequete`
--
ALTER TABLE `POrequete`
  ADD PRIMARY KEY (`idRequete`),
  ADD KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `Remise`
--
ALTER TABLE `Remise`
  ADD PRIMARY KEY (`numRemise`),
  ADD KEY `Entreprise-Remise` (`idUtilisateur`);

--
-- Indexes for table `Token`
--
ALTER TABLE `Token`
  ADD PRIMARY KEY (`idToken`),
  ADD KEY `Fk_token_user` (`email`);

--
-- Indexes for table `Transaction`
--
ALTER TABLE `Transaction`
  ADD PRIMARY KEY (`idTransaction`),
  ADD UNIQUE KEY `numeroAutorisation` (`numAutorisation`),
  ADD KEY `numRemise` (`numRemise`),
  ADD KEY `Entreprise-Transaction` (`idUtilisateur`),
  ADD KEY `Client-Transaction` (`idClient`);

--
-- Indexes for table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ClientFinal`
--
ALTER TABLE `ClientFinal`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `POrequete`
--
ALTER TABLE `POrequete`
  MODIFY `idRequete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Token`
--
ALTER TABLE `Token`
  MODIFY `idToken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=670;

--
-- AUTO_INCREMENT for table `Transaction`
--
ALTER TABLE `Transaction`
  MODIFY `idTransaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

--
-- AUTO_INCREMENT for table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Entreprise`
--
ALTER TABLE `Entreprise`
  ADD CONSTRAINT `idEntreprise` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Impaye`
--
ALTER TABLE `Impaye`
  ADD CONSTRAINT `Transaction-Impaye` FOREIGN KEY (`idTransaction`) REFERENCES `Transaction` (`idTransaction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `POrequete`
--
ALTER TABLE `POrequete`
  ADD CONSTRAINT `Fk_request_user` FOREIGN KEY (`email`) REFERENCES `Utilisateur` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Remise`
--
ALTER TABLE `Remise`
  ADD CONSTRAINT `Entreprise-Remise` FOREIGN KEY (`idUtilisateur`) REFERENCES `Entreprise` (`idUtilisateur`) ON UPDATE CASCADE;

--
-- Constraints for table `Token`
--
ALTER TABLE `Token`
  ADD CONSTRAINT `Fk_token_user` FOREIGN KEY (`email`) REFERENCES `Utilisateur` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Transaction`
--
ALTER TABLE `Transaction`
  ADD CONSTRAINT `Client-Transaction` FOREIGN KEY (`idClient`) REFERENCES `ClientFinal` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Entreprise-Transaction` FOREIGN KEY (`idUtilisateur`) REFERENCES `Entreprise` (`idUtilisateur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `numRemise` FOREIGN KEY (`numRemise`) REFERENCES `Remise` (`numRemise`) ON DELETE SET NULL ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`dsd`@`%` EVENT `delete_expired_tokens` ON SCHEDULE EVERY 1 DAY STARTS '2023-10-16 22:50:05' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM Token WHERE date_valid < NOW()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
