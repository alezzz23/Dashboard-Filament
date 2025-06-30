-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-06-2025 a las 20:55:06
-- Versión del servidor: 8.0.42-cll-lve
-- Versión de PHP: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursoen2_sistema_educativo`
--
CREATE DATABASE IF NOT EXISTS `cursoen2_sistema_educativo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `cursoen2_sistema_educativo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `profesor_id` int DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_cursos`
--

CREATE TABLE `estudiantes_cursos` (
  `estudiante_id` int NOT NULL,
  `curso_id` int NOT NULL,
  `fecha_inscripcion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int NOT NULL,
  `codigo_inscripcion` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `profesion` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `codigo_inscripcion`, `nombre`, `cedula`, `email`, `telefono`, `profesion`, `fecha_registro`) VALUES
(3, NULL, 'Zulay garcia', '18581164', 'traumaposthgo@gmail.com', '04147873203', 'especialista', '2025-06-07 20:13:04'),
(5, NULL, 'alejandro', '32371282', 'moisesalejandro200713@gmail.com', '04243581209', 'medico_cirujano', '2025-06-07 22:02:30'),
(11, 'INSC-313840A0', 'moises', '2312313', 'moisesalejandro200713@gmail.com', '432123', 'estudiante_pregrado', '2025-06-14 18:09:23'),
(12, 'INSC-86D0FC89', 'William Enrique Jhelis garcia', '17571240', 'jhelis2810@gmail.com', '04243011005', 'especialista', '2025-06-14 20:48:45'),
(13, 'INSC-7361DB9A', 'Cesar Astudillo ', '16214269', 'cesarastudillo2@gmail.com', '04242282575', 'especialista', '2025-06-14 21:51:50'),
(14, 'INSC-7DC72BDD', 'Iván Cadena ', 'E85000285', 'ivanrkdna@gmail.com', '04241390268', 'especialista', '2025-06-14 21:54:36'),
(15, 'INSC-881B864B', 'Jose Luis Alarcon Monasterio', '11412611', 'alarconmjose@gmail.com', '04265195041', 'especialista', '2025-06-14 21:57:21'),
(16, 'INSC-93769583', 'Abelardo Bachour', '20491880', 'doctor.bachour@gmail.com', '04141067450', 'especialista', '2025-06-14 22:00:23'),
(18, 'INSC-DA67C11D', 'Elder Madueño ', 'V-23887035', 'elderdiegoz@gmail.com', '04126854088', 'especialista', '2025-06-14 22:19:18'),
(20, 'INSC-9733156F', 'José Bozo ', '25371447', 'jbozofernandez@gmail.com', '04146910869', 'especialista', '2025-06-15 03:42:43'),
(21, 'INSC-6D00BF11', 'Jonathan José cova ', '23346423', 'de.jonathancova@gmail.com', '04248719580', 'especialista', '2025-06-16 06:49:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `creado_en`) VALUES
(1, 'admin', 'Administrador del sistema', '2025-06-05 12:57:38'),
(2, 'profesor', 'Profesor con acceso a cursos asignados', '2025-06-05 12:57:38'),
(3, 'estudiante', 'Estudiante con acceso a sus cursos', '2025-06-05 12:57:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol_id`, `activo`, `creado_en`, `actualizado_en`) VALUES
(1, 'Administrador', 'admin@example.com', '$2a$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '2025-06-05 12:57:38', '2025-06-05 12:57:38'),
(2, 'moises', 'moi@gmail.com', '$2y$10$lSo63MFtYmZv0H18x1Na/envtB.vZ26kN9H6i1uCmFTeLcMwEQ4k6', 3, 1, '2025-06-14 23:22:23', '2025-06-14 23:22:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `estudiantes_cursos`
--
ALTER TABLE `estudiantes_cursos`
  ADD PRIMARY KEY (`estudiante_id`,`curso_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `codigo_inscripcion_UNIQUE` (`codigo_inscripcion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `estudiantes_cursos`
--
ALTER TABLE `estudiantes_cursos`
  ADD CONSTRAINT `estudiantes_cursos_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `estudiantes_cursos_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
