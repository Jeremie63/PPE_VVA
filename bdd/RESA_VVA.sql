-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 16 Juin 2016 à 02:55
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `resa_vva`
--
DROP DATABASE IF EXISTS RESA_VVA;

CREATE DATABASE IF NOT EXISTS RESA_VVA;
USE RESA_VVA;
-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE IF NOT EXISTS `compte` (
  `USER` char(8) NOT NULL,
  `MDP` char(10) DEFAULT NULL,
  `NOMCOMPTE` char(40) DEFAULT NULL,
  `PRENOMCOMPTE` char(30) DEFAULT NULL,
  `DATEINSCRIP` date DEFAULT NULL,
  `DATESUPPRESSION` date DEFAULT NULL,
  `TYPECOMPTE` char(3) DEFAULT NULL,
  PRIMARY KEY (`USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`USER`, `MDP`, `NOMCOMPTE`, `PRENOMCOMPTE`, `DATEINSCRIP`, `DATESUPPRESSION`, `TYPECOMPTE`) VALUES
('admin', 'admin', 'Dubois', 'Jérémie', '2015-12-08', NULL, 'ADM'),
('ans05', 'ans05', 'Ansel', 'Benoit', '2016-05-23', '2016-12-01', 'VIL'),
('arsen90', 'arsen90', 'Arsenault', 'Mariette', '2016-05-23', '2016-12-01', 'VIL'),
('aubin93', 'aubin93', 'Bizier', 'Aubin', '2016-05-23', '2016-12-01', 'VIL'),
('avv', 'avv', 'Leclair', 'Emmanuel', '2016-04-21', NULL, 'AVV'),
('cha97', 'cha97', 'Patel', 'Charline', '2016-05-23', '2016-12-01', 'VIL'),
('des25', 'des25', 'Desroches', 'Eugène', '2016-05-23', '2016-12-01', 'VIL'),
('dum19', 'dum19', 'Dumoulin', 'Mélodie', '2016-05-23', '2016-12-01', 'VIL'),
('eliot96', 'eliot96', 'Boulanger', 'Eliot', '2016-05-23', '2016-12-01', 'VIL'),
('gauv78', 'gauv78', 'Gauvin', 'Eléonore', '2016-05-23', '2016-12-01', 'VIL'),
('hugh56', 'hugh56', 'Salmons', 'Hugues', '2016-05-23', '2016-12-01', 'VIL'),
('lav02', 'lav02', 'Lavoie', 'Agathe', '2016-05-23', '2016-12-01', 'VIL'),
('met23', 'met23', 'Métivier', 'Céline', '2016-05-23', '2016-12-01', 'VIL'),
('namo56', 'namo56', 'Ouellet', 'Namo', '2016-05-23', '2016-12-01', 'VIL'),
('pat25', 'pat25', 'Brisette', 'Patrick', '2016-05-23', '2016-12-01', 'VIL'),
('pois50', 'pois50', 'Poisson', 'André', '2016-05-23', '2016-12-01', 'VIL'),
('sator49', 'sator49', 'Desserres', 'Satordi', '2016-05-23', '2016-12-01', 'VIL'),
('val67', 'val67', 'Cuilleret', 'Valérie', '2016-05-23', '2016-12-01', 'VIL'),
('vern72', 'vern72', 'Rhéaume', 'Vernon', '2016-05-23', '2016-12-01', 'VIL'),
('vil', 'vil', 'Fouquet', 'Marmion', '2016-04-27', NULL, 'VIL');

-- --------------------------------------------------------

--
-- Structure de la table `etat_resa`
--

CREATE TABLE IF NOT EXISTS `etat_resa` (
  `CODEETATRESA` char(2) NOT NULL,
  `NOMETATRESA` char(16) DEFAULT NULL,
  PRIMARY KEY (`CODEETATRESA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat_resa`
--

INSERT INTO `etat_resa` (`CODEETATRESA`, `NOMETATRESA`) VALUES
('E1', 'Prise en compte'),
('E2', 'Accusé réception'),
('E3', 'Arrhes versées'),
('E4', 'Clés données');

-- --------------------------------------------------------

--
-- Structure de la table `hebergement`
--

CREATE TABLE IF NOT EXISTS `hebergement` (
  `NOHEB` int(4) NOT NULL AUTO_INCREMENT,
  `CODETYPEHEB` char(5) NOT NULL,
  `NOMHEB` char(25) DEFAULT NULL,
  `NBPLACEHEB` int(2) DEFAULT NULL,
  `SURFACEHEB` int(2) DEFAULT NULL,
  `INTERNET` tinyint(1) DEFAULT NULL,
  `ANNEEHEB` int(4) DEFAULT NULL,
  `SECTEURHEB` char(15) DEFAULT NULL,
  `ORIENTATIONHEB` char(5) DEFAULT NULL,
  `ETATHEB` char(32) DEFAULT NULL,
  `DESCRIHEB` char(200) DEFAULT NULL,
  `PHOTOHEB` char(50) DEFAULT NULL,
  `cdSite` char(3) NOT NULL,
  PRIMARY KEY (`NOHEB`),
  KEY `FK_HEBERGEMENT_TYPE_HEB` (`CODETYPEHEB`),
  KEY `cdSite` (`cdSite`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `hebergement`
--

INSERT INTO `hebergement` (`NOHEB`, `CODETYPEHEB`, `NOMHEB`, `NBPLACEHEB`, `SURFACEHEB`, `INTERNET`, `ANNEEHEB`, `SECTEURHEB`, `ORIENTATIONHEB`, `ETATHEB`, `DESCRIHEB`, `PHOTOHEB`, `cdSite`) VALUES
(31, 'APP', 'Les Ulysses', 2, 20, 1, 2006, 'secteur 1', 'Nord', 'Bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'appart1.jpg', 'SI1'),
(32, 'BUN', 'Le Nautilus', 3, 20, 1, 2010, 'Secteur 3', 'Sud', 'Bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'bunga1.jpg', 'SI2'),
(33, 'APP', 'Louise Bourgeois', 4, 40, 1, 2012, 'Secteur 4', 'Est', 'Neuf', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'appart2.jpg', 'SI3'),
(34, 'APP', 'Les Fleurs', 2, 20, 1, 2009, 'Secteur 5', 'Ouest', 'bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'appart3.jpg', 'SI1'),
(35, 'BUN', 'Le Navire', 1, 12, 0, 2007, 'Secteur 6', 'Nord', 'Rénové', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'bunga2.jpg', ''),
(36, 'MOB', 'Mobilien', 2, 10, 0, 2004, 'Secteur 7', 'Sud', 'Bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'mobil1.jpg', ''),
(37, 'CHA', 'Le Bouquetin', 4, 30, 0, 2008, 'Secteur 8', 'Ouest', 'Rénové plusieurs fois', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'chalet1.jpg', ''),
(38, 'APP', 'Le Chaligny', 4, 40, 1, 2011, 'secteur 9', 'Ouest', 'Excellent état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'appart5.jpg', ''),
(39, 'APP', 'Marie de Médicis', 1, 10, 0, 2006, 'secteur 8', 'Sud', 'bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'appart4.jpg', ''),
(40, 'BUN', 'Beauvau', 4, 25, 0, 2008, 'secteur 1', 'Sud', 'état moyen', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'bunga4.jpg', ''),
(41, 'BUN', 'Le Royal', 4, 30, 1, 2013, 'secteur 2', 'Sud', 'Neuf', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'bunga3.jpg', ''),
(42, 'BUN', 'Le Courbet', 2, 20, 0, 2010, 'secteur 3', 'Nord', 'Bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'bunga5.jpg', ''),
(43, 'MOB', 'Le Maréchal', 1, 15, 1, 2007, 'secteur 2', 'Nord', 'Bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'mobil2.jpg', ''),
(44, 'MOB', 'L''Amandier', 2, 15, 0, 2011, 'secteur 5', 'Sud', 'Moyen état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'mobil3.jpg', ''),
(45, 'MOB', 'Ferdinand', 1, 12, 0, 2005, 'secteur7', 'Est', 'Rénové plusieurs fois', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'mobil4.jpg', ''),
(46, 'MOB', 'Durand', 4, 14, 0, 2013, 'secteur 8', 'Nord', 'Bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'mobil5.jpg', ''),
(47, 'CHA', 'Le Châtelin', 2, 25, 1, 2011, 'secteur 1', 'Nord', 'Bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'chalet2.jpg', ''),
(48, 'CHA', 'Orangis', 3, 29, 1, 2012, 'secteur 2', 'Est', 'Excellent état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'chalet3.jpg', ''),
(49, 'CHA', 'Rouvray', 6, 50, 1, 2013, 'secteur 4', 'Est', 'Neuf', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'chalet4.jpg', ''),
(50, 'CHA', 'Saint Honoré', 2, 23, 0, 2006, 'secteur 3', 'Ouest', 'Bon état', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un', 'chalet5.jpg', ''),
(51, 'APP', 'Test1', 2, 20, 1, 2004, 'secteur 2', 'Nord', 'bon état', 'ok', 'appart1.jpg', 'SI2'),
(52, 'APP', 'appartement1', 4, 30, 1, 2006, 'secteur 2', 'Sud', 'bon état', 'ok', 'appart2.jpg', 'SI1');

-- --------------------------------------------------------

--
-- Structure de la table `resa`
--

CREATE TABLE IF NOT EXISTS `resa` (
  `NOHEB` int(4) NOT NULL,
  `DATEDEBSEM` date NOT NULL,
  `NOVILLAGEOIS` int(5) NOT NULL,
  `CODEETATRESA` char(2) NOT NULL,
  `DATERESA` date DEFAULT NULL,
  `DATEACCUSERECEPT` date DEFAULT NULL,
  `DATEARRHES` date DEFAULT NULL,
  `MONTANTARRHES` decimal(7,2) DEFAULT NULL,
  `NBOCCUPANT` int(2) DEFAULT NULL,
  `PRIXRESA` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`NOHEB`,`DATEDEBSEM`),
  KEY `FK_RESA_VILLAGEOIS` (`NOVILLAGEOIS`),
  KEY `FK_RESA_SEMAINE` (`DATEDEBSEM`),
  KEY `FK_RESA_ETAT_RESA` (`CODEETATRESA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `resa`
--

INSERT INTO `resa` (`NOHEB`, `DATEDEBSEM`, `NOVILLAGEOIS`, `CODEETATRESA`, `DATERESA`, `DATEACCUSERECEPT`, `DATEARRHES`, `MONTANTARRHES`, `NBOCCUPANT`, `PRIXRESA`) VALUES
(31, '2016-03-26', 4, 'E4', '2016-05-19', '2016-05-21', '2016-05-01', '800.00', 1, '600.00'),
(31, '2016-04-02', 4, 'E3', '2016-05-20', '2016-05-21', '2016-01-01', '400.00', 1, '600.00'),
(31, '2016-04-09', 4, 'E4', '2016-05-20', '2016-05-21', '2016-01-18', '500.00', 1, '600.00'),
(31, '2016-07-09', 4, 'E2', '2016-05-20', '2016-05-21', NULL, NULL, 1, '700.00'),
(31, '2016-07-16', 4, 'E2', '2016-05-20', '2016-05-21', NULL, NULL, 2, '700.00'),
(31, '2016-08-06', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 2, '700.00'),
(31, '2016-08-13', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 1, '700.00'),
(31, '2016-09-10', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 2, '500.00'),
(31, '2016-09-17', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 2, '500.00'),
(31, '2016-09-24', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 2, '500.00'),
(31, '2016-10-01', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 1, '500.00'),
(31, '2016-10-08', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 1, '500.00'),
(31, '2016-10-29', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 2, '500.00'),
(31, '2016-11-12', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 2, '500.00'),
(31, '2016-11-19', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 2, '500.00'),
(31, '2016-11-26', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 1, '500.00'),
(31, '2016-12-24', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 2, '500.00'),
(32, '2016-07-23', 4, 'E1', '2016-05-20', NULL, NULL, NULL, 3, '1200.00'),
(32, '2016-08-06', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 2, '1200.00'),
(32, '2016-08-13', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 3, '1200.00'),
(32, '2016-09-10', 4, 'E1', '2016-05-21', NULL, NULL, NULL, 1, '800.00'),
(32, '2016-10-08', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 2, '800.00'),
(32, '2016-10-15', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 1, '800.00'),
(32, '2016-10-22', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 2, '800.00'),
(32, '2016-10-29', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 2, '800.00'),
(32, '2016-11-19', 4, 'E2', '2016-05-21', '2016-05-21', NULL, NULL, 3, '800.00'),
(33, '2016-08-06', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 3, '1400.00'),
(34, '2016-06-18', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 1, '1100.00'),
(34, '2016-07-16', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 1, '1100.00'),
(37, '2016-07-09', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 4, '1300.00'),
(37, '2016-08-06', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 2, '1300.00'),
(37, '2016-09-10', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 2, '900.00'),
(39, '2016-07-16', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 1, '800.00'),
(39, '2016-07-30', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 1, '800.00'),
(40, '2016-07-23', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 3, '900.00'),
(41, '2016-09-03', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 2, '1200.00'),
(43, '2016-06-25', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 1, '900.00'),
(44, '2016-07-02', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 2, '700.00'),
(44, '2016-09-24', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 1, '500.00'),
(48, '2016-09-10', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 3, '800.00'),
(50, '2016-08-27', 12, 'E1', '2016-05-23', NULL, NULL, NULL, 1, '1050.00');

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

CREATE TABLE IF NOT EXISTS `saison` (
  `CODESAISON` char(2) NOT NULL,
  `NOMSAISON` char(15) DEFAULT NULL,
  `DATEDEBSAISON` date DEFAULT NULL,
  `DATEFINSAISON` date DEFAULT NULL,
  PRIMARY KEY (`CODESAISON`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `saison`
--

INSERT INTO `saison` (`CODESAISON`, `NOMSAISON`, `DATEDEBSAISON`, `DATEFINSAISON`) VALUES
('BS', 'Basse saison', '2016-09-03', '2016-12-30'),
('CR', 'Période creuse', '2016-01-02', '2016-03-04'),
('HS', 'Haute saison', '2016-06-04', '2016-09-02'),
('MS', 'Moyenne saison', '2016-03-05', '2016-06-03');

-- --------------------------------------------------------

--
-- Structure de la table `semaine`
--

CREATE TABLE IF NOT EXISTS `semaine` (
  `DATEDEBSEM` date NOT NULL,
  `CODESAISON` char(2) NOT NULL,
  `DATEFINSEM` date DEFAULT NULL,
  PRIMARY KEY (`DATEDEBSEM`),
  KEY `FK_SEMAINE_SAISON` (`CODESAISON`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `semaine`
--

INSERT INTO `semaine` (`DATEDEBSEM`, `CODESAISON`, `DATEFINSEM`) VALUES
('2016-01-02', 'CR', '2016-01-08'),
('2016-01-09', 'CR', '2016-01-15'),
('2016-01-16', 'CR', '2016-01-22'),
('2016-01-23', 'CR', '2016-01-29'),
('2016-01-30', 'CR', '2016-02-05'),
('2016-02-06', 'CR', '2016-02-12'),
('2016-02-13', 'CR', '2016-02-19'),
('2016-02-20', 'CR', '2016-02-26'),
('2016-02-27', 'CR', '2016-03-04'),
('2016-03-05', 'MS', '2016-03-11'),
('2016-03-12', 'MS', '2016-03-18'),
('2016-03-19', 'MS', '2016-03-25'),
('2016-03-26', 'MS', '2016-04-01'),
('2016-04-02', 'MS', '2016-04-08'),
('2016-04-09', 'MS', '2016-04-15'),
('2016-04-16', 'MS', '2016-04-22'),
('2016-04-23', 'MS', '2016-04-29'),
('2016-04-30', 'MS', '2016-05-06'),
('2016-05-07', 'MS', '2016-05-13'),
('2016-05-14', 'MS', '2016-05-20'),
('2016-05-21', 'MS', '2016-05-27'),
('2016-05-28', 'MS', '2016-06-03'),
('2016-06-04', 'HS', '2016-06-10'),
('2016-06-11', 'HS', '2016-06-17'),
('2016-06-18', 'HS', '2016-06-24'),
('2016-06-25', 'HS', '2016-07-01'),
('2016-07-02', 'HS', '2016-07-08'),
('2016-07-09', 'HS', '2016-07-15'),
('2016-07-16', 'HS', '2016-07-22'),
('2016-07-23', 'HS', '2016-07-29'),
('2016-07-30', 'HS', '2016-08-05'),
('2016-08-06', 'HS', '2016-08-12'),
('2016-08-13', 'HS', '2016-08-19'),
('2016-08-20', 'HS', '2016-08-26'),
('2016-08-27', 'HS', '2016-09-02'),
('2016-09-03', 'BS', '2016-09-09'),
('2016-09-10', 'BS', '2016-09-16'),
('2016-09-17', 'BS', '2016-09-23'),
('2016-09-24', 'BS', '2016-09-30'),
('2016-10-01', 'BS', '2016-10-07'),
('2016-10-08', 'BS', '2016-10-14'),
('2016-10-15', 'BS', '2016-10-21'),
('2016-10-22', 'BS', '2016-10-28'),
('2016-10-29', 'BS', '2016-11-04'),
('2016-11-05', 'BS', '2016-11-11'),
('2016-11-12', 'BS', '2016-11-18'),
('2016-11-19', 'BS', '2016-11-25'),
('2016-11-26', 'BS', '2016-12-02'),
('2016-12-03', 'BS', '2016-12-09'),
('2016-12-10', 'BS', '2016-12-16'),
('2016-12-17', 'BS', '2016-12-23'),
('2016-12-24', 'BS', '2016-12-30');

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

CREATE TABLE IF NOT EXISTS `tarif` (
  `NOHEB` int(4) NOT NULL,
  `CODESAISON` char(2) NOT NULL,
  `PRIXHEB` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`NOHEB`,`CODESAISON`),
  KEY `FK_TARIF_SAISON` (`CODESAISON`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tarif`
--

INSERT INTO `tarif` (`NOHEB`, `CODESAISON`, `PRIXHEB`) VALUES
(31, 'BS', '500.00'),
(31, 'HS', '700.00'),
(31, 'MS', '600.00'),
(32, 'BS', '800.00'),
(32, 'HS', '1200.00'),
(32, 'MS', '1000.00'),
(33, 'BS', '1100.00'),
(33, 'HS', '1400.00'),
(33, 'MS', '1200.00'),
(34, 'BS', '750.00'),
(34, 'HS', '1100.00'),
(34, 'MS', '900.00'),
(35, 'BS', '500.00'),
(35, 'HS', '700.00'),
(35, 'MS', '600.00'),
(36, 'BS', '400.00'),
(36, 'HS', '600.00'),
(36, 'MS', '500.00'),
(37, 'BS', '900.00'),
(37, 'HS', '1300.00'),
(37, 'MS', '1100.00'),
(38, 'BS', '1600.00'),
(38, 'HS', '2000.00'),
(38, 'MS', '1800.00'),
(39, 'BS', '400.00'),
(39, 'HS', '800.00'),
(39, 'MS', '600.00'),
(40, 'BS', '500.00'),
(40, 'HS', '900.00'),
(40, 'MS', '700.00'),
(41, 'BS', '1200.00'),
(41, 'HS', '1600.00'),
(41, 'MS', '1400.00'),
(42, 'BS', '500.00'),
(42, 'HS', '900.00'),
(42, 'MS', '700.00'),
(43, 'BS', '500.00'),
(43, 'HS', '900.00'),
(43, 'MS', '700.00'),
(44, 'BS', '500.00'),
(44, 'HS', '700.00'),
(44, 'MS', '600.00'),
(45, 'BS', '400.00'),
(45, 'HS', '700.00'),
(45, 'MS', '500.00'),
(46, 'BS', '550.00'),
(46, 'HS', '850.00'),
(46, 'MS', '650.00'),
(47, 'BS', '650.00'),
(47, 'HS', '900.00'),
(47, 'MS', '750.00'),
(48, 'BS', '800.00'),
(48, 'HS', '1000.00'),
(48, 'MS', '900.00'),
(49, 'BS', '1700.00'),
(49, 'HS', '1900.00'),
(49, 'MS', '1800.00'),
(50, 'BS', '650.00'),
(50, 'HS', '1050.00'),
(50, 'MS', '950.00'),
(51, 'BS', '600.00'),
(51, 'HS', '800.00'),
(51, 'MS', '700.00'),
(52, 'BS', '600.00'),
(52, 'HS', '800.00'),
(52, 'MS', '700.00');

-- --------------------------------------------------------

--
-- Structure de la table `type_heb`
--

CREATE TABLE IF NOT EXISTS `type_heb` (
  `CODETYPEHEB` char(5) NOT NULL,
  `NOMTYPEHEB` char(30) DEFAULT NULL,
  PRIMARY KEY (`CODETYPEHEB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_heb`
--

INSERT INTO `type_heb` (`CODETYPEHEB`, `NOMTYPEHEB`) VALUES
('APP', 'Appartement'),
('BUN', 'Bungalow'),
('CHA', 'Chalet'),
('MOB', 'Mobil home');

-- --------------------------------------------------------

--
-- Structure de la table `villageois`
--

CREATE TABLE IF NOT EXISTS `villageois` (
  `NOVILLAGEOIS` int(5) NOT NULL AUTO_INCREMENT,
  `USER` char(8) NOT NULL,
  `NOMVILLAGEOIS` char(40) DEFAULT NULL,
  `PRENOMVILLAGEOIS` char(30) DEFAULT NULL,
  `ADRMAIL` char(50) DEFAULT NULL,
  `NOTEL` char(15) DEFAULT NULL,
  `NOPORT` char(15) DEFAULT NULL,
  PRIMARY KEY (`NOVILLAGEOIS`),
  KEY `FK_VILLAGEOIS_COMPTE` (`USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `villageois`
--

INSERT INTO `villageois` (`NOVILLAGEOIS`, `USER`, `NOMVILLAGEOIS`, `PRENOMVILLAGEOIS`, `ADRMAIL`, `NOTEL`, `NOPORT`) VALUES
(4, 'vil', 'Fouquet', 'Marmion', 'MarmionFouquet@rhyta.com', '0447951348', '0651234957'),
(5, 'pat25', 'Brisette', 'Patrick', 'patrick@exemple.com', '0123459514', '0612569547'),
(6, 'cha97', 'Patel', 'Charline', 'patel@exemple.com', '0473216459', '0612345158'),
(7, 'namo56', 'Ouellet', 'Namo', 'ouellet@exemple.com', '0151236587', '0621547895'),
(8, 'val67', 'Cuilleret', 'Valérie', 'cuilleret@exemple.com', '0321547895', '0621548956'),
(9, 'met23', 'Métivier', 'Céline', 'metivier@exemple.com', '0215478952', '0651236598'),
(10, 'aubin93', 'Bizier', 'Aubin', 'bizier@exemple.com', '0159478632', '0654326898'),
(11, 'dum19', 'Dumoulin', 'Mélodie', 'dumoulin@exemple.com', '0154978514', '0612578952'),
(12, 'vern72', 'Rhéaume', 'Vernon', 'rheaume@exemple.com', '0159874785', '0625135874'),
(13, 'sator49', 'Desserres', 'Satordi', 'desserres@exemple.com', '0354985621', '0672487952'),
(14, 'hugh56', 'Salmons', 'Hugues', 'salmons@exemple.com', '0154968251', '0656321985'),
(15, 'eliot96', 'Boulanger', 'Eliot', 'boulanger@exemple.com', '0156248596', '0623594785'),
(16, 'des25', 'Desroches', 'Eugène', 'desroches@exemple.com', '0145963202', '0602351025'),
(17, 'gauv78', 'Gauvin', 'Eléonore', 'gauvin@exemple.com', '0415632962', '0691230254'),
(18, 'lav02', 'Lavoie', 'Agathe', 'lavoie@exemple.com', '0315963214', '0612478956'),
(19, 'pois50', 'Poisson', 'André', 'poissonandre@exemple.com', '0215479526', '0606879520'),
(20, 'arsen90', 'Arsenault', 'Mariette', 'arsenault@exemple.com', '0104035954', '0603021547'),
(21, 'ans05', 'Ansel', 'Benoit', 'anselbenoit@exemple.com', '0134595214', '0623547895');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `hebergement`
--
ALTER TABLE `hebergement`
  ADD CONSTRAINT `hebergement_ibfk_1` FOREIGN KEY (`CODETYPEHEB`) REFERENCES `type_heb` (`CODETYPEHEB`),
  ADD CONSTRAINT `hebergement_ibfk_2` FOREIGN KEY (`cdSite`) REFERENCES `site` (`cdSite`);

--
-- Contraintes pour la table `resa`
--
ALTER TABLE `resa`
  ADD CONSTRAINT `resa_ibfk_1` FOREIGN KEY (`NOVILLAGEOIS`) REFERENCES `villageois` (`NOVILLAGEOIS`),
  ADD CONSTRAINT `resa_ibfk_2` FOREIGN KEY (`DATEDEBSEM`) REFERENCES `semaine` (`DATEDEBSEM`),
  ADD CONSTRAINT `resa_ibfk_3` FOREIGN KEY (`NOHEB`) REFERENCES `hebergement` (`NOHEB`),
  ADD CONSTRAINT `resa_ibfk_4` FOREIGN KEY (`CODEETATRESA`) REFERENCES `etat_resa` (`CODEETATRESA`);

--
-- Contraintes pour la table `semaine`
--
ALTER TABLE `semaine`
  ADD CONSTRAINT `semaine_ibfk_1` FOREIGN KEY (`CODESAISON`) REFERENCES `saison` (`CODESAISON`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`NOHEB`) REFERENCES `hebergement` (`NOHEB`),
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`CODESAISON`) REFERENCES `saison` (`CODESAISON`);

--
-- Contraintes pour la table `villageois`
--
ALTER TABLE `villageois`
  ADD CONSTRAINT `villageois_ibfk_1` FOREIGN KEY (`USER`) REFERENCES `compte` (`USER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
