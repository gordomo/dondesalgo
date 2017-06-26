-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: boliches
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `album_post_evento`
--

DROP TABLE IF EXISTS `album_post_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album_post_evento` (
  `id_album_post` int(3) NOT NULL AUTO_INCREMENT,
  `nombre_evento` varchar(50) DEFAULT NULL,
  `foto` text,
  `fecha` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_album_post`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album_post_evento`
--

LOCK TABLES `album_post_evento` WRITE;
/*!40000 ALTER TABLE `album_post_evento` DISABLE KEYS */;
INSERT INTO `album_post_evento` VALUES (1,'Espuma fest',NULL,'2017-02-21',1),(2,'Havanna club',NULL,'2017-02-15',0),(3,'Summer fest',NULL,'2017-02-22',1);
/*!40000 ALTER TABLE `album_post_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codigos`
--

DROP TABLE IF EXISTS `codigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codigos` (
  `idcodigos` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(7) CHARACTER SET utf8 DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`idcodigos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codigos`
--

LOCK TABLES `codigos` WRITE;
/*!40000 ALTER TABLE `codigos` DISABLE KEYS */;
INSERT INTO `codigos` VALUES (1,'b126833',1),(2,'b933464',1),(3,'o562362',1),(4,'o643864',0),(5,'b458d5w',0),(6,'o38fdn3',0);
/*!40000 ALTER TABLE `codigos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `estado` tinyint(4) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'registrado'),(2,'suspendido'),(3,'baneado'),(4,'pago'),(5,'premium'),(9,'usado'),(10,'finalizado');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `ideventos` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `nombreevento` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `fechapublicacion` timestamp NULL DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `horainicio` time DEFAULT NULL,
  `horafin` time DEFAULT NULL,
  `fotoperfil` text,
  `fotoevento` text,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`ideventos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,2,2,'mdm','francia 200','alta fiesta','la fiesta que todos estaban esperando..<br/><br/>te la vas a perder','2017-05-09 00:25:00','2017-05-31','23:50:00','23:55:00','/2/2/Foto Perfil/Diora_Baird_020.jpg','/2/2/Foto Evento/IMG-20150306-WA0001.jpg',1),(2,9,2,'TuVieja','Entanha 452','poronga fest','lluvia de porongas para todos.. jajaja no vas a creer la sorpresita<br/><br/>que te esperaaaa','2017-05-09 00:33:03','2017-05-30','21:50:00','06:05:00','/2/9/Foto Perfil/2014-08-23-305.jpg','/2/9/Foto Evento/2014-08-23-304.jpg',1),(3,9,2,'TuVieja','Entanha 452','milf fest','no te lo pierdas.. la mejor fiesta milfs de la historia..<br/><br/>ni brazzers entiende de esto.. un poronto.','2017-05-10 22:06:41','2017-05-24','23:50:00','07:00:00','/2/9/Foto Perfil/2014-08-23-305.jpg','/2/9/Foto Evento/15049736_1866826080242525_763282826_n.jpg',1),(4,2,2,'mdm','francia 200','fiesta de la espuma','alta fiesta con espuma.. la mejor de la historia<br/><br/>asdasdasdasd','2017-05-12 00:19:08','2017-05-16','23:55:00','07:00:00','/2/2/Foto Perfil/Diora_Baird_020.jpg','/2/2/Foto Evento/2014-07-26-280.jpg',1),(5,2,2,'mdm','francia 200','tetas party','que se puede decir.. tetas para todos<br/><br/>te lo vas a perder','2017-05-25 21:34:39','2017-06-15','00:30:00','08:00:00','/2/2/Foto Perfil/Diora_Baird_020.jpg','/2/2/Foto Evento/14.jpg',1),(6,2,2,'mdm','francia 200','Superman fest','droga para todos asegurado.. se van a morir todos a dentro.. no van a entender nada','2017-06-07 21:59:58','2017-08-24','23:45:00','05:30:00','/2/2/Foto Perfil/Diora_Baird_020.jpg','/2/2/Foto Evento/1566.jpg',1);
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiposusuario`
--

DROP TABLE IF EXISTS `tiposusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiposusuario` (
  `tipo` tinyint(4) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposusuario`
--

LOCK TABLES `tiposusuario` WRITE;
/*!40000 ALTER TABLE `tiposusuario` DISABLE KEYS */;
INSERT INTO `tiposusuario` VALUES (1,'persona'),(2,'boliche'),(3,'organizador'),(4,'bar'),(5,'teatro');
/*!40000 ALTER TABLE `tiposusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` tinyint(4) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `idcodigo` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `contacto` varchar(50) DEFAULT NULL,
  `fotoperfil` text,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'vivaldi.matias@gmail.com','1234',0,'matias','vivaldi',NULL,NULL,'1990-04-30','m',NULL,'/1/1/Foto Perfil/IMG-20150306-WA0001.jpg',1),(2,2,'mdm@gmail.com','1234',NULL,'mdm',NULL,'francia 200','3414216666',NULL,NULL,NULL,'/2/2/Foto Perfil/Diora_Baird_020.jpg',1),(3,3,'piobesFest@gmail.com','1234',NULL,'los pibes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(4,3,'mega@hotmail.com','1234',0,'99',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(5,3,'sadasdvergman@hotmail.com','1414',99,'megaverga',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(6,3,'asdasdasd@gmial.com','sadasdasd',3,'adsdasd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(7,2,'laburra@hotmail.com','1234',2,'altaburra',NULL,'calle falsa 123','3421152153',NULL,NULL,NULL,'',1),(8,1,'maxi.elpipa@gmail.com','1234',NULL,'maxi','baldez',NULL,NULL,'1999-04-09','m',NULL,'',1),(9,2,'asd@gmail.com','1234',5,'TuVieja',NULL,'Entanha 452','3415253620',NULL,NULL,NULL,'/2/9/Foto Perfil/2014-08-23-305.jpg',1),(10,3,'poronga@gmail.com','1234',6,'poronga club',NULL,NULL,NULL,NULL,NULL,NULL,'',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votacion_evento`
--

DROP TABLE IF EXISTS `votacion_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votacion_evento` (
  `id_votacion_evento` int(3) NOT NULL AUTO_INCREMENT,
  `id_evento` int(3) DEFAULT NULL,
  `cantidad_voto` int(5) DEFAULT NULL,
  `tiempo_recompensa` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_votacion_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votacion_evento`
--

LOCK TABLES `votacion_evento` WRITE;
/*!40000 ALTER TABLE `votacion_evento` DISABLE KEYS */;
INSERT INTO `votacion_evento` VALUES (1,0,1,1000),(2,1,2,1000),(5,2,2,NULL),(6,6,5,NULL),(7,5,3,NULL);
/*!40000 ALTER TABLE `votacion_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votacion_post_evento`
--

DROP TABLE IF EXISTS `votacion_post_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votacion_post_evento` (
  `id_votacion_post` int(3) NOT NULL AUTO_INCREMENT,
  `id_evento` int(3) DEFAULT NULL,
  `id_usuario` int(3) DEFAULT NULL,
  `estado` varchar(5) DEFAULT NULL,
  `voto` int(1) DEFAULT NULL,
  `opinion` longtext,
  PRIMARY KEY (`id_votacion_post`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votacion_post_evento`
--

LOCK TABLES `votacion_post_evento` WRITE;
/*!40000 ALTER TABLE `votacion_post_evento` DISABLE KEYS */;
INSERT INTO `votacion_post_evento` VALUES (1,0,0,'4',1,'Fue genial'),(2,2,1,'2',1,'Mas o menos'),(3,2,2,'3',1,'Un toque buena');
/*!40000 ALTER TABLE `votacion_post_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votacion_usuario`
--

DROP TABLE IF EXISTS `votacion_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votacion_usuario` (
  `id_votacion_usuario` int(3) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(3) DEFAULT NULL,
  `id_evento` int(3) DEFAULT NULL,
  `voto` datetime DEFAULT NULL,
  PRIMARY KEY (`id_votacion_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votacion_usuario`
--

LOCK TABLES `votacion_usuario` WRITE;
/*!40000 ALTER TABLE `votacion_usuario` DISABLE KEYS */;
INSERT INTO `votacion_usuario` VALUES (22,1,5,'2017-06-15 00:30:00'),(23,1,6,'2017-08-24 23:45:00'),(24,8,6,'2017-08-24 23:45:00');
/*!40000 ALTER TABLE `votacion_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-08 14:11:55
