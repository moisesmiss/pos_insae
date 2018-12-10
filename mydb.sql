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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.categoria: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `nombre`, `creado_en`, `actualizado_en`) VALUES
	(23, 'categoria1', '2018-12-10 05:43:56', '2018-12-10 10:31:35'),
	(24, 'categoria2', '2018-12-10 05:44:01', NULL),
	(25, 'cateogria3', '2018-12-10 05:44:04', '2018-12-10 10:23:27'),
	(26, 'categoria4', '2018-12-10 05:44:10', NULL),
	(27, 'categoria4', '2018-12-10 10:06:46', NULL),
	(28, 'categoria5', '2018-12-10 10:06:58', NULL),
	(29, 'categoria6', '2018-12-10 10:07:04', NULL),
	(30, 'categoria7', '2018-12-10 10:07:09', NULL),
	(31, 'categoria8', '2018-12-10 10:07:17', NULL),
	(32, 'categoria9', '2018-12-10 10:07:24', NULL),
	(33, 'categoria10', '2018-12-10 10:07:32', NULL),
	(34, 'categoria11', '2018-12-10 10:07:40', NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`persona_id`),
  CONSTRAINT `fk_cliente_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.cliente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.compra
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(11,2) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compra_proveedor1_idx` (`proveedor_id`),
  KEY `fk_compra_estado_venta1_idx` (`estado_id`),
  CONSTRAINT `fk_compra_estado_venta1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  CONSTRAINT `fk_detalle_venta_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_venta_ventas1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.detalle_venta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.estado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;

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
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.persona: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`id`, `nombre`, `apellidos`, `fecha_nacimiento`, `direccion`, `creado_en`, `actualizado_en`) VALUES
	(1, 'moisés miss', 'mosies', '2018-12-08', 'mosies', '2018-12-08 15:34:11', '2018-12-09 20:37:45'),
	(2, 'admin', NULL, NULL, NULL, '2018-12-08 16:38:18', NULL),
	(3, 'admin', NULL, NULL, NULL, '2018-12-08 16:38:55', NULL),
	(4, 'admin', NULL, NULL, NULL, '2018-12-08 16:39:27', NULL),
	(5, 'admin', NULL, NULL, NULL, '2018-12-08 16:40:49', NULL),
	(6, 'admin', NULL, NULL, NULL, '2018-12-08 16:45:09', NULL),
	(7, 'admin', NULL, NULL, NULL, '2018-12-08 16:49:31', NULL),
	(8, 'admin', NULL, NULL, NULL, '2018-12-08 16:50:55', NULL),
	(9, 'admin', NULL, NULL, NULL, '2018-12-08 16:53:55', NULL),
	(10, 'admin', NULL, NULL, NULL, '2018-12-08 16:54:26', NULL),
	(11, 'admin', NULL, NULL, NULL, '2018-12-08 16:55:01', NULL),
	(12, 'admin', NULL, NULL, NULL, '2018-12-08 16:55:22', NULL),
	(13, 'admin', NULL, NULL, NULL, '2018-12-08 16:56:55', NULL),
	(14, 'admin', NULL, NULL, NULL, '2018-12-08 16:57:42', NULL),
	(15, 'admin', NULL, NULL, NULL, '2018-12-08 16:58:38', NULL),
	(16, 'admin', NULL, NULL, NULL, '2018-12-08 16:59:39', NULL),
	(19, 'daniel morales m', NULL, NULL, NULL, '2018-12-08 17:34:23', '2018-12-10 10:32:20'),
	(22, 'william', NULL, NULL, NULL, '2018-12-09 11:33:49', NULL),
	(23, 'william', NULL, NULL, NULL, '2018-12-09 11:34:06', NULL);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) DEFAULT '0',
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria1_idx` (`categoria_id`),
  CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.producto: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id`, `codigo`, `nombre`, `descripcion`, `imagen`, `precio_compra`, `precio_venta`, `stock`, `categoria_id`, `creado_en`, `actualizado_en`) VALUES
	(1, '1', 'producto1', NULL, NULL, 10.00, 14.00, 9, 23, '2018-12-10 08:05:04', '2018-12-10 13:27:07'),
	(2, '2', 'producto2', NULL, NULL, 10.00, 14.00, 49, 23, '2018-12-10 08:05:04', '2018-12-10 11:35:00'),
	(3, '3', 'producto3', NULL, NULL, 10.00, 14.00, 50, 24, '2018-12-10 08:05:04', '2018-12-10 11:35:44');
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

-- Volcando datos para la tabla mydb.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`persona_id`, `email`, `password`, `estado`, `perfil_id`, `ultimo_login`) VALUES
	(1, 'moises@correo.com', '$2y$10$AKp0RTXEygq5d0mXo.L71eC6Z8S0XzOkVN4Uot/jlwzUEfBs0SSFm', 'Y', 1, '2018-12-10 12:08:40'),
	(19, 'daniel@correo.com', '$2y$10$1OLB55V137Eg8MRMN/6aveooM67d4mlTIdP1LUJdoGDocswo4qH0q', 'N', 1, NULL),
	(22, 'william@correo.com', '$2y$10$nGKAlWNRQttku.CP.1PI.uH/edZ1nDlhIAetDEzIZ6VymmO8TrPbi', 'Y', 1, NULL),
	(23, 'william2@correo.com', '$2y$10$89oQfYDrCA0dvRTYDdbJ9uZ0DSZDH.OYq7/JnCNf7lYOfWs.YHPza', 'Y', 1, NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.venta
CREATE TABLE IF NOT EXISTS `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente_id` int(11) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `estado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compras_cliente1_idx` (`cliente_id`),
  KEY `fk_venta_estado_venta1_idx` (`estado_id`),
  CONSTRAINT `fk_compras_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`persona_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_estado_venta1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.venta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;

-- Volcando estructura para vista mydb.view_producto
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_producto` (
	`id` INT(11) NOT NULL,
	`codigo` VARCHAR(30) NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`descripcion` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`imagen` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`precio_compra` DECIMAL(11,2) NOT NULL,
	`precio_venta` DECIMAL(11,2) NOT NULL,
	`stock` INT(11) NULL,
	`categoria_id` INT(11) NULL,
	`creado_en` TIMESTAMP NOT NULL,
	`actualizado_en` TIMESTAMP NULL,
	`categoria` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci'
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
inner join categoria b on a.categoria_id = b.id ;

-- Volcando estructura para vista mydb.view_usuario
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_usuario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_usuario` AS SELECT * 
from usuario a
inner join persona b on b.id = a.persona_id ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
