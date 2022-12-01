-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2022 a las 19:43:47
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcarritocompras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL,
  `cofecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`, `cofecha`, `idusuario`) VALUES
(18, '2022-11-25 11:56:40', 3),
(19, '2022-11-25 14:29:17', 3),
(20, '2022-11-30 07:10:24', 6),
(21, '2022-11-30 07:17:54', 7),
(22, '2022-11-30 07:18:26', 7),
(23, '2022-12-01 22:00:53', 9),
(24, '2022-12-01 22:18:17', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestado`
--

CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT current_timestamp(),
  `cefechafin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `compraestado`
--

INSERT INTO `compraestado` (`idcompraestado`, `idcompra`, `idcompraestadotipo`, `cefechaini`, `cefechafin`) VALUES
(9, 18, 4, '2022-11-25 15:15:19', '0000-00-00 00:00:00'),
(10, 19, 1, '2022-11-25 23:22:36', '0000-00-00 00:00:00'),
(11, 20, 4, '2022-11-30 07:10:24', '0000-00-00 00:00:00'),
(12, 20, 0, '2022-11-30 07:10:24', '2022-11-30 07:10:33'),
(13, 20, 1, '2022-11-30 07:10:24', '2022-11-30 07:12:24'),
(14, 20, 4, '2022-11-30 07:10:24', '2022-11-30 07:12:59'),
(15, 21, 1, '2022-11-30 07:17:54', '0000-00-00 00:00:00'),
(16, 21, 0, '2022-11-30 07:17:54', '2022-11-30 07:18:16'),
(17, 22, 0, '2022-11-30 07:18:26', '2022-11-30 07:18:56'),
(18, 20, 1, '2022-11-30 07:10:24', '2022-11-30 07:24:34'),
(19, 23, 3, '2022-12-01 22:00:53', '0000-00-00 00:00:00'),
(20, 23, 0, '2022-12-01 22:00:53', '2022-12-01 22:03:12'),
(21, 24, 1, '2022-12-01 22:18:17', '0000-00-00 00:00:00'),
(22, 24, 0, '2022-12-01 22:18:17', '2022-12-01 22:18:27'),
(23, 23, 1, '2022-12-01 22:00:53', '2022-12-01 22:33:51'),
(24, 23, 2, '2022-12-01 22:00:53', '2022-12-01 22:34:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestadotipo`
--

CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(0, 'Borrador', 'Cuando los items estan en el carrito'),
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraitem`
--

CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `compraitem`
--

INSERT INTO `compraitem` (`idcompraitem`, `idproducto`, `idcompra`, `cicantidad`) VALUES
(3, 6, 18, 3),
(4, 5, 19, 1),
(5, 4, 19, 3),
(6, 8, 20, 7),
(7, 6, 21, 1),
(8, 11, 21, 1),
(9, 7, 22, 1),
(10, 6, 23, 2),
(11, 7, 23, 1),
(12, 4, 24, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL,
  `menombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu',
  `medescripcion` varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idpadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `medeshabilitado` timestamp NULL DEFAULT NULL COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez',
  `script` varchar(200) DEFAULT NULL COMMENT 'Script que hace referencia a la vista del menu.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`, `script`) VALUES
(1, 'Productos', 'Vista de Productos', NULL, NULL, 'Productos.php'),
(12, 'Compras', 'Vista de Compras', NULL, NULL, NULL),
(13, 'Gestion', 'Vista de Gestion', NULL, NULL, NULL),
(14, 'Productos 3D', 'Vista de Productos 3D', 1, NULL, 'Productos3D.php'),
(15, 'Productos 2D', 'Vista de Productos 2D', 1, NULL, 'Productos2D.php'),
(16, 'Accesorios', 'Vista de Accesorios', 1, NULL, 'Accesorios.php'),
(17, 'Mis compras', 'Vista de mis Compras', 12, NULL, 'MisCompras.php'),
(19, 'Gestion de Usuarios', 'Vista de gestion de usuarios', 13, NULL, 'GestionUsuarios.php'),
(20, 'Gestion de Menu', 'Vista de gestion de menu', 13, NULL, 'GestionMenu.php'),
(21, 'Administrar Productos', 'Vista admin productos', 1, NULL, 'AdminProductos.php'),
(22, 'Gestion de Compras', 'Vista de Compras', 12, NULL, 'GestionCompras.php'),
(23, 'PATO', 'para patos', NULL, '2022-12-01 22:43:07', 'home.php'),
(24, 'patito', 'para patitoz', 23, '0000-00-00 00:00:00', 'home.php'),
(25, 'MICHAa', 'para michis', NULL, '2022-12-01 01:29:10', '<?  echo $menuModificar->getScript(); ?>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menurol`
--

CREATE TABLE `menurol` (
  `idmenurol` bigint(20) NOT NULL,
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `menurol`
--

INSERT INTO `menurol` (`idmenurol`, `idmenu`, `idrol`) VALUES
(1, 1, 3),
(2, 1, 2),
(3, 1, 1),
(4, 14, 3),
(5, 15, 3),
(6, 16, 3),
(7, 21, 2),
(10, 19, 1),
(11, 20, 1),
(12, 14, 1),
(13, 15, 1),
(14, 16, 1),
(15, 12, 3),
(16, 17, 3),
(17, 13, 1),
(18, 22, 2),
(19, 12, 2),
(20, 23, 1),
(21, 24, 1),
(22, 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `pronombre` varchar(512) NOT NULL,
  `prodetalle` varchar(512) NOT NULL,
  `proprecio` int(11) NOT NULL,
  `procantstock` int(11) NOT NULL,
  `protipo` varchar(512) NOT NULL,
  `proimagen` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `pronombre`, `prodetalle`, `proprecio`, `procantstock`, `protipo`, `proimagen`) VALUES
(1, 'Aros Hito Hito no mi', 'Aros impresos 3D de One Piece', 800, 14, '', 'Assets/Img/Accesorios/Aritos Hito Hito no mi.jpeg'),
(2, 'Llaveros varios', 'Llaveros de acrílico con una imagen dentro', 300, 100, '', 'Assets/Img/Accesorios/Llaveros.jpeg'),
(3, 'Pins varios', 'Pins de pla con una imagen a elecci&oacute;n dentro', 300, 344, 'Accesorio', 'Assets/Img/Accesorios/Pins.jpeg'),
(4, 'Stickers surtidos', 'Stickers de varios animes, juegos, etc. Se venden de a 3 unidades', 100, 1041, '2D', 'Assets/Img/P2D/Stickers.jpeg'),
(5, 'Tarjetas Genshin Impact', 'Tarjetas del juego Genshin Impact, vienen con un soporte impreso 3D de color surtido', 300, 144, '2D', 'Assets/Img/P2D/Tarjetas Genshin.jpeg'),
(6, 'Anya', 'Figura 3D de Anya Forger, 10cm de alto', 1500, 4, '3D', 'Assets/Img/P3D/Anya.jpeg'),
(7, 'Bo', 'Figura 3D de Bo, de Studio Ghibli, 10cm de alto', 1200, 0, '3D', 'Assets/Img/P3D/Bo.jpeg'),
(8, 'Bulbasaur', 'Figura 3D de Bulbasaur, 8cm de alto. Puede pedirse Shiny', 1200, 18, '3D', 'Assets/Img/P3D/Bulbasaur.jpeg'),
(9, 'Chopper', 'Figura 3D de Chopper, 15cm de alto', 2000, 4, '3D', 'Assets/Img/P3D/Chopper.jpeg'),
(10, 'Eevee', 'Figura 3D de Eevee, 8cm de alto. Puede pedirse Shiny', 1200, 12, '3D', 'Assets/Img/P3D/Eevee.jpeg'),
(11, 'Gengar', 'Figura 3D de Gengar, 8cm de alto', 1200, 7, '3D', 'Assets/Img/P3D/Gengar.jpeg'),
(12, 'Eva 01', 'Figura 3D del Eva 01, 15cm de alto', 2500, 3, '3D', 'Assets/Img/P3D/Eva 01.jpeg'),
(13, 'Totoro', 'Figura 3D de Totoro, 15cm de alto', 2000, 7, '3D', 'Assets/Img/P3D/Totoro.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `rodescripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rodescripcion`) VALUES
(1, 'Administrador'),
(2, 'Deposito'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `usnombre` varchar(50) NOT NULL,
  `uspass` varchar(150) NOT NULL,
  `usmail` varchar(50) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES
(1, 'Administrador', 'admin123', 'admin@mail.com', '0000-00-00 00:00:00'),
(2, '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00 00:00:00'),
(3, 'marty', '5fa9db2e335ef69a4eeb9fe7974d61f4', 'mar', '0000-00-00 00:00:00'),
(4, 'marmarlis', '1a1233cfb69d7f27211e36aff9ec373a', 'marmarlis@gmail.com', '0000-00-00 00:00:00'),
(5, 'pato', '259823af837e251e560ca1158a4e77c7', 'pato@gmail.com', '2022-11-30 21:52:03'),
(6, 'cliente', '4983a0ab83ed86e0e7213c8783940193', 'cliente@gmail.com', '0000-00-00 00:00:00'),
(7, 'nuevo', 'e26c062fedf6b32834e4de93f9c8b644', 'nuevo@gmail.com', '0000-00-00 00:00:00'),
(8, 'pato1', '92b9cf943c1ddd0fe6214a01fb0fb855', 'pato1@gmail.com', '0000-00-00 00:00:00'),
(9, 'micaela', 'aea2c5e8317b1eeab8a6c4e6f6ef8299', 'micaela@gmail.com', '0000-00-00 00:00:00'),
(10, 'qwerty', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'qwerty@gmail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuariorol` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuariorol`
--

INSERT INTO `usuariorol` (`idusuariorol`, `idusuario`, `idrol`) VALUES
(2, 2, 1),
(3, 3, 3),
(50, 3, 2),
(52, 3, 1),
(59, 1, 1),
(60, 1, 2),
(61, 1, 3),
(62, 4, 1),
(63, 4, 2),
(64, 4, 3),
(65, 5, 1),
(66, 6, 3),
(67, 7, 3),
(68, 8, 1),
(69, 9, 1),
(70, 10, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);

--
-- Indices de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);

--
-- Indices de la tabla `compraestadotipo`
--
ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);

--
-- Indices de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);

--
-- Indices de la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenurol`),
  ADD KEY `idmenu` (`idmenu`),
  ADD KEY `idrol` (`idrol`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuariorol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `menurol`
--
ALTER TABLE `menurol`
  MODIFY `idmenurol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  MODIFY `idusuariorol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD CONSTRAINT `menurol_ibfk_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `menurol_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `usuariorol_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
