-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2025 a las 17:45:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conjunto_residencial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `apellido`, `email`, `clave`, `telefono`) VALUES
(1, 'Daniel', 'Vargas', 'dv@gmail.com', '202cb962ac59075b964b07152d234b70', '3124559757');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento`
--

CREATE TABLE `apartamento` (
  `id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `torre` int(11) DEFAULT NULL,
  `metrosCuadrados` int(11) DEFAULT NULL,
  `idPropietario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apartamento`
--

INSERT INTO `apartamento` (`id`, `numero`, `torre`, `metrosCuadrados`, `idPropietario`) VALUES
(1, 101, 1, 60, 1),
(2, 102, 1, 70, 1),
(3, 201, 2, 65, 2),
(4, 301, 3, 55, 3),
(5, 401, 4, 68, 4),
(6, 501, 5, 75, 5),
(7, 601, 6, 80, 6),
(8, 701, 7, 66, 7),
(9, 801, 8, 72, 8),
(10, 802, 8, 78, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentacobro`
--

CREATE TABLE `cuentacobro` (
  `id` int(11) NOT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `año` varchar(4) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `idApartamento` int(11) DEFAULT NULL,
  `idAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentacobro`
--

INSERT INTO `cuentacobro` (`id`, `mes`, `año`, `estado`, `monto`, `idApartamento`, `idAdmin`) VALUES
(1, '03', '2025', 'pago', 60000, 1, 1),
(2, '04', '2025', 'no pago', 60000, 1, 1),
(3, '03', '2025', 'pago', 60000, 2, 1),
(4, '04', '2025', 'no pago', 60000, 2, 1),
(5, '03', '2025', 'pago', 60000, 3, 1),
(6, '04', '2025', 'pago', 60000, 3, 1),
(7, '03', '2025', 'pago', 60000, 4, 1),
(8, '04', '2025', 'pago', 60000, 4, 1),
(9, '03', '2025', 'pago', 60000, 5, 1),
(10, '04', '2025', 'no pago', 60000, 5, 1),
(11, '03', '2025', 'pago', 60000, 6, 1),
(12, '04', '2025', 'pago', 60000, 6, 1),
(13, '03', '2025', 'pago', 60000, 7, 1),
(14, '04', '2025', 'no pago', 60000, 7, 1),
(15, '03', '2025', 'pago', 60000, 8, 1),
(16, '04', '2025', 'pago', 60000, 8, 1),
(17, '03', '2025', 'pago', 60000, 9, 1),
(18, '04', '2025', 'pago', 60000, 9, 1),
(19, '03', '2025', 'no pago', 60000, 10, 1),
(20, '04', '2025', 'no pago', 60000, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` int(11) NOT NULL,
  `fechaPago` date DEFAULT NULL,
  `medioPago` varchar(50) DEFAULT NULL,
  `idCuentaCobro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id`, `fechaPago`, `medioPago`, `idCuentaCobro`) VALUES
(21, '2025-04-01', 'nequi', 1),
(22, '2025-04-02', 'transferencia', 3),
(23, '2025-04-03', 'daviplata', 5),
(24, '2025-05-01', 'efectivo', 6),
(25, '2025-04-04', 'nequi', 7),
(26, '2025-05-02', 'transferencia', 8),
(27, '2025-04-05', 'daviplata', 9),
(28, '2025-04-06', 'efectivo', 11),
(29, '2025-05-03', 'nequi', 12),
(30, '2025-04-07', 'transferencia', 13),
(31, '2025-04-08', 'daviplata', 15),
(32, '2025-05-04', 'efectivo', 16),
(33, '2025-04-09', 'nequi', 17),
(34, '2025-05-05', 'transferencia', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
--

CREATE TABLE `propietario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`id`, `nombre`, `apellido`, `email`, `clave`, `telefono`) VALUES
(1, 'eugenio ', 'diaz', 'ed@gmail.com', '202cb962ac59075b964b07152d234b70', '3204588781'),
(2, 'Carlos ', 'Ramirez', 'cr@gmail.com', '202cb962ac59075b964b07152d234b70', '3124569871'),
(3, 'Sara', 'Herrera', 'se@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', '3214569887'),
(4, 'Pepe', 'Zaragosa', 'pz@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', '3204569821'),
(5, 'danilo', 'herrera', 'dh@gmail.com', '202cb962ac59075b964b07152d234b70', '3202225887'),
(6, 'sandra', 'tapia', 'st@gmail.com', '202cb962ac59075b964b07152d234b70', '3255266996'),
(7, 'sebastian', 'topa', 'stp@gmail.com', '202cb962ac59075b964b07152d234b70', '3256589887'),
(8, 'valentina', 'castañeda', 'vc@gmail.com', '202cb962ac59075b964b07152d234b70', '3211445441'),
(9, 'karla', 'toro', 'kt', '202cb962ac59075b964b07152d234b70', '3202544178'),
(10, 'cristian', 'arias', 'ca@gmai.com', '202cb962ac59075b964b07152d234b70', '3211544521');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPropietario` (`idPropietario`);

--
-- Indices de la tabla `cuentacobro`
--
ALTER TABLE `cuentacobro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idApartamento` (`idApartamento`),
  ADD KEY `idAdmin` (`idAdmin`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCuentaCobro` (`idCuentaCobro`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cuentacobro`
--
ALTER TABLE `cuentacobro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD CONSTRAINT `apartamento_ibfk_1` FOREIGN KEY (`idPropietario`) REFERENCES `propietario` (`id`);

--
-- Filtros para la tabla `cuentacobro`
--
ALTER TABLE `cuentacobro`
  ADD CONSTRAINT `cuentacobro_ibfk_1` FOREIGN KEY (`idApartamento`) REFERENCES `apartamento` (`id`),
  ADD CONSTRAINT `cuentacobro_ibfk_2` FOREIGN KEY (`idAdmin`) REFERENCES `administrador` (`id`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`idCuentaCobro`) REFERENCES `cuentacobro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
