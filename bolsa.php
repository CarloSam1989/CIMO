-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2024 a las 02:16:47
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cimo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesoramiento_profesional`
--

CREATE TABLE `asesoramiento_profesional` (
  `id_asesoramiento` int(11) NOT NULL,
  `tema` varchar(200) DEFAULT NULL,
  `descripción` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consejos_busqueda_empleos`
--

CREATE TABLE `consejos_busqueda_empleos` (
  `id_consejo` int(11) NOT NULL,
  `consejo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripciones_trabajo`
--

CREATE TABLE `descripciones_trabajo` (
  `id_descripcion` int(11) NOT NULL,
  `id_oferta` int(11) DEFAULT NULL,
  `responsabilidades` text DEFAULT NULL,
  `requisitos` text DEFAULT NULL,
  `condiciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresas` int(3) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `fundacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_reclutamiento`
--

CREATE TABLE `eventos_reclutamiento` (
  `id_evento` int(11) NOT NULL,
  `nombre_evento` varchar(250) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ubicacion` varchar(200) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_empleo`
--

CREATE TABLE `ofertas_empleo` (
  `id_oferta` int(3) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `descripción` varchar(500) DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `id empresa` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos_adicionales`
--

CREATE TABLE `recursos_adicionales` (
  `id_recurso` int(11) NOT NULL,
  `nombre recurso` varchar(250) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asesoramiento_profesional`
--
ALTER TABLE `asesoramiento_profesional`
  ADD PRIMARY KEY (`id_asesoramiento`);

--
-- Indices de la tabla `consejos_busqueda_empleos`
--
ALTER TABLE `consejos_busqueda_empleos`
  ADD PRIMARY KEY (`id_consejo`);

--
-- Indices de la tabla `descripciones_trabajo`
--
ALTER TABLE `descripciones_trabajo`
  ADD PRIMARY KEY (`id_descripcion`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresas`);

--
-- Indices de la tabla `eventos_reclutamiento`
--
ALTER TABLE `eventos_reclutamiento`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `ofertas_empleo`
--
ALTER TABLE `ofertas_empleo`
  ADD PRIMARY KEY (`id_oferta`);

--
-- Indices de la tabla `recursos_adicionales`
--
ALTER TABLE `recursos_adicionales`
  ADD PRIMARY KEY (`id_recurso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asesoramiento_profesional`
--
ALTER TABLE `asesoramiento_profesional`
  MODIFY `id_asesoramiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consejos_busqueda_empleos`
--
ALTER TABLE `consejos_busqueda_empleos`
  MODIFY `id_consejo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descripciones_trabajo`
--
ALTER TABLE `descripciones_trabajo`
  MODIFY `id_descripcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresas` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos_reclutamiento`
--
ALTER TABLE `eventos_reclutamiento`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_empleo`
--
ALTER TABLE `ofertas_empleo`
  MODIFY `id_oferta` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recursos_adicionales`
--
ALTER TABLE `recursos_adicionales`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
