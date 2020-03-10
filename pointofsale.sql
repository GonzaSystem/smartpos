-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2019 a las 18:35:53
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pointofsale`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  `categoria` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `estado`, `categoria`, `fecha_creacion`) VALUES
(1, 0, 'Procesadores', '2018-11-19 02:49:54'),
(2, 0, 'Memorias RAM', '2018-11-19 02:50:39'),
(3, 0, 'Cable UTP', '2018-11-20 23:01:16'),
(4, 1, 'Test', '2019-02-26 17:19:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `estado`, `nombre`, `documento`, `direccion`, `telefono`, `fecha_nacimiento`, `email`, `compras`, `ultima_compra`, `fecha`) VALUES
(13, 1, 'Gonzalo Proveedor', '20389531376', 'Soler 870', '1167455471', '1996-03-08', 'gonzaloholzmeister@gmail.com', 95, '2019-02-26 18:04:09', '2019-02-26 17:27:14'),
(14, 0, 'Julieta Natalia Carbone', '11111111', 'Calle falsa 123456', '1122334455', '1991-09-13', 'j@gmail', 59, '2019-02-20 13:41:46', '2019-02-26 17:32:54'),
(15, 1, 'Pedro Recuero', '20345678', 'Colombia 1649', '1145766895', '1980-06-15', 'pedro@gmail.com', 35, '2019-02-19 21:04:32', '2019-02-19 20:04:32'),
(16, 0, 'Test Client', '2011223344558', 'Falsa 123', '1188994455', '1995-12-13', 'test@test', 97, '2019-02-17 04:54:08', '2019-02-17 22:21:52'),
(17, 1, 'Prueba', '123456789', 'Sevilla 261', '112233445566', '1996-03-08', 'g@gmail.com', 0, '0000-00-00 00:00:00', '2019-02-26 17:26:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito_venta`
--

CREATE TABLE `nota_credito_venta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `tipo_factura` text COLLATE utf8_spanish_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` text COLLATE utf8_spanish_ci NOT NULL,
  `concepto` text COLLATE utf8_spanish_ci NOT NULL,
  `cae` text COLLATE utf8_spanish_ci NOT NULL,
  `vencimiento_cae` date NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nota_credito_venta`
--

INSERT INTO `nota_credito_venta` (`id`, `codigo`, `tipo_factura`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `neto`, `total`, `concepto`, `cae`, `vencimiento_cae`, `fecha`) VALUES
(3, 34, 'A', 16, 60, '[{\"id\":\"18\",\"descripcion\":\"Adata 4GB DDR4\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"4500\",\"total\":\"4500\"}]', 945, 4500, '5445', 'Efectivo', '69066727587548', '2019-02-21', '2019-02-13 23:23:59'),
(5, 35, 'A', 16, 60, '[{\"id\":\"29\",\"descripcion\":\"Intel Celeron 1GHz\",\"cantidad\":\"1\",\"stock\":\"4\",\"precio\":\"217\",\"total\":\"217\"}]', 45.57, 217, '262.57', 'Efectivo', '69076727779620', '2019-02-22', '2019-02-13 23:24:03'),
(6, 36, 'A', 16, 60, '[{\"id\":\"20\",\"descripcion\":\"Adata Sodimm 8gb DDR3\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"4150\",\"total\":\"4150\"}]', 871.5, 4150, '5021.5', 'TC-12345678', '69076727782309', '2019-02-22', '2019-02-13 23:24:07'),
(7, 1, 'B', 16, 60, '[{\"id\":\"26\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"1\",\"stock\":\"4\",\"precio\":\"1400\",\"total\":\"1400\"}]', 294, 1400, '1694', 'Efectivo', '69076727914663', '2019-02-23', '2019-02-13 23:24:58'),
(8, 37, 'A', 16, 60, '[{\"id\":\"15\",\"descripcion\":\"Kingston 8GB DDR4\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"2600\",\"total\":\"2600\"},{\"id\":\"14\",\"descripcion\":\"Kingston 4GB DDR4\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"2100\",\"total\":\"2100\"},{\"id\":\"13\",\"descripcion\":\"Kingston 8GB DDR3\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"1800\",\"total\":\"1800\"},{\"id\":\"12\",\"descripcion\":\"Kingston 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"1500\",\"total\":\"1500\"},{\"id\":\"11\",\"descripcion\":\"AMD a10\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"4100\",\"total\":\"4100\"},{\"id\":\"10\",\"descripcion\":\"AMD a9\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"3000\",\"total\":\"3000\"},{\"id\":\"9\",\"descripcion\":\"AMD a8\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"2450\",\"total\":\"2450\"},{\"id\":\"8\",\"descripcion\":\"AMD a7\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"2015\",\"total\":\"2015\"},{\"id\":\"7\",\"descripcion\":\"AMD a6\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"1800\",\"total\":\"1800\"},{\"id\":\"6\",\"descripcion\":\"Intel i7\",\"cantidad\":\"1\",\"stock\":\"10\",\"precio\":\"5600\",\"total\":\"5600\"}]', 5662.65, 26965, '32627.7', 'Efectivo', '69076728191520', '2019-02-25', '2019-02-16 01:24:13'),
(9, 38, 'A', 16, 60, '[{\"id\":\"29\",\"descripcion\":\"Intel Celeron 1GHz\",\"cantidad\":\"1\",\"stock\":\"3\",\"precio\":\"217\",\"total\":\"217\"},{\"id\":\"12\",\"descripcion\":\"Kingston 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"1500\",\"total\":\"1500\"}]', 360.57, 1717, '2077.57', 'Efectivo', '69076728192885', '2019-02-25', '2019-02-16 01:46:12'),
(10, 39, 'A', 16, 60, '[{\"id\":\"\",\"descripcion\":\"Adata 4GB DDR4\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"4500\",\"total\":\"4500\"}]', 945, 4500, '5445', 'Anulación FV 00000035', '69076728272637', '2019-02-26', '2019-02-17 04:14:51'),
(11, 41, 'A', 14, 60, '[{\"id\":\"30\",\"descripcion\":\"AMD Ryzen\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"140\",\"total\":\"140\"},{\"id\":\"29\",\"descripcion\":\"Intel Celeron 1GHz\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"217\",\"total\":\"217\"},{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"1\",\"stock\":\"4\",\"precio\":\"5000\",\"total\":\"5000\"},{\"id\":\"20\",\"descripcion\":\"Adata Sodimm 8gb DDR3\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"4150\",\"total\":\"4150\"},{\"id\":\"19\",\"descripcion\":\"Adata 8GB DDR4\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"4000\",\"total\":\"4000\"},{\"id\":\"18\",\"descripcion\":\"Adata 4GB DDR4\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"4500\",\"total\":\"4500\"},{\"id\":\"17\",\"descripcion\":\"Adata 8GB DDR3\",\"cantidad\":\"4\",\"stock\":\"10\",\"precio\":\"3400\",\"total\":\"13600\"},{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"6\",\"precio\":\"3000\",\"total\":\"3000\"}]', 7267.47, 34607, '41874.5', '123', '69086728727460', '2019-03-02', '2019-02-20 12:29:49'),
(12, 42, 'A', 14, 60, '[{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"1\",\"stock\":\"3\",\"precio\":\"5000\",\"total\":\"5000\"},{\"id\":\"30\",\"descripcion\":\"AMD Ryzen\",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"140\",\"total\":\"280\"}]', 1108.8, 5280, '6388.8', '123', '69086728732078', '2019-03-02', '2019-02-20 12:41:48'),
(13, 43, 'A', 13, 60, '[{\"id\":\"30\",\"descripcion\":\"AMD Ryzen\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"140\",\"total\":\"140\"},{\"id\":\"29\",\"descripcion\":\"Intel Celeron 1GHz\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"217\",\"total\":\"217\"},{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"1\",\"stock\":\"2\",\"precio\":\"5000\",\"total\":\"5000\"},{\"id\":\"20\",\"descripcion\":\"Adata Sodimm 8gb DDR3\",\"cantidad\":\"1\",\"stock\":\"6\",\"precio\":\"4150\",\"total\":\"4150\"},{\"id\":\"19\",\"descripcion\":\"Adata 8GB DDR4\",\"cantidad\":\"1\",\"stock\":\"6\",\"precio\":\"4000\",\"total\":\"4000\"},{\"id\":\"18\",\"descripcion\":\"Adata 4GB DDR4\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"4500\",\"total\":\"4500\"},{\"id\":\"17\",\"descripcion\":\"Adata 8GB DDR3\",\"cantidad\":\"4\",\"stock\":\"0\",\"precio\":\"3400\",\"total\":\"13600\"},{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"5\",\"precio\":\"3000\",\"total\":\"3000\"}]', 7267.47, 34607, '41874.47', 'test', '69086728732492', '2019-03-02', '2019-02-20 12:44:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_debito_venta`
--

CREATE TABLE `nota_debito_venta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `tipo_factura` text COLLATE utf8_spanish_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `cae` text COLLATE utf8_spanish_ci NOT NULL,
  `vencimiento_cae` date NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nota_debito_venta`
--

INSERT INTO `nota_debito_venta` (`id`, `codigo`, `tipo_factura`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `cae`, `vencimiento_cae`, `fecha`) VALUES
(1, 1, 'A', 16, 60, '[{\"id\":\"18\",\"descripcion\":\"Adata 4GB DDR4\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"4500\",\"total\":\"4500\"},{\"id\":\"19\",\"descripcion\":\"Adata 8GB DDR4\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"4000\",\"total\":\"4000\"}]', 1785, 8500, 10285, 'Efectivo', '69076727916709', '2019-02-23', '2019-02-13 23:53:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `estado`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(1, 1, 0, '101', 'Intel Celeron ', 'vistas/img/productos/101/680.png', 1, 1200, 1680, 0, '2019-02-26 17:25:48'),
(3, 1, 1, '103', 'Intel Pentium', '', 3, 1500, 2000, 3, '2019-02-26 17:25:18'),
(4, 1, 1, '104', 'Intel i3', '', 3, 1800, 3000, 13, '2019-02-26 17:25:18'),
(5, 1, 1, '105', 'Intel i5', 'vistas/img/productos/105/866.png', 0, 2500, 4250, 15, '2019-02-26 17:25:18'),
(6, 1, 1, '106', 'Intel i7', '', 10, 3000, 5600, 5, '2019-02-26 17:25:18'),
(7, 1, 1, '107', 'AMD a6', '', 8, 1300, 1800, 8, '2019-02-26 17:25:18'),
(8, 1, 1, '108', 'AMD a7', '', 8, 1450, 2015, 8, '2019-02-26 17:25:18'),
(9, 1, 1, '109', 'AMD a8', '', 9, 1800, 2450, 7, '2019-02-26 17:25:18'),
(10, 1, 1, '110', 'AMD a9', '', 9, 2050, 3000, 6, '2019-02-26 17:25:18'),
(11, 1, 1, '111', 'AMD a10', '', 8, 3400, 4100, 7, '2019-02-26 17:25:18'),
(12, 2, 1, '201', 'Kingston 4GB DDR3', '', 18, 1000, 1500, 2, '2019-02-26 17:25:18'),
(13, 2, 1, '202', 'Kingston 8GB DDR3', '', 17, 1300, 1800, 3, '2019-02-26 17:25:18'),
(14, 2, 1, '203', 'Kingston 4GB DDR4', '', 14, 1600, 2100, 6, '2019-02-26 17:25:18'),
(15, 2, 1, '204', 'Kingston 8GB DDR4', '', 12, 1900, 2600, 8, '2019-02-26 17:25:18'),
(16, 2, 1, '205', 'Adata 4GB DDR3', 'vistas/img/productos/205/698.png', 5, 1250, 3000, 16, '2019-02-26 17:25:18'),
(17, 2, 1, '206', 'Adata 8GB DDR3', 'vistas/img/productos/206/497.png', 0, 1700, 3400, 24, '2019-02-26 17:18:01'),
(18, 2, 1, '207', 'Adata 4GB DDR4', 'vistas/img/productos/207/311.png', 7, 3000, 4500, 20, '2019-02-26 17:25:18'),
(19, 2, 1, '208', 'Adata 8GB DDR4', 'vistas/img/productos/208/833.png', 6, 3600, 4000, 41, '2019-02-26 17:25:18'),
(20, 2, 1, '209', 'Adata Sodimm 8gb DDR3', 'vistas/img/productos/209/421.png', 6, 3500, 4150, 18, '2019-02-26 17:25:18'),
(21, 2, 1, '210', 'Adata Sodimm 8gb DDR4', 'vistas/img/productos/210/849.png', 2, 4000, 5000, 26, '2019-02-26 17:25:18'),
(26, 3, 1, '301', 'Caja de cable UTP Categoria 6', 'vistas/img/productos/default.png', 15, 1000, 1400, 16, '2019-02-26 17:25:18'),
(27, 3, 1, '302', 'Caja de cable UTP Categoria 6', 'vistas/img/productos/default.png', 16, 99.9, 139.86, 10, '2019-02-26 17:25:18'),
(29, 1, 1, '112', 'Intel Celeron 1GHz', 'vistas/img/productos/112/275.png', 18, 155, 217, 9, '2019-02-26 17:25:18'),
(30, 1, 1, '113', 'AMD Ryzen', 'vistas/img/productos/113/526.png', 17, 100, 140, 14, '2019-02-26 17:25:18'),
(31, 3, 1, '303', 'Bobina UTP Test', 'vistas/img/productos/default.png', 5, 100, 140, 0, '2019-02-26 17:35:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `estado2` int(1) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `estado2`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 1, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/191.jpg', 0, '2018-11-17 09:33:25', '2019-02-26 17:14:14'),
(62, 1, 'Vendedor', 'Vendedor', '$2a$07$asxx54ahjppf45sd87a5auF3SxTPxKrykQWP2opioJ/PI/QjcniEW', 'Vendedor', '', 0, '2019-02-07 20:18:01', '2019-02-26 16:19:21'),
(63, 0, 'Demo User', 'demo', '$2a$07$asxx54ahjppf45sd87a5au6eB6pERIOFn89hUR262rtQP3G4atVku', 'Demo', 'vistas/img/usuarios/Demo/136.png', 1, '2019-02-26 14:22:29', '2019-02-26 17:22:29'),
(64, 1, 'Prueba', 'prueba', '$2a$07$asxx54ahjppf45sd87a5auBxWKi32TyN7LTmhz0ONBYdcwSQJ0lWO', 'Vendedor', '', 0, '0000-00-00 00:00:00', '2019-02-17 22:47:33'),
(65, 0, 'Lucas Mailland', 'lmailland', '$2a$07$asxx54ahjppf45sd87a5augg8KidUap.HGs9jqLqZ5LZQPdubmE3S', 'Administrador', '', 1, '2019-02-26 14:26:29', '2019-02-26 17:26:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `tipo_factura` text COLLATE utf8_spanish_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `cae` text COLLATE utf8_spanish_ci NOT NULL,
  `vencimiento_cae` date NOT NULL,
  `barcode` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `tipo_factura`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `cae`, `vencimiento_cae`, `barcode`, `fecha`) VALUES
(15, 14, 'B', 14, 60, '[{\"id\":\"7\",\"descripcion\":\"AMD a6\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"1800\",\"total\":\"1800\"},{\"id\":\"8\",\"descripcion\":\"AMD a7\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"2015\",\"total\":\"2015\"},{\"id\":\"9\",\"descripcion\":\"AMD a8\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"2450\",\"total\":\"2450\"}]', 1315.65, 6265, 7580.65, 'Efectivo', '69046723386234', '2019-02-03', '', '2019-02-16 00:52:51'),
(16, 15, 'B', 13, 60, '[{\"id\":\"18\",\"descripcion\":\"Adata 4GB DDR4\",\"cantidad\":\"3\",\"stock\":\"17\",\"precio\":\"4500\",\"total\":\"13500\"},{\"id\":\"17\",\"descripcion\":\"Adata 8GB DDR3\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"3400\",\"total\":\"3400\"},{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"3000\",\"total\":\"3000\"}]', 4179, 19900, 24079, 'TC-1143245435', '69046723386292', '2019-02-03', '', '2019-02-16 00:52:54'),
(17, 16, 'B', 15, 60, '[{\"id\":\"6\",\"descripcion\":\"Intel i7\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"7\",\"descripcion\":\"AMD a6\",\"cantidad\":\"1\",\"stock\":\"10\",\"precio\":\"1800\",\"total\":\"1800\"}]', 777, 7400, 8177, 'TD-123123123123', '69046723445916', '2019-02-03', '', '2019-02-16 00:52:56'),
(18, 17, 'B', 16, 60, '[{\"id\":\"26\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"1400\",\"total\":\"1400\"},{\"id\":\"27\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"2\",\"stock\":\"3\",\"precio\":\"139.86\",\"total\":\"279.72\"}]', 176.371, 1679.72, 1856.09, 'Efectivo', '69046723449198', '2019-02-03', '', '2019-02-16 00:52:59'),
(19, 18, 'B', 16, 60, '[{\"id\":\"4\",\"descripcion\":\"Intel i3\",\"cantidad\":\"4\",\"stock\":\"3\",\"precio\":\"3000\",\"total\":\"12000\"}]', 2520, 12000, 14520, 'Efectivo', '69046723449716', '2019-02-03', '', '2019-02-16 00:53:02'),
(20, 19, 'B', 16, 60, '[{\"id\":\"15\",\"descripcion\":\"Kingston 8GB DDR4\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2600\",\"total\":\"2600\"}]', 546, 2600, 3146, 'Efectivo', '69046723454913', '2019-02-03', '', '2019-02-16 05:23:01'),
(21, 20, 'B', 13, 60, '[{\"id\":\"10\",\"descripcion\":\"AMD a9\",\"cantidad\":\"2\",\"stock\":\"11\",\"precio\":\"3000\",\"total\":\"6000\"}]', 600, 6000, 6600, 'Efectivo', '69046723455121', '2019-02-03', '', '2019-02-16 05:23:04'),
(22, 21, 'B', 14, 60, '[{\"id\":\"3\",\"descripcion\":\"Intel Pentium\",\"cantidad\":\"1\",\"stock\":\"3\",\"precio\":\"2000\",\"total\":\"2000\"}]', 420, 2000, 2420, 'Efectivo', '69046723460611', '2019-02-03', '', '2019-02-16 05:23:06'),
(23, 22, 'B', 16, 60, '[{\"id\":\"6\",\"descripcion\":\"Intel i7\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"7\",\"descripcion\":\"AMD a6\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"1800\",\"total\":\"1800\"},{\"id\":\"8\",\"descripcion\":\"AMD a7\",\"cantidad\":\"1\",\"stock\":\"10\",\"precio\":\"2015\",\"total\":\"2015\"},{\"id\":\"9\",\"descripcion\":\"AMD a8\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"2450\",\"total\":\"2450\"},{\"id\":\"10\",\"descripcion\":\"AMD a9\",\"cantidad\":\"1\",\"stock\":\"10\",\"precio\":\"3000\",\"total\":\"3000\"},{\"id\":\"11\",\"descripcion\":\"AMD a10\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"4100\",\"total\":\"4100\"}]', 3982.65, 18965, 22947.7, 'Efectivo', '69046724018471', '2019-02-05', '', '2019-02-16 05:23:08'),
(24, 23, 'B', 16, 60, '[{\"id\":\"8\",\"descripcion\":\"AMD a7\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"2015\",\"total\":\"2015\"},{\"id\":\"9\",\"descripcion\":\"AMD a8\",\"cantidad\":\"1\",\"stock\":\"10\",\"precio\":\"2450\",\"total\":\"2450\"}]', 446.5, 4465, 4911.5, 'Efectivo', '69056725740187', '2019-02-13', '', '2019-02-16 05:23:10'),
(25, 24, 'B', 15, 60, '[{\"id\":\"19\",\"descripcion\":\"Adata 8GB DDR4\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"4000\",\"total\":\"4000\"},{\"id\":\"20\",\"descripcion\":\"Adata Sodimm 8gb DDR3\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"4150\",\"total\":\"4150\"},{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"5000\",\"total\":\"10000\"}]', 3811.5, 18150, 21961.5, 'TD-444555666', '69056725740205', '2019-02-13', '', '2019-02-16 05:23:12'),
(26, 25, 'B', 13, 60, '[{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"5000\",\"total\":\"5000\"},{\"id\":\"20\",\"descripcion\":\"Adata Sodimm 8gb DDR3\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"4150\",\"total\":\"4150\"}]', 1921.5, 9150, 11071.5, 'TD-456465465', '69056725895401', '2019-02-14', '', '2019-02-16 05:23:15'),
(27, 26, 'B', 15, 60, '[{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"5000\",\"total\":\"5000\"}]', 1050, 5000, 6050, 'Efectivo', '69066726441636', '2019-02-15', '', '2019-02-16 05:23:17'),
(28, 27, 'B', 16, 60, '[{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"3000\",\"total\":\"3000\"}]', 630, 3000, 3630, 'Efectivo', '69066726444215', '2019-02-15', '', '2019-02-16 05:23:22'),
(29, 28, 'B', 15, 61, '[{\"id\":\"30\",\"descripcion\":\"AMD Ryzen\",\"cantidad\":\"1\",\"stock\":\"4\",\"precio\":\"140\",\"total\":\"140\"},{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"3000\",\"total\":\"3000\"},{\"id\":\"13\",\"descripcion\":\"Kingston 8GB DDR3\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"1800\",\"total\":\"1800\"},{\"id\":\"14\",\"descripcion\":\"Kingston 4GB DDR4\",\"cantidad\":\"5\",\"stock\":\"15\",\"precio\":\"2100\",\"total\":\"10500\"}]', 3242.4, 15440, 18682.4, 'TC-012364564987', '69066726530192', '2019-02-15', '', '2019-02-16 05:23:24'),
(32, 29, 'B', 15, 60, '[{\"id\":\"13\",\"descripcion\":\"Kingston 8GB DDR3\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"1800\",\"total\":\"1800\"},{\"id\":\"15\",\"descripcion\":\"Kingston 8GB DDR4\",\"cantidad\":\"6\",\"stock\":\"13\",\"precio\":\"2600\",\"total\":\"15600\"}]', 3480, 17400, 20880, 'TC-11231654', '69066726741917', '2019-02-16', '', '2019-02-16 05:23:56'),
(33, 31, 'B', 13, 60, '[{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"5000\",\"total\":\"5000\"}]', 1333.5, 6350, 7673.5, 'TC-45646546', '69066727309097', '2019-02-19', '', '2019-02-17 03:00:38'),
(34, 32, 'B', 16, 60, '[{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"5000\",\"total\":\"5000\"}]', 1333.5, 6350, 7683.5, 'Efectivo', '69066727309762', '2019-02-19', '', '2019-02-16 05:24:01'),
(35, 33, 'B', 14, 60, '[{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"3000\",\"total\":\"3000\"}]', 315, 3000, 3315, 'TC-132456465', '69066727310481', '2019-02-19', '', '2019-02-16 05:24:03'),
(36, 34, 'B', 13, 60, '[{\"id\":\"26\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"1400\",\"total\":\"1400\"}]', 294, 1400, 1694, 'Efectivo', '69066727330945', '2019-02-19', '', '2019-02-16 05:24:05'),
(37, 35, 'B', 16, 60, '[{\"id\":\"26\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"1400\",\"total\":\"1400\"}]', 294, 1400, 1694, 'Efectivo', '69066727331344', '2019-02-19', '', '2019-02-16 00:53:06'),
(38, 36, 'B', 13, 60, '[{\"id\":\"26\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"1\",\"stock\":\"6\",\"precio\":\"1400\",\"total\":\"1400\"}]', 294, 1400, 1694, 'Efectivo', '69066727331446', '2019-02-19', '', '2019-02-16 05:24:07'),
(39, 37, 'B', 16, 60, '[{\"id\":\"17\",\"descripcion\":\"Adata 8GB DDR3\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"3400\",\"total\":\"3400\"}]', 714, 3400, 4114, 'Efectivo', '69066727331548', '2019-02-19', '', '2019-02-16 05:24:12'),
(40, 38, 'B', 16, 60, '[{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"3000\",\"total\":\"3000\"}]', 630, 3000, 3630, 'TC-456789', '69066727331962', '2019-02-19', '', '2019-02-16 05:24:15'),
(41, 1, 'A', 14, 60, '[{\"id\":\"19\",\"descripcion\":\"Adata 8GB DDR4\",\"cantidad\":\"2\",\"stock\":\"14\",\"precio\":\"4000\",\"total\":\"8000\"}]', 1680, 8000, 9680, 'Efectivo', '69066727339313', '2019-02-19', '', '2019-02-16 05:24:23'),
(42, 39, 'B', 13, 60, '[{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"3000\",\"total\":\"3000\"}]', 630, 3000, 3630, 'Efectivo', '69066727369757', '2019-02-20', '', '2019-02-16 05:24:31'),
(43, 2, 'A', 13, 60, '[{\"id\":\"19\",\"descripcion\":\"Adata 8GB DDR4\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"4000\",\"total\":\"4000\"}]', 840, 4000, 4840, 'Efectivo', '69066727369977', '2019-02-20', '', '2019-02-16 05:24:34'),
(44, 40, 'B', 13, 60, '[{\"id\":\"19\",\"descripcion\":\"Adata 8GB DDR4\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"4000\",\"total\":\"4000\"}]', 840, 4000, 4840, 'Efectivo', '69066727372512', '2019-02-20', '', '2019-02-10 04:28:27'),
(45, 3, 'A', 13, 60, '[{\"id\":\"16\",\"descripcion\":\"Adata 4GB DDR3\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"3000\",\"total\":\"3000\"}]', 630, 3000, 3630, 'Efectivo', '69066727404573', '2019-02-20', '', '2019-02-10 13:08:24'),
(46, 4, 'A', 16, 60, '[{\"id\":\"30\",\"descripcion\":\"AMD Ryzen\",\"cantidad\":\"1\",\"stock\":\"3\",\"precio\":\"140\",\"total\":\"140\"}]', 29.4, 140, 169.4, 'Efectivo', '69076728242086', '2019-02-26', '', '2019-02-16 12:12:25'),
(47, 1, 'C', 16, 60, '[{\"id\":\"26\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"1\",\"stock\":\"3\",\"precio\":\"1400\",\"total\":\"1400\"}]', 0, 1400, 1400, 'Efectivo', '69076728243545', '2019-02-26', '', '2019-02-16 12:33:58'),
(49, 115, '', 15, 60, '123', 21, 100, 121, 'Efectivo', '112233445566', '2019-02-27', '', '2018-11-30 03:00:00'),
(51, 3, 'C', 16, 60, '[{\"id\":\"26\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"1\",\"stock\":\"2\",\"precio\":\"1400\",\"total\":\"1400\"}]', 0, 1400, 1400, 'Efectivo', '69076728304716', '2019-02-27', '', '2019-02-17 03:47:30'),
(52, 5, 'C', 16, 63, '[{\"id\":\"26\",\"descripcion\":\"Caja de cable UTP Categoria 6\",\"cantidad\":\"1\",\"stock\":\"1\",\"precio\":\"1400\",\"total\":\"1400\"}]', 0, 1400, 1400, 'Efectivo', '69076728305131', '2019-02-27', '', '2019-02-17 03:54:09'),
(53, 41, '1', 13, 60, '[{\"id\":\"21\",\"descripcion\":\"Adata Sodimm 8gb DDR4\",\"cantidad\":\"1\",\"stock\":\"6\",\"precio\":\"5000\",\"total\":\"5000\"}]', 1050, 5000, 6050, 'Efectivo', '69086728649869', '2019-03-01', '', '2019-02-19 19:52:40'),
(54, 10, 'A', 13, 60, '[{\"id\":\"30\",\"descripcion\":\"AMD Ryzen\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"140\",\"total\":\"140\"}]', 29.4, 140, 169.4, 'Efectivo', '', '0000-00-00', '', '2019-02-26 16:59:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_credito_venta`
--
ALTER TABLE `nota_credito_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_debito_venta`
--
ALTER TABLE `nota_debito_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `nota_credito_venta`
--
ALTER TABLE `nota_credito_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `nota_debito_venta`
--
ALTER TABLE `nota_debito_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
