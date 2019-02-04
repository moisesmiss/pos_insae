-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.37-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para mydb
CREATE DATABASE IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mydb`;

-- Volcando estructura para tabla mydb.bitacora
CREATE TABLE IF NOT EXISTS `bitacora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(50) DEFAULT NULL,
  `accion` varchar(50) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `datos_old` text,
  `datos_new` text,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK__usuario` (`usuario_id`),
  CONSTRAINT `FK__usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.bitacora: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` (`id`, `modulo`, `accion`, `usuario_id`, `datos_old`, `datos_new`, `fecha`) VALUES
	(1, 'usuario', 'agregar', 1, NULL, '{"email":"u1@correo.com","password":"$2y$10$J0I6WRMyAf35g2Ia8IAw0eKmUZ0gnxrGdy1FD5z0VdAprF9wPk92y","perfil_id":"3","persona_id":"61","nombre":"usuario1","correo":"u1@correo.com"}', '2019-01-30 21:57:46'),
	(11, 'usuario', 'agregar', 1, NULL, '{"email":"u3@correo.com","password":"$2y$10$8XOi3Z3HJ59ee\\/qkPiVGCOqRQ50Jdm4qW3NFOl4GxZ5kDikUa48b.","perfil_id":"1","persona_id":"71","nombre":"u3","correo":"u3@correo.com"}', '2019-01-31 22:33:16'),
	(12, 'usuario', 'agregar', 1, NULL, '{"email":"u3@correo.com","password":"$2y$10$acZY\\/PZ\\/OvWnWdcoNpfb.urP7Dl62MAq.OBl6VDkhFssOgRLr6soK","perfil_id":"3","persona_id":"72","nombre":"u3","correo":"u3@correo.com"}', '2019-01-31 22:54:25');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.categoria: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `nombre`, `creado_en`, `actualizado_en`) VALUES
	(36, 'computadoras', '2019-01-12 12:46:50', '2019-01-12 22:42:30'),
	(37, 'impresoras', '2019-01-12 22:35:28', NULL),
	(38, 'equipo de redes', '2019-01-12 22:36:31', '2019-01-12 22:41:29'),
	(39, 'cables de redes', '2019-01-12 22:42:11', NULL),
	(40, 'accesorios de computo', '2019-01-12 22:42:56', NULL);
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
	(43),
	(53);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.compra
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `impuesto` float DEFAULT NULL,
  `neto` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` (`id`, `fecha`, `impuesto`, `neto`, `total`) VALUES
	(6, '2019-02-01 15:10:51', 16, 7300.00, 8468.00);
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.configuracion
CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_corto_empresa` varchar(50) NOT NULL DEFAULT '',
  `nombre_largo_empresa` varchar(100) NOT NULL DEFAULT '',
  `rfc` varchar(50) NOT NULL DEFAULT '',
  `telefono` varchar(15) NOT NULL DEFAULT '',
  `correo` varchar(50) NOT NULL DEFAULT '',
  `sitio_web` varchar(50) NOT NULL DEFAULT '',
  `direccion` varchar(200) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `iva` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.configuracion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` (`id`, `nombre_corto_empresa`, `nombre_largo_empresa`, `rfc`, `telefono`, `correo`, `sitio_web`, `direccion`, `logo`, `iva`) VALUES
	(6, 'INSAE', 'Informática, Solución y Asesoría Empresarial', 'TUAD840920AT5', '(993) 315-9720', 'dtrujillo84@gmail.com', 'http://www.insae.com.mx/soporte-tecnico/', 'Villahermosa, Tabasco, Gil y Saens Calle Ayuntamiento No. 337 Altos', 'logo-insae.png', 16);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;

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
  CONSTRAINT `fk_detalle_compra_compra1` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detalle_compra_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.detalle_compra: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
INSERT INTO `detalle_compra` (`id`, `compra_id`, `producto_id`, `subtotal`, `cantidad`) VALUES
	(10, 6, 52, 2800.00, 10),
	(11, 6, 60, 4500.00, 3);
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
) ENGINE=InnoDB AUTO_INCREMENT=543 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.detalle_venta: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` (`id`, `producto_id`, `venta_id`, `cantidad`, `subtotal`) VALUES
	(536, 52, 171, 1, 392.00),
	(537, 51, 171, 1, 4900.00),
	(538, 50, 171, 1, 3234.00),
	(539, 46, 171, 1, 2660.00),
	(540, 60, 172, 1, 2100.00),
	(541, 51, 172, 1, 4900.00),
	(542, 50, 172, 1, 3234.00);
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
	(2, 'vendedor'),
	(3, 'almacenista');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT '',
  `direccion` varchar(255) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.persona: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`id`, `nombre`, `apellidos`, `correo`, `fecha_nacimiento`, `telefono`, `rfc`, `direccion`, `creado_en`, `actualizado_en`) VALUES
	(1, 'moisés jair garcía miss', '', NULL, '2018-12-08', NULL, '', '', '2018-12-08 15:34:11', '2019-01-24 17:21:35'),
	(39, 'david collado ramirez', NULL, 'dcollado@live.es', '1899-12-18', '(934) 102-4062', 'DACR991218JTH', 'Chiapas, México', '2018-12-18 19:57:42', '2019-01-29 15:54:40'),
	(42, 'arturo lopez martinez', NULL, 'lpez.martinez@hotmail.com', '1998-08-29', '(934) 102-4063', 'ARLM980829', 'Villahermosa, Tab., México', '2018-12-18 20:43:54', '2019-01-29 15:43:35'),
	(43, 'mario alejandro garcia perez', NULL, 'perez@live.com', '1990-12-18', '(934) 102-4062', 'MAGP901218GTH', 'Villahermosa, Tab., México', '2018-12-18 21:12:41', '2019-01-29 15:45:01'),
	(44, 'daniel morales', NULL, NULL, NULL, NULL, '', NULL, '2019-01-13 12:27:34', '2019-01-13 15:00:22'),
	(45, 'william', NULL, 'william@correo.com', NULL, NULL, '', NULL, '2019-01-13 12:39:07', NULL),
	(46, 'david', NULL, 'david@correo.com', NULL, NULL, '', NULL, '2019-01-13 12:39:36', NULL),
	(47, 'emmanuel', NULL, 'mariana@correo.com', NULL, NULL, '', NULL, '2019-01-13 12:44:14', '2019-01-14 18:52:42'),
	(48, 'junior', NULL, 'junior@correo.com', NULL, NULL, '', NULL, '2019-01-13 15:03:08', NULL),
	(53, 'gregodio miss morales', NULL, 'gregodi.mm@gmail.com', '1996-01-22', '(993) 245-6793', 'GRMM960122TJY', 'Guatemala', '2019-01-22 13:31:22', '2019-01-29 15:53:15'),
	(55, 'Maria Perez Vasconcelos', NULL, 'mari.canon@outlook.com', '1890-03-04', '(993) 245-6789', 'MAPV900304GTJ', 'Chicago, Illinois, EE. UU.', '2019-01-29 15:33:11', '2019-01-29 15:42:01'),
	(56, 'Marcos Mendez Priego', NULL, 'mendez.compu@hotmail.com', '1890-08-20', '(993) 254-8360', 'MAMS900820FTL', 'Huixquilucan, Méx., México', '2019-01-29 15:35:44', '2019-01-29 15:50:41'),
	(57, 'Luis Ramos Damian', NULL, 'luis.rd@live.es', '1890-07-29', '(913) 568-4586', 'LURD900729GTI', 'Puebla, Pue., México', '2019-01-29 15:56:22', NULL),
	(61, 'usuario1', NULL, 'u1@correo.com', NULL, NULL, '', NULL, '2019-01-31 21:57:46', NULL),
	(62, 'u2', NULL, 'u2@correo.com', NULL, NULL, '', NULL, '2019-01-31 22:18:52', NULL),
	(63, 'u2', NULL, 'u2@correo.com', NULL, NULL, '', NULL, '2019-01-31 22:20:00', NULL),
	(64, 'u2', NULL, 'u2@correo.com', NULL, NULL, '', NULL, '2019-01-31 22:20:15', NULL),
	(66, 'u2', NULL, 'u2', NULL, NULL, '', NULL, '2019-01-31 22:28:33', NULL),
	(69, 'u2', NULL, 'u2@correo.com', NULL, NULL, '', NULL, '2019-01-31 22:32:42', NULL),
	(70, 'u3', NULL, 'u3@correo.com', NULL, NULL, '', NULL, '2019-01-31 22:33:09', NULL),
	(72, 'u3', NULL, 'u3@correo.com', NULL, NULL, '', NULL, '2019-01-31 22:54:25', NULL);
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
  `proveedor_id` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria1_idx` (`categoria_id`),
  KEY `FK_producto_proveedor` (`proveedor_id`),
  CONSTRAINT `FK_producto_proveedor` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.producto: ~47 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id`, `codigo`, `nombre`, `descripcion`, `imagen`, `precio_compra`, `precio_venta`, `stock`, `categoria_id`, `proveedor_id`, `creado_en`, `actualizado_en`) VALUES
	(40, 'Q5837', 'notebook hp 240 g6', 'Sistema operativo	Windows 10 Home\r\nProcesador	Intel Celeron\r\nCapacidad	500 GB\r\nMemoria RAM	4 GB\r\nTamaño de la pantalla (pulg)	14.00\r\nTecnologia de pantalla	HD.', '2019-01-12 14.54.42 55d8c52ce58329ece58ab0b40a26e464.jpg', 3950.00, 5530.00, 50, NULL, NULL, '2019-01-12 14:54:42', '2019-01-13 10:16:44'),
	(41, 'N7846', 'victsing mouse/ratón inalámbrico Óptico', 'Con Receptor Nano, 6 Buttons, 2400DPI, 5 Niveles de dpi Ajustable – Color Gris.', '2019-01-12 14.58.17 88db2c0198f5955536802d6a3f682db7.jpg', 160.00, 224.00, 60, 40, NULL, '2019-01-12 14:58:18', '2019-01-13 10:19:07'),
	(42, 'D6934', 'hp z3700 mouse wireless, gold', 'Marca	HP\r\nColor	Modern Gold\r\nNúmero de puertos USB 3.0  1', '2019-01-12 15.21.03 d0149ef1219710969b6f547273b9f35e.jpg', 300.00, 420.00, 60, 40, NULL, '2019-01-12 15:21:03', '2019-01-13 10:12:08'),
	(43, 'M8456', 'bluetooth teclado inalámbrico.', 'Estilo: Ergonomía, Delgado, Para tableta, Estándar, Para computadora portátil, Mini \r\nTeclado de tamaño completo: Sí \r\nAplicación: Tableta, Computadora portátil.', '2019-01-12 15.33.36 4791678fc2996aa3b102db24ff02fa77.jpg', 665.00, 931.00, 20, 40, NULL, '2019-01-12 15:33:36', '2019-01-13 10:10:06'),
	(44, 'D7169', 'microsoft teclado para tablet surface pro, ne', 'Marca	Microsoft\r\nColor	Negro.', '2019-01-12 15.37.27 d3a44adcd2fb64f2a194ab10237a1b13.jpg', 2100.00, 2940.00, 40, 40, NULL, '2019-01-12 15:37:28', '2019-01-13 10:12:44'),
	(45, 'V7903', 'cargador laptop original toshiba satellite 19', '•	Marca del cargadorToshiba\r\n•	Modelo del cargador19v - 3.95a\r\n•	Potencia75 W\r\n•	Amperaje de salida3.95 A\r\n•	Voltaje de salida19 V\r\n•	Conector de salida5.5mm X 2.5mm.', '2019-01-12 15.54.36 38736fa666a26369c5bc26da810833a3.jpg', 120.00, 168.00, 40, 40, NULL, '2019-01-12 15:48:37', '2019-01-13 10:11:31'),
	(46, 'G5890', 'brother hl-l2360dw impresora láser monocromo ', 'Marca	Brother\r\nModelo	Brother HL-L2360DW\r\nNombre del modelo	HL-L2360DW\r\nModelo	2014\r\nNúmero de parte	BRTHLL2380DW\r\nTamaño de RAM	32 MB.', '2019-01-12 16.02.45 c9b5be0822813f040d1b16e445ee56b5.jpg', 1900.00, 2660.00, 29, 37, NULL, '2019-01-12 16:02:45', '2019-01-29 15:58:39'),
	(47, 'D3609', 'epson tm-t20ii direct thermal printer - monoc', 'Dimensiones del producto: 14 x 14.6 x 19.9 cm ; 1.7 Kg\r\nPeso del envío: 2.5 Kg\r\nNúmero de modelo del producto: C31CD52062\r\nASIN: B00HEMOOE0', '2019-01-12 16.11.31 139125c7bbc232d329eb1967580f838c.jpg', 2320.00, 3248.00, 10, 37, NULL, '2019-01-12 16:11:32', '2019-01-13 10:11:49'),
	(48, 'S4683', 'royal pt300 impresora térmica para negocio ro', 'Conexión WiFi, Bluetooth y USB\r\nImpresión térmica. Rollo térmico de impresión de 57 mm\r\nBatería recargable\r\nCompatible con Android, iOS y Windows.', '2019-01-12 22.49.46 ba2dc38ab6a6b81f6ad4049b8f1f6af0.jpg', 1800.00, 2520.00, 30, 37, NULL, '2019-01-12 22:49:47', '2019-01-13 10:18:07'),
	(49, 'D6848', 'bixolon srp-330iicoesk impresora térmica de t', 'arca	Bixolon\r\nModelo	SRP-330IICOESK\r\nNombre del modelo	SRP-330IICOESK/BEG\r\nModelo	2016\r\nNúmero de parte	SRP-330IICOESK/BEG\r\nTamaño de RAM	64 MB.', '2019-01-12 22.54.25 4b4ec0a5dd4d318c414ca31d74662afe.jpg', 2550.00, 3570.00, 35, 37, NULL, '2019-01-12 22:54:25', '2019-01-13 10:09:29'),
	(50, 'G3458', 'bixolon abix-srp330iicopg impresora de ticket', 'Marca	Bixolon\r\nModelo	SRP-330IICOPK\r\nModelo	2016\r\nNúmero de parte	SRP-330IICOPK\r\nTamaño de RAM	8 MB\r\nCapacidad de almacenamiento de la memoria	8 MB.', '2019-01-12 22.57.01 cd962443629f83d255ecd4f2be83b292.jpg', 2310.00, 3234.00, 23, 37, NULL, '2019-01-12 22:57:02', '2019-01-31 11:13:15'),
	(51, 'D3958', 'benq rl2455s monitor 24", lcd, 1920 x 1080 pi', 'Marca	BenQ\r\nSeries	RL\r\nColor	Gris\r\nAlto del producto	43.5 centimeter\r\nAncho del producto	57.9 centimeter\r\nTamaño de la pantalla	24 inches\r\nResolución de la pantalla	1920 x 1080 Pixeles.', '2019-01-12 22.59.44 02b7ceb3e0e465f421183bda253eda73.jpg', 3500.00, 4900.00, 13, 36, NULL, '2019-01-12 22:59:45', '2019-01-31 11:13:14'),
	(52, 'B1346', 'amazon basics para adaptador ethernet usb', 'Marca	Amazon Basics\r\nColor	Verde\r\nAlto del producto	24 millimeters\r\nAncho del producto	16 millimeters\r\nSistema operativo	Windows XP, Windows Vista, Chrome OS.', '2019-01-12 23.04.20 63f6d74323a496fa47b37602386184e2.jpg', 280.00, 392.00, 29, 39, NULL, '2019-01-12 23:04:21', '2019-02-01 15:10:52'),
	(53, 'B4635', 'ugreen cable ethernet, cat 7 cable de red 100', 'arca	UGREEN\r\nNúmero de modelo	11262\r\nColor	Plano - Negro\r\nTamaño	3m\r\nNúmero de pieza del fabricante	11262.', '2019-01-12 23.05.58 ceb74b42b221d7fd1deb675ecb91a0d7.jpg', 150.00, 210.00, 25, 39, NULL, '2019-01-12 23:05:59', '2019-01-13 10:18:55'),
	(54, 'N6734', 'cable puente, calibre 10, 3.6 m.', 'Dimensiones del producto: 30 x 7 x 30 cm ; 998 g\r\nPeso del envío: 1.1 Kg\r\nNúmero de modelo del producto: BC120749A\r\nASIN: B074DMCRNF.', '2019-01-12 23.08.18 0808f0bd21ff0625114f4d2ef4e9611b.jpg', 195.00, 273.00, 35, 39, NULL, '2019-01-12 23:08:19', '2019-01-13 10:11:19'),
	(55, 'K4624', 'startech, adaptador cable divisor sas de 29 p', 'Marca	StarTech\r\nSeries	Adaptador Cable Divisor SAS 29 Pines a Molex Macho LP4 y SATA - SFF-8482\r\nColor	Rojo\r\nFactor de forma	Derecho\r\nAlto del producto	22 centimeter.', '2019-01-12 23.09.41 f3e6117499da6fb886209b716fb86b1d.jpg', 230.00, 322.00, 20, 39, NULL, '2019-01-12 23:09:41', '2019-01-13 10:18:21'),
	(56, 'H4026', 'cable de extensión 16/3 de vinilo, para exter', 'Número de parte	MW-A1/B3-1600\r\nTamaño	30.5 m\r\nColor	Anaranjado\r\nVoltaje	120 volts.', '2019-01-12 23.11.00 3d155d3fd711b29f4075f4e927d8f83e.jpg', 475.00, 665.00, 30, 39, NULL, '2019-01-12 23:11:00', '2019-01-13 10:11:04'),
	(57, 'W3756', 'router tp-link ethernet tl-r480t+, alámbrico', 'Color del producto	Gris\r\nMontaje en rack	Si\r\nCertificación	CE, FCC', '2019-01-12 23.15.13 1283a2252f2840ad61f85d574ca57824.jpg', 1050.00, 1470.00, 20, 38, NULL, '2019-01-12 23:15:14', '2019-01-13 10:17:06'),
	(58, 'R5896', 'router tp-link wisp ethernet tl-mr3020, inalá', 'Banda Wi-Fi: Single-band (2.4 GHz)\r\nTasa de transferencia de datos WLAN: 150 Mbit/s\r\nTipo de interfaz Ethernet LAN: Fast Ethernet\r\nCantidad de Puertos RJ-45: 1.', '2019-01-12 23.17.51 334a3aec751c137e919cf3a0305b1fde.jpg', 355.00, 497.00, 18, 38, NULL, '2019-01-12 23:17:51', '2019-01-13 10:17:39'),
	(59, 'C3724', 'tp-link tl-wr841 n inalámbrico n300 router wi', 'Marca	TP-LINK\r\nColor	Negro\r\nAlto del producto	36 millimeters\r\nAncho del producto	14.5 centimeter\r\nTipo de conexión inalámbrica	2.4 GHz Radio Frequency, 5 GHz Radio Frequency.', '2019-01-12 23.19.38 e9fb073c7d6fc19a865d21cfdceb3c26.jpg', 590.00, 826.00, 22, 38, NULL, '2019-01-12 23:19:39', '2019-01-13 10:18:30'),
	(60, 'C4569', 'asus enrutador inalámbrico 3 en 1 (rt-n12).1,', 'Marca	Asus\r\nColor	Negro\r\nAlto del producto	20.7 centimeter\r\nAncho del producto	40 millimeters\r\nTipo de conexión inalámbrica	802.11.ac.', '2019-01-12 23.21.30 bb231fe740e3233d074541fcbcd824ea.jpg', 1500.00, 2100.00, 30, 38, NULL, '2019-01-12 23:21:31', '2019-02-01 15:10:52'),
	(61, 'D3687', 'ubiquiti networks usg-pro-4 rotator unifi emp', '1 Puerto Serial 4 Puertos Gigabit Ethernet\r\n2 puertos SFP (Combo con 2 puertos Gigabit) Mas de 2 millones de paquetes por segundo\r\nMontaje en Rack.', '2019-01-12 23.23.48 eedd752aad4788e8c0e2a29fe02df6b8.jpg', 5750.00, 8050.00, 25, 38, NULL, '2019-01-12 23:23:49', '2019-01-13 10:18:41'),
	(62, 'R6312', 'tp-link archer c9 router gigabit de banda dua', 'Marca	TP-LINK\r\nSeries	Archer C9\r\nColor	Color blanco\r\nAlto del producto	24.1 centimeter\r\nAncho del producto	9.9 centimeter\r\nTipo de conexión inalámbrica	802.11.ac.', '2019-01-13 10.23.11 bc741a40b179624dbcaa192cdf044d8f.jpg', 1700.00, 2380.00, 35, 38, NULL, '2019-01-13 10:23:11', NULL),
	(63, 'R7356', 'router tp-link archer c7', ' ROUTER INALÁMBRICO\r\nROUTER GIGABIT INALÁMBRICO DE BANDA DUAL AC1750.', '2019-01-13 10.25.43 3174883f863673f9d9d49bb8968dc6b1.jpg', 1500.00, 2100.00, 45, 38, NULL, '2019-01-13 10:25:43', NULL),
	(64, 'R8567', 'tp-link tl-wr941hp 450 mbps wireless-n router', '4 Puertos LAN 10/100Mbps y 1 Puerto WAN\r\n3 Antenas de 9 dBi\r\nVelocidad de 450 Mbps\r\nHasta 900 m2 de Cobertura.', '2019-01-13 10.27.52 e6e9c40ef70a956c37640f533e71ebeb.jpg', 900.00, 1260.00, 34, 38, NULL, '2019-01-13 10:27:52', NULL),
	(65, 'R3743', 'tp-link, enrutadores inalámbricos, tgr1900', 'Marca	TP-LINK\r\nSeries	TGR1900\r\nColor	Azul\r\nVoltaje	12 volts.', '2019-01-13 10.30.14 b87d8a6cf22a57d22a19da917b5e73bf.jpg', 2600.00, 3640.00, 35, 38, NULL, '2019-01-13 10:30:14', NULL),
	(66, 'R1579', 'router inalámbrico tp-link tl-wr840n blanco', 'Basado en la tecnología 802.11n, el TL-WR840N te ofrece un rendimiento inalámbrico de hasta 300 Mbps.', '2019-01-13 10.33.16 2a221e30f2e76ddaf6cdfd832302f28b.jpg', 490.00, 686.00, 45, 38, NULL, '2019-01-13 10:33:16', NULL),
	(67, 'A6890', 'kingston hx-hscs-bk/la audífonos hyperx sting', 'Diseño ergonómico para utilizar durante horas\r\nCancelación de ruido\r\nAlto Rendimiento.', '2019-01-13 10.37.07 b87d8a6cf22a57d22a19da917b5e73bf.jpg', 800.00, 1120.00, 60, 40, NULL, '2019-01-13 10:37:07', NULL),
	(68, 'M5783', 'hp 500 spectre mouse bluetooth', 'La conectividad Bluetooth 3.0 te mantiene constantemente conectado sin la molestia de cables o dispositivos USB.', '2019-01-13 10.40.11 457633423d0e58e47eb7dcc9aa9a6e6f.jpg', 680.00, 952.00, 60, 40, NULL, '2019-01-13 10:40:11', '2019-01-13 10:40:44'),
	(69, 'C3534', 'cable de conexión lightning a usb con certifi', 'Apple MFi certificó el cable cargador y sincronizador para tus dispositivos Apple.', '2019-01-13 10.42.24 10823ab8ae8df7c5c9a4c4db215efef7.jpg', 130.00, 182.00, 50, 40, NULL, '2019-01-13 10:42:25', NULL),
	(70, 'M5897', 'amazon basics soporte ventilado y ajustable p', 'El soporte ventilado ayuda a mantener las computadoras portátiles más frescas para reducir los fallos.', '2019-01-13 10.44.53 0fe958ecf4eeb3e466557c53e27bb9f8.jpg', 240.00, 336.00, 50, 40, NULL, '2019-01-13 10:44:54', NULL),
	(71, 'A1436', 'logitech receptor usb para mouse/teclado, ina', 'Nuestro receptor Unifying más pequeño. Tan pequeño que puedes dejarlo en la notebook de forma permanente, no es necesario desconectarlo para ir de un lado a otro.', '2019-01-13 10.50.20 1650c499e5d3dfd9893bbb10f5d8c696.jpg', 90.00, 126.00, 100, 40, NULL, '2019-01-13 10:50:20', NULL),
	(72, 'C6894', 'cable adaptador splitter rj45 de 2x hembra a ', 'Cable divisor, 2 vías, 1 x RJ-45 Macho NetworkMacho Network, Cobre.', '2019-01-13 10.55.43 bd347d352807a88c9959545e78d4fbcf.jpg', 120.00, 168.00, 50, 39, NULL, '2019-01-13 10:55:43', NULL),
	(73, 'C5289', 'ugreen chromecast ethernet adaptador 100mbps ', 'Habilita fácilmente la Ethernet conexión a su Google Chromecast o Fire TV Stick, lo que te permite aprovechar la velocidad y confiabilidad de Internet por router con cable RJ45.', '2019-01-13 10.59.02 532bc57336157869909a8b81317aa624.jpg', 210.00, 294.00, 38, 39, NULL, '2019-01-13 10:59:02', NULL),
	(74, 'C5689', 'ocamo tipo c hub con ethernet 3 puertos usb 3', 'Soporte para una variedad de sistemas: Windows (XP/7/8/10)/Mac (OS X 10.2 y superior/Linux).', '2019-01-13 11.01.16 894fb279fb97c6f8f73a1664eacfceb9.jpg', 260.00, 364.00, 45, 39, NULL, '2019-01-13 11:01:16', NULL),
	(75, 'C6478', 'tp-link tl-poe200 power over ethernet adapter', 'Deliver power and data to another device up to about 328. 1 feet(100 meters) away via a single Ethernet cable\r\n10/100M Ethernet ports\r\n5/9/12V DC power output.', '2019-01-13 11.18.30 368206d6930b7205ddda075d89074855.jpg', 490.00, 686.00, 60, 39, NULL, '2019-01-13 11:18:30', NULL),
	(76, 'C6789', 'tp-link tl-pa4010kit av500 nano powerline ada', 'Conexión de cable con transferencia de datos de alta velocidad de hasta 500Mbps, ideal para transmisión de vídeo de alta definición o video 3D y juegos en línea.', '2019-01-13 11.19.39 dbd04fa5e9be474eda3f499c8ce53d5a.jpg', 600.00, 840.00, 50, 39, NULL, '2019-01-13 11:19:40', NULL),
	(77, 'C7696', 'microsoft surface book laptop - ordenador por', 'Microsoft Surface Laptop cuenta con un procesador Intel Core i7 de 7ª generación, 512 GB de almacenamiento, 16 GB de RAM, y hasta 14,5 horas de reproducción de vídeo', '2019-01-13 11.34.49 13a19d672afce28bc8f210d18a22d2d8.jpg', 13500.00, 18900.00, 40, 36, NULL, '2019-01-13 11:34:49', NULL),
	(78, 'C5371', 'dell - inspiron 11.6" laptop - amd a6-9220e -', 'Marca	Dell\r\nAlto del producto	22 millimeters\r\nAncho del producto	20.3 centimeter\r\nTamaño de la pantalla	11.6 inches\r\nMarca del procesador	AMD\r\nTipo de procesador	Athlon X2 Dual Core 7550\r\nVelocidad del procesador	2.30 GHz', '2019-01-13 11.40.17 271adfb3fc9c62af787562a1c0b9af84.jpg', 3600.00, 5040.00, 25, 36, NULL, '2019-01-13 11:40:18', NULL),
	(79, 'C5786', 'laptop semireforzada de 14" con múltiples opc', 'Con certificación MIL-STD-810G y protección contra el ingreso IP-52.', '2019-01-13 11.44.00 738fe6199ab472845fdc6a9f86a751ea.jpg', 49000.00, 68600.00, 20, 36, 55, '2019-01-13 11:44:00', '2019-02-01 14:55:01'),
	(80, 'C6785', 'samsung lc24f390fhlxzx - monitor curvo, negro', 'Una curva profunda para una experiencia inmersiva\r\nPantalla de 1,800R para mayor comodidad\r\nAvanzado panel con menos fugas de luz.', '2019-01-13 11.50.12 e4c1f65dbd8872aecc0319eb39fd03d1.jpg', 1900.00, 2660.00, 15, 36, NULL, '2019-01-13 11:50:12', NULL),
	(81, 'C7689', 'microsoft surface pro 4 - tablet (31.2 cm (12', 'Resolución de la pantalla	2736 x 1824 Pixeles\r\nResolución máxima de la pantalla	2736x1824 pixels\r\nMarca del procesador	Intel\r\nTipo de procesador	Intel Core i5\r\nVelocidad del procesador	3 GHz\r\nNúmero de procesadores	2\r\nTamaño de RAM	4 GB.', '2019-01-13 11.51.57 f60fdf7026f4b68351816d5f2656e56e.jpg', 17000.00, 23800.00, 12, 36, NULL, '2019-01-13 11:51:57', NULL),
	(82, 'I5185', 'impresora canon imageclass mf249dw inalámbric', 'Todo en uno, funcionalidad le permite imprimir, escanear, copiar y enviar faxes con facilidad.', '2019-01-13 11.58.30 7530c2c6f351c204727926770737ab47.jpg', 5900.00, 8260.00, 10, 37, NULL, '2019-01-13 11:58:30', NULL),
	(83, 'I5810', 'hp m180nw impresora inalámbrica, lcd 1"', 'Obtenga altas velocidades de impresión y un rápido tiempo de salida de la primera página\r\nImprima fácilmente y con rapidez directamente desde el panel de control.', '2019-01-13 11.59.34 6fa43d91293371a0048026bcf88aed38.jpg', 2500.00, 3500.00, 16, 37, NULL, '2019-01-13 11:59:35', NULL),
	(84, 'I5016', 'multifuncional canon ts3110 negra', 'Dale la bienvenida a la nueva tecnología con la multifuncional Canon TS3110. Es una práctica solución que imprime, copia y escanea con gran calidad; todo en un diseño compacto y elegante.', '2019-01-13 12.00.36 09dcf92462c6f7ebad1d12bd6220599b.jpg', 600.00, 840.00, 18, 37, NULL, '2019-01-13 12:00:36', NULL),
	(85, 'I7545', 'multifuncional canon mg2410 blanca', 'Conoce la nueva multifuncional Canon MG2410 de inyección de tinta que te ofrece funciones de impresora, copiadora, escáner y tu propio centro de impresión fotográfica de alta calidad.', '2019-01-13 12.02.03 f5999fabfb1f692885bba2e6beaa6782.jpg', 580.00, 812.00, 18, 37, NULL, '2019-01-13 12:02:03', NULL),
	(86, 'I5489', 'hp g3q47a impresora láser, 1200 x 1200 dpi, 3', 'Impresora Láser Blanco y Negro\r\nHasta 30 ppm en A4 (31 ppm en Carta)\r\nBandeja estándar para 150 hojas.', '2019-01-13 12.04.31 d20e0649e8c8e19558ece327b9b346a5.jpg', 2500.00, 3500.00, 27, 37, NULL, '2019-01-13 12:04:31', NULL);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`persona_id`),
  CONSTRAINT `fk_proveedor_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.proveedor: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` (`persona_id`) VALUES
	(55),
	(56),
	(57);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `persona_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` enum('Y','N') DEFAULT 'Y',
  `perfil_id` int(11) NOT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`persona_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuarios_personas_idx` (`persona_id`),
  KEY `fk_usuario_perfil1_idx` (`perfil_id`),
  CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_personas` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.usuario: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`persona_id`, `email`, `password`, `estado`, `perfil_id`, `ultimo_login`, `token`) VALUES
	(1, 'moisesgamiss@gmail.com', '$2y$10$pyiYdb1NVZFqpAA.e29UcetgF21u.hSp8N.5YWLP5/PS46X.3rYQu', 'Y', 1, '2019-01-31 11:10:59', ''),
	(44, 'daniel@correo.com', '$2y$10$PA6kVl1oylv/gAT1R1mJ0.aVSaCbQok3AbbS6oOCINlaP/M82GTrK', 'Y', 1, '2019-01-29 16:01:08', NULL),
	(45, 'william@correo.com', '$2y$10$r3EjX6qNC/toyFAWpyKXgeNkt9SubAKpUhzXefHamhuYvwQ1ilFmK', 'Y', 1, NULL, NULL),
	(46, 'david@correo.com', '$2y$10$ejnMC9m1P6/cVjUDLyf3KuwBhWRHYA.yTasonIcO1r59EiJS/MUfS', 'Y', 2, '2019-01-13 21:10:14', NULL),
	(47, 'emmauel@correo.com', '$2y$10$AU2ugnLjzEzIdbM5kuckk.eCRK8AYVSQPWr/YPHa7u.Vft8MvThhi', 'Y', 2, NULL, NULL),
	(48, 'junior@correo.com', '$2y$10$ST30LNw/kOaryxfA733Du./zNaz24kClsuXZpwDnnD897ih9DnnGe', 'Y', 3, NULL, NULL),
	(61, 'u1@correo.com', '$2y$10$J0I6WRMyAf35g2Ia8IAw0eKmUZ0gnxrGdy1FD5z0VdAprF9wPk92y', 'Y', 3, NULL, NULL),
	(69, 'u2@correo.com', '$2y$10$LCOBo7ENnBROiDEk./RtX.wC7wxfdWAWLKbXgzgC9FeDQqC.zsEx2', 'Y', 3, NULL, NULL),
	(72, 'u3@correo.com', '$2y$10$acZY/PZ/OvWnWdcoNpfb.urP7Dl62MAq.OBl6VDkhFssOgRLr6soK', 'Y', 3, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.venta: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` (`id`, `fecha`, `cliente_id`, `vendedor_id`, `metodo_pago`, `impuesto`, `neto`, `total`) VALUES
	(171, '2019-01-29 15:58:38', 39, 1, 'Efectivo', 16, 11186.00, 12975.76),
	(172, '2019-01-31 11:13:09', 43, 1, 'Efectivo', 16, 10234.00, 11871.44);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;

-- Volcando estructura para vista mydb.view_bitacora
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_bitacora` (
	`id` INT(11) NOT NULL,
	`modulo` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`accion` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`usuario_id` INT(11) NULL,
	`datos_old` TEXT NULL COLLATE 'utf8_general_ci',
	`datos_new` TEXT NULL COLLATE 'utf8_general_ci',
	`fecha` TIMESTAMP NULL,
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

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
	`rfc` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`direccion` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`creado_en` VARCHAR(24) NULL COLLATE 'utf8mb4_general_ci',
	`ultima_compra` VARCHAR(24) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_compra
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_compra` (
	`id` INT(11) NOT NULL,
	`impuesto` FLOAT NULL,
	`neto` DECIMAL(11,2) NOT NULL,
	`total` DECIMAL(11,2) NOT NULL,
	`fecha_sin_formato` TIMESTAMP NOT NULL,
	`fecha` VARCHAR(24) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_detalle_compra
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_detalle_compra` (
	`id` INT(11) NOT NULL,
	`compra_id` INT(11) NOT NULL,
	`producto_id` INT(11) NOT NULL,
	`subtotal` DECIMAL(11,2) NOT NULL,
	`cantidad` INT(11) NOT NULL,
	`codigo` VARCHAR(30) NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci'
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
	`categoria` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`proveedor_id` INT(11) NULL,
	`proveedor` VARCHAR(45) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_proveedor
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_proveedor` (
	`proveedor_id` INT(11) NOT NULL,
	`id` INT(11) NOT NULL,
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`apellidos` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`correo` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`fecha_nacimiento` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`telefono` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`rfc` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`direccion` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`creado_en` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista mydb.view_usuario
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_usuario` (
	`persona_id` INT(11) NOT NULL,
	`email` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	`estado` ENUM('Y','N') NULL COLLATE 'utf8_general_ci',
	`ultimo_login` DATETIME NULL,
	`perfil_id` INT(11) NOT NULL,
	`correo` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`apellidos` VARCHAR(45) NULL COLLATE 'utf8_general_ci',
	`perfil` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci'
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

-- Volcando estructura para vista mydb.view_bitacora
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_bitacora`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_bitacora` AS SELECT 
t1.*,
t3.nombre
from bitacora t1
inner join usuario t2 on t2.persona_id = t1.usuario_id
inner join persona t3 on t3.id = t2.persona_id ;

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
t2.rfc,
t2.direccion,
date_format(t2.creado_en, '%d/%m/%Y - %r') as creado_en,
(select date_format(fecha, '%d/%m/%Y - %r') from venta where cliente_id = t1.persona_id order by fecha desc limit 1) as ultima_compra
from cliente t1
inner join persona t2 on t1.persona_id = t2.id ;

-- Volcando estructura para vista mydb.view_compra
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_compra`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_compra` AS SELECT

t1.id,
t1.impuesto,
t1.neto,
t1.total,
fecha as fecha_sin_formato,
date_format(t1.fecha, '%d/%m/%Y - %r') as fecha
from compra t1 ;

-- Volcando estructura para vista mydb.view_detalle_compra
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_detalle_compra`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detalle_compra` AS select 
t1.*,
t2.codigo,
t2.nombre
from detalle_compra t1
inner join producto t2 on t2.id = t1.producto_id
inner join compra t3 on t3.id = t1.compra_id ;

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
b.nombre as categoria,
c.persona_id as proveedor_id,
d.nombre as proveedor
from producto a 
left join categoria b on a.categoria_id = b.id
left join proveedor c on c.persona_id = a.proveedor_id
left join persona d on d.id = c.persona_id ;

-- Volcando estructura para vista mydb.view_proveedor
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_proveedor`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_proveedor` AS SELECT 
t1.persona_id as proveedor_id,
t2.id,
t2.nombre,
t2.apellidos,
t2.correo,
date_format(t2.fecha_nacimiento, '%d/%m/%Y') as fecha_nacimiento,
t2.telefono,
t2.rfc,
t2.direccion,
date_format(t2.creado_en, '%d/%m/%Y') as creado_en
from proveedor t1
inner join persona t2 on t1.persona_id = t2.id ;

-- Volcando estructura para vista mydb.view_usuario
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_usuario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_usuario` AS SELECT 
a.persona_id,
a.email,
a.password,
a.estado,
a.ultimo_login,
a.perfil_id,
b.correo,
b.nombre,
b.apellidos,
c.nombre as perfil
from usuario a
inner join persona b on b.id = a.persona_id
inner join perfil c on c.id = a.perfil_id ;

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
coalesce(coalesce(t3.nombre, 'anÃ³nimo'), concat(coalesce(t3.nombre, ''), ' ', coalesce(t3.apellidos, ''))) as cliente,
t3.nombre,
t3.apellidos

from venta t1
left join persona t2 on t1.vendedor_id = t2.id
left join persona t3 on t1.cliente_id = t3.id ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
