CREATE DATABASE  IF NOT EXISTS `pedale_douce` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pedale_douce`;
-- MySQL dump 10.13  Distrib 8.0.14, for macos10.14 (x86_64)
--
-- Host: 127.0.0.1    Database: pedale_douce
-- ------------------------------------------------------
-- Server version	8.0.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blue_cards`
--

DROP TABLE IF EXISTS `blue_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `blue_cards` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `number` varchar(45) NOT NULL,
  `cryptogram` varchar(45) NOT NULL,
  `expiry` varchar(16) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blue_cards`
--

LOCK TABLES `blue_cards` WRITE;
/*!40000 ALTER TABLE `blue_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `blue_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bornes`
--

DROP TABLE IF EXISTS `bornes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bornes` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `num` int NOT NULL,
  `status` int NOT NULL,
  `code` varchar(4) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fk_station` int NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `borne_station_idx` (`fk_station`),
  CONSTRAINT `borne_station` FOREIGN KEY (`fk_station`) REFERENCES `stations` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bornes`
--

LOCK TABLES `bornes` WRITE;
/*!40000 ALTER TABLE `bornes` DISABLE KEYS */;
/*!40000 ALTER TABLE `bornes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stations`
--

DROP TABLE IF EXISTS `stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `stations` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `num` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `coor_x` int NOT NULL,
  `coor_y` int NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stations`
--

LOCK TABLES `stations` WRITE;
/*!40000 ALTER TABLE `stations` DISABLE KEYS */;
/*!40000 ALTER TABLE `stations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(24) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `fk_cb` int DEFAULT NULL,
  `role` int NOT NULL,
  `fk_bike` int DEFAULT NULL,
  `time_bike` bigint unsigned DEFAULT NULL,
  `fk_borne` int DEFAULT NULL,
  `time_borne` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `user_bluecard_idx` (`fk_cb`),
  KEY `user_bike_idx` (`fk_bike`),
  KEY `user_borne_idx` (`fk_borne`),
  CONSTRAINT `user_bluecard` FOREIGN KEY (`fk_cb`) REFERENCES `blue_cards` (`uid`),
  CONSTRAINT `user_borne` FOREIGN KEY (`fk_borne`) REFERENCES `bornes` (`uid`),
  CONSTRAINT `user_bike` FOREIGN KEY (`fk_bike`) REFERENCES `bikes` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bikes`
--

DROP TABLE IF EXISTS `bikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bikes` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `serial` tinytext NOT NULL,
  `status` int NOT NULL,
  `fk_borne` int DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `bike_borne_idx` (`fk_borne`),
  CONSTRAINT `bike_borne` FOREIGN KEY (`fk_borne`) REFERENCES `bornes` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bikes`
--

LOCK TABLES `bikes` WRITE;
/*!40000 ALTER TABLE `bikes` DISABLE KEYS */;
/*!40000 ALTER TABLE `bikes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


--
-- stations records
--

INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('1', 'San Juan de la vega', '150', '100');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('2', 'Martinez del rio', '500', '100');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('3', 'Santa Clara', '800', '100');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('4', 'Uno mas Vondre', '50', '350');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('5', 'Estacion peru', '350', '350');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('6', 'Huevos de pascua', '650', '350');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('7', 'Pollo loco', '950', '350');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('8', 'Mas grande', '150', '600');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('9', 'Mimi el gato', '500', '600');
INSERT INTO stations (num, name, coor_x, coor_y) VALUES ('10', 'Zorro de madera', '800', '600');

--
-- bornes records
--

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '1');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '1');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '2');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '2');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '3');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '3');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '4');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '4');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '5');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '5');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '6');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '6');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '7');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '7');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '8');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '8');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '9');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '9');

INSERT INTO bornes (num, status, code, fk_station) VALUES ('1', '1', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('2', '1', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('3', '1', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('4', '1', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('5', '1', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('6', '0', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('7', '0', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('8', '0', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('9', '0', '0000', '10');
INSERT INTO bornes (num, status, code, fk_station) VALUES ('10', '0', '0000', '10');

--
-- bikes records
--

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178901', '1', '1');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178902', '1', '2');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178903', '1', '3');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178904', '1', '4');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178905', '1', '5');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178906', '1', '11');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178907', '1', '12');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178908', '1', '13');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178909', '1', '14');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178910', '1', '15');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178911', '1', '21');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178912', '1', '22');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178913', '1', '23');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178914', '1', '24');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178915', '1', '25');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178916', '1', '31');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178917', '1', '32');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178918', '1', '33');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178919', '1', '34');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178920', '1', '35');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178921', '1', '41');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178922', '1', '42');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178923', '1', '43');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178924', '1', '44');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178925', '1', '45');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178926', '1', '51');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178927', '1', '52');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178928', '1', '53');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178929', '1', '54');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178930', '1', '55');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178931', '1', '61');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178932', '1', '62');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178933', '1', '63');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178934', '1', '64');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178935', '1', '65');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178936', '1', '71');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178937', '1', '72');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178938', '1', '73');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178939', '1', '74');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178940', '1', '75');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178941', '1', '81');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178942', '1', '82');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178943', '1', '83');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178944', '1', '84');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178945', '1', '85');

INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178946', '1', '91');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178947', '1', '92');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178948', '1', '93');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178949', '1', '94');
INSERT INTO bikes (serial, status, fk_borne) VALUES ('14178950', '1', '95');

--
-- blue_cards records
--

INSERT INTO blue_cards (first_name, last_name, number, cryptogram, expiry) VALUES ('Raymond', 'STANTZ', '8436716874269654', '876', '11/22');
INSERT INTO blue_cards (first_name, last_name, number, cryptogram, expiry) VALUES ('Peter', 'VENKMAN', '3437815649493255', '543', '11/22');
INSERT INTO blue_cards (first_name, last_name, number, cryptogram, expiry) VALUES ('Egon', 'SPENGLE', '2559751695945462', '177', '11/22');
INSERT INTO blue_cards (first_name, last_name, number, cryptogram, expiry) VALUES ('Winston', 'ZEDDEMORE', '9814452666565265', '698', '11/22');

--
-- users records
--

INSERT INTO users (pseudo, password, email, role, fk_cb) VALUES ('raymond', '$2y$10$gDFko0KOMOKc0NqfD5q.0Ous7CjSXvD8Mf44NVB48PlW40WOyVTuy', 'raymond.stantz@ghost.com', '0', '1');
INSERT INTO users (pseudo, password, email, role, fk_cb) VALUES ('peter', '$2y$10$gDFko0KOMOKc0NqfD5q.0Ous7CjSXvD8Mf44NVB48PlW40WOyVTuy', 'peter.venkman@ghost.com', '0', '2');
INSERT INTO users (pseudo, password, email, role, fk_cb) VALUES ('egon', '$2y$10$gDFko0KOMOKc0NqfD5q.0Ous7CjSXvD8Mf44NVB48PlW40WOyVTuy', 'egon.spengle@ghost.com', '0', '3');
INSERT INTO users (pseudo, password, email, role, fk_cb) VALUES ('winston', '$2y$10$gDFko0KOMOKc0NqfD5q.0Ous7CjSXvD8Mf44NVB48PlW40WOyVTuy', 'winston.zeddemore@ghost.com', '0', '4');
