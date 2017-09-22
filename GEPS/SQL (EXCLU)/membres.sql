
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 16 Mai 2016 à 00:58
-- Version du serveur: 10.0.20-MariaDB
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `u924407628_mbre`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `insc_date` varchar(255) NOT NULL,
  `grade` int(11) NOT NULL,
  `asTS` varchar(255) NOT NULL,
  `monthLeft` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mail`, `motdepasse`, `nom`, `prenom`, `age`, `sexe`, `pays`, `insc_date`, `grade`, `asTS`, `monthLeft`) VALUES
(2, 'Willbill360', 'wilgagnon@yahoo.com', '974cbda8726ee8e3cdb25e9346377042ae65eccc', 'Gagnon', 'William', 15, 'Homme', 'Canada', 'Samedi, le 14 mai 2016', 1, 'Non', '-1'),
(3, 'XxTheGamecraftxX', 'thekilleurcraft@gmail.com', '1726b659e9c281e71394f76a11ac352cc4d7b15e', 'Lagacé', 'Mathieu', 15, 'Homme', 'Canada', 'Samedi, le 14 mai 2016', 1, 'Oui', '-1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
