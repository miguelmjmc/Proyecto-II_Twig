-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2017 a las 01:09:26
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `jemaro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `about`
--

CREATE TABLE IF NOT EXISTS `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `view` longtext NOT NULL,
  `mission` longtext NOT NULL,
  `values` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name1` varchar(45) NOT NULL,
  `name2` varchar(45) NOT NULL,
  `slogan` varchar(45) NOT NULL,
  `rif` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone1` varchar(45) NOT NULL,
  `phone2` varchar(45) NOT NULL,
  `location` varchar(180) NOT NULL,
  `img` longblob NOT NULL,
  `imgType` varchar(45) NOT NULL,
  `facebook` varchar(45) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `googleplus` varchar(45) DEFAULT NULL,
  `skype` varchar(45) DEFAULT NULL,
  `youtube` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `action` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_history_user1_idx` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `offer` float NOT NULL,
  `price` float NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `productImg` longblob NOT NULL,
  `productImgType` varchar(45) NOT NULL,
  `productCode` varchar(45) NOT NULL,
  `productBrand` varchar(45) NOT NULL,
  `productClass` varchar(45) NOT NULL,
  PRIMARY KEY (`productCode`,`productBrand`,`productClass`),
  KEY `fk_product_productBrand1_idx` (`productBrand`),
  KEY `fk_product_productClass1_idx` (`productClass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productbrand`
--

CREATE TABLE IF NOT EXISTS `productbrand` (
  `productBrand` varchar(45) NOT NULL,
  `productBrandImg` longblob NOT NULL,
  `productBrandImgType` varchar(45) NOT NULL,
  PRIMARY KEY (`productBrand`),
  UNIQUE KEY `idmarca_producto_UNIQUE` (`productBrand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productcategory`
--

CREATE TABLE IF NOT EXISTS `productcategory` (
  `productCategory` varchar(45) NOT NULL,
  PRIMARY KEY (`productCategory`),
  UNIQUE KEY `iddepartamento_producto_UNIQUE` (`productCategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productclass`
--

CREATE TABLE IF NOT EXISTS `productclass` (
  `productClass` varchar(45) NOT NULL,
  `productCategory` varchar(45) NOT NULL,
  PRIMARY KEY (`productClass`),
  UNIQUE KEY `tipo_producto_UNIQUE` (`productClass`),
  KEY `fk_productClass_productCategory1_idx` (`productCategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` varchar(720) NOT NULL,
  `link` varchar(90) NOT NULL,
  `slideImg` longblob NOT NULL,
  `slideImgType` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idslides_UNIQUE` (`id`),
  UNIQUE KEY `number_UNIQUE` (`number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(45) NOT NULL,
  `password` varchar(120) NOT NULL,
  `ci` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `adminImg` longblob NOT NULL,
  `adminImgType` varchar(45) NOT NULL,
  `userType` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_user_userType1_idx` (`userType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `userType` varchar(45) NOT NULL,
  PRIMARY KEY (`userType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiclebrand`
--

CREATE TABLE IF NOT EXISTS `vehiclebrand` (
  `vehicleBrand` varchar(45) NOT NULL,
  `vehicleBrandImg` longblob NOT NULL,
  `vehicleBrandImgType` varchar(45) NOT NULL,
  PRIMARY KEY (`vehicleBrand`),
  UNIQUE KEY `marca_vehiculo_UNIQUE` (`vehicleBrand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiclemodel`
--

CREATE TABLE IF NOT EXISTS `vehiclemodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleModel` varchar(45) NOT NULL,
  `firstYear` year(4) NOT NULL,
  `lastYear` year(4) NOT NULL,
  `vehicleBrand` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_modelo_vehiculo_UNIQUE` (`id`),
  KEY `fk_vehicleModel_vehicleBrand1_idx` (`vehicleBrand`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiclemodel_has_product`
--

CREATE TABLE IF NOT EXISTS `vehiclemodel_has_product` (
  `vehicleModel_id` int(11) NOT NULL,
  `productCode` varchar(45) NOT NULL,
  `productBrand` varchar(45) NOT NULL,
  `productClass` varchar(45) NOT NULL,
  PRIMARY KEY (`vehicleModel_id`,`productCode`,`productBrand`,`productClass`),
  KEY `fk_vehicleModel_has_product_product1_idx` (`productCode`,`productBrand`,`productClass`),
  KEY `fk_vehicleModel_has_product_vehicleModel1_idx` (`vehicleModel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_user1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_productBrand1` FOREIGN KEY (`productBrand`) REFERENCES `productbrand` (`productBrand`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_productClass1` FOREIGN KEY (`productClass`) REFERENCES `productclass` (`productClass`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `productclass`
--
ALTER TABLE `productclass`
  ADD CONSTRAINT `fk_productClass_productCategory1` FOREIGN KEY (`productCategory`) REFERENCES `productcategory` (`productCategory`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_userType1` FOREIGN KEY (`userType`) REFERENCES `usertype` (`userType`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiclemodel`
--
ALTER TABLE `vehiclemodel`
  ADD CONSTRAINT `fk_vehicleModel_vehicleBrand1` FOREIGN KEY (`vehicleBrand`) REFERENCES `vehiclebrand` (`vehicleBrand`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiclemodel_has_product`
--
ALTER TABLE `vehiclemodel_has_product`
  ADD CONSTRAINT `fk_vehicleModel_has_product_product1` FOREIGN KEY (`productCode`, `productBrand`, `productClass`) REFERENCES `product` (`productCode`, `productBrand`, `productClass`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vehicleModel_has_product_vehicleModel1` FOREIGN KEY (`vehicleModel_id`) REFERENCES `vehiclemodel` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
