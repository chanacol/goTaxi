use a7881501_gotaxi;

DROP TABLE IF EXISTS `historial`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL auto_increment,
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `id_rel_t_t` int(11) NOT NULL,
  `monto` float NOT NULL,
  `corte` int(11) NOT NULL COMMENT '0-No ha hecho corte\n1-Ha hecho corte',
  PRIMARY KEY  (`id_historial`),
  KEY `hist_id_rel` (`id_rel_t_t`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Esta tabla contiene los datos del historial de corridas diar';


DROP TABLE IF EXISTS `rel_taxista_taxi`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rel_taxista_taxi` (
  `id_rel_t_t` int(11) NOT NULL auto_increment,
  `id_taxista` int(11) NOT NULL,
  `id_taxi` int(11) NOT NULL,
  `estado` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_rel_t_t`),
  KEY `rel_taxista` (`id_taxista`),
  KEY `rel_taxi` (`id_taxi`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Relación de taxistas con taxis, se realiza de esta forma por';

DROP TABLE IF EXISTS `taxi`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `taxi` (
  `id_taxi` int(11) NOT NULL,
  `modelo` varchar(45) default NULL,
  `anio` int(11) default NULL,
  `placas` varchar(15) default NULL,
  `serie` varchar(45) default NULL,
  `activo` int(11) NOT NULL default '1',
  `marca` varchar(45) NOT NULL,
  PRIMARY KEY  (`id_taxi`),
  UNIQUE KEY `id_taxi_UNIQUE` (`id_taxi`),
  UNIQUE KEY `serie_UNIQUE` (`serie`),
  UNIQUE KEY `placas_UNIQUE` (`placas`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Conjunto de datos de taxis registrados.\nFunción: Despliega l';

DROP TABLE IF EXISTS `taxista`;
SET character_set_client = utf8;
CREATE TABLE `taxista` (
  `id_taxista` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `ap_paterno` varchar(45) NOT NULL,
  `ap_materno` varchar(45) NOT NULL,
  `sexo` int(11) NOT NULL default '0' COMMENT '0-Hombre, 1- Mujer',
  `telefono` varchar(10) NOT NULL,
  `licencia` int(11) NOT NULL default '1' COMMENT '0-No vigente, 1 - Vigente',
  `Comentarios` mediumtext,
  `activo` int(11) NOT NULL default '1' COMMENT '0- No activo, 1- Activo',
  PRIMARY KEY  (`id_taxista`),
  UNIQUE KEY `id_taxista_UNIQUE` (`id_taxista`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Conjunto de taxistas registrados.\nFunción: Almacén de los da';

DROP TABLE IF EXISTS `usuario`;
SET character_set_client = utf8;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `nivel` int(11) NOT NULL default '0' COMMENT '0 - Normal, 1 - Administrativo',
  `estado` int(11) NOT NULL default '1' COMMENT '0 - no activo, 1 - Activo',
  PRIMARY KEY  (`id_usuario`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;