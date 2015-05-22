CREATE SCHEMA bestnid;
USE bestnid;

CREATE TABLE users (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `fecha_nac` date NOT NULL,
  `sexo` tinyint(1) NOT NULL DEFAULT '0',
  `nro_tarjeta` varchar(255) NOT NULL,
  `es_admin` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY(id)
) ENGINE = INNODB;

INSERT INTO `users` (`id`, `nombre`, `apellido`, `username`, `password`, `email`, `telefono`, `fecha_nac`, `sexo`, `nro_tarjeta`, `es_admin`, `fecha_registro`) VALUES
(1, 'Nicolás', 'Rejep', 'macatapichon', '81dc9bdb52d04dc20036dbd8313ed055', 'ytagcom@gmail.com', '0221155024411', '1986-07-29', 1,'6878676876876', 1, '2015-05-21 14:31:20'),
(2, 'Josefina', 'Alvarez', 'josefina', '81dc9bdb52d04dc20036dbd8313ed055', 'jalvarez@gmail.com', '7878787878', '1986-05-17', 0, '879798798798798', 0, '2015-05-22 17:28:24');
