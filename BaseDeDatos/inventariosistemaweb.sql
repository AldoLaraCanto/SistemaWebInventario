-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2020 a las 04:47:07
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventariosistemaweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `iddatos` int(11) NOT NULL,
  `num_reporte` int(11) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `no_serie` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `tipo_registro` int(11) DEFAULT NULL,
  `motivo` int(11) DEFAULT NULL,
  `departamento` text,
  `ubicacion_fisica` text,
  `ubicacion_sistema` text,
  `dateadd` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`iddatos`, `num_reporte`, `marca`, `modelo`, `no_serie`, `descripcion`, `tipo_registro`, `motivo`, `departamento`, `ubicacion_fisica`, `ubicacion_sistema`, `dateadd`, `usuario_id`) VALUES
(1, 1, 'DELL', 'Dell Inspirion 7000 Series', '2147483647', 'Pantalla Rota', 1, 1, 'Oficinas UV', 'Oficinas UV', 'Oficinas UV', '2020-06-13 21:12:47', 1),
(2, 2, 'NOKIA', 'Nokia 6', '20170221', 'No enciende', 1, 1, 'Oficinas UV', 'Oficinas UV', 'Oficinas UV', '2020-06-13 21:50:20', 1),
(7, 3, 'IBM', 'IBM Netvista', '1234567876', 'Pantalla Rota', 1, 12, 'Oficinas UV', 'Oficinas UV', 'Oficinas UV', '2020-06-13 22:49:20', 1),
(8, 4, '', '', '', 'Sin Descripcion', 2, 12, 'Microna', 'Microna', 'Microna', '2020-06-15 15:54:22', 2),
(11, 5, 'LG', 'Minisplit Inverter LG', 'VM122H6 1 t', 'Ninguna', 1, 11, 'SalÃ³n Julio Acosta', 'SalÃ³n Julio Acosta', 'SalÃ³n Julio Acosta', '2020-06-26 20:41:57', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idinventario` int(11) NOT NULL,
  `r_usuario` int(11) DEFAULT NULL,
  `r_datos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo`
--

CREATE TABLE `motivo` (
  `idmotivo` int(11) NOT NULL,
  `motivo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motivo`
--

INSERT INTO `motivo` (`idmotivo`, `motivo`) VALUES
(1, 'Por cambio de Vice-Rector'),
(2, 'Cambio de Secretario Acedemico'),
(3, 'Cambio de Administrador'),
(4, 'Revision de Rutina'),
(5, 'Por cambio de Coordinador'),
(6, 'Cambio de Jefatura'),
(7, 'Por cambio de Director'),
(8, 'Solicitado por la dependencia'),
(9, 'Revision por prueba Selectiva'),
(10, 'Cambio por el Secretario de la Rectoria'),
(11, 'Por Revision Periodica'),
(12, 'Por Revision Programada'),
(13, 'Por cambio de Rector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Encargado'),
(2, 'Verificador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_registro`
--

CREATE TABLE `tipo_registro` (
  `idtipo_registro` int(11) NOT NULL,
  `tipo_registro` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_registro`
--

INSERT INTO `tipo_registro` (`idtipo_registro`, `tipo_registro`) VALUES
(1, 'Mueble'),
(2, 'Inmueble');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text,
  `rol` int(11) DEFAULT NULL,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `telefono`, `direccion`, `rol`, `foto`) VALUES
(1, 'user', 'user@gmail.com', 'user', '123', '2292141127', 'Casas Tamsa', 1, 'Open_Source_Initiative_Logo.png'),
(2, 'Aldo Lara Canto', 'aldo@gmail.com', 'aldo', '12345', '9216007', 'Donato Casas', 2, 'img_b192c7a59b36c493f3c0dc5de0cd0b67.jpg'),
(3, 'Adolfo Lara Canto', 'adolfo@hotmail.com', 'Adolfo', 'abcd', '9215007', 'Ejido Primero de Mayo Sur', 1, 'img_2d788c3856d3527c4f1e31737e75e1ed.jpg'),
(4, 'Luis Perez', 'luis@yahoo.com', 'luis07', 'zxcvb', '2299330347', 'Colonia Carranza', 2, 'img_8f56e4764ddf911cef3ae10662d78c5e.jpg'),
(5, 'Pedro Suarez.', 'pedro@gmail.com', 'pedro', 'qwert', '921305969', 'Infonavit Buena Vista', 2, 'img_0455a838074b63e0d883658dbb373950.jpg'),
(7, 'Oscar Lopez', 'oscar@prodigy.com', 'oscar', 'oscar', '2291475643', 'Su casa', 2, 'img_usuario.png'),
(8, 'Julio Hernandez', 'julio@prodigy.com', 'julioCR7', 'asdfg', '2292345678', 'Su casa', 2, 'img_usuario.png'),
(9, 'Luis', 'Lopez@gmail.com', 'lopez02', 'asdfgh', '123456789', 'su casa', 2, 'img_8368cabce2513f18c1940ae49a29bfb6.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`iddatos`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `nombre_motivo` (`motivo`),
  ADD KEY `tipo_registro` (`tipo_registro`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idinventario`),
  ADD KEY `r_login` (`r_usuario`),
  ADD KEY `r_usuario` (`r_usuario`),
  ADD KEY `r_datos` (`r_datos`);

--
-- Indices de la tabla `motivo`
--
ALTER TABLE `motivo`
  ADD PRIMARY KEY (`idmotivo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tipo_registro`
--
ALTER TABLE `tipo_registro`
  ADD PRIMARY KEY (`idtipo_registro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `iddatos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idinventario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `motivo`
--
ALTER TABLE `motivo`
  MODIFY `idmotivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_registro`
--
ALTER TABLE `tipo_registro`
  MODIFY `idtipo_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos`
--
ALTER TABLE `datos`
  ADD CONSTRAINT `datos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datos_ibfk_2` FOREIGN KEY (`tipo_registro`) REFERENCES `tipo_registro` (`idtipo_registro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datos_ibfk_3` FOREIGN KEY (`motivo`) REFERENCES `motivo` (`idmotivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_10` FOREIGN KEY (`r_datos`) REFERENCES `datos` (`iddatos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_ibfk_9` FOREIGN KEY (`r_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
