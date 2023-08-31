-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-08-2023 a las 18:59:58
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
-- Estructura de tabla para la tabla `pasaporte_facturas`
--

CREATE TABLE `pasaporte_facturas` (
  `id` int(11) NOT NULL,
  `usuario_id` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` varchar(100) NOT NULL,
  `numero` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pasaporte_facturas`
--

INSERT INTO `pasaporte_facturas` (`id`, `usuario_id`, `fecha`, `total`, `numero`, `foto`) VALUES
(190, '79', '2023-04-16 12:00:00', '69.29', 'TFHKC50001811-00105572', 'images/heic_1693146682.jpg'),
(191, '88', '2023-08-29 12:00:00', '89.72', 'TFHKC50001811-00135914', 'https://bot.pidepaya.com/facturas/50766183087c34f9d57-8ace-420a-9b6b-d1c2ca4d6477.webp');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pasaporte_facturas`
--
ALTER TABLE `pasaporte_facturas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pasaporte_facturas`
--
ALTER TABLE `pasaporte_facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
