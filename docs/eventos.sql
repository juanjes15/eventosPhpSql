-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-06-2023 a las 15:27:36
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eventos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `asa_id` int(11) NOT NULL,
  `eve_id` int(11) NOT NULL,
  `ase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`asa_id`, `eve_id`, `ase_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 5),
(4, 2, 1),
(5, 2, 3),
(6, 3, 2),
(7, 3, 4),
(8, 3, 5),
(9, 4, 1),
(10, 4, 6),
(11, 5, 5),
(12, 5, 6),
(13, 6, 1),
(14, 6, 2),
(15, 6, 6),
(16, 6, 7),
(17, 6, 9),
(18, 7, 10),
(19, 8, 7),
(20, 8, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistente`
--

CREATE TABLE `asistente` (
  `ase_id` int(11) NOT NULL,
  `ase_nombre` varchar(100) NOT NULL,
  `ase_apellido` varchar(100) NOT NULL,
  `ase_correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistente`
--

INSERT INTO `asistente` (`ase_id`, `ase_nombre`, `ase_apellido`, `ase_correo`) VALUES
(1, 'Eustabio', 'Gutierrez', 'esugu@correo.com'),
(2, 'Ulises', 'Wilfredo', 'uwu@correo.com'),
(3, 'Orlando', 'Chavez', 'oniichan@correo.com'),
(4, 'Pepito', 'Perez', 'pepe@correo.com'),
(5, 'Fulanito', 'Fonseca', 'fufu@correo.com'),
(6, 'Thomas', 'Giraldo', 'tortilla69@gmail.com'),
(7, 'Agni', 'Giraldo', 'aggi@correo.com'),
(8, 'Brais', 'Aristizabal', 'braris@correo.com'),
(9, 'Ciro', 'Cogollon', 'circo@correo.com'),
(10, 'Benito', 'Camela', 'benica@correo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `eve_id` int(11) NOT NULL,
  `eve_nombre` varchar(100) NOT NULL,
  `eve_fecha` date NOT NULL,
  `ubi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`eve_id`, `eve_nombre`, `eve_fecha`, `ubi_id`) VALUES
(1, 'Dia de la mujer', '2023-04-13', 4),
(2, 'Torneo Relampago', '2023-02-11', 1),
(3, 'Dia del profesor', '2022-10-15', 2),
(4, 'ICFES', '2023-01-14', 2),
(5, 'Circo Hermanos Gasca', '2023-03-27', 5),
(6, 'Exposicion Orquideas', '2023-05-14', 5),
(7, 'Manifestacion 1 de mayo', '2023-05-01', 3),
(8, 'Concierto Maluma', '2023-02-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `ubi_id` int(11) NOT NULL,
  `ubi_nombre` varchar(100) NOT NULL,
  `ubi_direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`ubi_id`, `ubi_nombre`, `ubi_direccion`) VALUES
(1, 'Estadio Palogrande', 'Cra 20 #49-12'),
(2, 'Colegio Normal', 'Calle 68 #12-23'),
(3, 'Parque Bolivar', 'Cra 35 #10-12'),
(4, 'Parque de la mujer', 'Calle 23 #42-15'),
(5, 'Expoferias', 'Cra 15 #30-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_nombre` varchar(50) NOT NULL,
  `usu_contrasena` varchar(150) NOT NULL,
  `usu_correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`asa_id`),
  ADD KEY `eve_id` (`eve_id`),
  ADD KEY `ase_id` (`ase_id`);

--
-- Indices de la tabla `asistente`
--
ALTER TABLE `asistente`
  ADD PRIMARY KEY (`ase_id`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`eve_id`),
  ADD KEY `ubi_id` (`ubi_id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`ubi_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `asa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `asistente`
--
ALTER TABLE `asistente`
  MODIFY `ase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `eve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `ubi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`eve_id`) REFERENCES `evento` (`eve_id`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`ase_id`) REFERENCES `asistente` (`ase_id`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`ubi_id`) REFERENCES `ubicacion` (`ubi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
