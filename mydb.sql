-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.31-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5280
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para mydb
CREATE DATABASE IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mydb`;

-- Volcando estructura para tabla mydb.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.categoria: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `nombre`, `creado_en`, `actualizado_en`) VALUES
	(23, 'categoria1', '2018-12-10 05:43:56', '2018-12-10 10:31:35'),
	(24, 'categoria2', '2018-12-10 05:44:01', NULL),
	(25, 'cateogria3', '2018-12-10 05:44:04', '2018-12-10 10:23:27'),
	(26, 'categoria4', '2018-12-10 05:44:10', NULL),
	(27, 'categoria4', '2018-12-10 10:06:46', NULL),
	(28, 'categoria5', '2018-12-10 10:06:58', NULL),
	(29, 'categoria6', '2018-12-10 10:07:04', NULL),
	(32, 'categoria9', '2018-12-10 10:07:24', NULL),
	(33, 'categoria10', '2018-12-10 10:07:32', NULL),
	(34, 'categoria11', '2018-12-10 10:07:40', NULL),
	(35, 'categoria12', '2018-12-10 22:41:04', NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`persona_id`),
  CONSTRAINT `fk_cliente_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.cliente: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`persona_id`) VALUES
	(39),
	(42),
	(43);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.compra
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(11,2) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compra_proveedor1_idx` (`proveedor_id`),
  CONSTRAINT `fk_compra_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`persona_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.detalle_compra
CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detalle_compra_compra1_idx` (`compra_id`),
  KEY `fk_detalle_compra_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_detalle_compra_compra1` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_compra_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.detalle_compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_compra` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.detalle_venta
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detalle_venta_producto1_idx` (`producto_id`),
  KEY `fk_detalle_venta_ventas1_idx` (`venta_id`),
  CONSTRAINT `fk_detalle_venta_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detalle_venta_ventas1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.detalle_venta: ~31 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` (`id`, `producto_id`, `venta_id`, `cantidad`, `subtotal`) VALUES
	(290, 30, 86, 1, 138.00),
	(291, 27, 86, 1, 27.00),
	(292, 30, 87, 1, 138.00),
	(293, 27, 87, 1, 27.00),
	(294, 30, 88, 1, 138.00),
	(295, 27, 88, 1, 27.00),
	(299, 30, 91, 1, 138.00),
	(300, 27, 91, 1, 27.00),
	(301, 30, 92, 1, 138.00),
	(302, 27, 92, 1, 27.00),
	(303, 30, 93, 1, 138.00),
	(304, 27, 93, 1, 27.00),
	(305, 30, 94, 1, 138.00),
	(306, 27, 94, 1, 27.00),
	(307, 26, 94, 1, 27.00),
	(308, 30, 95, 10, 1380.00),
	(309, 30, 96, 1, 138.00),
	(310, 30, 97, 1, 138.00),
	(311, 30, 98, 1, 138.00),
	(312, 27, 98, 1, 27.00),
	(313, 26, 98, 1, 27.00),
	(314, 28, 99, 5, 700.00),
	(315, 31, 99, 3, 0.00),
	(316, 32, 99, 1, 5.60),
	(317, 33, 99, 2, 30.80),
	(318, 34, 99, 6, 109.20),
	(319, 28, 100, 1, 140.00),
	(320, 29, 100, 1, 5.60),
	(321, 31, 100, 1, 0.00),
	(322, 32, 101, 1, 5.60),
	(323, 33, 101, 1, 15.40),
	(324, 34, 101, 1, 18.20);
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.perfil: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `nombre`) VALUES
	(1, 'administrador'),
	(2, 'Vendedor'),
	(3, 'Supervisor');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.perfil_has_permiso
CREATE TABLE IF NOT EXISTS `perfil_has_permiso` (
  `perfil_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  PRIMARY KEY (`perfil_id`,`permiso_id`),
  KEY `fk_perfil_has_permiso_permiso1_idx` (`permiso_id`),
  KEY `fk_perfil_has_permiso_perfil1_idx` (`perfil_id`),
  CONSTRAINT `fk_perfil_has_permiso_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_has_permiso_permiso1` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.perfil_has_permiso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil_has_permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfil_has_permiso` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.permiso
CREATE TABLE IF NOT EXISTS `permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.permiso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.persona: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`id`, `nombre`, `apellidos`, `correo`, `fecha_nacimiento`, `telefono`, `direccion`, `creado_en`, `actualizado_en`) VALUES
	(1, 'moisés garcía miss', '', NULL, '2018-12-08', NULL, '', '2018-12-08 15:34:11', '2019-01-03 12:55:28'),
	(19, 'daniel morales', NULL, NULL, NULL, NULL, NULL, '2018-12-08 17:34:23', '2018-12-11 17:23:06'),
	(39, 'moises ', NULL, 'moises@correo.com', '2018-12-18', '(934) 102-4062', 'Villahermosa, Tab., México', '2018-12-18 19:57:42', NULL),
	(42, 'cliente2', NULL, 'cliente2editado@correo.com', '2018-12-18', '(934) 102-4063', 'Villahermosa, Tab., México', '2018-12-18 20:43:54', '2018-12-18 21:11:31'),
	(43, 'cliente3editado', NULL, 'cliente3@correo.com', '2018-12-18', '(934) 102-4062', 'Villahermosa, Tab., México', '2018-12-18 21:12:41', '2018-12-18 21:12:50');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) NOT NULL DEFAULT '',
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria1_idx` (`categoria_id`),
  CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.producto: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id`, `codigo`, `nombre`, `descripcion`, `imagen`, `precio_compra`, `precio_venta`, `stock`, `categoria_id`, `creado_en`, `actualizado_en`) VALUES
	(20, '', 'producto21', '', 'e962f83a5cc3dedb252a249ae4795aaf.jpeg', 25.00, 35.00, 972, 25, '2018-12-14 18:11:11', '2019-01-03 12:38:29'),
	(26, '', 'producto11editado', '', '2018-12-16 13.07.04 13c292159cce2b9751f359fd6d4e06a5.jpg', 20.00, 27.00, 972, 23, '2018-12-14 19:20:02', '2019-01-04 22:57:31'),
	(27, '', 'producto11', '', 'dc620bc2b8249ac35cdf31eea438d515.jpg', 20.00, 27.00, 962, 23, '2018-12-14 19:20:32', '2019-01-04 22:57:31'),
	(28, '', 'producto22', '', '065a71480a4de1045cdea1fa14041d60.jpg', 100.00, 140.00, 877, 25, '2018-12-14 21:28:53', '2019-01-05 17:11:09'),
	(29, '', 'producto22', '', '49c0de57d3e51e969b8886d27089840e.jpg', 4.00, 5.60, 973, 25, '2018-12-14 21:32:01', '2019-01-05 17:11:10'),
	(30, '300', 'producto nuevo :3', 'un producto nuevo', '2018-12-16 13.26.12 bde8ad228ec3972bf1bc62f490cd7637.jpg', 60.00, 138.00, 931, 34, '2018-12-16 13:26:13', '2019-01-04 22:57:30'),
	(31, '', 'producto30', '', '', 0.00, 0.00, 982, NULL, '2018-12-29 18:04:57', '2019-01-05 17:11:10'),
	(32, '', 'producto32', '', '', 4.00, 5.60, 984, NULL, '2018-12-29 18:05:09', '2019-01-05 17:11:30'),
	(33, '', 'producto33', '', '', 11.00, 15.40, 983, NULL, '2018-12-29 18:05:23', '2019-01-05 17:11:31'),
	(34, '', 'producto34', '', '', 13.00, 18.20, 1979, NULL, '2018-12-29 18:05:35', '2019-01-05 17:11:31'),
	(35, '', 'producto35', '', '', 11.00, 15.40, 93, NULL, '2018-12-29 18:05:46', '2019-01-02 13:00:53'),
	(36, '', 'producto36', '', '', 9.00, 12.60, 93, NULL, '2018-12-29 18:05:56', '2019-01-02 13:00:53'),
	(37, '', 'producto38', '', '', 5.00, 7.00, 93, NULL, '2018-12-29 18:06:15', '2019-01-02 13:00:53');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`persona_id`),
  CONSTRAINT `fk_proveedor_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.proveedor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `persona_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` enum('Y','N') DEFAULT 'Y',
  `perfil_id` int(11) NOT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  PRIMARY KEY (`persona_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuarios_personas_idx` (`persona_id`),
  KEY `fk_usuario_perfil1_idx` (`perfil_id`),
  CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_personas` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.usuario: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`persona_id`, `email`, `password`, `estado`, `perfil_id`, `ultimo_login`) VALUES
	(1, 'moises@correo.com', '$2y$10$AKp0RTXEygq5d0mXo.L71eC6Z8S0XzOkVN4Uot/jlwzUEfBs0SSFm', 'Y', 1, '2018-12-29 21:45:42'),
	(19, 'daniel@correo.com', '$2y$10$LyPeCkCVFB8snY8NsD9Ag.HKRdLOCl6jBhiWGdOK/Ck8u/Ftmjkh.', 'Y', 1, '2018-12-11 13:24:07');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.venta
CREATE TABLE IF NOT EXISTS `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente_id` int(11) DEFAULT NULL,
  `vendedor_id` int(11) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `impuesto` int(11) NOT NULL,
  `neto` decimal(11,2) DEFAULT NULL,
  `total` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compras_cliente1_idx` (`cliente_id`),
  KEY `FK_venta_usuario` (`vendedor_id`),
  CONSTRAINT `FK_venta_usuario` FOREIGN KEY (`vendedor_id`) REFERENCES `usuario` (`persona_id`),
  CONSTRAINT `fk_compras_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`persona_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.venta: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` (`id`, `fecha`, `cliente_id`, `vendedor_id`, `metodo_pago`, `impuesto`, `neto`, `total`) VALUES
	(86, '2019-01-03 13:17:10', NULL, 1, 'Efectivo', 0, NULL, 165.00),
	(87, '2019-01-03 13:18:40', NULL, 1, 'Efectivo', 0, NULL, 165.00),
	(88, '2019-01-03 13:19:04', NULL, 1, 'Efectivo', 0, NULL, 165.00),
	(91, '2019-01-03 13:20:33', NULL, 1, 'Efectivo', 0, NULL, 165.00),
	(92, '2019-01-03 13:21:02', NULL, 1, 'TC-001', 0, NULL, 165.00),
	(93, '2019-01-03 13:22:55', 43, 1, 'Efectivo', 0, NULL, 165.00),
	(94, '2019-01-03 13:31:26', NULL, 1, 'Efectivo', 0, NULL, 192.00),
	(95, '2019-01-03 15:02:12', NULL, 1, 'Efectivo', 0, NULL, 1380.00),
	(96, '2019-01-03 15:34:59', NULL, 1, 'Efectivo', 0, 138.00, 138.00),
	(97, '2019-01-03 15:35:40', NULL, 1, 'Efectivo', 16, 138.00, 160.08),
	(98, '2019-01-04 22:57:29', NULL, 1, 'Efectivo', 16, 192.00, 222.72),
	(99, '2019-01-05 00:55:13', NULL, 1, 'Efectivo', 16, 845.60, 980.90),
	(100, '2019-01-05 17:11:09', NULL, 1, 'Efectivo', 16, 145.60, 168.90),
	(101, '2018-01-05 17:11:30', NULL, 1, 'Efectivo', 16, 39.20, 45.47);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;

-- Volcando estructura para vista mydb.view_cliente
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_cliente` (
	`cliente_id` INT(11) NOT NULL,
	`id` INT(11) NOT NULL,
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`apellidos` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`correo` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`fecha_nacimiento` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`telefono` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`direccion` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`creado_en` VARCHAR(24) NULL COLLATE 'utf8mb4_general_ci',
	`ultima_compra` VARCHAR(24) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_detalle_venta
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_detalle_venta` (
	`id` INT(11) NOT NULL,
	`producto_id` INT(11) NOT NULL,
	`venta_id` INT(11) NOT NULL,
	`cantidad` INT(11) NOT NULL,
	`subtotal` DECIMAL(11,2) NOT NULL,
	`codigo` VARCHAR(30) NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_producto
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_producto` (
	`id` INT(11) NOT NULL,
	`codigo` VARCHAR(30) NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`descripcion` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`imagen` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	`precio_compra` DECIMAL(11,2) NOT NULL,
	`precio_venta` DECIMAL(11,2) NOT NULL,
	`stock` INT(11) NULL,
	`categoria_id` INT(11) NULL,
	`creado_en` TIMESTAMP NOT NULL,
	`actualizado_en` TIMESTAMP NULL,
	`categoria` VARCHAR(45) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_usuario
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_usuario` (
	`persona_id` INT(11) NOT NULL,
	`email` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	`estado` ENUM('Y','N') NULL COLLATE 'utf8_general_ci',
	`perfil_id` INT(11) NOT NULL,
	`ultimo_login` DATETIME NULL,
	`id` INT(11) NOT NULL,
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`apellidos` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`fecha_nacimiento` DATE NULL,
	`direccion` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`creado_en` TIMESTAMP NOT NULL,
	`actualizado_en` TIMESTAMP NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_venta
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_venta` (
	`id` INT(11) NOT NULL,
	`cliente_id` INT(11) NULL,
	`vendedor_id` INT(11) NOT NULL,
	`metodo_pago` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`impuesto` INT(11) NOT NULL,
	`neto` DECIMAL(11,2) NULL,
	`total` DECIMAL(11,2) NOT NULL,
	`fecha_sin_formato` TIMESTAMP NOT NULL,
	`fecha` VARCHAR(24) NULL COLLATE 'utf8mb4_general_ci',
	`vendedor` VARCHAR(91) NULL COLLATE 'utf8_general_ci',
	`cliente` VARCHAR(91) NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`apellidos` VARCHAR(45) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_cliente
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_cliente`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cliente` AS SELECT 
t1.persona_id as cliente_id,
t2.id,
t2.nombre,
t2.apellidos,
t2.correo,
date_format(t2.fecha_nacimiento, '%d/%m/%Y') as fecha_nacimiento,
t2.telefono,
t2.direccion,
date_format(t2.creado_en, '%d/%m/%Y - %r') as creado_en,
(select date_format(fecha, '%d/%m/%Y - %r') from venta where cliente_id = t1.persona_id order by fecha desc limit 1) as ultima_compra
from cliente t1
inner join persona t2 on t1.persona_id = t2.id ;

-- Volcando estructura para vista mydb.view_detalle_venta
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_detalle_venta`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detalle_venta` AS select 
t1.*,
t2.codigo,
t2.nombre
from detalle_venta t1
inner join producto t2 on t2.id = t1.producto_id
inner join venta t3 on t3.id = t1.venta_id ;

-- Volcando estructura para vista mydb.view_producto
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_producto`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_producto` AS SELECT a.id, 
a.codigo, 
a.nombre, 
a.descripcion,
a.imagen, 
a.precio_compra,
a.precio_venta,
a.stock,
a.categoria_id,
a.creado_en,
a.actualizado_en,
b.nombre as categoria
from producto a 
left join categoria b on a.categoria_id = b.id ;

-- Volcando estructura para vista mydb.view_usuario
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_usuario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_usuario` AS SELECT * 
from usuario a
inner join persona b on b.id = a.persona_id ;

-- Volcando estructura para vista mydb.view_venta
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_venta`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_venta` AS SELECT

t1.id,
t1.cliente_id,
t1.vendedor_id,
t1.metodo_pago,
t1.impuesto,
t1.neto,
t1.total,
fecha as fecha_sin_formato,
date_format(t1.fecha, '%d/%m/%Y - %r') as fecha,
concat(coalesce(t2.nombre, ''), ' ', coalesce(t2.apellidos, '')) as vendedor,
coalesce(coalesce(t3.nombre, 'anónimo'), concat(coalesce(t3.nombre, ''), ' ', coalesce(t3.apellidos, ''))) as cliente,
t3.nombre,
t3.apellidos

from venta t1
left join persona t2 on t1.vendedor_id = t2.id
left join persona t3 on t1.cliente_id = t3.id ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
