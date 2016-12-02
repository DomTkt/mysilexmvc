# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.5.5-10.1.16-MariaDB)
# Base de données: mysilexmvc
# Temps de génération: 2016-12-01 14:40:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table horaires
# ------------------------------------------------------------

DROP TABLE IF EXISTS `horaires`;

CREATE TABLE `horaires` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `arret` int(11) DEFAULT NULL,
  `heure` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

LOCK TABLES `horaires` WRITE;
/*!40000 ALTER TABLE `horaires` DISABLE KEYS */;

INSERT INTO `horaires` (`id`, `arret`, `heure`)
VALUES
	(1,1,'08:30:00'),
	(2,1,'08:45:00'),
	(3,2,'08:30:00'),
	(4,3,'08:30:00'),
	(5,1,'09:00:00'),
	(6,2,'08:45:00'),
	(7,1,'09:15:00'),
	(8,2,'09:00:00');

/*!40000 ALTER TABLE `horaires` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table lignes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lignes`;

CREATE TABLE `lignes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

LOCK TABLES `lignes` WRITE;
/*!40000 ALTER TABLE `lignes` DISABLE KEYS */;

INSERT INTO `lignes` (`id`, `nom`)
VALUES
	(1,'ligne1'),
	(2,'ligne2'),
	(3,'ligne3'),
	(9,'ligne4'),
	(10,'ligne5'),
	(11,'ligne6'),
	(12,'ligne7'),
	(13,'ligne8'),
	(14,'ligne21');

/*!40000 ALTER TABLE `lignes` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table stops
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stops`;

CREATE TABLE `stops` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL DEFAULT '',
  `nomligne` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

LOCK TABLES `stops` WRITE;
/*!40000 ALTER TABLE `stops` DISABLE KEYS */;

INSERT INTO `stops` (`id`, `nom`, `nomligne`)
VALUES
	(1,'la chagne','ligne1'),
	(2,'sardieres','ligne2'),
	(3,'norelan','ligne1'),
	(4,'iut','ligne3'),
	(14,'la chagne','ligne1');

/*!40000 ALTER TABLE `stops` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
