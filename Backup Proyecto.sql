-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.18-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema pw2proyecto
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ pw2proyecto;
USE pw2proyecto;

--
-- Table structure for table `pw2proyecto`.`factura_orden`
--

DROP TABLE IF EXISTS `factura_orden`;
CREATE TABLE `factura_orden` (
  `order_id` int(11) NOT NULL auto_increment,
  `user_id` varchar(45) NOT NULL,
  `order_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `cliente_id` varchar(45) NOT NULL,
  `order_receiver_name` varchar(250) character set utf8 NOT NULL,
  `order_receiver_address` text character set utf8 NOT NULL,
  `order_total_before_tax` decimal(10,2) NOT NULL,
  `order_total_tax` decimal(10,2) NOT NULL,
  `order_tax_per` varchar(250) character set utf8 NOT NULL,
  `order_total_after_tax` double(10,2) NOT NULL,
  `order_amount_paid` decimal(10,2) NOT NULL,
  `order_total_amount_due` decimal(10,2) NOT NULL,
  `note` text character set utf8 NOT NULL,
  `factura_estado` varchar(45) NOT NULL,
  `usuario_cobrar` varchar(45) default NULL,
  `factura_tipopago` varchar(45) default NULL,
  PRIMARY KEY  (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pw2proyecto`.`factura_orden`
--

/*!40000 ALTER TABLE `factura_orden` DISABLE KEYS */;
INSERT INTO `factura_orden` (`order_id`,`user_id`,`order_date`,`cliente_id`,`order_receiver_name`,`order_receiver_address`,`order_total_before_tax`,`order_total_tax`,`order_tax_per`,`order_total_after_tax`,`order_amount_paid`,`order_total_amount_due`,`note`,`factura_estado`,`usuario_cobrar`,`factura_tipopago`) VALUES 
 (1,'ichigo','2021-11-24 17:16:07','1506199500122','Betsabe','El Sauce','230.00','11.50','5',241.50,'250.00','-8.50','comment','PAGADO','ichigo','Efectivo'),
 (2,'ichigo','2021-11-25 02:39:44','0101199000122','Jose Maradiaga','','100.00','0.00','0',100.00,'100.00','0.00','Cita','PENDIENTE','',''),
 (3,'ichigo','2021-11-28 23:17:19','0107199600654','Salvador','El Sauce','28000.00','0.00','0',28000.00,'0.00','28000.00','Cita','PENDIENTE','','');
/*!40000 ALTER TABLE `factura_orden` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`factura_orden_producto`
--

DROP TABLE IF EXISTS `factura_orden_producto`;
CREATE TABLE `factura_orden_producto` (
  `order_item_id` int(11) NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `item_code` varchar(250) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `order_item_quantity` int(11) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `order_item_final_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`factura_orden_producto`
--

/*!40000 ALTER TABLE `factura_orden_producto` DISABLE KEYS */;
INSERT INTO `factura_orden_producto` (`order_item_id`,`order_id`,`item_code`,`item_name`,`order_item_quantity`,`order_item_price`,`order_item_final_amount`) VALUES 
 (1,1,'10','Polvos',2,'50.00','100.00'),
 (2,1,'9','Brochas',2,'15.00','30.00'),
 (3,2,'55','Consulta Medica',1,'100.00','100.00'),
 (4,3,'30','Operacion de Apendice',1,'28000.00','28000.00');
/*!40000 ALTER TABLE `factura_orden_producto` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_acceso`
--

DROP TABLE IF EXISTS `tbl_acceso`;
CREATE TABLE `tbl_acceso` (
  `modulo_codigo` varchar(45) NOT NULL,
  `usuario_usuario` varchar(45) NOT NULL,
  `acceso_estado` varchar(45) default NULL,
  PRIMARY KEY  (`modulo_codigo`,`usuario_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_acceso`
--

/*!40000 ALTER TABLE `tbl_acceso` DISABLE KEYS */;
INSERT INTO `tbl_acceso` (`modulo_codigo`,`usuario_usuario`,`acceso_estado`) VALUES 
 ('1','ichigo','activo'),
 ('1','ilsw','activo'),
 ('1','woo1','inactivo'),
 ('1-1','ichigo','activo'),
 ('1-1','ilsw','activo'),
 ('1-2','ichigo','activo'),
 ('1-2','ilsw','activo'),
 ('2','ichigo','activo'),
 ('2','ilsw','activo'),
 ('2','islw','activo'),
 ('2-1','ichigo','activo'),
 ('2-2','ichigo','activo'),
 ('3','ichigo','activo'),
 ('3','ilsw','activo'),
 ('3-1','ichigo','activo'),
 ('3-1','ilsw','activo'),
 ('4','ichigo','activo'),
 ('4','ilsw','activo'),
 ('5','ichigo','activo'),
 ('5-1','ichigo','activo'),
 ('6','ichigo','activo'),
 ('6-1','ichigo','activo'),
 ('6-2','ichigo','activo'),
 ('6-3','ichigo','activo'),
 ('7','ichigo','activo'),
 ('8','ichigo','activo'),
 ('8-1','ichigo','activo'),
 ('8-2','ichigo','activo'),
 ('8-3','ichigo','activo'),
 ('9','ichigo','activo');
/*!40000 ALTER TABLE `tbl_acceso` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_aniolectivo`
--

DROP TABLE IF EXISTS `tbl_aniolectivo`;
CREATE TABLE `tbl_aniolectivo` (
  `aniol_anio` int(11) NOT NULL,
  `aniol_fechadesde` datetime default NULL,
  `aniol_fechahasta` datetime default NULL,
  `aniol_estado` varchar(45) default NULL,
  PRIMARY KEY  (`aniol_anio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_aniolectivo`
--

/*!40000 ALTER TABLE `tbl_aniolectivo` DISABLE KEYS */;
INSERT INTO `tbl_aniolectivo` (`aniol_anio`,`aniol_fechadesde`,`aniol_fechahasta`,`aniol_estado`) VALUES 
 (2019,'2018-12-04 00:00:00','2019-12-04 23:59:59','CERRADO'),
 (2020,'2019-11-10 00:00:00','2020-11-09 23:59:59','CERRADO'),
 (2021,'2020-11-10 00:00:00','2021-12-04 23:59:59','ACTIVO'),
 (2022,'2021-12-04 18:46:01','2022-12-04 00:00:00','PENDIENTE');
/*!40000 ALTER TABLE `tbl_aniolectivo` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_area`
--

DROP TABLE IF EXISTS `tbl_area`;
CREATE TABLE `tbl_area` (
  `area_codigo` int(11) NOT NULL,
  `area_nombre` varchar(45) default NULL,
  `area_descripcion` text,
  `area_estado` varchar(45) default NULL,
  PRIMARY KEY  (`area_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_area`
--

/*!40000 ALTER TABLE `tbl_area` DISABLE KEYS */;
INSERT INTO `tbl_area` (`area_codigo`,`area_nombre`,`area_descripcion`,`area_estado`) VALUES 
 (1,'Sistemas','Personal que trabaja en el Area Sistemas','ACTIVO'),
 (2,'Administrativo','Personal que trabaja en Administracion','ACTIVO'),
 (3,'Doctor','Personal que trabaja de Medico','ACTIVO'),
 (4,'Enfermero','Personal que trabaja en el area de enfermeria','ACTIVO'),
 (5,'Cajero','Personal que trabaja de Cajero','ACTIVO'),
 (6,'Servicio','Personal que trabaja en el area de Mantenimiento','ACTIVO');
/*!40000 ALTER TABLE `tbl_area` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_bitacora`
--

DROP TABLE IF EXISTS `tbl_bitacora`;
CREATE TABLE `tbl_bitacora` (
  `bitacora_codigo` varchar(45) character set latin1 NOT NULL,
  `bitacora_modificacion` datetime default NULL,
  `bitacora_descripcion` text character set latin1,
  `empleado_cedula` varchar(45) character set latin1 NOT NULL,
  PRIMARY KEY  (`bitacora_codigo`,`empleado_cedula`),
  KEY `fk_tbl_bitacora_tbl_empleado_idx` (`empleado_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_bitacora`
--

/*!40000 ALTER TABLE `tbl_bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_bitacora` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_cirugia`
--

DROP TABLE IF EXISTS `tbl_cirugia`;
CREATE TABLE `tbl_cirugia` (
  `cirugia_codigo` int(11) NOT NULL auto_increment,
  `cita_codigo` int(11) NOT NULL,
  `fecha_realizada` timestamp NULL default CURRENT_TIMESTAMP,
  `cirugia_resultado` varchar(45) character set latin1 NOT NULL,
  `cirugia_nota` longtext character set latin1 NOT NULL,
  `doctor_nombre` varchar(45) character set latin1 NOT NULL,
  PRIMARY KEY  (`cirugia_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_cirugia`
--

/*!40000 ALTER TABLE `tbl_cirugia` DISABLE KEYS */;
INSERT INTO `tbl_cirugia` (`cirugia_codigo`,`cita_codigo`,`fecha_realizada`,`cirugia_resultado`,`cirugia_nota`,`doctor_nombre`) VALUES 
 (1,3,'2021-11-29 00:03:53','Exitoso','Se realizo en 45min. con exito','Salvador Gonzalez Acosta');
/*!40000 ALTER TABLE `tbl_cirugia` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_cita`
--

DROP TABLE IF EXISTS `tbl_cita`;
CREATE TABLE `tbl_cita` (
  `cita_codigo` int(11) NOT NULL auto_increment,
  `cita_fecha` date default NULL,
  `cita_cliente_nombre` varchar(45) default NULL,
  `cita_cliente_id` varchar(45) default NULL,
  `cita_servicio` varchar(45) default NULL,
  `cita_estado` varchar(45) default NULL,
  PRIMARY KEY  (`cita_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pw2proyecto`.`tbl_cita`
--

/*!40000 ALTER TABLE `tbl_cita` DISABLE KEYS */;
INSERT INTO `tbl_cita` (`cita_codigo`,`cita_fecha`,`cita_cliente_nombre`,`cita_cliente_id`,`cita_servicio`,`cita_estado`) VALUES 
 (1,'2021-11-25','BATMAN','1506199500122','Examen','ATENDIDO'),
 (2,'2021-11-25','Jose Maradiaga','0101199000122','Consulta Medica','ATENDIDO'),
 (3,'2021-11-29','Salvador','0107199600654','Operacion de Apendice','ATENDIDO');
/*!40000 ALTER TABLE `tbl_cita` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
CREATE TABLE `tbl_cliente` (
  `cliente_codigo` int(11) NOT NULL auto_increment,
  `cliente_id` varchar(45) character set utf8 NOT NULL,
  `cliente_nombre1` varchar(45) character set utf8 default NULL,
  `cliente_nombre2` varchar(45) character set utf8 default NULL,
  `cliente_apellido1` varchar(45) character set utf8 default NULL,
  `cliente_apellido2` varchar(45) character set utf8 default NULL,
  `cliente_genero` varchar(45) character set utf8 default NULL,
  `cliente_nacimiento` datetime default NULL,
  `cliente_nacionalidad` longtext character set utf8,
  `cliente_direccion` longtext character set utf8,
  `cliente_departamento` varchar(45) character set utf8 default NULL,
  `cliente_municipio` varchar(45) character set utf8 default NULL,
  `cliente_telefono` varchar(45) character set utf8 default NULL,
  `cliente_celular` varchar(45) character set utf8 default NULL,
  `cliente_afiliado` varchar(45) character set utf8 default NULL,
  `cliente_fechamatricula` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`cliente_codigo`,`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pw2proyecto`.`tbl_cliente`
--

/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` (`cliente_codigo`,`cliente_id`,`cliente_nombre1`,`cliente_nombre2`,`cliente_apellido1`,`cliente_apellido2`,`cliente_genero`,`cliente_nacimiento`,`cliente_nacionalidad`,`cliente_direccion`,`cliente_departamento`,`cliente_municipio`,`cliente_telefono`,`cliente_celular`,`cliente_afiliado`,`cliente_fechamatricula`) VALUES 
 (1,'0101199000122','Jose','','Maradiaga','','masculino','2000-02-02 00:00:00','lkug','kljhg','lkgh','kljhg','9865','68468','no','2015-03-03 00:00:00'),
 (2,'0107199600654','Salvador','Alejandro','Gonzalez','Acosta','masculino','1996-03-11 00:00:00','Hondureña','El Sauce','Atlantida','La Ceiba','95633607','95633607','no','2012-01-28 00:00:00'),
 (3,'1506199500122','Ilian','Betsabe','Reyes','Meraz','femenino','1995-06-27 00:00:00','Honduras','El Sauce','Olancho','El Rosario','95633607','95633607','no','2021-11-26 01:31:03');
/*!40000 ALTER TABLE `tbl_cliente` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_consultas`
--

DROP TABLE IF EXISTS `tbl_consultas`;
CREATE TABLE `tbl_consultas` (
  `consultas_codigo` int(11) NOT NULL auto_increment,
  `cita_codigo` int(11) NOT NULL,
  `fecha_atendida` timestamp NULL default CURRENT_TIMESTAMP,
  `consulta_diagnostico` longtext character set latin1 NOT NULL,
  `consulta_nota` longtext NOT NULL,
  `doctor_nombre` varchar(45) NOT NULL,
  PRIMARY KEY  (`consultas_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_consultas`
--

/*!40000 ALTER TABLE `tbl_consultas` DISABLE KEYS */;
INSERT INTO `tbl_consultas` (`consultas_codigo`,`cita_codigo`,`fecha_atendida`,`consulta_diagnostico`,`consulta_nota`,`doctor_nombre`) VALUES 
 (2,2,'2021-11-28 03:34:43','Hola','WUU!','Salvador Gonzalez Acosta');
/*!40000 ALTER TABLE `tbl_consultas` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_empleado`
--

DROP TABLE IF EXISTS `tbl_empleado`;
CREATE TABLE `tbl_empleado` (
  `empleado_cedula` varchar(45) NOT NULL,
  `empleado_nombre` varchar(100) default NULL,
  `empleado_apellido1` varchar(100) default NULL,
  `empleado_apellido2` varchar(100) default NULL,
  `empleado_fechai` datetime default NULL,
  `empleado_fechan` datetime default NULL,
  `empleado_estadocivil` varchar(45) default NULL,
  `empleado_direccion` text,
  `empleado_email` varchar(255) default NULL,
  `empleado_tipoempleado` varchar(45) default NULL,
  `empleado_gradoaca` varchar(255) default NULL,
  `empleado_genero` varchar(45) default NULL,
  `empleado_estado` varchar(45) default NULL,
  `empleado_telefono` varchar(45) default NULL,
  `empleado_celular` varchar(45) default NULL,
  `empleado_salario` decimal(9,2) default NULL,
  `empleado_observaciones` text,
  PRIMARY KEY  (`empleado_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_empleado`
--

/*!40000 ALTER TABLE `tbl_empleado` DISABLE KEYS */;
INSERT INTO `tbl_empleado` (`empleado_cedula`,`empleado_nombre`,`empleado_apellido1`,`empleado_apellido2`,`empleado_fechai`,`empleado_fechan`,`empleado_estadocivil`,`empleado_direccion`,`empleado_email`,`empleado_tipoempleado`,`empleado_gradoaca`,`empleado_genero`,`empleado_estado`,`empleado_telefono`,`empleado_celular`,`empleado_salario`,`empleado_observaciones`) VALUES 
 ('0107199600654','Salvador','Gonzalez','Acosta','2021-10-25 00:00:00','1996-11-03 00:00:00','casado','El Sauce','ichigogonzalez@gmail.com','Doctor','Ing. Sistemas','masculino','activo','95633607','95633607','0.00','0'),
 ('1','Isaias','Lorenzo','Woods','2021-06-17 00:00:00','1995-06-27 00:00:00','soltero','1','1','Sistemas','1','masculino','activo','1','1','0.00','0'),
 ('12','Juan Pancho','Juarez','Rodriguez','2021-10-25 00:00:00','1992-02-02 00:00:00','soltero','goiuhoi','blkhgvh','Administrativo','nkjhvky','masculino','activo','984654','65165','0.00','0'),
 ('1506199500122','Betsabe','Reyes','Meraz','2021-06-17 00:00:00','1995-06-27 00:00:00','casado','Miramar','oigyu@gmail.com','Enfermero','Contaduria y Finanzas','femenino','inactivo','9877897','98767898','0.00','0'),
 ('58765987','Woo','Wii','Wee','2021-10-27 00:00:00','1994-04-04 00:00:00','divorciado','uygoiuhoiu','oiupouihp','Servicio','fiuygoiuy','femenino','jubilado','8949849','645498','0.00','0');
/*!40000 ALTER TABLE `tbl_empleado` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_grado`
--

DROP TABLE IF EXISTS `tbl_grado`;
CREATE TABLE `tbl_grado` (
  `grado_codigo` int(11) NOT NULL,
  `grado_nombre` varchar(45) default NULL,
  `grado_parcial` int(11) default NULL,
  `grado_descripcion` varchar(45) default NULL,
  PRIMARY KEY  (`grado_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_grado`
--

/*!40000 ALTER TABLE `tbl_grado` DISABLE KEYS */;
INSERT INTO `tbl_grado` (`grado_codigo`,`grado_nombre`,`grado_parcial`,`grado_descripcion`) VALUES 
 (1,'Septimo',4,'1er Curso'),
 (2,'Octavo',4,'2o Curso'),
 (3,'Noveno',4,'3er Curso'),
 (4,'Decimo',4,'1o Bach'),
 (5,'Onceavo',4,'2o Bach');
/*!40000 ALTER TABLE `tbl_grado` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_laboratorio`
--

DROP TABLE IF EXISTS `tbl_laboratorio`;
CREATE TABLE `tbl_laboratorio` (
  `laboratorio_codigo` int(11) NOT NULL auto_increment,
  `cita_codigo` int(11) NOT NULL,
  `fecha_realizada` timestamp NULL default CURRENT_TIMESTAMP,
  `diagnostico` longtext character set latin1 NOT NULL,
  `nota` longtext character set latin1 NOT NULL,
  `doctor_nombre` varchar(45) character set latin1 NOT NULL,
  PRIMARY KEY  (`laboratorio_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_laboratorio`
--

/*!40000 ALTER TABLE `tbl_laboratorio` DISABLE KEYS */;
INSERT INTO `tbl_laboratorio` (`laboratorio_codigo`,`cita_codigo`,`fecha_realizada`,`diagnostico`,`nota`,`doctor_nombre`) VALUES 
 (1,1,'2021-11-28 21:55:34','Negativo VIH','Adios Preocupacion','Salvador Gonzalez Acosta');
/*!40000 ALTER TABLE `tbl_laboratorio` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_modulo`
--

DROP TABLE IF EXISTS `tbl_modulo`;
CREATE TABLE `tbl_modulo` (
  `modulo_codigo` varchar(45) NOT NULL,
  `modulo_nombre` varchar(45) default NULL,
  `modulo_descripcion` text,
  `modulo_estado` varchar(45) default NULL,
  PRIMARY KEY  (`modulo_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_modulo`
--

/*!40000 ALTER TABLE `tbl_modulo` DISABLE KEYS */;
INSERT INTO `tbl_modulo` (`modulo_codigo`,`modulo_nombre`,`modulo_descripcion`,`modulo_estado`) VALUES 
 ('1','Control de Empleado','Formulario de Mantenimiento de Empleados','activo'),
 ('1-1','Crear Empleado','Creacion de Empleados','activo'),
 ('1-2','Modificar Empleado','Modificacion de Empleados','activo'),
 ('2','Control de Cliente','Formulario de Mantenimiento de Clientes','activo'),
 ('2-1','Crear Cliente','Creacion de Cliente','activo'),
 ('2-2','Modificar Cliente','Modificacion de Cliente','activo'),
 ('3','Control de Usuario','Formulario de Mantenimiento de Usuarios','activo'),
 ('3-1','Crear y Modificar un Usuario','Creacion de Usuarios','activo'),
 ('4','Crear y Modificar un Acceso','Creacion y Modificacion de Accesos','activo'),
 ('5','Control Cita','Control de Citas','activo'),
 ('5-1','Agendar Cita','Creacion de Cita Medica','activo'),
 ('6','Formulario Factura','Formulario de Mantenimiento de Reseteo de Clave','activo'),
 ('6-1','Crear Factura','Crear Factura','activo'),
 ('6-2','Cobrar Factura','Cobrar Facturas','activo');
INSERT INTO `tbl_modulo` (`modulo_codigo`,`modulo_nombre`,`modulo_descripcion`,`modulo_estado`) VALUES 
 ('6-3','Cierre de Caja','Cierre de Caja','activo'),
 ('7','Control Medicos','Control de Medicos','activo'),
 ('8','Control de Servicios','Control de Multiples Servicios','activo'),
 ('8-1','Consultas','Control de Consultas','activo'),
 ('8-2','Laboratorio','Control de Laboratorio','activo'),
 ('8-3','Cirugia','Control de Cirugias','activo'),
 ('9','Recetas','Control de Recetas','activo');
/*!40000 ALTER TABLE `tbl_modulo` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_receta`
--

DROP TABLE IF EXISTS `tbl_receta`;
CREATE TABLE `tbl_receta` (
  `receta_codigo` int(11) NOT NULL auto_increment,
  `receta_cliente` varchar(45) NOT NULL,
  `receta_edad` varchar(45) NOT NULL,
  `doctor_nombre` text character set latin1 NOT NULL,
  `receta_fecha` timestamp NULL default CURRENT_TIMESTAMP,
  `receta_nota` text NOT NULL,
  PRIMARY KEY  (`receta_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_receta`
--

/*!40000 ALTER TABLE `tbl_receta` DISABLE KEYS */;
INSERT INTO `tbl_receta` (`receta_codigo`,`receta_cliente`,`receta_edad`,`doctor_nombre`,`receta_fecha`,`receta_nota`) VALUES 
 (1,'Jose','26','Salvador Gonzalez Acosta','2021-11-27 03:14:43',''),
 (2,'Isaias','30','Salvador Gonzalez Acosta','2021-11-27 04:12:24','Tiene que Nebulizar a su hijo segun lo indicado');
/*!40000 ALTER TABLE `tbl_receta` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_receta_medicamento`
--

DROP TABLE IF EXISTS `tbl_receta_medicamento`;
CREATE TABLE `tbl_receta_medicamento` (
  `receta_medicamento_id` int(11) NOT NULL auto_increment,
  `receta_codigo` int(11) NOT NULL,
  `receta_medicamento` varchar(45) character set latin1 NOT NULL,
  `receta_dosis` varchar(45) character set latin1 NOT NULL,
  `receta_unidad` int(11) NOT NULL,
  PRIMARY KEY  (`receta_medicamento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_receta_medicamento`
--

/*!40000 ALTER TABLE `tbl_receta_medicamento` DISABLE KEYS */;
INSERT INTO `tbl_receta_medicamento` (`receta_medicamento_id`,`receta_codigo`,`receta_medicamento`,`receta_dosis`,`receta_unidad`) VALUES 
 (1,1,'Acetaminofen 500mg','8 horas',10),
 (2,1,'Musflex Compuesto','8 horas',5),
 (3,2,'Neumotol','12 horas',4);
/*!40000 ALTER TABLE `tbl_receta_medicamento` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
CREATE TABLE `tbl_usuario` (
  `usuario_usuario` varchar(45) NOT NULL,
  `usuario_contra` varchar(45) default NULL,
  `usuario_estado` varchar(45) default NULL,
  `empleado_cedula` varchar(45) NOT NULL,
  PRIMARY KEY  (`empleado_cedula`,`usuario_usuario`),
  UNIQUE KEY `usuario_usuario_UNIQUE` (`usuario_usuario`),
  KEY `fk_tbl_usuario_tbl_empleado_idx` (`empleado_cedula`),
  CONSTRAINT `fk_tbl_usuario_tbl_empleado` FOREIGN KEY (`empleado_cedula`) REFERENCES `tbl_empleado` (`empleado_cedula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_usuario`
--

/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` (`usuario_usuario`,`usuario_contra`,`usuario_estado`,`empleado_cedula`) VALUES 
 ('ichigo','gonzalez','activo','0107199600654'),
 ('ilsw','olimpia','activo','1');
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;


--
-- Table structure for table `pw2proyecto`.`tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE `tbl_usuarios` (
  `usuario_usuario` varchar(45) NOT NULL,
  `usuario_contra` varchar(45) default NULL,
  `usuario_estado` varchar(45) default NULL,
  `empleado_cedula` varchar(45) NOT NULL,
  `usuario_temp` varchar(45) default NULL,
  PRIMARY KEY  (`empleado_cedula`,`usuario_usuario`),
  UNIQUE KEY `usuario_usuario_UNIQUE` (`usuario_usuario`),
  KEY `fk_tbl_usuarios_tbl_empleado_idx` (`empleado_cedula`),
  CONSTRAINT `fk_tbl_usuarios_tbl_empleado` FOREIGN KEY (`empleado_cedula`) REFERENCES `tbl_empleado` (`empleado_cedula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pw2proyecto`.`tbl_usuarios`
--

/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` (`usuario_usuario`,`usuario_contra`,`usuario_estado`,`empleado_cedula`,`usuario_temp`) VALUES 
 ('ichigo','gonzalez','activo','0107199600654','NO'),
 ('ilsw','olimpia','activo','1','NO'),
 ('wii','hola','activo','58765987','NO');
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;


--
-- View structure for view `pw2proyecto`.`vista_de_accesos`
--

DROP VIEW IF EXISTS `vista_de_accesos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pw2proyecto`.`vista_de_accesos` AS select `e`.`empleado_cedula` AS `cedula`,concat(`e`.`empleado_nombre`,_utf8' ',`e`.`empleado_apellido1`,_utf8' ',`e`.`empleado_apellido2`) AS `nombrec`,`u`.`usuario_usuario` AS `usuario_usuario`,`u`.`usuario_estado` AS `estado_usuario`,`m`.`modulo_nombre` AS `modulo`,`a`.`acceso_estado` AS `estado_acceso` from (((`pw2proyecto`.`tbl_empleado` `e` join `pw2proyecto`.`tbl_usuario` `u` on((`u`.`empleado_cedula` = `e`.`empleado_cedula`))) left join `pw2proyecto`.`tbl_acceso` `a` on((`a`.`usuario_usuario` = `u`.`usuario_usuario`))) left join `pw2proyecto`.`tbl_modulo` `m` on((`m`.`modulo_codigo` = `a`.`modulo_codigo`)));


--
-- View structure for view `pw2proyecto`.`vista_de_usuarios`
--

DROP VIEW IF EXISTS `vista_de_usuarios`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pw2proyecto`.`vista_de_usuarios` AS select `e`.`empleado_cedula` AS `cedula`,concat(`e`.`empleado_nombre`,_utf8' ',`e`.`empleado_apellido1`,_utf8' ',`e`.`empleado_apellido2`) AS `nombre`,ifnull(`u`.`usuario_usuario`,_utf8'') AS `usuario_usuario`,if(isnull(`u`.`usuario_usuario`),_utf8'NO',_utf8'SI') AS `siesta`,ifnull(`u`.`usuario_contra`,_utf8'') AS `usuario_contra`,ifnull(`u`.`usuario_estado`,_utf8'') AS `usuario_estado` from (`pw2proyecto`.`tbl_empleado` `e` left join `pw2proyecto`.`tbl_usuario` `u` on((`u`.`empleado_cedula` = `e`.`empleado_cedula`)));


--
-- View structure for view `pw2proyecto`.`vista_de_usuarios2`
--

DROP VIEW IF EXISTS `vista_de_usuarios2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pw2proyecto`.`vista_de_usuarios2` AS select `e`.`empleado_cedula` AS `cedula`,`u`.`usuario_temp` AS `temp`,concat(`e`.`empleado_nombre`,_utf8' ',`e`.`empleado_apellido1`,_utf8' ',`e`.`empleado_apellido2`) AS `nombre`,ifnull(`u`.`usuario_usuario`,_utf8'') AS `usuario_usuario`,if(isnull(`u`.`usuario_usuario`),_utf8'NO',_utf8'SI') AS `siesta`,ifnull(`u`.`usuario_contra`,_utf8'') AS `usuario_contra`,ifnull(`u`.`usuario_estado`,_utf8'') AS `usuario_estado` from (`pw2proyecto`.`tbl_empleado` `e` left join `pw2proyecto`.`tbl_usuarios` `u` on((`u`.`empleado_cedula` = `e`.`empleado_cedula`)));

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
