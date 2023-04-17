-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2023 a las 00:50:20
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_datos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `NombreCurso` varchar(200) DEFAULT NULL,
  `EstadoCurso` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `NombreCurso`, `EstadoCurso`) VALUES
(1, 'Arquitectura de datos', 1),
(2, 'Sistemas Distribuidos', 1),
(3, 'Sistemas Transaccionales', 1),
(4, 'Diseño de Algoritmos', 1),
(5, 'Interconectividad', 1),
(6, 'Programación Web', 1),
(7, 'No aplica', 1),
(8, 'etica', 1),
(9, 'catedra MD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructorescursos`
--

CREATE TABLE `instructorescursos` (
  `id_inscrito` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `nombre_instructor` varchar(150) DEFAULT NULL,
  `EstadoAceptado` int(11) NOT NULL DEFAULT 0,
  `Observacion` text NOT NULL DEFAULT 'Ninguna'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instructorescursos`
--

INSERT INTO `instructorescursos` (`id_inscrito`, `id_alumno`, `id_curso`, `nombre_instructor`, `EstadoAceptado`, `Observacion`) VALUES
(8, 16, 4, 'angelina bermudez', 1, 's'),
(10, 17, 3, 'angelina bermudez', 0, 'sssss'),
(11, 18, 5, 'angelina bermudez', 0, 'esta es una observacion para Andres'),
(12, 20, 2, 'miguel blanco', 0, 'Ninguna'),
(13, 23, 6, 'angelina bermudez', 0, 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `NombreRol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `NombreRol`) VALUES
(1, 'Administrador'),
(2, 'Instructor'),
(3, 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id_documento` int(11) NOT NULL,
  `NombreDoc` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`id_documento`, `NombreDoc`) VALUES
(1, 'Tarjeta de Identidad'),
(2, 'Cedula de Ciudadania'),
(3, 'Pasaporte'),
(4, 'Cedula Extranjera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `tipoDocumento` int(11) DEFAULT NULL,
  `NumeroDocmuento` int(10) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Primer_Apellido` varchar(100) DEFAULT NULL,
  `Segundo_Apellido` varchar(100) DEFAULT NULL,
  `Telefono` int(10) DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  `Contrasena` varchar(250) NOT NULL,
  `idRol` int(11) NOT NULL,
  `Curso` int(11) DEFAULT NULL,
  `fregistro` datetime NOT NULL DEFAULT current_timestamp(),
  `Estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `tipoDocumento`, `NumeroDocmuento`, `Nombres`, `Primer_Apellido`, `Segundo_Apellido`, `Telefono`, `Correo`, `Contrasena`, `idRol`, `Curso`, `fregistro`, `Estado`) VALUES
(13, 2, 1000699053, 'Johans', 'bermudez', 'Rodríguez', 2147483647, 'johanrodriguezbermudez@gmail.com', '$2y$10$2ggx9UvNGjsez.ZKmIHZIutPEJLarZpLTBgca.MYa4Rw6mp1Bt7rK', 1, 7, '2023-04-07 20:57:50', 1),
(14, 2, 52186526, 'angelina', 'bermudez', 'Cardenas', 2147483647, 'angelac.76@hotmail.com', '$2y$10$iFwQEirX27w20z5eirBGr.3ozCufspAq.emODitbUs7./.aOdR7ne', 2, 7, '2023-04-08 21:49:22', 1),
(16, 2, 79400886, 'ivan', 'rodriguez', 'herrera', 2147483647, 'ivancho@gmail.com', '$2y$10$8K2zKx1rADYXWHgMxaHeYel6WixOR1SLusBUyO3abIsNGObVdtxxS', 3, 4, '2023-04-08 22:02:22', 1),
(17, 1, 1000699547, 'nicolle', 'bermudez', 'rodriguez', 2147483647, 'nicolle@gmail.com', '$2y$10$MmTd4GtUS8rVQkZySYsqVee0Ut2IDgAyBYKCdau0BDOx3DgrVQ7cm', 3, 3, '2023-04-08 22:03:46', 1),
(18, 2, 526985614, 'andres', 'cabezas', 'perez', 2147483647, 'cabezasperez@gmail.com', '$2y$10$uQn8YmDjIM8hEIiQ52E5I.txGk2WSz/BuIjO91sLGKrZBumztHB6.', 3, 5, '2023-04-09 11:16:47', 1),
(19, 2, 1234567, 'miguel', 'blanco', 'rodriguez', 2147483647, 'miguel@gmail.com', '$2y$10$icwy46EphJVvzd6gxib/SeW/VrZ8EWFWnCwyx4deACDznNVxlFJUy', 2, 7, '2023-04-09 12:00:53', 1),
(20, 2, 7654321, 'andres', 'blanco', 'herrera', 2147483647, 'andres@gmail.com', '$2y$10$D9m7E11es75t7Q81FbVcPOCVHYAbvx7GQsDtXhI7.VjM0LMGMJyNy', 3, 2, '2023-04-09 12:02:49', 1),
(23, 2, 784512, 'carlos', 'rodriguez', 'sss', 2147483647, 'carlos@gmail.com', '$2y$10$gdf67N.XYMqZBb7wrmEVseyDawMqXCrNeibBOQuOMWT2KIJuPuNvK', 3, 6, '2023-04-09 17:48:24', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `instructorescursos`
--
ALTER TABLE `instructorescursos`
  ADD PRIMARY KEY (`id_inscrito`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `tipoDocumento` (`tipoDocumento`),
  ADD KEY `Curso` (`Curso`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `instructorescursos`
--
ALTER TABLE `instructorescursos`
  MODIFY `id_inscrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `instructorescursos`
--
ALTER TABLE `instructorescursos`
  ADD CONSTRAINT `instructorescursos_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `instructorescursos_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipoDocumento`) REFERENCES `tipodocumento` (`id_documento`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
