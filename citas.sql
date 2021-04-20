-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2021 a las 11:45:05
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asig_friends`
--

CREATE TABLE `asig_friends` (
  `id_userE` int(11) NOT NULL,
  `id_userR` int(11) NOT NULL,
  `respuestaR` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asig_rol`
--

CREATE TABLE `asig_rol` (
  `id_rol` int(2) NOT NULL,
  `id_user` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asig_rol`
--

INSERT INTO `asig_rol` (`id_rol`, `id_user`) VALUES
(1, 12),
(1, 13),
(2, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencias` (
  `id` int(11) NOT NULL,
  `tipoRelacion` int(1) NOT NULL,
  `Deporte` int(3) NOT NULL,
  `Arte` int(3) NOT NULL,
  `Politica` int(3) NOT NULL,
  `hijos` int(1) NOT NULL,
  `busca` int(1) NOT NULL,
  `foto` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preferencias`
--

INSERT INTO `preferencias` (`id`, `tipoRelacion`, `Deporte`, `Arte`, `Politica`, `hijos`, `busca`, `foto`) VALUES
(12, 0, 50, 50, 56, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(2) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `description`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(3) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `age` int(2) NOT NULL,
  `phone` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `online` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `dni`, `email`, `password`, `nick`, `age`, `phone`, `active`, `online`) VALUES
(12, '06280822M', 'isra9movil@hotmail.com', '$2y$10$nl9/KM0lZHkcjJE5O7vVcO50wQKGt6WZMBEBBpDA92KElIhoKZqsm', 'isra', 28, 987654321, 1, 1),
(13, '06280823L', 'dario@gmail.com', '$2y$10$ECXpQTTC8F3ZmiaK24hYWONdsg6b2PiFCyLixupu7LMjfp/iRv6Ye', 'darIOS', 23, 12345678, 0, 1),
(14, '06285555A', 'luzmaria_1106@hotmail.com', '$2y$10$/UK2cgiv86vOlCYL4aeeuuYMQwpQKUIoMoRP6mY.gytry5EodVGLu', 'luz', 28, 605847826, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asig_friends`
--
ALTER TABLE `asig_friends`
  ADD KEY `id_userE` (`id_userE`,`id_userR`);

--
-- Indices de la tabla `asig_rol`
--
ALTER TABLE `asig_rol`
  ADD KEY `id_rol` (`id_rol`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asig_friends`
--
ALTER TABLE `asig_friends`
  ADD CONSTRAINT `asig_friends_ibfk_1` FOREIGN KEY (`id_userE`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asig_rol`
--
ALTER TABLE `asig_rol`
  ADD CONSTRAINT `asig_rol_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asig_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD CONSTRAINT `preferencias_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
