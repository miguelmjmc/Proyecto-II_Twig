-- MySQL Script generated by MySQL Workbench
-- 05/30/17 03:08:12
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema jemaro
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema jemaro
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `jemaro` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `jemaro` ;

-- -----------------------------------------------------
-- Table `jemaro`.`vehicleBrand`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`vehicleBrand` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vehicleBrand` VARCHAR(45) NOT NULL,
  `img` LONGBLOB NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `marca_vehiculo_UNIQUE` (`vehicleBrand` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`vehicleModel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`vehicleModel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vehicleName` VARCHAR(45) NOT NULL,
  `firstYear` YEAR NOT NULL,
  `lastYear` YEAR NOT NULL,
  `vehicleBrand_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_modelo_vehiculo_UNIQUE` (`id` ASC),
  INDEX `fk_vehicleModel_vehicleBrand1_idx` (`vehicleBrand_id` ASC),
  CONSTRAINT `fk_vehicleModel_vehicleBrand1`
    FOREIGN KEY (`vehicleBrand_id`)
    REFERENCES `jemaro`.`vehicleBrand` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productBrand`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productBrand` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `productBrand` VARCHAR(45) NOT NULL,
  `img` LONGBLOB NOT NULL,
  UNIQUE INDEX `idmarca_producto_UNIQUE` (`productBrand` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productClass`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productClass` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `productClass` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `tipo_producto_UNIQUE` (`productClass` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `offer` FLOAT NOT NULL,
  `price` FLOAT NOT NULL,
  `description` LONGTEXT NOT NULL,
  `code` VARCHAR(45) NOT NULL,
  `productClass_id` INT NOT NULL,
  `productBrand_id` INT NOT NULL,
  PRIMARY KEY (`code`, `productClass_id`, `productBrand_id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_product_productClass1_idx` (`productClass_id` ASC),
  INDEX `fk_product_productBrand1_idx` (`productBrand_id` ASC),
  CONSTRAINT `fk_product_productClass1`
    FOREIGN KEY (`productClass_id`)
    REFERENCES `jemaro`.`productClass` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_productBrand1`
    FOREIGN KEY (`productBrand_id`)
    REFERENCES `jemaro`.`productBrand` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productImage`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productImage` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `img` LONGBLOB NOT NULL,
  `product_code` VARCHAR(45) NOT NULL,
  `product_productClass_id` INT NOT NULL,
  `product_productBrand_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idimagen_producto_UNIQUE` (`id` ASC),
  INDEX `fk_productImage_product1_idx` (`product_code` ASC, `product_productClass_id` ASC, `product_productBrand_id` ASC),
  CONSTRAINT `fk_productImage_product1`
    FOREIGN KEY (`product_code` , `product_productClass_id` , `product_productBrand_id`)
    REFERENCES `jemaro`.`product` (`code` , `productClass_id` , `productBrand_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productCategory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productCategory` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `productCategory` VARCHAR(45) NOT NULL,
  UNIQUE INDEX `iddepartamento_producto_UNIQUE` (`productCategory` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`modelo_vehiculo_has_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`modelo_vehiculo_has_producto` (
  `modelo_vehiculo_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  PRIMARY KEY (`modelo_vehiculo_id`, `producto_id`),
  INDEX `fk_modelo_vehiculo_has_producto_producto1_idx` (`producto_id` ASC),
  INDEX `fk_modelo_vehiculo_has_producto_modelo_vehiculo1_idx` (`modelo_vehiculo_id` ASC),
  CONSTRAINT `fk_modelo_vehiculo_has_producto_modelo_vehiculo1`
    FOREIGN KEY (`modelo_vehiculo_id`)
    REFERENCES `jemaro`.`vehicleModel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modelo_vehiculo_has_producto_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `jemaro`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`configuration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`configuration` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name1` VARCHAR(45) NOT NULL,
  `name2` VARCHAR(45) NOT NULL,
  `rif` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone1` VARCHAR(45) NOT NULL,
  `phone2` VARCHAR(45) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `img` LONGBLOB NOT NULL,
  `facebook` VARCHAR(45) NOT NULL,
  `twitter` VARCHAR(45) NOT NULL,
  `googleplus` VARCHAR(45) NOT NULL,
  `skype` VARCHAR(45) NOT NULL,
  `youtube` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `name1_UNIQUE` (`name1` ASC),
  UNIQUE INDEX `name2_UNIQUE` (`name2` ASC),
  UNIQUE INDEX `rif_UNIQUE` (`rif` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `phone1_UNIQUE` (`phone1` ASC),
  UNIQUE INDEX `phone2_UNIQUE` (`phone2` ASC),
  UNIQUE INDEX `location_UNIQUE` (`location` ASC),
  UNIQUE INDEX `facebook_UNIQUE` (`facebook` ASC),
  UNIQUE INDEX `twitter_UNIQUE` (`twitter` ASC),
  UNIQUE INDEX `googleplus_UNIQUE` (`googleplus` ASC),
  UNIQUE INDEX `skype_UNIQUE` (`skype` ASC),
  UNIQUE INDEX `youtube_UNIQUE` (`youtube` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`slide`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`slide` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `number` VARCHAR(45) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `content` VARCHAR(720) NOT NULL,
  `link` VARCHAR(45) NOT NULL,
  `img` LONGBLOB NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idslides_UNIQUE` (`id` ASC),
  UNIQUE INDEX `number_UNIQUE` (`number` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`product_has_imagen_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`product_has_imagen_producto` (
  `product_id` INT NOT NULL,
  PRIMARY KEY (`product_id`),
  INDEX `fk_product_has_imagen_producto_product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_product_has_imagen_producto_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `jemaro`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`about`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`about` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`vehicleModel_has_product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`vehicleModel_has_product` (
  `vehicleModel_id` INT NOT NULL,
  `product_code` VARCHAR(45) NOT NULL,
  `product_productClass_id` INT NOT NULL,
  `product_productBrand_id` INT NOT NULL,
  PRIMARY KEY (`vehicleModel_id`, `product_code`, `product_productClass_id`, `product_productBrand_id`),
  INDEX `fk_vehicleModel_has_product_product1_idx` (`product_code` ASC, `product_productClass_id` ASC, `product_productBrand_id` ASC),
  INDEX `fk_vehicleModel_has_product_vehicleModel1_idx` (`vehicleModel_id` ASC),
  CONSTRAINT `fk_vehicleModel_has_product_vehicleModel1`
    FOREIGN KEY (`vehicleModel_id`)
    REFERENCES `jemaro`.`vehicleModel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehicleModel_has_product_product1`
    FOREIGN KEY (`product_code` , `product_productClass_id` , `product_productBrand_id`)
    REFERENCES `jemaro`.`product` (`code` , `productClass_id` , `productBrand_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productCategory_has_productClass`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productCategory_has_productClass` (
  `productCategory_id` INT NOT NULL,
  `productClass_id` INT NOT NULL,
  PRIMARY KEY (`productCategory_id`, `productClass_id`),
  INDEX `fk_productCategory_has_productClass_productClass1_idx` (`productClass_id` ASC),
  INDEX `fk_productCategory_has_productClass_productCategory1_idx` (`productCategory_id` ASC),
  CONSTRAINT `fk_productCategory_has_productClass_productCategory1`
    FOREIGN KEY (`productCategory_id`)
    REFERENCES `jemaro`.`productCategory` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productCategory_has_productClass_productClass1`
    FOREIGN KEY (`productClass_id`)
    REFERENCES `jemaro`.`productClass` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
