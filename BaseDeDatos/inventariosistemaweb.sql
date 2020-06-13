-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2020 a las 01:28:44
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
  `no_serie` int(11) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `tipo_registro` int(11) DEFAULT NULL,
  `motivo` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `departamento` text,
  `ubicacion_fisica` text,
  `ubicacion_sistema` text,
  `dateadd` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `motivo` varchar(50) DEFAULT NULL
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
  `tipo_registro` varchar(45) DEFAULT NULL
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
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `telefono`, `direccion`, `rol`) VALUES
(1, 'user', 'user@gmail.com', 'user', '123', NULL, NULL, 1),
(2, 'aldo', 'aldo@gmail.com', 'aldo', '123', NULL, NULL, 2),
(3, 'adolfo', 'adolfo@gmail.com', 'adolfo', 'abcd', NULL, NULL, 2);

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
  MODIFY `iddatos` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos`
--
ALTER TABLE `datos`
  ADD CONSTRAINT `datos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datos_ibfk_2` FOREIGN KEY (`motivo`) REFERENCES `motivo` (`idmotivo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datos_ibfk_3` FOREIGN KEY (`tipo_registro`) REFERENCES `tipo_registro` (`idtipo_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

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
