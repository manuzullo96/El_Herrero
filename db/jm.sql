-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2021 a las 16:08:58
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `clavecarrito` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`clavecarrito`, `idpedido`, `idproducto`, `cantidad`, `precio`, `subtotal`) VALUES
(1, 1, 34, 1, 323232, 323232),
(2, 1, 30, 10, 500, 5000),
(3, 2, 37, 1, 323232, 323232),
(4, 3, 2, 1, 850, 850),
(5, 4, 39, 1, 3000.9, 3000.9),
(6, 4, 34, 1, 500, 500),
(7, 5, 32, 1, 789, 789),
(8, 6, 39, 21, 3000.9, 63018.9),
(9, 7, 32, 1, 789, 789),
(10, 8, 32, 2, 789, 1578),
(11, 8, 2, 1, 850, 850),
(12, 9, 11, 1, 3000.9, 3000.9),
(13, 9, 14, 1, 1500, 1500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`) VALUES
(1, 'HERRAMIENTAS'),
(2, 'ELECTRICIDAD'),
(3, 'REPUESTOS'),
(4, 'MAQUINARIA PESADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fechayhora` timestamp NOT NULL DEFAULT current_timestamp(),
  `monto` float NOT NULL,
  `cumplido` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `idusuario`, `fechayhora`, `monto`, `cumplido`) VALUES
(1, 2, '2021-03-03 20:03:42', 328232, 1),
(2, 2, '2021-03-03 20:08:24', 323232, 1),
(3, 2, '2021-03-03 22:45:39', 850, 1),
(4, 2, '2021-07-15 19:24:30', 3500.9, 0),
(5, 2, '2021-07-19 20:36:51', 789, NULL),
(6, 2, '2021-07-21 21:37:39', 63018.9, NULL),
(7, 2, '2021-08-01 19:13:26', 789, NULL),
(8, 2, '2021-08-01 23:39:02', 2428, NULL),
(9, 2, '2021-08-05 18:48:20', 4500.9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `detalle` varchar(500) NOT NULL,
  `precio` double NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `es_oferta` tinyint(4) DEFAULT NULL,
  `es_visible` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `detalle`, `precio`, `idcategoria`, `foto`, `es_oferta`, `es_visible`) VALUES
(1, 'Taladro Einhell 2000', 'electrica', 800, 1, 'taladroeinhell.jpg', 0, 1),
(2, 'Taladro Stanley', 'Electrica', 850, 2, 'taladro_stanley.jpg', 1, 1),
(3, 'Serrucho  Redline', 'Excelente calidad', 800, 1, 'serrucho.jpg', 0, 1),
(4, 'Clavos temper', 'Set de 4 Clavos temper', 789, 3, 'clavos.jpg', 1, 1),
(5, 'Cinta Negra', 'Nueva Cinta Negra', 25, 1, 'cinta.jpg', 0, 1),
(7, 'Casco ', 'Casco ', 500, 1, 'casco.jpg', 0, 1),
(8, 'Cinta Metrica', 'Cinta Metrica ', 800, 1, 'cinta_metrica.jpg', 0, 1),
(9, 'Set de Tornillos ', 'Set tornillos Stanley', 30, 3, 'tornillos.jpg', 0, 1),
(10, 'Cables', 'Cables ', 200, 2, 'cable.jpg', NULL, 1),
(11, 'Amoladora ', 'Amoladora ', 3000.9, 1, 'amoladora.jpg', 1, 1),
(12, 'Destornillador', 'Destornillador azul y transparente', 150, 1, 'destornillador.jpg', 1, 1),
(13, 'Martillo ', 'Cabeza forjada en acero especial y templada garantizando gran resistencia al producto.', 800, 1, 'martillo.jpg', 0, 1),
(14, 'Picoloro Knipex', 'Adecuado para el agarre frecuente de diferentes tamaños de piezas de trabajo, diseño delgado en el área de la cabeza y las articulaciones.\r\n', 1500, 1, 'picoloro.jpg', 0, 1),
(15, 'Pinza Universal', 'Pinza universal profesional', 345, 1, 'pinsa.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `es_admin` tinyint(1) DEFAULT NULL,
  `domicilio` varchar(200) NULL,
  `telefono` varchar(50) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `fullname`, `email`, `password`, `es_admin`, `domicilio`, `telefono`) VALUES
(1, 'Profesor', 'PROFESOR@YAHOO.COM', '$2y$10$8lY7XEcVsL1WWZ/JnorPxOmf8Fl8JLbEL9KW/mdrAR58heYaeBW96', 1, '', ''),
(2, 'Juan Manuel Zullo', 'JMZ@YAHOO.COM', '$2y$10$2mnYyNj/2gW5jM0JRhbNXOJ3m0qcY6cuyi6i3t65q8LWs0wu5g8tq', NULL, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`clavecarrito`),
  ADD KEY `idpedido` (`idpedido`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CATEGORIAITEMS` (`idcategoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `clavecarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
