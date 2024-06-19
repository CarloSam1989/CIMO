# Host: localhost (Version 5.0.45-community-nt)
# Date: 2024-06-15
# Generator: MySQL-Front 6.1 (Build 1.26)

#
# Structure for table "categoria"
#

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for table "persona"
#

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

#
# Structure for table "contenido"
#

DROP TABLE IF EXISTS `contenido`;
CREATE TABLE `contenido` (
  `id_contenido` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `cuerpo` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_contenido`),
  KEY `fk_categoria` (`id_categoria`),
  CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for table "bolsa_de_trabajo"
#

DROP TABLE IF EXISTS `bolsa_de_trabajo`;
CREATE TABLE `bolsa_de_trabajo` (
  `CurriculumVitae` NVARCHAR(255),
  `CartasRecomendacion` NVARCHAR(50),
  `TarjetasPresentacion` NVARCHAR(50),
  `BlocNotasBoligrafos` NVARCHAR(50),
  `DispositivoElectronico` NVARCHAR(50),
  `DocumentosIdentificacion` NVARCHAR(50),
  `AguaSnacks` NVARCHAR(50),
  `ArticulosAseoPersonal` NVARCHAR(50),
  `MapaDirecciones` NVARCHAR(50),
  `Portafolio` NVARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for table "carrusel"
#

DROP TABLE IF EXISTS `carrusel`;
CREATE TABLE `carrusel` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ruta_imagen` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
