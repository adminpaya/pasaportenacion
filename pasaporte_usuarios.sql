-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-08-2023 a las 19:00:40
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
-- Estructura de tabla para la tabla `pasaporte_usuarios`
--

CREATE TABLE `pasaporte_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT 0,
  `tipo` varchar(100) NOT NULL DEFAULT 'usuario',
  `estado` varchar(10) NOT NULL DEFAULT 'N',
  `perfil` varchar(200) NOT NULL DEFAULT 'N/A',
  `nombre_usuario` varchar(200) NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pasaporte_usuarios`
--

INSERT INTO `pasaporte_usuarios` (`id`, `nombre`, `contrasena`, `telefono`, `email`, `puntos`, `tipo`, `estado`, `perfil`, `nombre_usuario`) VALUES
(12, 'jean', 'j34np4zr0', '64693759', 'jeanfernand@gmail.com', 0, 'usuario', 'N', 'N/A', 'N/A'),
(13, 'Ivan julio ', '1234.', '61755691', 'ivanbernardojulio@gmail.com', 0, 'usuario', 'N', 'N/A', 'N/A'),
(15, 'master', 'master', '66880861', 'pasaporte@nacion.com', 0, 'admin', 'OK', 'N/A', 'N/A'),
(37, 'kevurbina', '1234', '986012171', 'kenvurbina@gmail.com', 0, 'usuario', 'FAIL', 'N/A', 'N/A'),
(39, 'Breadgyal', 'niqxeq-godruT-xywwi0', '62200033', 'aclausfinlayson@yahoo.com', 0, 'usuario', 'OK', 'N/A', 'N/A'),
(40, 'milton21', 'mercadeo', '66138786', 'milton@nacionsushi.com', 0, 'usuario', 'FAIL', 'N/A', 'N/A'),
(42, 'Jorge', '66759468', '66759468', 'jorgehcorre@gmail.com', 0, 'usuario', 'OK', 'N/A', 'N/A'),
(49, 'keff_g', '88888888', '67964090', 'kchen_zhang@hotmail.com', 0, 'usuario', 'OK', 'N/A', 'N/A'),
(60, 'Popovich', '789456748596', '23232932612168', 'email@popovich', 0, 'usuario', 'N', 'N/A', 'N/A'),
(69, 'Diego', '789456748596', '5492932612168', 'email@diegoschmidt.com', 0, 'usuario', 'N', 'N/A', 'N/A'),
(78, 'ALEJANDRO', '12493422', '62371181', 'alerou79@hotmail.com', 0, 'usuario', 'FAIL', 'N/A', 'N/A'),
(81, 'Tonypaya', 'paya2023', '64110615', 'tony@pidepaya.com', 0, 'usuario', 'OK', 'N/A', 'N/A'),
(82, 'joharamos', 'Jagger0387', '65933307', 'johannaramos50@gmail.com', 0, 'usuario', 'OK', 'N/A', 'N/A'),
(83, 'valeria bar', 'creativa', '60707839', 'valebarmaimon@gmail.com', 0, 'usuario', 'OK', 'N/A', 'N/A'),
(91, 'alonsoapplewhite', '12345', '66183087', 'alonsoapplewhite@yahoo.com', 0, 'usuario', 'OK', 'N/A', 'Alonso Applewhite'),
(92, 'luisf', 'fercas', '65505868', 'luisfernando26@gmail.com', 0, 'usuario', 'OK', 'N/A', 'Luis Fernando');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pasaporte_usuarios`
--
ALTER TABLE `pasaporte_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pasaporte_usuarios`
--
ALTER TABLE `pasaporte_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
