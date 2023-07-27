-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 13 avr. 2022 à 21:04
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `ceder`
--

DROP TABLE IF EXISTS `ceder`;
CREATE TABLE IF NOT EXISTS `ceder` (
  `IdInv` int(11) NOT NULL,
  `IdDem` int(11) NOT NULL,
  KEY `IdDem` (`IdDem`),
  KEY `IdInv` (`IdInv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `IdDem` int(11) NOT NULL AUTO_INCREMENT,
  `MotDem` text NOT NULL,
  `DateDem` date NOT NULL,
  `IdUtil` int(11) NOT NULL,
  `IdUtilDes` int(11) NOT NULL,
  PRIMARY KEY (`IdDem`),
  KEY `IdUtil` (`IdUtil`),
  KEY `IdUtilDes` (`IdUtilDes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `investissement`
--

DROP TABLE IF EXISTS `investissement`;
CREATE TABLE IF NOT EXISTS `investissement` (
  `IdInv` int(11) NOT NULL AUTO_INCREMENT,
  `NomInv` varchar(30) NOT NULL,
  `SomInv` int(10) NOT NULL,
  `PtgInv` double DEFAULT NULL,
  `GainInv` double DEFAULT NULL,
  `IdUtil` int(11) NOT NULL,
  `DateDebutInv` datetime DEFAULT NULL,
  `DateIncrement` datetime DEFAULT NULL,
  `DateFinInv` datetime DEFAULT NULL,
  `Duree` smallint(5) UNSIGNED DEFAULT NULL,
  `DateFinEff` datetime DEFAULT NULL,
  `TypeInv` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdInv`),
  KEY `IdUtil` (`IdUtil`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `investissement`
--

INSERT INTO `investissement` (`IdInv`, `NomInv`, `SomInv`, `PtgInv`, `GainInv`, `IdUtil`, `DateDebutInv`, `DateIncrement`, `DateFinInv`, `Duree`, `DateFinEff`, `TypeInv`) VALUES
(1, 'geeckteck', 10000000, 2, 2000000, 1, NULL, '2022-03-25 00:00:00', NULL, 0, NULL, NULL),
(2, 'AKPACA', 100000, 1, 11111, 24, NULL, '2022-03-25 00:00:00', NULL, 0, NULL, NULL),
(3, 'AKPACA', 100000, 1, 11111, 24, NULL, '2022-03-25 00:00:00', NULL, 0, NULL, NULL),
(6, 'lerias', 100000, 0.044505494, 104450.5494, 31, '2022-03-19 10:27:44', '2022-03-29 08:38:07', '2022-09-17 10:27:44', 9, NULL, NULL),
(7, 'lerias', 100000, 0.044505494, 104450.5494, 31, '2022-03-19 10:27:44', '2022-03-29 08:38:07', '2022-09-17 10:27:44', 9, NULL, NULL),
(8, 'lerias', 1001, 0.034615384, 1035.649999384, 31, '2022-03-21 12:32:04', '2022-03-29 08:38:07', '2022-09-19 12:32:04', 7, NULL, 'Achat de BlÃ©'),
(10, 'lerias', 650, 0.004945054, 653.2142851, 31, '2022-03-27 11:37:16', '2022-03-29 08:38:07', '2022-09-25 11:37:16', 1, NULL, 'Achat de ble'),
(11, 'lerias', 0, 0, 0, 31, '2022-03-29 18:02:05', '2022-03-29 18:02:05', '2022-09-27 18:02:05', 0, NULL, ''),
(12, 'lerias', 0, 0, 0, 31, '2022-03-29 18:02:56', '2022-03-29 18:02:56', '2022-09-27 18:02:56', 0, NULL, ''),
(13, 'lerias', 0, 0, 0, 31, '2022-03-29 18:04:01', '2022-03-29 18:04:01', '2022-09-27 18:04:01', 0, NULL, ''),
(14, 'lerias', 0, 0, 0, 31, '2022-03-29 18:05:25', '2022-03-29 18:05:25', '2022-09-27 18:05:25', 0, NULL, '');

--
-- Déclencheurs `investissement`
--
DROP TRIGGER IF EXISTS `before_insert_investissement`;
DELIMITER $$
CREATE TRIGGER `before_insert_investissement` BEFORE INSERT ON `investissement` FOR EACH ROW BEGIN
SET NEW.PtgInv = 0;
SET NEW.GainInv = NEW.SomInv;
SET NEW.DateDebutInv = NOW();
SET NEW.DateFinInv = ADDDATE(NEW.DateDebutInv, INTERVAL 182 DAY);
SET NEW.DateIncrement = NEW.DateDebutInv;
SET NEW.Duree = DATEDIFF(NEW.DateDebutInv,NEW.DateIncrement);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_investissement`;
DELIMITER $$
CREATE TRIGGER `before_update_investissement` BEFORE UPDATE ON `investissement` FOR EACH ROW BEGIN
SET NEW.Duree = TIMESTAMPDIFF(day,NEW.DateDebutInv,NEW.DateIncrement);
SET NEW.PtgInv = (0.9*NEW.Duree)/182;
SET NEW.GainInv = NEW.SomInv*(1+ NEW.PtgInv);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `IdNotif` int(11) NOT NULL AUTO_INCREMENT,
  `Expediteur` varchar(30) NOT NULL,
  `Destinataire` varchar(30) NOT NULL,
  `Message` text,
  `DateEnvoi` datetime DEFAULT NULL,
  PRIMARY KEY (`IdNotif`),
  KEY `index_exdes` (`Expediteur`,`Destinataire`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déclencheurs `notifications`
--
DROP TRIGGER IF EXISTS `before_insert_notifications`;
DELIMITER $$
CREATE TRIGGER `before_insert_notifications` BEFORE INSERT ON `notifications` FOR EACH ROW BEGIN
SET NEW.DateEnvoi = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IdUtil` int(11) NOT NULL AUTO_INCREMENT,
  `PseudoUtil` varchar(30) NOT NULL,
  `MailUtil` varchar(60) NOT NULL,
  `TelUtil` int(13) NOT NULL,
  `PassUtil` tinytext NOT NULL,
  `DateInscription` datetime DEFAULT NULL,
  `Solde` double DEFAULT '0',
  `Statut` varchar(30) NOT NULL DEFAULT 'Utilisateur',
  PRIMARY KEY (`IdUtil`),
  UNIQUE KEY `PseudoUtil` (`PseudoUtil`),
  UNIQUE KEY `TelUtil` (`TelUtil`),
  UNIQUE KEY `MailUtil` (`MailUtil`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtil`, `PseudoUtil`, `MailUtil`, `TelUtil`, `PassUtil`, `DateInscription`, `Solde`, `Statut`) VALUES
(1, 'hadi', 'hadiradjji64@gmail.com', 67957132, 'geeecktack0097', NULL, 0, 'Utilisateur'),
(2, 'jo', 'ji@gamil.com', 25412254, 'mplolikuj', NULL, 0, 'Utilisateur'),
(24, 'AKPACA', 'akpacale@gmail.com', 78787878, 'uio', NULL, 0, 'Admin'),
(26, 'ldkl', 'kpa@gmail.com', 54120570, 'Okplao@65', NULL, 0, 'Utilisateur'),
(28, 'tenor', 'akps@gmail.com', 84571200, 'jldlkld,l,@A54', NULL, 0, 'Admin'),
(29, 'pl', 'ghjfgfdff@gmail.com', 85465850, 'tyLAP@25', NULL, 0, 'Utilisateur'),
(30, 'Leri', 'akpacalerias@gmail.com', 51100880, '2fe10486fa3b118d5b5273dc147a7682bdd09875', NULL, 0, 'SuperAdmin'),
(31, 'lerias', 'akpacajean@gmail.com', 95373859, '2fe10486fa3b118d5b5273dc147a7682bdd09875', '2022-03-13 00:00:00', 210588, 'Utilisateur'),
(32, 'dine', 'alpha@gmail.com', 65452343, '2fe10486fa3b118d5b5273dc147a7682bdd09875', '2022-03-30 11:35:59', NULL, 'Utilisateur');

--
-- Déclencheurs `utilisateur`
--
DROP TRIGGER IF EXISTS `before_insert_utilisateur`;
DELIMITER $$
CREATE TRIGGER `before_insert_utilisateur` BEFORE INSERT ON `utilisateur` FOR EACH ROW BEGIN
SET NEW.DateInscription = NOW();
END
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications` ADD FULLTEXT KEY `message` (`Message`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ceder`
--
ALTER TABLE `ceder`
  ADD CONSTRAINT `ceder_ibfk_1` FOREIGN KEY (`IdDem`) REFERENCES `demande` (`IdDem`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ceder_ibfk_2` FOREIGN KEY (`IdInv`) REFERENCES `investissement` (`IdInv`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`IdUtil`) REFERENCES `utilisateur` (`IdUtil`) ON UPDATE CASCADE,
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`IdUtilDes`) REFERENCES `utilisateur` (`IdUtil`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `investissement`
--
ALTER TABLE `investissement`
  ADD CONSTRAINT `investissement_ibfk_1` FOREIGN KEY (`IdUtil`) REFERENCES `utilisateur` (`IdUtil`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
