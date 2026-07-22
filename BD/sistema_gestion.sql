-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2026 a las 00:21:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_gestion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficio`
--

CREATE TABLE `beneficio` (
  `idbeneficio` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `beneficio`
--

INSERT INTO `beneficio` (`idbeneficio`, `nombre`, `fecha_inicio`, `fecha_fin`, `estado`, `descripcion`) VALUES
(1, 'Beca Académicafdasfds', '2026-01-01', '2026-12-31', 0, 'Descuento del 50% por excelencia académica'),
(2, 'Apoyo Alimentario', '2026-02-01', '2026-11-30', 1, 'Entrega de vales de alimentación'),
(3, 'Útiles Escolares', '2026-03-01', '2026-12-15', 1, 'Entrega de kit escolar'),
(4, 'Transporte Escolar', '2026-01-15', '2026-12-15', 1, 'Subsidio de transporte'),
(5, 'Beneficio Deportivo', '2026-04-01', '2026-10-31', 0, 'Apoyo para actividades deportivas'),
(6, 'Beca Académica 2', '2026-01-01', '2026-12-31', 0, ''),
(7, 'Beca Académica 222', '2026-01-01', '2026-12-31', 1, ''),
(8, 'hdwasudhnwñawdm', '2026-07-16', '2028-11-17', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficio_producto`
--

CREATE TABLE `beneficio_producto` (
  `idproductos` int(11) NOT NULL,
  `idbeneficio` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `beneficio_producto`
--

INSERT INTO `beneficio_producto` (`idproductos`, `idbeneficio`, `cantidad`) VALUES
(2, 3, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `idproductos` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`idproductos`, `idventa`, `cantidad`, `precio_unitario`, `fecha_entrega`) VALUES
(1, 7, 5, 8.50, NULL),
(1, 9, 1, 8.50, NULL),
(1, 10, 1, 8.50, NULL),
(4, 6, 12, 85.00, NULL),
(4, 8, 3, 85.00, NULL),
(4, 11, 1, 85.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `historial_id` int(11) NOT NULL,
  `beneficio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_inscripto` date DEFAULT NULL,
  `estado` enum('Pendiente','Aprobado','Rechazado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`historial_id`, `beneficio_id`, `usuario_id`, `fecha_inscripto`, `estado`) VALUES
(0, 2, 1, '2026-07-07', 'Rechazado'),
(0, 2, 3, '2026-07-18', 'Rechazado'),
(0, 2, 6, '2026-07-21', 'Rechazado'),
(0, 2, 12, '2026-07-22', 'Pendiente'),
(0, 3, 1, '2026-07-07', 'Rechazado'),
(0, 3, 8, '2026-07-21', 'Pendiente'),
(0, 4, 1, '2026-07-07', 'Rechazado'),
(1, 1, 1, '2026-01-20', NULL),
(2, 2, 2, '2026-02-15', NULL),
(3, 3, 3, '2026-03-02', NULL),
(4, 4, 4, '2026-01-28', NULL),
(5, 1, 5, '2026-02-10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproductos` int(11) NOT NULL,
  `nombre_prod` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock_inicial` int(11) DEFAULT NULL,
  `stock_actual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproductos`, `nombre_prod`, `precio`, `stock_inicial`, `stock_actual`) VALUES
(1, 'Cuaderno A4', 8.50, 100, 78),
(2, 'Lápiz HB', 1.50, 300, 250),
(3, 'Mochila Escolar', 65.00, 40, 32),
(4, 'Calculadora Científica', 85.00, 25, 4),
(5, 'Uniforme Escolar', 120.00, 50, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `rol` enum('admin','vendedor','usuario') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `apellido`, `dni`, `telefono`, `email`, `direccion`, `password_hash`, `rol`) VALUES
(1, 'Juan', 'Pérez', '12345678', '987654321', 'juan@escuela.edu', 'Av. Los Pinos 123', 'hash123', 'admin'),
(2, 'María', 'Gómez', '23456789', '987654322', 'maria@escuela.edu', 'Jr. Lima 456', 'hash123', 'vendedor'),
(3, 'Carlos', 'Rojas', '34567890', '987654323', 'carlos@escuela.edu', 'Av. Central 789', 'hash123', 'usuario'),
(4, 'Ana', 'Torres', '45678901', '987654324', 'ana@escuela.edu', 'Calle Sol 321', 'hash123', 'usuario'),
(5, 'Luis', 'Mendoza', '56789012', '987654325', 'luis@escuela.edu', 'Av. Primavera 654', 'hash123', 'vendedor'),
(6, 'andres', 'sandoval', '46559654', '3408332211', 'andress.sandoval@gmail.com', 'calle 123', '$2y$10$U1SHa39SFbBT3IBRplrWguPZJQ8isgvKWIewLlLO9Y8C5TV/oJLDm', 'admin'),
(7, 'juan', 'lopez', '32112345', '3408776655', 'juan@gmail.com', 'calle 444', '$2y$10$I6haWcLOsQbm6K./ZCaKNuE4UCxL8Og/xMfVvcRzOVa1pDBTbACNK', 'vendedor'),
(8, 'jose', 'lopez', '11111111', '3408675444', 'jose@gmail.com', 'calle 777', '$2y$10$jhTr734TyS/gHxNFraE1o.WsuDhbEE5TWbdcMr0XK2WbIz5dGNnd2', 'usuario'),
(9, 'profesores', 'Neldo y Rosalba', '10000000', '3400000000', 'admin@gmail.com', 'calle 1234', '$2y$10$y6E8rEzjXcenxKDPBy/Ka.1jYFfxbcG1G1/Giq3HjXoMgJb32UHH2', 'admin'),
(11, 'profesores', 'Neldo y Rosalba', '10000001', '3400000000', 'vendedor@gmail.com', 'calle 1234', '$2y$10$WvEymtxWa00.3UEqsDzLTeha6uoiYvsWgX3iXQW7YOiMt4mROZ1a.', 'vendedor'),
(12, 'profesores', 'Neldo y Rosalba', '10000011', '3400000000', 'usuario@gmail.com', 'calle 1234', '$2y$10$/hoG0piVuv364PNiev3NPOIip.QzMKEW0EOahyYmmz53RvxR2aKG.', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `estado_venta` enum('Pagada','Pendiente','Entregada','Cancelada','Registrada') DEFAULT NULL,
  `fecha_venta` date DEFAULT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `monto`, `estado_venta`, `fecha_venta`, `idusuario`) VALUES
(1, 17.00, 'Entregada', '2026-03-10', 1),
(2, 65.00, 'Pendiente', '2026-03-12', 2),
(3, 120.00, 'Pagada', '2026-03-15', 3),
(4, 85.00, 'Cancelada', '2026-03-18', 4),
(5, 137.00, 'Entregada', '2026-03-20', 5),
(6, 1020.00, '', '2026-07-21', 6),
(7, 42.50, 'Registrada', '2026-07-21', 6),
(8, 255.00, 'Registrada', '2026-07-21', 7),
(9, 8.50, 'Registrada', '2026-07-21', 7),
(10, 8.50, 'Registrada', '2026-07-21', 7),
(11, 85.00, 'Registrada', '2026-07-22', 11);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficio`
--
ALTER TABLE `beneficio`
  ADD PRIMARY KEY (`idbeneficio`);

--
-- Indices de la tabla `beneficio_producto`
--
ALTER TABLE `beneficio_producto`
  ADD PRIMARY KEY (`idproductos`,`idbeneficio`),
  ADD KEY `fk_productos_has_beneficio_beneficio1_idx` (`idbeneficio`),
  ADD KEY `fk_productos_has_beneficio_productos1_idx` (`idproductos`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`idproductos`,`idventa`),
  ADD KEY `fk_productos_has_venta_venta1_idx` (`idventa`),
  ADD KEY `fk_productos_has_venta_productos_idx` (`idproductos`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`historial_id`,`beneficio_id`,`usuario_id`),
  ADD KEY `fk_beneficio_has_usuarios_beneficio1_idx` (`beneficio_id`),
  ADD KEY `fk_beneficio_has_usuarios_usuarios1_idx` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproductos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_venta_usuarios1_idx` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beneficio`
--
ALTER TABLE `beneficio`
  MODIFY `idbeneficio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficio_producto`
--
ALTER TABLE `beneficio_producto`
  ADD CONSTRAINT `fk_productos_has_beneficio_beneficio1` FOREIGN KEY (`idbeneficio`) REFERENCES `beneficio` (`idbeneficio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_beneficio_productos1` FOREIGN KEY (`idproductos`) REFERENCES `productos` (`idproductos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_productos_has_venta_productos` FOREIGN KEY (`idproductos`) REFERENCES `productos` (`idproductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_venta_venta1` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_beneficio_has_usuarios_beneficio1` FOREIGN KEY (`beneficio_id`) REFERENCES `beneficio` (`idbeneficio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_beneficio_has_usuarios_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
