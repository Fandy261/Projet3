-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 30 jan. 2021 à 22:45
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet3`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(255) NOT NULL,
  `question` text NOT NULL,
  `reponse` text NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`id_user`, `nom`, `prenom`, `username`, `password`, `question`, `reponse`) VALUES
(1, 'Roulière', 'Fandy', 'Fandy', '$2y$10$QUWp3HSgTkcl3IjMQIr7h.83j5kzPqnpEC.e01ea4LB7lE8c1w4rK', 'Qui est mon professeur préféré?', 'Mr Andry'),
(17, 'Rouliere', 'Junior', 'Junior', '$2y$10$stfJUqvDhNmfM0TXWz.jleToI5dHUYDeL44HbzgQ3mKtezclw9pgm', 'Qui est mon père ?', 'je ne sais pas'),
(18, 'Chaigneaud', 'Marie', 'Marie', '$2y$10$3rqX8OHNmGj6Ad7KAopFX.DMRyGjXxplM4SgP60IvRx0Q5rij9pT2', 'Qui est moi?', 'maman'),
(19, 'Tsirimihanta', 'Fandeferana', 'fandeferana', '$2y$10$on9GVRll0P4RbOtXM/uOZOOBnil2LTNzDoLqMBeljZXIiWoC3vwxa', 'Qui est mon père?', 'dada'),
(15, 'Chaubet', 'Arlette', 'mamie', '$2y$10$3rqX8OHNmGj6Ad7KAopFX.DMRyGjXxplM4SgP60IvRx0Q5rij9pT2', 'Comment s\'appelle mon gros chat?', 'Balou'),
(14, 'Rojotiana', 'Santatra', 'Razoky', '$2y$10$ayH1fXZMUbrKRJu6huEOWu2Yat4sKsrn3M1qJBy.TXpqLpxl4hg3i', 'Qui suis-je?', 'frère de Fandeferana'),
(10, 'Roulière', 'Edmond', 'dada', '$2y$10$3rqX8OHNmGj6Ad7KAopFX.DMRyGjXxplM4SgP60IvRx0Q5rij9pT2', 'quel est ma chanson préféré?', 'scorpion love of my life'),
(11, 'Roulière', 'Stanys', 'Stan', '$2y$10$FyTc2yl.Db79lwmx9cxvkOnD/lU.xHMpPLmkJVeKD0p4D4GOetfMm', 'comment s\'appelle ma mère?', 'Coco'),
(12, 'Roulière', 'Tony', 'Tony', '$2y$10$3rqX8OHNmGj6Ad7KAopFX.DMRyGjXxplM4SgP60IvRx0Q5rij9pT2', 'comment s\'appelle mon père?', 'Eric'),
(13, 'Pivot', 'Gauss', 'Piso', '$2y$10$3rqX8OHNmGj6Ad7KAopFX.DMRyGjXxplM4SgP60IvRx0Q5rij9pT2', 'comment s\'appelle mon père?', 'Edmond');

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

DROP TABLE IF EXISTS `acteurs`;
CREATE TABLE IF NOT EXISTS `acteurs` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_acteur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `acteurs`
--

INSERT INTO `acteurs` (`id_acteur`, `nom`, `description`, `logo`) VALUES
(1, 'Protectpeople', 'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.\r\nNotre mission est double :\r\nsociale : nous garantissons la fiabilité des données sociales ;\r\néconomique : nous apportons une contribution aux activités économiques.', 'images\\protectpeople.png'),
(2, 'Formation&co', 'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\nNotre proposition : \r\n- un financement jusqu’à 30 000€ ;\r\n- un suivi personnalisé et gratuit ;\r\n- une lutte acharnée contre les freins sociétaux et les stéréotypes.\r\n\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.', 'images\\formation_co.png'),
(3, 'Dsa France', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s’adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.', 'images\\Dsa_france.png'),
(4, 'CDE', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.', 'images\\CDE.png');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_acteur` int NOT NULL,
  `date_add` datetime NOT NULL,
  `post` text NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `id_acteur`, `date_add`, `post`) VALUES
(121, 11, 1, '2021-01-30 23:44:44', '                        aaaaa'),
(119, 1, 1, '2021-01-29 19:08:30', 'Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale. Chez Protectpeople, '),
(120, 1, 3, '2021-01-29 19:10:59', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales. Nous accompagnons les entreprises dans les étapes clés de leur évolution. Notre philosophie : s’adapter à chaque entreprise. Nous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.'),
(115, 12, 1, '2021-01-29 18:55:55', 'Protectpeople finance la solidarité nationale.'),
(116, 12, 2, '2021-01-29 18:56:24', 'Nous appliquons le principe édifié par la Sécurité sociale');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_acteur` int NOT NULL,
  `vote` int NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id_user`, `id_acteur`, `vote`) VALUES
(12, 1, 1),
(15, 1, 1),
(10, 1, -1),
(1, 1, 1),
(19, 4, -1),
(11, 1, -1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
