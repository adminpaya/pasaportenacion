-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-08-2023 a las 19:00:24
-- Versión del servidor: 10.6.14-MariaDB-cll-lve
-- Versión de PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tamitutc_paya`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasaporte_token`
--

CREATE TABLE `pasaporte_token` (
  `id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  `telefono` varchar(100) NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pasaporte_token`
--

INSERT INTO `pasaporte_token` (`id`, `token`, `time`, `telefono`) VALUES
(1, 'e68e0362', '0000-00-00 00:00:00', ''),
(2, 'b3409385', '2023-08-27 13:30:55', ''),
(3, '4819375f', '0000-00-00 00:00:00', ''),
(4, '8c945c9f', '2023-08-27 08:35:18', ''),
(5, 'cfafc6f6', '2023-08-27 08:36:06', ''),
(6, 'a522a56e', '2023-08-27 08:37:22', '66183087'),
(7, 'cfa20af7', '2023-08-27 08:47:55', '66183087'),
(8, '1536c669', '2023-08-27 09:07:31', '66183087'),
(9, 'd832c715', '2023-08-27 09:10:17', '66183087'),
(10, 'd06127d0', '2023-08-27 09:13:16', '66183087'),
(11, '7c07171b', '2023-08-27 09:18:40', '66183087'),
(12, '956f4164', '2023-08-27 09:22:53', '66183087'),
(13, 'aa457ba8', '2023-08-27 10:03:03', '66183087'),
(14, 'efd7a557', '2023-08-29 15:36:22', '65933307');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pasaporte_token`
--
ALTER TABLE `pasaporte_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pasaporte_token`
--
ALTER TABLE `pasaporte_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
