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
  `nro_tarjeta` varchar(255) DEFAULT NULL,
  `es_admin` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL
  PRIMARY KEY(id)
) ENGINE = INNODB;

INSERT INTO `users` (`id`, `nombre`, `apellido`, `username`, `password`, `email`, `telefono`, `fecha_nac`, `sexo`, `nro_tarjeta`, `es_admin`, `fecha_registro`) VALUES
(1, 'Nicolás', 'Rejep', 'macatapichon', '81dc9bdb52d04dc20036dbd8313ed055', 'ytagcom@gmail.com', '0221155024411', '1986-07-29', 1,'6878676876876', 1, '2015-05-21 14:31:20'),
(2, 'Josefina', 'Alvarez', 'josefina', '81dc9bdb52d04dc20036dbd8313ed055', 'jalvarez@gmail.com', '7878787878', '1986-05-17', 0, '879798798798798', 0, '2015-05-22 17:28:24');

CREATE TABLE categorias (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY(id)
) ENGINE = INNODB;

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Antigüedades'),
(2, 'Arte y Artesanías'),
(3, 'Cámaras y Accesorios'),
(4, 'Celulares y Teléfonos'),
(5, 'Colecccionables y Hobbies'),
(6, 'Computación'),
(7, 'Consolas y Videojuegos'),
(8, 'Delicatessen y Vinos'),
(9, 'Deportes'),
(10, 'Electrónica, Audio y Video'),
(11, 'Entradas para Eventos'),
(12, 'Hogar'),
(13, 'Instrumentos Musicales'),
(14, 'Joyas'),
(15, 'Juegos y Juguetes'),
(16, 'Libros, Revistas y Comics'),
(17, 'Música, Películas y Series'),
(18, 'Ropa y Accesorios'),
(19, 'Otras categorias');

CREATE TABLE productos (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` longtext NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` varchar(255) DEFAULT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `vendido` tinyint(1) DEFAULT '0',
  `comision` varchar(255) DEFAULT NULL
  PRIMARY KEY(id)
) ENGINE = INNODB;

INSERT INTO `productos` (`id`, `id_categoria`, `id_vendedor`, `titulo`, `descripcion`, `imagen`, `precio`, `fecha_publicacion`, `fecha_fin`, `activo`, `vendido`, `comision`) VALUES
(1, 3, 2, 'Increible camara Canon', 'Increible camara Canon, no te pierdas esta oportunidad', 'canon.jpg', NULL, '2015-06-03 00:00:00', '2015-07-30 00:00:00', 1, 0, NULL),
(2, 6, 2, 'Teclado inalambrico Logitech', 'Teclado inalambrico Logitech con sorpresa de regalo', 'teclado.jpg', NULL, '2015-06-04 00:00:00', '2015-06-30 00:00:00', 1, 0, NULL),
(3, 9, 2, 'Remera de Messi', 'Remera de messi transpirada por el no el hermano', 'messi.jpg', NULL, '2015-06-04 00:00:00', '2015-07-22 00:00:00', 1, 0, NULL),
(4, 8, 2, 'Rutini wine', 'Rutini wine Malbec', 'rutini.jpg', NULL, '2015-06-10 00:00:00', '2015-06-24 00:00:00', 1, 0, NULL);

CREATE TABLE ofertas_realizadas (
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_ofertado` varchar(255) NOT NULL,
  `necesidad_ofertada` varchar(255) NOT NULL,
  `fecha_oferta` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE = INNODB;

CREATE TABLE consultas (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `fecha_pregunta` datetime NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `fecha_respuesta` datetime NOT NULL,
  PRIMARY KEY(id)
) ENGINE = INNODB;


