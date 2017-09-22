-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Juin 2016 à 02:54
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
-- Structure de la table `f_messages`
--

DROP TABLE IF EXISTS `f_messages`;
CREATE TABLE IF NOT EXISTS `f_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `date_heure_post` datetime NOT NULL,
  `date_heure_edition` datetime DEFAULT NULL,
  `meilleure_reponse` int(1) NOT NULL DEFAULT '0',
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `f_messages`
--

INSERT INTO `f_messages` (`id`, `id_topic`, `id_posteur`, `date_heure_post`, `date_heure_edition`, `meilleure_reponse`, `contenu`) VALUES
(1, 6, 2, '2016-06-27 17:00:41', NULL, 0, 'Test'),
(2, 6, 2, '2016-06-27 17:29:01', NULL, 0, 'couccuxou bvgqnghjk'),
(3, 6, 2, '2016-06-27 17:29:05', NULL, 0, 'whgwghgjaghgsg'),
(4, 6, 2, '2016-06-27 17:29:09', NULL, 0, 'ghwywjhwjh'),
(5, 6, 2, '2016-06-27 17:29:16', NULL, 0, 'afaqfawgf'),
(6, 6, 2, '2016-06-27 17:29:21', NULL, 0, 'afafsfsa'),
(8, 6, 2, '2016-06-27 17:30:59', NULL, 0, 'weyt'),
(9, 6, 2, '2016-06-27 20:33:54', NULL, 0, '[center]HEllo[/center]'),
(10, 6, 2, '2016-06-27 20:36:59', NULL, 0, '[b][u]zdfafaf[/u][/b]'),
(11, 6, 2, '2016-06-27 20:37:11', NULL, 0, '[xlarge]fuuudu[/xlarge]'),
(12, 6, 2, '2016-06-27 20:37:18', NULL, 0, '[small]uu[/small]'),
(13, 6, 2, '2016-06-27 20:37:24', NULL, 0, '[xsmall]dyudyy[/xsmall]'),
(14, 6, 2, '2016-06-27 20:38:39', NULL, 0, '[small]Test pfaiogbaÂ [/small]\n[list2][*]dg[/*][/list2][img]http://s2.quickmeme.com/img/b5/b5f906fcfde62a7b863d0bf065a4f747f848567178e0eff8f1c64dee24008822.jpg[/img]\n'),
(15, 8, 2, '2016-06-27 22:49:07', NULL, 0, '[i]iiiiiiiiiiiiiiii[/i]');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
