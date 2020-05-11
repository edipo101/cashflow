/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : cashflow

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-05-10 19:03:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `activo`
-- ----------------------------
DROP TABLE IF EXISTS `activo`;
CREATE TABLE `activo` (
  `id_activo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `id_tipo_activo` int(11) NOT NULL,
  `cantidad` tinyint(4) DEFAULT NULL,
  `precio_unitario` double DEFAULT NULL,
  `deposito` double DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `id_profesion` int(11) NOT NULL,
  `inc_ingresos` double DEFAULT NULL,
  PRIMARY KEY (`id_activo`,`id_tipo_activo`,`id_profesion`),
  KEY `id_tipo_activo` (`id_tipo_activo`),
  KEY `activo_ibfk_2` (`id_profesion`),
  KEY `id_activo` (`id_activo`),
  CONSTRAINT `activo_ibfk_1` FOREIGN KEY (`id_tipo_activo`) REFERENCES `tipo_activo` (`id_tipo_activo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `activo_ibfk_2` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of activo
-- ----------------------------

-- ----------------------------
-- Table structure for `datos_iniciales`
-- ----------------------------
DROP TABLE IF EXISTS `datos_iniciales`;
CREATE TABLE `datos_iniciales` (
  `id_valor` tinyint(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL COMMENT 'Tipo de valor inicial (1: gasto; 2: pasivo)',
  `color_etiqueta` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_valor`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of datos_iniciales
-- ----------------------------
INSERT INTO `datos_iniciales` VALUES ('1', 'Impuestos', '1', 'red');
INSERT INTO `datos_iniciales` VALUES ('2', 'Pagos hipotecarios', '1', 'yellow');
INSERT INTO `datos_iniciales` VALUES ('3', 'Pago de préstamo escolar', '1', 'blue');
INSERT INTO `datos_iniciales` VALUES ('4', 'Pago de préstamo de automovil', '1', 'green');
INSERT INTO `datos_iniciales` VALUES ('5', 'Pago de tarjeta de crétido', '1', null);
INSERT INTO `datos_iniciales` VALUES ('6', 'Cuota de compras minoristas', '1', null);
INSERT INTO `datos_iniciales` VALUES ('7', 'Otros gastos', '1', null);
INSERT INTO `datos_iniciales` VALUES ('8', 'Gastos por hijos', '1', null);
INSERT INTO `datos_iniciales` VALUES ('9', 'Hipoteca de casa', '2', null);
INSERT INTO `datos_iniciales` VALUES ('10', 'Préstamos escolares', '2', null);
INSERT INTO `datos_iniciales` VALUES ('11', 'Préstamos de automovil', '2', null);
INSERT INTO `datos_iniciales` VALUES ('12', 'Tarjetas de crédito', '2', null);
INSERT INTO `datos_iniciales` VALUES ('13', 'Deuda por compras minoristas', '2', null);

-- ----------------------------
-- Table structure for `gasto`
-- ----------------------------
DROP TABLE IF EXISTS `gasto`;
CREATE TABLE `gasto` (
  `id_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasivo` int(11) DEFAULT NULL,
  `descripcion` varchar(35) DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `id_profesion` int(11) NOT NULL,
  `color_etiqueta` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_gasto`,`id_profesion`),
  KEY `id_profesion` (`id_profesion`),
  KEY `id_pasivo` (`id_pasivo`),
  CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gasto_ibfk_2` FOREIGN KEY (`id_pasivo`) REFERENCES `pasivo` (`id_pasivo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gasto
-- ----------------------------
INSERT INTO `gasto` VALUES ('1', null, 'Impuestos', '280', '3', 'red');
INSERT INTO `gasto` VALUES ('2', null, 'Pagos hipotecarios', '200', '3', 'yellow');
INSERT INTO `gasto` VALUES ('3', null, 'Pago de préstamo escolar', '0', '3', 'blue');
INSERT INTO `gasto` VALUES ('4', null, 'Pago de préstamo de automovil', '60', '3', 'green');
INSERT INTO `gasto` VALUES ('5', null, 'Pago de tarjeta de crétido', '60', '3', null);
INSERT INTO `gasto` VALUES ('6', null, 'Cuota de compras minoristas', '50', '3', null);
INSERT INTO `gasto` VALUES ('7', null, 'Otros gastos', '300', '3', null);
INSERT INTO `gasto` VALUES ('8', null, 'Gastos por hijos', '0', '3', null);

-- ----------------------------
-- Table structure for `ingreso`
-- ----------------------------
DROP TABLE IF EXISTS `ingreso`;
CREATE TABLE `ingreso` (
  `id_ingreso` int(11) NOT NULL AUTO_INCREMENT,
  `id_activo` int(11) NOT NULL,
  `descripcion` varchar(55) DEFAULT NULL,
  `monto` double DEFAULT '0',
  `id_profesion` int(11) NOT NULL,
  PRIMARY KEY (`id_ingreso`,`id_activo`,`id_profesion`),
  KEY `id_activo` (`id_activo`),
  KEY `id_profesion` (`id_profesion`),
  CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ingreso
-- ----------------------------

-- ----------------------------
-- Table structure for `pasivo`
-- ----------------------------
DROP TABLE IF EXISTS `pasivo`;
CREATE TABLE `pasivo` (
  `id_pasivo` int(11) NOT NULL AUTO_INCREMENT,
  `id_activo` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `id_profesion` int(11) NOT NULL,
  `color_etiqueta` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_pasivo`,`id_profesion`),
  KEY `pasivo_ibfk_1` (`id_activo`),
  KEY `pasivo_ibfk_2` (`id_profesion`),
  KEY `id_pasivo` (`id_pasivo`),
  CONSTRAINT `pasivo_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `activo` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pasivo_ibfk_2` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pasivo
-- ----------------------------
INSERT INTO `pasivo` VALUES ('87', null, 'Hipoteca de casa', '20000', '3', 'red');
INSERT INTO `pasivo` VALUES ('88', null, 'Préstamos escolares', '0', '3', 'yellow');
INSERT INTO `pasivo` VALUES ('89', null, 'Préstamos de automovil', '4000', '3', 'blue');
INSERT INTO `pasivo` VALUES ('90', null, 'Tarjetas de crédito', '2000', '3', 'green');
INSERT INTO `pasivo` VALUES ('91', null, 'Deuda por compras minoristas', '1000', '3', null);

-- ----------------------------
-- Table structure for `profesion`
-- ----------------------------
DROP TABLE IF EXISTS `profesion`;
CREATE TABLE `profesion` (
  `id_profesion` int(11) NOT NULL AUTO_INCREMENT,
  `profesion` varchar(30) DEFAULT NULL,
  `salario` double DEFAULT '0',
  `ahorro` double DEFAULT '0',
  `cant_hijos` tinyint(4) DEFAULT '0',
  `gastos_hijo` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_profesion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of profesion
-- ----------------------------
INSERT INTO `profesion` VALUES ('1', 'Abogado', '1600', '560', '0', '0');
INSERT INTO `profesion` VALUES ('2', 'Médico', '13200', '400', '0', '0');
INSERT INTO `profesion` VALUES ('3', 'Conserje', '1000', '360', '0', '70');
INSERT INTO `profesion` VALUES ('4', 'Profesor', '2200', '450', '0', '0');

-- ----------------------------
-- Table structure for `profesion_datos_iniciales`
-- ----------------------------
DROP TABLE IF EXISTS `profesion_datos_iniciales`;
CREATE TABLE `profesion_datos_iniciales` (
  `id_profesion` int(11) NOT NULL,
  `id_valor` tinyint(4) NOT NULL,
  `monto` double DEFAULT NULL,
  PRIMARY KEY (`id_profesion`,`id_valor`),
  KEY `id_valor` (`id_valor`),
  CONSTRAINT `profesion_datos_iniciales_ibfk_1` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `profesion_datos_iniciales_ibfk_2` FOREIGN KEY (`id_valor`) REFERENCES `datos_iniciales` (`id_valor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of profesion_datos_iniciales
-- ----------------------------
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '1', '280');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '2', '200');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '3', '0');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '4', '60');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '5', '60');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '6', '50');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '7', '300');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '8', '0');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '9', '20000');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '10', '0');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '11', '4000');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '12', '2000');
INSERT INTO `profesion_datos_iniciales` VALUES ('3', '13', '1000');

-- ----------------------------
-- Table structure for `tipo_activo`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_activo`;
CREATE TABLE `tipo_activo` (
  `id_tipo_activo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_activo` varchar(30) NOT NULL,
  PRIMARY KEY (`id_tipo_activo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipo_activo
-- ----------------------------
INSERT INTO `tipo_activo` VALUES ('1', 'ACCIONES');
INSERT INTO `tipo_activo` VALUES ('2', 'FONDOS COMUNES');
INSERT INTO `tipo_activo` VALUES ('3', 'CERTIFICADOS DE DEPÓSITO');
INSERT INTO `tipo_activo` VALUES ('4', 'BIENES RAICES');
INSERT INTO `tipo_activo` VALUES ('5', 'NEGOCIOS');

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `id_profesion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_profesion` (`id_profesion`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'edipo', '123', 'Edwin', '3');
INSERT INTO `usuario` VALUES ('2', 'jhon', '123', 'Jhonny', null);

-- ----------------------------
-- View structure for `view_usuario`
-- ----------------------------
DROP VIEW IF EXISTS `view_usuario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_usuario` AS select `u`.`id_usuario` AS `id_usuario`,`u`.`username` AS `username`,`u`.`password` AS `password`,`u`.`nombre` AS `nombre`,`u`.`id_profesion` AS `id_profesion`,`p`.`profesion` AS `profesion` from (`usuario` `u` left join `profesion` `p` on((`p`.`id_profesion` = `u`.`id_profesion`))) ;
