-- Host: localhost (Version 5.0.45-community-nt)
-- Date: 2024-06-15
-- Generator: MySQL-Front 6.1 (Build 1.26)

--
-- Structure for table "persona"
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure for table "noticia"
--

CREATE TABLE `noticia` (
  `id_contenido` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `cuerpo` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_contenido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Structure for table "empleos"
--

DROP TABLE IF EXISTS `empleos`;
CREATE TABLE `empleos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `Puesto` NVARCHAR(255) NOT NULL,
  `ubicacion` NVARCHAR(255) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `requisitos` TEXT NOT NULL,
  `fecha_publicacion` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure for table "aplicar empleo"
--

DROP TABLE IF EXISTS `aplicar_empleo`;
CREATE TABLE `aplicar_empleo` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `empleo_id` INT NOT NULL,
  `nombre_candidato` NVARCHAR(255) NOT NULL,
  `email` NVARCHAR(255) NOT NULL,
  `telefono` NVARCHAR(50) NOT NULL,
  `cv_url` NVARCHAR(255) NOT NULL,
  `fecha_aplicacion` DATE NOT NULL,
  FOREIGN KEY (`empleo_id`) REFERENCES `empleos`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `carrusel`;
CREATE TABLE `carrusel` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ruta_imagen` VARCHAR(255) NOT NULL
);
