-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2024 a las 20:53:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Base de datos: `sayafit`
CREATE DATABASE IF NOT EXISTS `sayafit` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sayafit`;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `producto`
CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `producto`
INSERT INTO `producto` (`id`, `nombre`, `precio`, `stock`, `descripcion`, `imagen`) VALUES
(1, 'creatina integral', 25.00, 4, 'es un elemento para la salud', 'ae97a9aff69379f61b91ef5ea6796b4a.jpg'),
(20, 'Proteina nueva', 123.00, 2, 'Cosas bonitas de esta proteina', '057cf4f8121aeaa1796788ea3d88883f.jpg'),
(21, 'Pesas', 29.99, 10, 'Conjunto de pesas de 10 kg', 'pesas.jpg'),
(22, 'Barras', 19.99, 15, 'Barra de levantamiento de pesas de acero', 'barras.jpg'),
(23, 'Cinta de correr', 399.99, 5, 'Cinta de correr eléctrica para ejercicios cardiovasculares', 'cinta_correr.jpg');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `usuarios`
INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`) VALUES
(2, 'Rodolfa', 'santanaquintanai7@gmail.com', '$2y$10$Bbt4bUjNFphVljvQ3.9PCO8oVY5rhswvX7WR9vwYE/zDqLjjRiNHa'),
(3, 'Rodolfa', 'santanaquintanai@gmail.com', '$2y$10$fg1VOoJdM7BxAav3xeTmTu1JuA0y393AF0bHeUS73ehPlP36x01cO'),
(4, 'Amado', 'amadosantana@gmail.com', '$2y$10$OHngyXAu.bawynPvtkrXI.4dxplHqStMxXqR/smv9sb.4Ewic1jI6'),
(5, 'Amado23', 'amados@gmail.com', '$2y$10$/zTsv47O0LpZOnbBAH6p2ujo24wgVTqlFbxJgTSDSPH88Kgbx0QZ.');

-- Índices para tablas volcadas

-- Indices de la tabla `producto`
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `usuarios`
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT de las tablas volcadas

-- AUTO_INCREMENT de la tabla `producto`
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

-- AUTO_INCREMENT de la tabla `usuarios`
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

COMMIT;

-- Crear tabla para los pedidos
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear tabla para los detalles del pedido
CREATE TABLE `detalles_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_pedido`) REFERENCES `pedidos`(`id`),
  FOREIGN KEY (`id_producto`) REFERENCES `producto`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
