-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ac_gym
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.13.10.1

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
-- Table structure for table `ac_base_productos`
--

DROP TABLE IF EXISTS `ac_base_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_base_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `precio` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_ac_producto_base_ac_categoria1_idx` (`id_categoria`),
  KEY `fk_ac_producto_base_ac_periodo1_idx` (`id_periodo`),
  CONSTRAINT `fk_ac_producto_base_ac_categoria1` FOREIGN KEY (`id_categoria`) REFERENCES `ac_categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ac_producto_base_ac_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `ac_periodos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='tabla para cargar data a la tabla = ac_empresa_productos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_base_productos`
--

LOCK TABLES `ac_base_productos` WRITE;
/*!40000 ALTER TABLE `ac_base_productos` DISABLE KEYS */;
INSERT INTO `ac_base_productos` VALUES (1,1,2,'GYM 1DIA',5),(2,1,3,'GYM 1SEM',35),(3,1,4,'GYM 1MES',150),(4,1,5,'GYM 3MES',450),(5,1,6,'GYM 6MES',900),(8,1,7,'GYM 1AN',1500);
/*!40000 ALTER TABLE `ac_base_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_categorias`
--

DROP TABLE IF EXISTS `ac_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='categoria \n- 1 = gym\n- 2 = vitaminas y suplementos\n- 3 = otro';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_categorias`
--

LOCK TABLES `ac_categorias` WRITE;
/*!40000 ALTER TABLE `ac_categorias` DISABLE KEYS */;
INSERT INTO `ac_categorias` VALUES (1,'GYM'),(2,'VITAMINAS'),(3,'OTRO');
/*!40000 ALTER TABLE `ac_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_empresa_productos`
--

DROP TABLE IF EXISTS `ac_empresa_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_empresa_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `precio` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_ac_empresa_productos_ac_categoria1_idx` (`id_categoria`),
  KEY `fk_ac_empresa_productos_ac_periodo1_idx` (`id_periodo`),
  KEY `fk_ac_empresa_productos_ac_empresas1_idx` (`id_empresa`),
  CONSTRAINT `ac_empresa_productos_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `ac_empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ac_empresa_productos_ac_categoria1` FOREIGN KEY (`id_categoria`) REFERENCES `ac_categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ac_empresa_productos_ac_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `ac_periodos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_empresa_productos`
--

LOCK TABLES `ac_empresa_productos` WRITE;
/*!40000 ALTER TABLE `ac_empresa_productos` DISABLE KEYS */;
INSERT INTO `ac_empresa_productos` VALUES (1,1,'GYM 1DIA',1,2,5),(2,1,'GYM 1SEM',1,3,35),(3,1,'GYM 1MES',1,4,150),(4,1,'GYM 3MES',1,5,450),(5,1,'GYM 6MES',1,6,900),(6,1,'GYM 1AN',1,7,1500);
/*!40000 ALTER TABLE `ac_empresa_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_empresas`
--

DROP TABLE IF EXISTS `ac_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `tipo_documento` enum('RUC','OTRO') DEFAULT NULL,
  `numDocumento` varchar(15) DEFAULT NULL,
  `instalacion` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '0',
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_inicio_membresia` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ac_empresas_ac_usuarios1_idx` (`id_usuario`),
  CONSTRAINT `fk_ac_empresas_ac_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `ac_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_empresas`
--

LOCK TABLES `ac_empresas` WRITE;
/*!40000 ALTER TABLE `ac_empresas` DISABLE KEYS */;
INSERT INTO `ac_empresas` VALUES (1,1,'EMPRESA 01','RUC','1045269187',1,1,'2014-06-16 00:00:00',NULL),(2,NULL,'EMPRESA 02','RUC','10452699887',0,0,'2014-06-16 00:00:00',NULL);
/*!40000 ALTER TABLE `ac_empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_logs`
--

DROP TABLE IF EXISTS `ac_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_logs`
--

LOCK TABLES `ac_logs` WRITE;
/*!40000 ALTER TABLE `ac_logs` DISABLE KEYS */;
INSERT INTO `ac_logs` VALUES (1,'Empresa Instalado: id [id_empresa]1','2014-06-18 02:13:02'),(2,'Empresa Instalado: ac_empresas [id_empresa] = 1','2014-06-18 02:18:26'),(3,'Empresa Instalado: ac_empresas [id_empresa] = 1','2014-06-18 02:22:30'),(4,'Empresa Instalado: ac_empresas [id_empresa] = 1','2014-07-13 00:01:24');
/*!40000 ALTER TABLE `ac_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_membresias`
--

DROP TABLE IF EXISTS `ac_membresias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_membresias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `pago` double DEFAULT NULL,
  `estado_pago` int(1) DEFAULT NULL,
  `descripcion` text,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ac_membresia_ac_paquete1_idx` (`id_paquete`),
  KEY `fk_ac_membresias_ac_empresas1_idx` (`id_empresa`),
  CONSTRAINT `fk_ac_membresia_ac_paquete1` FOREIGN KEY (`id_paquete`) REFERENCES `ac_paquetes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='paquete_precio: precio a la mano.\nestado_pago: \n1 = PAGO\n0 = NO PAGO';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_membresias`
--

LOCK TABLES `ac_membresias` WRITE;
/*!40000 ALTER TABLE `ac_membresias` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_membresias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_pagos`
--

DROP TABLE IF EXISTS `ac_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membresia` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `cantidad` double DEFAULT NULL,
  `descripcion` text,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ac_pagos_ac_membresias1_idx` (`id_membresia`),
  KEY `fk_ac_pagos_ac_paquetes1_idx` (`id_paquete`),
  CONSTRAINT `fk_ac_pagos_ac_membresias1` FOREIGN KEY (`id_membresia`) REFERENCES `ac_membresias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ac_pagos_ac_paquetes1` FOREIGN KEY (`id_paquete`) REFERENCES `ac_paquetes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_pagos`
--

LOCK TABLES `ac_pagos` WRITE;
/*!40000 ALTER TABLE `ac_pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_paquetes`
--

DROP TABLE IF EXISTS `ac_paquetes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_paquetes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_paquetes`
--

LOCK TABLES `ac_paquetes` WRITE;
/*!40000 ALTER TABLE `ac_paquetes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_paquetes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_periodos`
--

DROP TABLE IF EXISTS `ac_periodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_periodos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `nombre_corto` varchar(5) DEFAULT NULL,
  `nro_dia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='- 1 = ninguno\n- 2 = 1dia\n- 3 = 1semana\n- 4 = 1mes\n- 5 = 3meses\n- 6 = 6meses\n- 7 = 1año';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_periodos`
--

LOCK TABLES `ac_periodos` WRITE;
/*!40000 ALTER TABLE `ac_periodos` DISABLE KEYS */;
INSERT INTO `ac_periodos` VALUES (1,'-','-',NULL),(2,'1 DIA','1DIA',1),(3,'1 SEMANA','1SEM',7),(4,'1 MES','1MES',30),(5,'3 MESES','3MES',90),(6,'6 MESES','6MES',180),(7,'1 AÑO','1AÑO',365);
/*!40000 ALTER TABLE `ac_periodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_socios`
--

DROP TABLE IF EXISTS `ac_socios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_socios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `sexo` enum('F','M') DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ac_socios_ac_usuarios1_idx` (`id_usuario`),
  CONSTRAINT `fk_ac_socios_ac_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `ac_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_socios`
--

LOCK TABLES `ac_socios` WRITE;
/*!40000 ALTER TABLE `ac_socios` DISABLE KEYS */;
INSERT INTO `ac_socios` VALUES (1,1,'MARIO','ROJAS','M','958458458','mario_rojas@hotmail.com','direccion mario rojas','2014-06-16 00:00:00',NULL),(2,1,'MARIA','ROBLES','F','989658547','robles@gmail.com','sin direccion maria','2014-06-16 00:00:00',NULL);
/*!40000 ALTER TABLE `ac_socios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_socios_suscriptores`
--

DROP TABLE IF EXISTS `ac_socios_suscriptores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_socios_suscriptores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_socio` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_empresa_producto` int(11) DEFAULT NULL,
  `empresa_producto_precio` double DEFAULT NULL,
  `pago` double DEFAULT NULL,
  `adeuda` double DEFAULT NULL,
  `fecha_inicio_base` datetime DEFAULT NULL COMMENT '''nunca se cambia edita : util para calular tiempos con fecha_final u otra''',
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `observacion` text,
  `baja` int(1) DEFAULT '0' COMMENT '0= OFF : 1= ON',
  `estado` int(1) DEFAULT NULL COMMENT '1 = ACTIVO 2 = AL COBRO 3 = EN MORA 4 = INACTIVO',
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ac_suscriptores_ac_empresa_productos1_idx` (`id_empresa_producto`),
  KEY `fk_ac_suscriptores_ac_socios1_idx` (`id_socio`),
  KEY `fk_ac_socios_suscriptores_ac_empresas1_idx` (`id_empresa`),
  CONSTRAINT `ac_socios_suscriptores_ibfk_3` FOREIGN KEY (`id_empresa_producto`) REFERENCES `ac_empresa_productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ac_socios_suscriptores_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `ac_socios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ac_socios_suscriptores_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `ac_empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='empresa_producto_precio : procio a la mano.\nestado : \n1 = ACTIVO\n2 = AL COBRO\n3 = EN MORA\n4 = INACTIVO';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_socios_suscriptores`
--

LOCK TABLES `ac_socios_suscriptores` WRITE;
/*!40000 ALTER TABLE `ac_socios_suscriptores` DISABLE KEYS */;
INSERT INTO `ac_socios_suscriptores` VALUES (1,1,1,3,150,0,0,'2014-07-26 21:31:02','2014-07-26 21:31:02','2014-08-25 21:31:02',NULL,0,1,'2014-07-26 21:31:02'),(2,2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `ac_socios_suscriptores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_socios_suscriptores_records`
--

DROP TABLE IF EXISTS `ac_socios_suscriptores_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_socios_suscriptores_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_producto_precio` double DEFAULT NULL,
  `pago` double DEFAULT NULL,
  `adeuda` double DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `observacion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='registros historicos  de la taba : ac_socios_suscriptores \nmetodo chamilo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_socios_suscriptores_records`
--

LOCK TABLES `ac_socios_suscriptores_records` WRITE;
/*!40000 ALTER TABLE `ac_socios_suscriptores_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_socios_suscriptores_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_usuarios`
--

DROP TABLE IF EXISTS `ac_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_usuarios`
--

LOCK TABLES `ac_usuarios` WRITE;
/*!40000 ALTER TABLE `ac_usuarios` DISABLE KEYS */;
INSERT INTO `ac_usuarios` VALUES (1,'ROBERTO','RONEY','root@gmail.com','123456',NULL,'2014-06-16 00:00:00',NULL,1);
/*!40000 ALTER TABLE `ac_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_privileges`
--

DROP TABLE IF EXISTS `acl_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ac_acl_provileges_ac_acl_resources1_idx` (`resource_id`),
  KEY `fk_ac_acl_provileges_ac_acl_roles1_idx` (`role_id`),
  CONSTRAINT `fk_ac_acl_provileges_ac_acl_resources1` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ac_acl_provileges_ac_acl_roles1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_privileges`
--

LOCK TABLES `acl_privileges` WRITE;
/*!40000 ALTER TABLE `acl_privileges` DISABLE KEYS */;
INSERT INTO `acl_privileges` VALUES (1,2,1),(2,2,2),(3,2,3);
/*!40000 ALTER TABLE `acl_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_resources`
--

DROP TABLE IF EXISTS `acl_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_resources`
--

LOCK TABLES `acl_resources` WRITE;
/*!40000 ALTER TABLE `acl_resources` DISABLE KEYS */;
INSERT INTO `acl_resources` VALUES (1,'dashboard','2014-06-16'),(2,'dashboard/index','2014-06-16'),(3,'socio/listGrid','2014-06-16');
/*!40000 ALTER TABLE `acl_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_roles`
--

DROP TABLE IF EXISTS `acl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ac_acl_roles_ac_acl_roles1_idx` (`parent_id`),
  CONSTRAINT `fk_ac_acl_roles_ac_acl_roles1` FOREIGN KEY (`parent_id`) REFERENCES `acl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_roles`
--

LOCK TABLES `acl_roles` WRITE;
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` VALUES (1,NULL,'admin','2014-06-16'),(2,NULL,'usuario','2014-06-16');
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('3ac1a25b0096f970dd917601a66ecfc1','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/34.0.1847.116 Chrome/34.0.1847.11',1406428940,'a:3:{s:9:\"user_data\";s:0:\"\";s:5:\"token\";s:32:\"bde107829739989dab1d057f43709308\";s:4:\"user\";a:16:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"ROBERTO\";s:9:\"last_name\";s:5:\"RONEY\";s:5:\"email\";s:14:\"root@gmail.com\";s:8:\"password\";s:6:\"123456\";s:4:\"salt\";N;s:10:\"created_at\";s:19:\"2014-06-16 00:00:00\";s:10:\"updated_at\";N;s:6:\"status\";s:1:\"1\";s:10:\"empresa_id\";s:1:\"1\";s:14:\"empresa_nombre\";s:10:\"EMPRESA 01\";s:20:\"empresa_numDocumento\";s:10:\"1045269187\";s:22:\"empresa_tipo_documento\";s:3:\"RUC\";s:19:\"empresa_instalacion\";s:1:\"1\";s:14:\"empresa_status\";s:1:\"1\";s:30:\"empresa_fecha_inicio_membresia\";N;}}'),('a3e54800f5ca324060c3b4992ee8f43d','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',1406428681,'a:3:{s:9:\"user_data\";s:0:\"\";s:5:\"token\";s:32:\"70bb9760d05c8e1fff533c6dcb4a245d\";s:4:\"user\";a:16:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"ROBERTO\";s:9:\"last_name\";s:5:\"RONEY\";s:5:\"email\";s:14:\"root@gmail.com\";s:8:\"password\";s:6:\"123456\";s:4:\"salt\";N;s:10:\"created_at\";s:19:\"2014-06-16 00:00:00\";s:10:\"updated_at\";N;s:6:\"status\";s:1:\"1\";s:10:\"empresa_id\";s:1:\"1\";s:14:\"empresa_nombre\";s:10:\"EMPRESA 01\";s:20:\"empresa_numDocumento\";s:10:\"1045269187\";s:22:\"empresa_tipo_documento\";s:3:\"RUC\";s:19:\"empresa_instalacion\";s:1:\"1\";s:14:\"empresa_status\";s:1:\"1\";s:30:\"empresa_fecha_inicio_membresia\";N;}}'),('b18a71c5cb419638afdfbfa2d1d8003b','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:24.0) Gecko/20100101 Firefox/24.0',1406428872,'a:3:{s:9:\"user_data\";s:0:\"\";s:5:\"token\";s:32:\"dc25dac90e79475081b982d13864356e\";s:4:\"user\";a:16:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"ROBERTO\";s:9:\"last_name\";s:5:\"RONEY\";s:5:\"email\";s:14:\"root@gmail.com\";s:8:\"password\";s:6:\"123456\";s:4:\"salt\";N;s:10:\"created_at\";s:19:\"2014-06-16 00:00:00\";s:10:\"updated_at\";N;s:6:\"status\";s:1:\"1\";s:10:\"empresa_id\";s:1:\"1\";s:14:\"empresa_nombre\";s:10:\"EMPRESA 01\";s:20:\"empresa_numDocumento\";s:10:\"1045269187\";s:22:\"empresa_tipo_documento\";s:3:\"RUC\";s:19:\"empresa_instalacion\";s:1:\"1\";s:14:\"empresa_status\";s:1:\"1\";s:30:\"empresa_fecha_inicio_membresia\";N;}}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-26 21:50:36
