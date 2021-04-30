-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2021 a las 10:47:35
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
  `respuestaE` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asig_friends`
--

INSERT INTO `asig_friends` (`id_userE`, `id_userR`, `respuestaE`) VALUES
(26, 12, 1),
(26, 25, 1),
(26, 24, 1),
(12, 26, 1),
(26, 21, 2),
(26, 16, 1),
(26, 23, 1),
(26, 22, 2),
(21, 20, 2);

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
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26);

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
(12, 0, 17, 6, 8, 1, 1, 0),
(16, 1, 50, 50, 17, 0, 0, 0),
(17, 0, 9, 37, 43, 0, 1, 0),
(18, 0, 50, 50, 50, 0, 0, 0),
(19, 1, 7, 75, 19, 1, 1, 0),
(20, 1, 74, 75, 27, 1, 1, 0),
(21, 1, 10, 38, 88, 0, 0, 0),
(22, 0, 100, 15, 13, 1, 1, 0),
(23, 1, 4, 93, 80, 0, 1, 0),
(24, 1, 0, 100, 75, 1, 1, 0),
(25, 0, 61, 95, 42, 0, 0, 0),
(26, 0, 10, 45, 8, 0, 0, 0);

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
  `sexo` int(1) NOT NULL,
  `age` int(2) NOT NULL,
  `phone` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `online` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `dni`, `email`, `password`, `nick`, `sexo`, `age`, `phone`, `active`, `online`) VALUES
(12, '06280822M', 'isra9movil@hotmail.com', '$2y$10$PGvBoUC35pgBMqb0PWe6KOFPqrG/sLnLPrLKB7.LExfTQgU.wfjme', 'isra', 1, 28, 987654321, 1, 1),
(16, '06280822F', 'pepe@gmail.com', '$2y$10$HauWr9sDyV6RCkqQUVJpeuDKJWDZodffk6ogQfQNDtr0Lz0ytXySu', 'pe', 1, 25, 123456789, 1, 0),
(17, '06280823A', 'luzmaria_1106@hotmail.com', '$2y$10$HZPtmgOWCp00ycaJjCsuK.a2fFddu3GDZfegCaWOUPG.2eok8nCzu', 'luz', 0, 30, 605847826, 1, 0),
(18, '06280833L', 'luis@gmail.com', '$2y$10$ifQqHo3.WcdO3V/enRMF6.UfE/u0c6jFwKzsWBaJafu8pMmpOANWe', 'luis', 1, 40, 666666666, 1, 1),
(19, '06280855P', 'maria@gmail.com', '$2y$10$1cZIaayQHKesrox4VinpkeOBur7RYczCd.paGQOdyI8pMvCX/w6vW', 'maria', 0, 20, 444444444, 1, 0),
(20, '06222222L', 'paloma@gmail.com', '$2y$10$4StuwlI/TkoW8tTPjnxYvO68RTpJxpe4XAsdAnvvNeU0oOMPLrIzK', 'paloma', 0, 29, 789478752, 1, 1),
(21, '44444444I', 'daniel@gmail.com', '$2y$10$83K2Q79gwXkJXV2EacvSIuEQLKRnuXMpYngaHL3KPme7zqbUFhUru', 'daniel', 1, 23, 478521414, 1, 0),
(22, '01444444A', 'carmen@gmail.com', '$2y$10$bCnP6E2xYa5PT3Ong.cTLedMqJeQ8t8p8YpxuB41Ayka.peSNr0Ou', 'carmen', 0, 50, 213456879, 1, 0),
(23, '04778888A', 'coral@gmail.com', '$2y$10$uLsFxu4M6hq/2kYCrdTTPe0up2/pDPJwMNHyS.h2qOQTRyKeNoPPy', 'coralina', 0, 26, 123456789, 1, 0),
(24, '06280855W', 'nuria@gmail.com', '$2y$10$6PFfh7lBjYBcNO2r71tTbOyJMI59t0aMzYIFnyPoax3.zQBDuIhIa', 'nuria', 0, 27, 123456777, 1, 1),
(25, '06284447S', 'sebas@gmail.com', '$2y$10$XulzoPw6R1VjfR9V7QqdK.xMNhC66DKEhOraBdGZahQJPV48hscsi', 'sebastian', 1, 29, 123456789, 1, 0),
(26, '06299999S', 'jose@gmail.com', '$2y$10$k7cA09uOkPs8zDMZl1ECcOHEstIPibYKOB/Bl82EHMtnoiqnjTffy', 'jose', 1, 30, 123456987, 1, 0);

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
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
