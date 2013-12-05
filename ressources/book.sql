-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 04 Décembre 2013 à 21:10
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `book`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` longtext NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_element` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_element` (`id_element`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE if not exists `contact` (
`id_utilisateur1` int(11) NOT NULL, 
`id_utilisateur2` int(11) NOT NULL, 
`accept` tinyint(1) NOT NULL DEFAULT '0', 
PRIMARY KEY (`id_utilisateur1`,`id_utilisateur2`)) 
ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

CREATE TABLE IF NOT EXISTS `dossier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `element`
--

CREATE TABLE IF NOT EXISTS `element` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur1` int(11) NOT NULL,
  `id_utilisateur2` int(11) NOT NULL,
  `id_element` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur1` (`id_utilisateur1`),
  KEY `id_utilisateur2` (`id_utilisateur2`),
  KEY `id_element` (`id_element`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expediteur` int(11) NOT NULL,
  `receveur` int(11) NOT NULL,
  `text` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `time` datetime NOT NULL,
  `lu` enum('0','1') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expediteur` (`expediteur`),
  KEY `receveur` (`receveur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `sexualite` varchar(10) DEFAULT NULL,
  `situation_amoureuse` varchar(50) DEFAULT NULL,
  `langue` varchar(50) DEFAULT NULL,
  `religion` text,
  `politique` text,
  `adresse` text,
  `ville` text,
  `cp` int(5) DEFAULT NULL,
  `telephone` int(10) DEFAULT NULL,
  `emplois` varchar(50) DEFAULT NULL,
  `scolarite` varchar(50) DEFAULT NULL,
  `apropos` text,
  `citationsFavorites` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `prenom`, `mdp`, `nom`, `mail`, `date_naissance`, `sexe`, `sexualite`, `situation_amoureuse`, `langue`, `religion`, `politique`, `adresse`, `ville`, `cp`, `telephone`, `emplois`, `scolarite`, `apropos`, `citationsFavorites`) VALUES
(1, 'anthony', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'ringard', 'anthony.ringard@gmail.com', '1991-02-10', 'homme', 'femme', 'en couple', 'français', '', '', '67 rue pasteur', 'vendin ', 62880, 760587649, '', '', '', ''),
(2, 'test', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'test', 'test@gmail.com', '1922-02-03', 'homme', NULL, '', '', '', '', '', '', 0, 0, '', '', '', ''),
(3, 'Cindy ', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'ring', 'cindy@gmail.com', '1994-04-01', 'female', NULL, '', '', '', '', '', '', 0, 0, '', '', '', '');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_element`) REFERENCES `element` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_4` FOREIGN KEY (`id_element`) REFERENCES `element` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`id_utilisateur1`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `contact_ibfk_2` FOREIGN KEY (`id_utilisateur2`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `contact_ibfk_3` FOREIGN KEY (`id_utilisateur1`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `contact_ibfk_4` FOREIGN KEY (`id_utilisateur2`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `dossier_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `dossier_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `element`
--
ALTER TABLE `element`
  ADD CONSTRAINT `element_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `element_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`id_utilisateur1`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`id_utilisateur2`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `like_ibfk_3` FOREIGN KEY (`id_element`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `like_ibfk_4` FOREIGN KEY (`id_utilisateur1`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `like_ibfk_5` FOREIGN KEY (`id_utilisateur2`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `like_ibfk_6` FOREIGN KEY (`id_element`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`expediteur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receveur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`expediteur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `message_ibfk_4` FOREIGN KEY (`receveur`) REFERENCES `utilisateur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
