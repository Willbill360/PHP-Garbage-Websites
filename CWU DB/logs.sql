-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 10 Octobre 2016 à 23:38
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cwu_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo_modifier` varchar(255) NOT NULL,
  `id_fiche` int(11) NOT NULL,
  `modif` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `serveur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `logs`
--

INSERT INTO `logs` (`id`, `pseudo_modifier`, `id_fiche`, `modif`, `date`, `serveur`) VALUES
(1, 'Willbill360', 2, 'Localisation', '2016-08-15', 'uwg'),
(2, 'Willbill360', 2, 'Localisation', '2016-08-15', 'uwg'),
(3, 'Willbill360', 2, 'Localisation', '2016-08-15', 'uwg'),
(4, 'Willbill360', 2, 'Localisation', '2016-08-15', 'uwg'),
(5, 'Willbill360', 2, 'Localisation', '2016-08-15', 'uwg'),
(6, 'Willbill360', 2, 'Localisation', '2016-08-15', 'uwg'),
(7, 'Willbill360', 2, 'Localisation', '2016-08-15', 'uwg'),
(8, 'Willbill360', 2, 'Localisation', '2016-08-15', 'uwg'),
(9, 'MPF', 4, 'RÃ©compensement', '2016-10-08', 'uwg'),
(10, 'MPF', 4, 'RÃ©primende', '2016-10-08', 'uwg'),
(11, 'Willbill360', 4, 'Localisation', '2016-10-08', 'uwg'),
(12, 'Willbill360', 4, 'Localisation', '2016-10-08', 'uwg'),
(13, 'Willbill360', 4, 'Localisation', '2016-10-08', 'uwg'),
(14, 'Willbill360', 4, 'CID', '2016-10-08', 'uwg'),
(15, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(16, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(17, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(18, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(19, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(20, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(21, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(22, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(23, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(24, 'MPF', 4, 'Statut RecherchÃ©', '2016-10-09', 'uwg'),
(25, 'MPF', 4, 'Statut RecherchÃ©', '2016-10-09', 'uwg'),
(26, 'MPF', 4, 'Statut Disparu', '2016-10-09', 'uwg'),
(27, 'MPF', 4, 'Statut DÃ©cÃ©dÃ©', '2016-10-09', 'uwg'),
(28, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(29, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(30, 'MPF', 4, 'Statut RecherchÃ©', '2016-10-09', 'uwg'),
(31, 'MPF', 4, 'Statut Disparu', '2016-10-09', 'uwg'),
(32, 'MPF', 4, 'Statut DÃ©cÃ©dÃ©', '2016-10-09', 'uwg'),
(33, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(34, 'MPF', 4, 'Statut Disparu', '2016-10-09', 'uwg'),
(35, 'MPF', 4, 'Statut RecherchÃ©', '2016-10-09', 'uwg'),
(36, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(37, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(38, 'MPF', 4, 'Statut RecherchÃ©', '2016-10-09', 'uwg'),
(39, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(40, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(41, 'MPF', 4, 'Statut RecherchÃ©', '2016-10-09', 'uwg'),
(42, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(43, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(44, 'MPF', 4, 'RÃ©primende', '2016-10-09', 'uwg'),
(45, 'MPF', 4, 'RÃ©compensement', '2016-10-09', 'uwg'),
(46, 'MPF', 4, 'Statut DÃ©cÃ©dÃ©', '2016-10-09', 'uwg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
