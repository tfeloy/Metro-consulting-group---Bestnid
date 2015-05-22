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
(1, 'Nicolás', 'Rejep', 'macatapichon', '81dc9bdb52d04dc20036dbd8313ed055', 'ytagcom@gmail.com', '0221155024411', '1986-07-29', 1,'6878676876876', 1, '2015-05-21 14:31:20');





CREATE TABLE productos 
(
	id INT( 11 ) unsigned NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL, 
	tipo_id INT ( 11 ), 
	activo TINYINT(1) DEFAULT '1' NOT NULL, 
  	PRIMARY KEY(`id`)
);

CREATE TABLE precios_medidas 
(
	id INT( 11 ) unsigned NOT NULL AUTO_INCREMENT,
  	productos_id INT( 11 ) unsigned NOT NULL,
  	medida VARCHAR(50) NOT NULL,
  	precio VARCHAR(25) NOT NULL,
  	index pm_productos_index(productos_id),
  	FOREIGN KEY(productos_id) REFERENCES productos(id) ON DELETE CASCADE,
  	PRIMARY KEY(id)
);

CREATE TABLE `tipo_producto` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tipo_producto` (`id`, `nombre`) VALUES
(1, 'Sutiles'),
(2, 'Silvestres Natura'),
(3, 'Silvestres Árboles'),
(4, 'Pop'),
(5, 'Baby'),
(6, 'Chiquis'),
(7, 'Murales Adultos'),
(8, 'Murales Infantiles'),
(9, 'Urbanik'),
(10, 'Packs'),
(11, 'Esmerilados'),
(12, 'Vidrieras'),
(13, 'Objetos'),
(14, 'Empapelados'),
(15, 'Heladeras'),
(16, 'Impresos'),
(17, 'Frases'),
(18, 'Nueva Temporada'),
(19, 'Personalizados');
