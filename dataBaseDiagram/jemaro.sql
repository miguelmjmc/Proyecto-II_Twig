-- MySQL Script generated by MySQL Workbench
-- 06/30/17 01:45:33
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
  `vehicleBrand` VARCHAR(45) NOT NULL,
  `vehicleBrandImg` LONGBLOB NOT NULL,
  `vehicleBrandImgType` VARCHAR(45) NOT NULL,
  UNIQUE INDEX `marca_vehiculo_UNIQUE` (`vehicleBrand` ASC),
  PRIMARY KEY (`vehicleBrand`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`vehicleModel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`vehicleModel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vehicleModel` VARCHAR(45) NOT NULL,
  `firstYear` YEAR NOT NULL,
  `lastYear` YEAR NOT NULL,
  `vehicleBrand` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_modelo_vehiculo_UNIQUE` (`id` ASC),
  INDEX `fk_vehicleModel_vehicleBrand1_idx` (`vehicleBrand` ASC),
  CONSTRAINT `fk_vehicleModel_vehicleBrand1`
    FOREIGN KEY (`vehicleBrand`)
    REFERENCES `jemaro`.`vehicleBrand` (`vehicleBrand`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productBrand`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productBrand` (
  `productBrand` VARCHAR(45) NOT NULL,
  `productBrandImg` LONGBLOB NOT NULL,
  `productBrandImgType` VARCHAR(45) NOT NULL,
  UNIQUE INDEX `idmarca_producto_UNIQUE` (`productBrand` ASC),
  PRIMARY KEY (`productBrand`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productClass`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productClass` (
  `productClass` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`productClass`),
  UNIQUE INDEX `tipo_producto_UNIQUE` (`productClass` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`product` (
  `offer` FLOAT NOT NULL,
  `price` FLOAT NOT NULL,
  `description` LONGTEXT NOT NULL,
  `stock` TINYINT(1) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  `productCode` VARCHAR(45) NOT NULL,
  `productBrand` VARCHAR(45) NOT NULL,
  `productClass` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`productCode`, `productBrand`, `productClass`),
  INDEX `fk_product_productBrand1_idx` (`productBrand` ASC),
  INDEX `fk_product_productClass1_idx` (`productClass` ASC),
  CONSTRAINT `fk_product_productBrand1`
    FOREIGN KEY (`productBrand`)
    REFERENCES `jemaro`.`productBrand` (`productBrand`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_productClass1`
    FOREIGN KEY (`productClass`)
    REFERENCES `jemaro`.`productClass` (`productClass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productImage`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productImage` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `productImg` LONGBLOB NOT NULL,
  `productImgType` VARCHAR(45) NOT NULL,
  `productCode` VARCHAR(45) NOT NULL,
  `productBrand` VARCHAR(45) NOT NULL,
  `productClass` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idimagen_producto_UNIQUE` (`id` ASC),
  INDEX `fk_productImage_product1_idx` (`productCode` ASC, `productBrand` ASC, `productClass` ASC),
  CONSTRAINT `fk_productImage_product1`
    FOREIGN KEY (`productCode` , `productBrand` , `productClass`)
    REFERENCES `jemaro`.`product` (`productCode` , `productBrand` , `productClass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productCategory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productCategory` (
  `productCategory` VARCHAR(45) NOT NULL,
  UNIQUE INDEX `iddepartamento_producto_UNIQUE` (`productCategory` ASC),
  PRIMARY KEY (`productCategory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`userType`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`userType` (
  `userType` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`userType`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`user` (
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(120) NOT NULL,
  `ci` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `adminImg` LONGBLOB NOT NULL,
  `adminImgType` VARCHAR(45) NOT NULL,
  `userType` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_user_userType1_idx` (`userType` ASC),
  CONSTRAINT `fk_user_userType1`
    FOREIGN KEY (`userType`)
    REFERENCES `jemaro`.`userType` (`userType`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`modelo_vehiculo_has_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`modelo_vehiculo_has_producto` (
  `modelo_vehiculo_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  PRIMARY KEY (`modelo_vehiculo_id`, `producto_id`),
  INDEX `fk_modelo_vehiculo_has_producto_modelo_vehiculo1_idx` (`modelo_vehiculo_id` ASC),
  CONSTRAINT `fk_modelo_vehiculo_has_producto_modelo_vehiculo1`
    FOREIGN KEY (`modelo_vehiculo_id`)
    REFERENCES `jemaro`.`vehicleModel` (`id`)
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
  `slogan` VARCHAR(45) NOT NULL,
  `rif` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone1` VARCHAR(45) NOT NULL,
  `phone2` VARCHAR(45) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `img` LONGBLOB NOT NULL,
  `imgType` VARCHAR(45) NOT NULL,
  `facebook` VARCHAR(45) NULL,
  `twitter` VARCHAR(45) NULL,
  `googleplus` VARCHAR(45) NULL,
  `skype` VARCHAR(45) NULL,
  `youtube` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
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
  `slideImg` LONGBLOB NOT NULL,
  `slideImgType` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idslides_UNIQUE` (`id` ASC),
  UNIQUE INDEX `number_UNIQUE` (`number` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`product_has_imagen_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`product_has_imagen_producto` (
  `product_id` INT NOT NULL,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`about`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`about` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `view` LONGTEXT NOT NULL,
  `mission` LONGTEXT NOT NULL,
  `values` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`productCategory_has_productClass`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`productCategory_has_productClass` (
  `productCategory` VARCHAR(45) NOT NULL,
  `productClass` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`productCategory`, `productClass`),
  INDEX `fk_productCategory_has_productClass_productClass1_idx` (`productClass` ASC),
  INDEX `fk_productCategory_has_productClass_productCategory1_idx` (`productCategory` ASC),
  CONSTRAINT `fk_productCategory_has_productClass_productCategory1`
    FOREIGN KEY (`productCategory`)
    REFERENCES `jemaro`.`productCategory` (`productCategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productCategory_has_productClass_productClass1`
    FOREIGN KEY (`productClass`)
    REFERENCES `jemaro`.`productClass` (`productClass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`vehicleModel_has_product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`vehicleModel_has_product` (
  `vehicleModel_id` INT NOT NULL,
  `productCode` VARCHAR(45) NOT NULL,
  `productBrand` VARCHAR(45) NOT NULL,
  `productClass` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`vehicleModel_id`, `productCode`, `productBrand`, `productClass`),
  INDEX `fk_vehicleModel_has_product_product1_idx` (`productCode` ASC, `productBrand` ASC, `productClass` ASC),
  INDEX `fk_vehicleModel_has_product_vehicleModel1_idx` (`vehicleModel_id` ASC),
  CONSTRAINT `fk_vehicleModel_has_product_vehicleModel1`
    FOREIGN KEY (`vehicleModel_id`)
    REFERENCES `jemaro`.`vehicleModel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehicleModel_has_product_product1`
    FOREIGN KEY (`productCode` , `productBrand` , `productClass`)
    REFERENCES `jemaro`.`product` (`productCode` , `productBrand` , `productClass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jemaro`.`history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jemaro`.`history` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME(0) NOT NULL,
  `action` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_history_user1_idx` (`email` ASC),
  CONSTRAINT `fk_history_user1`
    FOREIGN KEY (`email`)
    REFERENCES `jemaro`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
