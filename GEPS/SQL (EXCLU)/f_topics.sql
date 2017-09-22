-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Juin 2016 à 02:56
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
-- Structure de la table `f_topics`
--

DROP TABLE IF EXISTS `f_topics`;
CREATE TABLE IF NOT EXISTS `f_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `titre` text NOT NULL,
  `contenu` text NOT NULL,
  `date_heure_creation` datetime NOT NULL,
  `resolu` tinyint(1) NOT NULL DEFAULT '0',
  `notif_createur` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `f_topics`
--

INSERT INTO `f_topics` (`id`, `id_createur`, `titre`, `contenu`, `date_heure_creation`, `resolu`, `notif_createur`) VALUES
(1, 2, 'Test', 'Ceci est yb test', '2016-06-27 13:50:32', 0, 0),
(2, 2, 'Test2', 'afffaf', '2016-06-27 14:06:43', 0, 0),
(3, 2, 'waffwaf', 'afghsdfr', '2016-06-27 14:06:47', 0, 0),
(4, 2, 'coucou jecrit sans regaerder le cklavvier lol', 'sa matrceh a peut pres mais sa bug uin peu ', '2016-06-27 14:07:15', 0, 0),
(5, 2, 'Je ssate encore mais sa marcvbe pas beaucoyup ebncore ', 'cvaslusabsgangsBGNM,.DF', '2016-06-27 14:07:34', 0, 0),
(6, 2, 'Les Clavier c cool', 'Non', '2016-06-27 15:31:38', 0, 0),
(7, 2, 'Casque pas cher', 'Non mais serieux', '2016-06-27 15:32:12', 0, 0),
(8, 2, 'Test', 'Hello Just testing d\r\nadnaffjj\r\nbecause im not shute its workin[img]http://dl.ziza.ru/other/072009/08/pics/021_pics.jpg[/img]gÂ ', '2016-06-27 21:08:46', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
