-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 08-10-2022 a las 03:09:54
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `williams`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `caja_id` int(5) NOT NULL,
  `caja_numero` int(5) NOT NULL,
  `caja_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `caja_estado` varchar(17) COLLATE utf8_spanish2_ci NOT NULL,
  `caja_efectivo` decimal(30,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id_catalogo` int(11) NOT NULL,
  `fecha_catalogo` date NOT NULL,
  `detalle_catalogo` varchar(100) NOT NULL,
  `foto_catalogo` varchar(50) NOT NULL,
  `identificador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id_catalogo`, `fecha_catalogo`, `detalle_catalogo`, `foto_catalogo`, `identificador`) VALUES
(3, '2022-10-06', 'Nuevos estilos', 'G7F0I3F4B7-3.jpg', 'Caballero'),
(5, '2022-09-30', 'Estilo formal', 'C8U6T4Q7R3-3.jpg', 'Dama'),
(6, '2022-10-06', 'Estilo infantil', 'T2A7C7E4I9-4.jpg', 'Niños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(10) NOT NULL,
  `categoria_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_descripcion`, `categoria_estado`) VALUES
(1, 'Deportivo', 'Productos relacionados con el deporte y mas', 'Habilitada'),
(2, 'Casual', 'Para eventos de tipo estándar', 'Habilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(10) NOT NULL,
  `cliente_nombre` varchar(37) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_apellido` varchar(37) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_dni` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_fnacimiento` date DEFAULT NULL,
  `cliente_genero` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_celular` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_provincia` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_ciudad` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_direccion` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_clave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_foto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_cuenta_estado` varchar(17) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_nombre`, `cliente_apellido`, `cliente_dni`, `cliente_fnacimiento`, `cliente_genero`, `cliente_celular`, `cliente_provincia`, `cliente_ciudad`, `cliente_direccion`, `cliente_email`, `cliente_clave`, `cliente_foto`, `cliente_cuenta_estado`) VALUES
(1, 'Carlos', 'Jimenez', '1234567899', '2022-09-07', 'Masculino', '2346542817', 'Chimborazo', 'Riobamba', 'Riobamba', 'carlosjimenez32077@gmail.com', 'RzR3MENjQjBOWmNjZTRjakxOZEVtZz09', 'M8U6E1U0R1-1.jpg', 'Activa'),
(2, 'Carlos', 'Jimenez', '1900693886', '1995-02-23', 'Masculino', '0983667467', 'Zamora Chinchipe', 'Centinela', 'Av. Unidad Nacional', 'carloshack1995@gmail.com', 'RzR3MENjQjBOWmNjZTRjakxOZEVtZz09', 'V0Y0Z2X6Z2-2.jpg', 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `comentario_id` int(11) NOT NULL,
  `comentario_detalle` varchar(500) NOT NULL,
  `comentario_fecha` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`comentario_id`, `comentario_detalle`, `comentario_fecha`, `id_cliente`, `id_producto`) VALUES
(2, 'Producto de calidad', '2022-10-04', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_empresa`
--

CREATE TABLE `comentario_empresa` (
  `id_comentarios` int(11) NOT NULL,
  `fecha_comentario` date NOT NULL,
  `detalle_comentario` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario_empresa`
--

INSERT INTO `comentario_empresa` (`id_comentarios`, `fecha_comentario`, `detalle_comentario`, `id_cliente`) VALUES
(1, '2022-10-07', 'Excelente servicio', 2),
(2, '2022-10-07', 'Productos de calidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacado`
--

CREATE TABLE `destacado` (
  `id_destacado` int(11) NOT NULL,
  `numero_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(3) NOT NULL,
  `empresa_tipo_documento` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_numero_documento` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_nombre` varchar(90) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_impuesto_nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_impuesto_porcentaje` int(3) NOT NULL,
  `empresa_factura_impuestos` varchar(3) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `empresa_tipo_documento`, `empresa_numero_documento`, `empresa_nombre`, `empresa_telefono`, `empresa_email`, `empresa_direccion`, `empresa_impuesto_nombre`, `empresa_impuesto_porcentaje`, `empresa_factura_impuestos`) VALUES
(1, 'Ruc', '0000000000000', 'William', '000000000', 'william@gmail.com', 'default', '12', 12, '12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE `favorito` (
  `favorito_id` int(15) NOT NULL,
  `favorito_fecha` date NOT NULL,
  `cliente_id` int(10) NOT NULL,
  `producto_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `imagen_id` int(30) NOT NULL,
  `imagen_nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`imagen_id`, `imagen_nombre`, `producto_id`) VALUES
(5, 'F0N3N9V6Y1-2-1.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `detalle_pedido` varchar(100) NOT NULL,
  `total` decimal(30,2) NOT NULL,
  `estado_pedido` varchar(50) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `fecha_pedido`, `detalle_pedido`, `total`, `estado_pedido`, `id_cliente`) VALUES
(22, '2022-10-04', 'Deportiva clásica,', '43.71', 'Pendiente', 2),
(24, '2022-10-05', 'Zapatillas Running, Deportiva clásica,', '78.90', 'Pendiente', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL,
  `producto_codigo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_sku` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_descripcion` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_stock` int(10) NOT NULL,
  `producto_stock_minimo` int(10) NOT NULL,
  `producto_precio_compra` decimal(30,2) NOT NULL,
  `producto_precio_venta` decimal(30,2) NOT NULL,
  `producto_descuento` int(3) NOT NULL,
  `producto_tipo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_genero` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_tipo_persona` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_presentacion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_marca` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_modelo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_portada` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_sku`, `producto_nombre`, `producto_descripcion`, `producto_stock`, `producto_stock_minimo`, `producto_precio_compra`, `producto_precio_venta`, `producto_descuento`, `producto_tipo`, `producto_genero`, `producto_tipo_persona`, `producto_presentacion`, `producto_marca`, `producto_modelo`, `producto_estado`, `producto_portada`, `categoria_id`) VALUES
(2, '1234567890', '001', 'Deportiva clásica', 'Deportiva clásica suela relieve', 100, 10, '42.99', '43.99', 12, 'Digital', 'Masculino', 'Caballero', 'Unidad', 'Inside', 'Suela relieve', 'Habilitado', 'E6S1J3W9I8-2.png', 1),
(3, '1234567890-002', '002', 'Zapatillas Running', 'Zapatillas running Mujer Jogflow 500.K beige', 50, 10, '48.00', '49.99', 12, 'Digital', 'Femenino', 'Dama', 'Unidad', 'Kalenji', 'JOGFLOW', 'Habilitado', 'M3F1K0U3M2-2.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL,
  `detalle_promocion` varchar(100) NOT NULL,
  `descuento_promocion` int(3) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id_promocion`, `detalle_promocion`, `descuento_promocion`, `id_producto`) VALUES
(1, 'Viernes Negro', 20, 3),
(2, 'Viernes negro', 20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_nombre` varchar(37) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(37) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_dni` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_fnacimiento` date NOT NULL,
  `usuario_telefono` int(11) NOT NULL,
  `usuario_genero` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_cargo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_clave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_codigo` int(6) NOT NULL,
  `usuario_direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_cuenta_estado` varchar(17) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_foto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_dni`, `usuario_fnacimiento`, `usuario_telefono`, `usuario_genero`, `usuario_cargo`, `usuario_usuario`, `usuario_email`, `usuario_clave`, `usuario_codigo`, `usuario_direccion`, `usuario_cuenta_estado`, `usuario_foto`) VALUES
(2, 'adminCJ', 'admin', '1900693886', '1995-07-07', 123456789, 'Masculino', 'Administrador', 'admin', 'admin@gmail.com', 'VFBZMXRzeUsvN3RaWkJZdkZhMHNJUT09', 199527, 'Ecuador', 'Activa', 'X3E6G3G8P0-2.jpg'),
(3, 'Carlos', 'Jimenez', '1234567898', '1995-07-07', 234567829, 'Masculino', 'Administrador', 'cj95', 'carlosjimenez32077@gmail.com', 'UVZ1L3A0R3U4MHRJUy9UelhMSDVUZz09', 123456, 'Riobamba', 'Activa', 'Avatar_Male_4.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int(20) NOT NULL,
  `venta_codigo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_fecha` date NOT NULL,
  `venta_tipo_envio` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_comprobante` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_impuestos` decimal(30,2) NOT NULL,
  `venta_total` decimal(30,2) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `cliente_id` int(10) NOT NULL,
  `empresa_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`venta_id`, `venta_codigo`, `venta_fecha`, `venta_tipo_envio`, `venta_direccion`, `venta_comprobante`, `venta_impuestos`, `venta_total`, `pedido_id`, `cliente_id`, `empresa_id`) VALUES
(5, 'WV-001', '2022-10-05', 'Por definir', 'Riobamba', 'U4C3U1C9P7-1.png', '0.12', '79.02', 24, 2, 1),
(22, 'WV-002', '2022-10-05', 'Por definir', 'Riobamba', 'V4Z2Y7C5U1-2.png', '0.12', '43.83', 22, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `venta_detalle_id` int(20) NOT NULL,
  `venta_detalle_cantidad` int(10) NOT NULL,
  `venta_detalle_precio_compra` decimal(30,2) NOT NULL,
  `venta_detalle_precio_regular` decimal(30,2) NOT NULL,
  `venta_detalle_precio_venta` decimal(30,2) NOT NULL,
  `venta_detalle_total` decimal(30,2) NOT NULL,
  `venta_detalle_costo` decimal(30,2) NOT NULL,
  `venta_codigo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`caja_id`);

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id_catalogo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`comentario_id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `comentario_empresa`
--
ALTER TABLE `comentario_empresa`
  ADD PRIMARY KEY (`id_comentarios`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `destacado`
--
ALTER TABLE `destacado`
  ADD PRIMARY KEY (`id_destacado`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`favorito_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`imagen_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`detalle_pedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_promocion`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`),
  ADD UNIQUE KEY `venta_codigo` (`venta_codigo`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD KEY `venta_id` (`venta_codigo`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `caja_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentario_empresa`
--
ALTER TABLE `comentario_empresa`
  MODIFY `id_comentarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `destacado`
--
ALTER TABLE `destacado`
  MODIFY `id_destacado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `favorito`
--
ALTER TABLE `favorito`
  MODIFY `favorito_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `imagen_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario_empresa`
--
ALTER TABLE `comentario_empresa`
  ADD CONSTRAINT `comentario_empresa_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `destacado`
--
ALTER TABLE `destacado`
  ADD CONSTRAINT `destacado_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`),
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`);

--
-- Filtros para la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `promocion_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  ADD CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD CONSTRAINT `venta_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`),
  ADD CONSTRAINT `venta_detalle_ibfk_3` FOREIGN KEY (`venta_codigo`) REFERENCES `venta` (`venta_codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
