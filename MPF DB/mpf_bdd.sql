-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 11 Juin 2017 à 20:23
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mpf_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `interogatoires`
--

DROP TABLE IF EXISTS `interogatoires`;
CREATE TABLE IF NOT EXISTS `interogatoires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createur_matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` date DEFAULT NULL,
  `nom_sujet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `technique` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `infos_recup` text COLLATE utf8_unicode_ci NOT NULL,
  `deces_sujet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `outil` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `interogatoires`
--

INSERT INTO `interogatoires` (`id`, `createur_matricule`, `date_creation`, `nom_sujet`, `technique`, `infos_recup`, `deces_sujet`, `outil`) VALUES
(2, 'CCA-C17-ADMIN-ADMIN-3333', '2017-05-22', 'Jhon Rachid', 'Technnique de fou', 'rien nada fuckall', 'oui', 'aucun'),
(3, 'CCA-C17-ADMIN-ADMIN-3333', '2017-05-22', 'John Big Mama', 'Defoncage de gueule', 'Rien', 'Negatif', 'Massue'),
(4, 'CCA-C17-ADMIN-ADMIN-3333', '2017-05-22', 'Alfred LeBlond', 'Cassage des doights', 'Rien', 'Affirmatif', 'Masse');

-- --------------------------------------------------------

--
-- Structure de la table `lavagescerveau`
--

DROP TABLE IF EXISTS `lavagescerveau`;
CREATE TABLE IF NOT EXISTS `lavagescerveau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createur_matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` date DEFAULT NULL,
  `stage` int(11) NOT NULL,
  `raison` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `lavagescerveau`
--

INSERT INTO `lavagescerveau` (`id`, `matricule`, `createur_matricule`, `date_creation`, `stage`, `raison`) VALUES
(1, 'CCA-C17-VICE-DeL-14587', 'ADMIN', '2017-06-05', 1, 'A la vue trop de chose pas supposÃ© voir'),
(2, 'CCA-C17-VICE-DeL-14587', 'ADMIN', '2017-06-05', 2, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww');

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

DROP TABLE IF EXISTS `missions`;
CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emeteur_matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mission` text COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `missions`
--

INSERT INTO `missions` (`id`, `matricule`, `emeteur_matricule`, `mission`, `date_creation`) VALUES
(1, 'CCA-C17-ADMIN-ADMIN-3333', 'CCA-C17-CMB-SqL-8897', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed nibh tempor, faucibus sapien in, blandit nibh. Pellentesque sapien eros, dignissim at vestibulum eu, venenatis ut tortor. Vestibulum pretium leo et dapibus pharetra. Praesent non venenatis augue. Maecenas tristique sapien non nunc hendrerit, eget posuere nibh sodales. Morbi nunc magna, ullamcorper ut pharetra et, elementum ut sapien. Aliquam congue enim in augue laoreet, a egestas tortor ultricies. Praesent blandit blandit sollicitudin. Sed fermentum porta justo eget dapibus. Cras fermentum molestie sapien a pretium. Duis dui leo, semper id malesuada non, posuere nec risus.', '2017-05-22'),
(2, 'CCA-C17-ADMIN-ADMIN-3333', 'CCA-C17-ADMIN-ADMIN-3333', 'Raid en zone rebel', '2017-06-02'),
(3, 'ADMIN', 'ADMIN', 'awdaddadd', '2017-06-05'),
(4, 'ADMIN', 'ADMIN', 'dawdadad', '2017-06-05'),
(5, 'ADMIN', 'ADMIN', 'aweaeaeae', '2017-06-05'),
(6, 'CCA-C17-VICE-DeL-14587', 'ADMIN', 'waeeaeae', '2017-06-05');

-- --------------------------------------------------------

--
-- Structure de la table `qualifications`
--

DROP TABLE IF EXISTS `qualifications`;
CREATE TABLE IF NOT EXISTS `qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `qualifications`
--

INSERT INTO `qualifications` (`id`, `qualification`, `matricule`) VALUES
(2, 'Qualification de Tireur d''Ã‰lite', 'CCA-C17-ADMIN-ADMIN-3333'),
(3, 'Qualification en IngÃ©nÃ©rie Niveau 2', 'CCA-C17-ADMIN-ADMIN-3333'),
(9, 'Qualification en IngÃ©nÃ©rie Niveau 1', 'CCA-C17-VICE-DeL-14587'),
(6, 'Qualification en MÃ©canique Niveau 2', 'CCA-C17-ADMIN-ADMIN-3333');

-- --------------------------------------------------------

--
-- Structure de la table `rapportsprimaire`
--

DROP TABLE IF EXISTS `rapportsprimaire`;
CREATE TABLE IF NOT EXISTS `rapportsprimaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createur_matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'JURY',
  `statut` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'opened',
  `date_creation` date DEFAULT NULL,
  `rapport` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `rapportsprimaire`
--

INSERT INTO `rapportsprimaire` (`id`, `createur_matricule`, `division`, `statut`, `date_creation`, `rapport`) VALUES
(1, 'CCA-C17-JURY-SqL-8767', 'JURY', 'opened', '2017-05-21', 'Le premier rapport primaire pour effectuer des test de tout genre'),
(2, 'CCA-C17-JURY-AdJ-9882', 'JURY', 'opened', '2017-05-22', 'Deuxième rapports primaires, ceci fait aussi office de test.'),
(3, 'CCA-C17-JURY-DeL-5138', 'JURY', 'opened', '2017-05-22', 'Troisieme a la chaine'),
(4, 'CCA-C17-ADMIN-ADMIN-3333', 'JURY', 'closed', '2017-06-02', 'wea'),
(5, 'CCA-C17-ADMIN-ADMIN-3333', 'JURY', 'closed', '2017-06-02', 'addead'),
(6, 'CCA-C17-ADMIN-ADMIN-3333', 'JURY', 'closed', '2017-06-02', 'addead'),
(7, 'CCA-C17-ADMIN-ADMIN-3333', 'JURY', 'closed', '2017-06-03', 'test3'),
(8, 'CCA-C17-ADMIN-ADMIN-3333', 'JURY', 'closed', '2017-06-03', 'iaeharhaeae'),
(9, 'CCA-C17-ADMIN-ADMIN-3333', 'JURY', 'closed', '2017-06-03', 'eaweaweae'),
(10, 'CCA-C17-ADMIN-ADMIN-3333', 'JURY', 'closed', '2017-06-03', 'aeaweaeae');

-- --------------------------------------------------------

--
-- Structure de la table `rapportssecondaire`
--

DROP TABLE IF EXISTS `rapportssecondaire`;
CREATE TABLE IF NOT EXISTS `rapportssecondaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rapportprim_id` int(11) NOT NULL,
  `createur_matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` date DEFAULT NULL,
  `rapport` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `rapportssecondaire`
--

INSERT INTO `rapportssecondaire` (`id`, `rapportprim_id`, `createur_matricule`, `date_creation`, `rapport`) VALUES
(1, 6, 'CCA-C17-ADMIN-ADMIN-3333', '2017-06-03', 'waddad'),
(2, 6, 'CCA-C17-ADMIN-ADMIN-3333', '2017-06-03', 'awerarae'),
(3, 8, 'CCA-C17-ADMIN-ADMIN-3333', '2017-06-03', 'dadadada'),
(4, 8, 'CCA-C17-ADMIN-ADMIN-3333', '2017-06-03', 'adada'),
(5, 3, 'CCA-C17-ADMIN-ADMIN-3333', '2017-06-03', 'dawdawdaa'),
(6, 3, 'CCA-C17-ADMIN-ADMIN-3333', '2017-06-03', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numericalgrade` int(11) NOT NULL,
  `division` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_service` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `matricule`, `password`, `grade`, `numericalgrade`, `division`, `p_service`) VALUES
(1, 'ADMIN', '9ad02ee9af2b536b421008920d279d59d7bd2309', 'SqL', 8, 'JURY', 100),
(2, 'CCA-C17-VICE-DeL-14587', '3ebfa301dc59196f18593c45e519287a23297589', 'DeL', 9, 'VICE', 100),
(3, 'CCA-C17-CMB-01-8124', 'test2', '04', 3, 'CMB', 100),
(4, 'CCA-C17-CMB-01-1458', 'test34', '01', 6, 'CMB', 100),
(5, 'CCA-C17-CMB-04-1458', 'test5', '01', 6, 'CMB', 131),
(6, 'CCA-C17-CMB-RCT-97543', 'ab5fa01535b83aa4045276201ebf24d1f9e18c37', 'RCT', 1, 'CMB', 0),
(7, 'CCA-C17-MACE-04-89655', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '04', 3, 'MACE', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
