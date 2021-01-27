-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 27 jan. 2021 à 11:44
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`id_user`, `nom`, `prenom`, `username`, `password`, `question`, `reponse`) VALUES
(1, 'Roulière', 'Fandy', 'Fandy', '$2y$10$aAU05LM07eGCKIHaIFwAZuMfmhcD9qJjtIqvqERxjk3/QkhbJEEWS', 'qui est mon professeur préféré ', 'Mr Andry'),
(17, 'Rouliere', 'Junior', 'Junior', '$2y$10$aAU05LM07eGCKIHaIFwAZuMfmhcD9qJjtIqvqERxjk3/QkhbJEEWS', 'Qui est mon père ?', 'je ne sais pas'),
(18, 'Chaigneaud', 'Marie', 'Marie', '$2y$10$aAU05LM07eGCKIHaIFwAZuMfmhcD9qJjtIqvqERxjk3/QkhbJEEWS', 'Qui est moi?', 'maman'),
(15, 'Chaubet', 'Arlette', 'mamie', '$2y$10$McBnAFeL6V3is.GyUqhYUOf/XJSz2ZX9p2f6ydhRR9DmbkuMZxIny', 'Comment s\'appelle mon gros chat?', 'Balou'),
(14, 'Smith', 'John', 'razoky', '$2y$10$aAU05LM07eGCKIHaIFwAZuMfmhcD9qJjtIqvqERxjk3/QkhbJEEWS', 'comment s\'apelle ma femme?', 'Julie'),
(10, 'Roulière', 'Edmond', 'dada', '$2y$10$G5Mb4gGmrx4pnzHdmx1To..a9igh0887PioFIsrqZpTzoH2xvY/5q', 'quel est ma chanson préféré?', 'scorpion love of my life'),
(11, 'Roulière', 'Stanys', 'Stan', '$2y$10$sTfS74sxa5pkKrlo2xxdAORuPSZHAgaA89o/7M2fZYNK45u7bwlAy', 'comment s\'appelle ma mère?', 'Coco'),
(12, 'Roulière', 'Tony', 'Tony', '$2y$10$0iFokxUV7hCbkFZ7sAg3FOMRvht/YYEZ2qu/JlvBWZSLHPtvn3UNa', 'comment s\'appelle mon père?', 'Eric'),
(13, 'Pivot', 'Gauss', 'Piso', '$2y$10$aAU05LM07eGCKIHaIFwAZuMfmhcD9qJjtIqvqERxjk3/QkhbJEEWS', 'comment s\'appelle mon père?', 'Edmond');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
