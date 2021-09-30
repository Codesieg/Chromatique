-- MySQL Script generated by MySQL Workbench
-- Fri Apr  2 18:41:30 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema chromatique
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema chromatique
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `chromatique` DEFAULT CHARACTER SET utf8 ;
USE `chromatique` ;

-- -----------------------------------------------------
-- Table `chromatique`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chromatique`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(64) NOT NULL COMMENT 'e-mail de l\'utilisateur',
  `password` VARCHAR(64) NOT NULL COMMENT 'mdp de l\'utilisateur',
  `pseudo` VARCHAR(64) NOT NULL,
  `avatar` VARCHAR(45) NULL,
  `role` ENUM('admin', 'reader', 'dev', 'uploader') NOT NULL DEFAULT 'reader' COMMENT 'Rôle du compte :\nAdmin\nDev\nReader\nUploader',
  `status` TINYINT(3) NULL DEFAULT 0 COMMENT '1 => actif 2 => désactivé/bloqué	',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chromatique`.`mangas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chromatique`.`mangas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `manga_name` VARCHAR(45) NULL COMMENT 'Nom du manga',
  `author` VARCHAR(45) NULL COMMENT 'Auteur du manga',
  `synopsis` MEDIUMTEXT NULL COMMENT 'Résumé du manga',
  `manga_jacket` VARCHAR(45) NOT NULL COMMENT 'Couverture du manga',
  `manga_banner` VARCHAR(45) NULL COMMENT 'bannière de page du manga',
  `home_order` INT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chromatique`.`tomes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chromatique`.`tomes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tome_name` VARCHAR(45) NOT NULL COMMENT 'nom du tome',
  `views` INT NULL COMMENT 'nombre de vue du manga',
  `rankings` INT NULL COMMENT 'note du manga',
  `tome_jacket` VARCHAR(45) NULL COMMENT 'couverture du tome',
  `tome_number` INT NULL COMMENT 'numero du tome',
  `id_manga` INT NULL COMMENT 'id du manga',
  `id_uploader` INT NULL COMMENT 'id de l\'utilisateur ayant le grade uploader',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`tome_name` ASC) ,
  INDEX `id_manga_idx` (`id_manga` ASC) ,
  INDEX `id_uploader_idx` (`id_uploader` ASC) ,
  CONSTRAINT `id_uploader`
    FOREIGN KEY (`id_uploader`)
    REFERENCES `chromatique`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_mangas`
    FOREIGN KEY (`id_manga`)
    REFERENCES `chromatique`.`mangas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chromatique`.`chapters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chromatique`.`chapters` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `chapter_name` VARCHAR(45) NULL COMMENT 'nom du chapitre',
  `chapter_number` INT NOT NULL COMMENT 'numero du chapitre',
  `id_tome` INT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `id_manga_idx` (`id_tome` ASC) ,
  CONSTRAINT `id_tome`
    FOREIGN KEY (`id_tome`)
    REFERENCES `chromatique`.`tomes` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chromatique`.`pages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chromatique`.`pages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `page_name` VARCHAR(256) NOT NULL,
  `page_number` INT NOT NULL,
  `id_chapter` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `update_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `id_chapter_idx` (`id_chapter` ASC) ,
  CONSTRAINT `id_chapter`
    FOREIGN KEY (`id_chapter`)
    REFERENCES `chromatique`.`chapters` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chromatique`.`users_historys`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chromatique`.`users_historys` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NOT NULL COMMENT 'identifiant de l\'utilisateur',
  `id_manga` INT NOT NULL COMMENT 'identifiant du manga',
  `id_chapter` INT NOT NULL COMMENT 'identifiant du chapitre',
  `id_tome` INT NOT NULL COMMENT 'identifiant du tome',
  `id_page` INT NOT NULL COMMENT 'numer de page',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  INDEX `id_user_idx` (`id_user` ASC) ,
  INDEX `id_chapter_idx` (`id_chapter` ASC) ,
  INDEX `id_tome_idx` (`id_tome` ASC) ,
  INDEX `id_manga_idx` (`id_manga` ASC) ,
  INDEX `id_pages_idx` (`id_page` ASC) ,
  CONSTRAINT `id_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `chromatique`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_manga`
    FOREIGN KEY (`id_manga`)
    REFERENCES `chromatique`.`mangas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_chapter`
    FOREIGN KEY (`id_chapter`)
    REFERENCES `chromatique`.`chapters` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_tome`
    FOREIGN KEY (`id_tome`)
    REFERENCES `chromatique`.`tomes` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_pages`
    FOREIGN KEY (`id_page`)
    REFERENCES `chromatique`.`pages` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
