# ************************************************************
# Sequel Pro SQL dump
# Version 
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.10-MariaDB)
# Database: iparty
# Generation Time: 2017-05-16 09:43:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table iparty_friend
# ------------------------------------------------------------

DROP TABLE IF EXISTS `iparty_friend`;

CREATE TABLE `iparty_friend` (
  `myid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `nickname` text,
  `time` int(20) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;



# Dump of table iparty_party
# ------------------------------------------------------------

DROP TABLE IF EXISTS `iparty_party`;

CREATE TABLE `iparty_party` (
  `partyid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` char(11) NOT NULL DEFAULT '',
  `title` text,
  `place` text,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `party_description` text,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `creat_time` int(11) DEFAULT NULL,
  `groupchatid` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`partyid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;



# Dump of table iparty_partymember
# ------------------------------------------------------------

DROP TABLE IF EXISTS `iparty_partymember`;

CREATE TABLE `iparty_partymember` (
  `userid` int(11) NOT NULL,
  `jointime` int(11) NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partyid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;



# Dump of table iparty_picture
# ------------------------------------------------------------

DROP TABLE IF EXISTS `iparty_picture`;

CREATE TABLE `iparty_picture` (
  `picid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` text,
  `partyid` int(11) DEFAULT NULL,
  `creat_time` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`picid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;



# Dump of table iparty_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `iparty_user`;

CREATE TABLE `iparty_user` (
  `userid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `gender` tinyint(1) DEFAULT '0',
  `regist_time` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `headimage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=10000005 DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
