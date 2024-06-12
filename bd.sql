# Host: localhost  (Version 5.0.45-community-nt)
# Date: 2024-06-06 21:21:52
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "categoria"
#

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL auto_increment,
  `tipo` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "categoria"
#


#
# Structure for table "persona"
#

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL auto_increment,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_persona`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "persona"
#


#
# Structure for table "contenido"
#

DROP TABLE IF EXISTS `contenido`;
CREATE TABLE `contenido` (
  `id_contenido` int(11) NOT NULL auto_increment,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `cuerpo` text NOT NULL,
  `foto` varchar(255) default NULL,
  `id_persona` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id_contenido`),
  KEY `fk_categoria` (`id_categoria`),
  KEY `fk_persona` (`id_persona`),
  CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "contenido"
#

#
# Structure for table "bolsa de trabajo"
#

DROP TABLE IF EXISTS `contenido`;

#
# Data for table "bolsa de trabajo"
#






