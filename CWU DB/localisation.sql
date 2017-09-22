-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 10 Octobre 2016 à 23:37
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
-- Structure de la table `localisation`
--

DROP TABLE IF EXISTS `localisation`;
CREATE TABLE IF NOT EXISTS `localisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `serveur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `localisation`
--

INSERT INTO `localisation` (`id`, `id_user`, `localisation`, `date`, `serveur`) VALUES
(1, 2, 'a', '2016-08-15', 'uwg'),
(2, 2, '34 Apt. 5D', '2016-08-15', 'uwg'),
(3, 2, 'adad', '2016-08-15', 'uwg'),
(4, 2, 'adad', '2016-08-15', 'uwg'),
(5, 2, 'adad', '2016-08-15', 'uwg'),
(6, 2, 'adad', '2016-08-15', 'uwg'),
(7, 2, 'adad', '2016-08-15', 'uwg'),
(8, 2, 'adad', '2016-08-15', 'uwg'),
(9, 2, 'adad', '2016-08-15', 'uwg'),
(10, 4, '36837 Rue du poassan', '2016-10-08', 'uwg'),
(11, 4, '36837 Rue du poassan', '2016-10-08', 'uwg'),
(12, 4, 'aad', '2016-10-08', 'uwg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
