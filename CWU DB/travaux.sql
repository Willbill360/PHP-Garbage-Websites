-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 05 Novembre 2016 à 16:36
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
-- Structure de la table `travaux`
--

DROP TABLE IF EXISTS `travaux`;
CREATE TABLE IF NOT EXISTS `travaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fiche` int(11) NOT NULL,
  `travail` varchar(255) NOT NULL,
  `assigneur` varchar(255) NOT NULL,
  `paie` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `serveur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `travaux`
--

INSERT INTO `travaux` (`id`, `id_fiche`, `travail`, `assigneur`, `paie`, `statut`, `date`, `serveur`) VALUES
(1, 4, 'Nettoyage de la cite', 'Steeve Thibodeau', '5', 'Terminer', '2016-11-03', 'uwg'),
(2, 4, 'ee', 'Willbill360', '0', 'Annuler', '2016-11-05', 'uwg'),
(3, 4, 'agnxzxv', 'Willbill360', '13', 'Terminer', '2016-11-05', 'uwg'),
(4, 4, 'Rammaser la citÃ©', 'Steeve Thibodeau', '13131', 'Terminer', '2016-11-05', 'uwg'),
(5, 4, 'Have fun toningh', 'Steeve Thibodeau', '35353', 'Terminer', '2016-11-05', 'uwg'),
(6, 4, 'e64647647dgdhgdg', 'Steeve Thibodeau', '0', 'Annuler', '2016-11-05', 'uwg'),
(7, 4, 'Â«cÂ«c', 'Steeve Thibodeau', '0', 'Annuler', '2016-11-05', 'uwg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
