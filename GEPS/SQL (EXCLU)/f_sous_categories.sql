-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Juin 2016 à 02:55
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `f_sous_categories`
--

DROP TABLE IF EXISTS `f_sous_categories`;
CREATE TABLE IF NOT EXISTS `f_sous_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_id` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL DEFAULT '0',
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `f_sous_categories`
--

INSERT INTO `f_sous_categories` (`id`, `ord_id`, `temp_id`, `id_categorie`, `nom`) VALUES
(1, 3, 3, 1, 'HTML'),
(2, 1, 1, 1, 'CSS'),
(3, 4, 4, 1, 'JavaScript'),
(4, 5, 5, 1, 'PHP'),
(5, 6, 6, 1, 'Ruby'),
(6, 7, 7, 1, 'C'),
(7, 8, 8, 1, 'Python'),
(8, 9, 9, 1, 'Perl'),
(9, 10, 10, 1, 'Java'),
(10, 11, 11, 2, 'Webcam'),
(11, 12, 12, 2, 'Claviers'),
(12, 13, 13, 2, 'Souris'),
(13, 14, 14, 2, 'Micro-Casque'),
(14, 15, 15, 3, 'PrÃ©sentation'),
(22, 16, 16, 3, 'trsts'),
(24, 2, 2, 1, 'CSS');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
