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
(4, 8, 2, 'Rutini wine', 'Rutini wine Malbec', 'rutini.jpg', NULL, '2015-06-10 00:00:00', '2015-06-24 00:00:00', 1, 0, NULL),
(5, 1, 3, 'Balanza Antiguas 2 Platos', 'HERMOSA BALANZA ANTIGUA ESPECIAL PARA DECORACIÓN NO TE LA PIERDAS\r\nESTRUCTURA DE FUNDICIÓN:\r\nANCHO MÁXIMO 70 cm.\r\nBASE 52 x 13 cm.\r\nALTURA 24 cm.\r\nPLATOSDE BRONCE 29 cm. ', 'balanza.jpg', NULL, '2015-06-05 00:00:00', '2015-07-31 00:00:00', 1, 0, NULL),
(6, 2, 2, 'Resina Poliester Cristal', 'Precio por 1kg. Resina poliester cristal preacelerada. Catalizador incluido en el precio . \r\nEXCELENTE CALIDAD PARA TODOS SUS TRABAJOS. LO ASESORAMOS ANTES Y DESPUÉS DE SU COMPRA PARA QUE SU TRABAJO SALGA PERFECTAMENTE.', 'resina.jpg', NULL, '2015-06-05 00:00:00', '2015-06-30 00:00:00', 1, 0, NULL),
(7, 4, 3, 'Celular Libre Lg G3 D690 Quad Core 5,5 Pulgadas', 'Celular LG G3 Stylus D690 Quad Core 8 Mp Wifi Libre Garantia', 'lg.jpg', NULL, '2015-06-05 00:00:00', '2015-07-29 00:00:00', 1, 0, NULL),
(8, 5, 3, 'Muñeco Buzz Lightyear', 'Muñeco Buzz Lightyear Camina, Sonido Y Luces - Toy Story 4', 'toy.jpg', NULL, '2015-06-03 00:00:00', '2015-07-30 00:00:00', 1, 0, NULL),
(9, 7, 4, 'Nintendo Nes Action Set Igual A Nuevo!!', 'Consola Nintendo Nes en excelente estado! Las fotos hablan solas\r\nSe entrega con la caja original con todo lo que incluía de nuevo.\r\nLo entrego con juego Mario bros y duck hunt', 'nintendo.jpg', NULL, '2015-06-05 00:00:00', '2015-07-28 00:00:00', 1, 0, NULL),
(10, 10, 4, 'Amazon Kindle Touch 7 Gen 2015', 'Amazon Kindle Touch 7 Gen 2015 Modelo Nuevo Recien Lanzado', 'kindle.jpg', NULL, '2015-06-02 00:00:00', '2015-07-29 00:00:00', 1, 0, NULL),
(11, 11, 2, 'Entrada Roger Waters River Plate 2007', 'ROGER WATERS - THE DARK SIDE OF THE MOON\r\nPARA COLECCIONISTAS - EN MUY BUEN ESTADO\r\nDOMINGO 18 DE MARZO DE 2007 - ESTADIO RIVER PLATE', 'roger.jpg', NULL, '2015-06-03 00:00:00', '2015-07-14 00:00:00', 1, 0, NULL),
(12, 12, 3, 'Puerta De Exterior Doble', 'PUERTA DE EXTERIOR DOBLE HOJA \r\nSOMOS FABRICANTES\r\nLAS PUERTAS DOBLES Y LAS PUERTAS Y MEDIA TIENEN EL MISMO PRECIO', 'puerta.jpg', NULL, '2015-06-03 00:00:00', '2015-07-28 00:00:00', 1, 0, NULL),
(13, 13, 5, 'Guitarra Criolla', 'Guitarra Criolla / Clasica Fonseca 31p', 'guitarra.jpg', NULL, '2015-06-04 00:00:00', '2015-07-29 00:00:00', 1, 0, NULL),
(14, 14, 5, 'Reloj De Bolsillo', 'Reloj De Bolsillo Automático Skeleton Con Tapa', 'reloj.jpg', NULL, '2015-06-01 00:00:00', '2015-07-28 00:00:00', 1, 0, NULL),
(15, 15, 2, 'Mini Truck Rc Camioneta 4x4', 'Mini Truck Rc Camioneta 4x4 a radio control, ideal para los mas chiquitos.', 'camioneta.jpg', NULL, '2015-06-01 00:00:00', '2015-07-22 00:00:00', 1, 0, NULL),
(16, 16, 3, 'Mi Primer Balance - Flavio A. Mantovan', 'nmersa en las cualidades características de nuestra Colección, la obra está destinada principalmente al profesional que debe elaborar su primer conjunto de estados contables; no solo a quien trabaja dentro del ente, sino al que lo asiste en forma independiente desde su estudio.', 'libro.jpg', NULL, '2015-06-02 00:00:00', '2015-07-29 00:00:00', 1, 0, NULL),
(17, 17, 3, 'Pink Floyd The Dark Side Of The Moon', 'PINK FLOYD \r\n"The Dark Side of The Moon"\r\n2 Cd''s\r\nExperience Version\r\nDigital Remaster 2011\r\nEdición Nacional\r\nNUEVO Y CERRADO', 'pinkfloyd.jpg', NULL, '2015-06-04 00:00:00', '2015-07-29 00:00:00', 1, 0, NULL),
(18, 18, 4, 'Vestido Importado', 'Vestido Importado De Fiesta De Encaje Elastizado - Noche', 'vestido.jpg', NULL, '2015-06-01 00:00:00', '2015-07-29 00:00:00', 1, 0, NULL),
(19, 19, 5, 'Combo Cinta Engomada', 'Combo Cinta Engomada X 2 + Pigmento Al Alcohol Para Goma Eva', 'cinta.jpg', NULL, '2015-06-02 00:00:00', '2015-07-30 00:00:00', 1, 0, NULL);

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


