
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 16 Juillet 2016 à 17:07
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
-- Structure de la table `f_categories`
--

CREATE TABLE IF NOT EXISTS `f_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_id` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `f_categories`
--

INSERT INTO `f_categories` (`id`, `ord_id`, `temp_id`, `nom`, `status`) VALUES
(1, 1, 0, 'Annonce Officielle', 'close'),
(2, 2, 0, 'Discussion', 'open'),
(3, 3, 0, 'Serveur', 'open');

-- --------------------------------------------------------

--
-- Structure de la table `f_messages`
--

CREATE TABLE IF NOT EXISTS `f_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `date_heure_post` datetime NOT NULL,
  `date_heure_edition` datetime DEFAULT NULL,
  `meilleure_reponse` int(1) NOT NULL DEFAULT '0',
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `f_sous_categories`
--

CREATE TABLE IF NOT EXISTS `f_sous_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_id` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL DEFAULT '0',
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `f_sous_categories`
--

INSERT INTO `f_sous_categories` (`id`, `ord_id`, `temp_id`, `id_categorie`, `nom`) VALUES
(2, 1, 0, 2, 'Général'),
(3, 2, 0, 3, 'asdfgh'),
(4, 3, 0, 1, 'No Subcats'),
(5, 4, 0, 1, 'No Subcats2');

-- --------------------------------------------------------

--
-- Structure de la table `f_suivis`
--

CREATE TABLE IF NOT EXISTS `f_suivis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `f_topics`
--

CREATE TABLE IF NOT EXISTS `f_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `titre` text NOT NULL,
  `contenu` text NOT NULL,
  `date_heure_creation` datetime NOT NULL,
  `resolu` tinyint(1) NOT NULL DEFAULT '0',
  `notif_createur` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `f_topics_categories`
--

CREATE TABLE IF NOT EXISTS `f_topics_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_souscategorie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `ip` varchar(255) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mail`, `motdepasse`, `ip`, `nom`, `prenom`, `age`, `sexe`, `pays`, `insc_date`, `grade`, `asTS`, `monthLeft`) VALUES
(2, 'Willbill360', 'wilgagnon@yahoo.com', '974cbda8726ee8e3cdb25e9346377042ae65eccc', '74.210.227.97', 'Gagnon', 'William', 15, 'Homme', 'Canada', 'Samedi, le 14 mai 2016', 1, 'Oui', '5'),
(3, 'XxTheGamecraftxX', 'thekilleurcraft@gmail.com', '1726b659e9c281e71394f76a11ac352cc4d7b15e', '', 'Lagacé', 'Mathieu', 15, 'Homme', 'Canada', 'Samedi, le 14 mai 2016', 1, 'Non', '-1'),
(4, 'YT_TheCOBBLE360', 'thomswim360@gmail.com', 'ea8897ccd720e030f9127ddabebc72cbbe6d626f', '', 'Gosselin', 'Thomas', 16, 'Homme', 'Canada', 'Samedi, le 21 mai 2016', 1, 'Non', '-1'),
(5, 'Yazid Down', 'zizougame@gmail.com', '11d1a1b70503ea9dff37c1c647b94485413e4d6e', '', 'Abdelli', 'Yazid', 15, 'Homme', 'France', 'Vendredi, le 01 juillet 2016', 0, 'Non', '-1'),
(6, 'YT_BedenPower', 'bedenpower20000@gmail.com', '2a68ec66aedd134f9d7805213bba69a3d84c95eb', '', 'Rioux', 'Benjamin', 16, 'Homme', 'Canada', 'Vendredi, le 01 juillet 2016', 0, 'Non', '-1'),
(7, 'Walky94', 'theps4online@hotmail.fr', '97682166813861ccf66b477158ccbe387c1b40e8', '', 'Lemieux', 'Anthony', 16, 'Homme', 'Canada', 'Lundi, le 04 juillet 2016', 0, 'Non', '-1'),
(8, 'Devaxtator', 'florian.gaire@sfr.fr', '3b731bb2fd00d8bbc7542ed36945926c1b1e5574', '', 'Gaire', 'Florian', 18, 'Homme', 'France', 'Mercredi, le 06 juillet 2016', 0, 'Non', '-1'),
(9, 'nanouvisilane', 'cedric.jeanneteau@gmail.com', '6940b6a2258d57fa70e837db1095b713c20c99c8', '', 'Jeanneteau', 'Cedric', 13, 'Homme', 'France', 'Mercredi, le 06 juillet 2016', 0, 'Non', '-1'),
(10, 'agent2208', 'aymanenon@gmail.com', '8e8b644917c8f71ba8d847de3f913dfb2d191a18', '', 'Ouiaazzane', 'Aymane', 12, 'Homme', 'France', 'Jeudi, le 07 juillet 2016', 0, 'Non', '-1'),
(11, 'bryano_15', 'rayanayadi02@gmail.com', 'e5c91d987507e996e4987a6f275997fb2e036e55', '', 'Ayadi', 'Rayan', 14, 'Homme', 'France', 'Samedi, le 09 juillet 2016', 0, 'Non', '-1'),
(12, 'arkane777', 'jam.henry.fontaine@gmail.com', '02a91cea62b98352d8e78466c82c0e41c8c3998e', '', 'Henry', 'Jeremy', 23, 'Homme', 'France', 'Dimanche, le 10 juillet 2016', 0, 'Non', '-1'),
(13, 'AkiramY', 'jonathanfarcine@gmail.com', '1ca12a0b6cc2afed5e993b55d65b77c8e148f02f', '', 'Farcine', 'Jonathan', 19, 'Homme', 'France', 'Dimanche, le 10 juillet 2016', 0, 'Non', '-1'),
(14, 'SnaKe420', 'sachaj653@gmail.com', 'd2d5ea5c9c18cdcbeda50ac8a11ef2a0f2465f6f', '', 'Jean st-pierre', 'Sacha', 17, 'Homme', 'Canada', 'Mardi, le 12 juillet 2016', 0, 'Non', '-1'),
(15, 'okyre', 'liam.liamus@gmail.com', '8a31b3fef69ae36005ab78d647518ee6bd4e4fdb', '77.151.146.16', 'Sangel', 'Liam', 14, 'Homme', 'France', 'Jeudi, le 14 juillet 2016', 0, 'Non', '-1');

-- --------------------------------------------------------

--
-- Structure de la table `newslester`
--

CREATE TABLE IF NOT EXISTS `newslester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `newslester`
--

INSERT INTO `newslester` (`id`, `pseudo`, `mail`) VALUES
(3, 'Yazid Down', 'zizougame@gmail.com'),
(2, 'Willbill360', 'wilgagnon@yahoo.com'),
(4, 'Walky94', 'theps4online@hotmail.fr'),
(5, 'nanouvisilane', 'cedric.jeanneteau@gmail.com'),
(6, 'agent2208', 'aymanenon@gmail.com'),
(7, 'bryano_15', 'rayanayadi02@gmail.com'),
(8, 'arkane777', 'jam.henry.fontaine@gmail.com'),
(9, 'AkiramY', 'jonathanfarcine@gmail.com'),
(10, 'SnaKe420', 'sachaj653@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

CREATE TABLE IF NOT EXISTS `rapport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `pseudo_sender` varchar(255) NOT NULL,
  `mail_sender` varchar(255) NOT NULL,
  `thedate` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `rapport`
--

INSERT INTO `rapport` (`id`, `ip`, `id_sender`, `pseudo_sender`, `mail_sender`, `thedate`, `type`, `message`) VALUES
(9, '74.210.227.97', 2, 'Willbill360', 'wilgagnon@yahoo.com', 'Dimanche, le 12 juin 2016', 'Bug', 'Type de bug: Site Web<br/> Explication: Ne pas supprimer ce rapport, sinon l''email n''aura pas l''id du dernier rapport !');

-- --------------------------------------------------------

--
-- Structure de la table `screenshot_more`
--

CREATE TABLE IF NOT EXISTS `screenshot_more` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sender` int(11) NOT NULL,
  `pseudo_sender` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `screenshot_more`
--

INSERT INTO `screenshot_more` (`id`, `id_sender`, `pseudo_sender`, `img`) VALUES
(1, 2, 'Willbill360', 'images/user_src/JB5RW.13.36.png'),
(2, 2, 'Willbill360', 'images/user_src/W4F7B.17.43.png'),
(3, 2, 'Willbill360', 'images/user_src/EvQ8J.12.50.png');

-- --------------------------------------------------------

--
-- Structure de la table `tsmdp`
--

CREATE TABLE IF NOT EXISTS `tsmdp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `monthLeft` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tsmdp`
--

INSERT INTO `tsmdp` (`id`, `pseudo`, `mail`, `monthLeft`) VALUES
(2, 'Willbill360', 'wilgagnon@yahoo.com', '5');

-- --------------------------------------------------------

--
-- Structure de la table `user_vote`
--

CREATE TABLE IF NOT EXISTS `user_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_vote` datetime NOT NULL,
  `counter_vote` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
