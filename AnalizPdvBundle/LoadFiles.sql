-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 21 2016 г., 22:23
-- Версия сервера: 5.6.22-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `LoadFiles`
--
CREATE DATABASE IF NOT EXISTS `LoadFiles` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `LoadFiles`;

-- --------------------------------------------------------

--
-- Структура таблицы `Erpn_out`
--

DROP TABLE IF EXISTS `Erpn_out`;
CREATE TABLE IF NOT EXISTS `Erpn_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_invoice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_create_invoice` date NOT NULL,
  `date_reg_invoice` date NOT NULL,
  `type_invoice_full` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `edrpou_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inn_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_branch_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suma_invoice` double(15,2) NOT NULL,
  `pdvinvoice` double(15,2) DEFAULT NULL,
  `baza_invoice` double(15,2) NOT NULL,
  `name_vendor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_branch_vendor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_reg_invoice` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `type_invoice` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_contract` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_contract` date DEFAULT NULL,
  `type_contract` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_create_invoice` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_field` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Key_fields` (`num_invoice`,`date_create_invoice`,`type_invoice_full`,`inn_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=182262 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Erpn_out_load`
--

DROP TABLE IF EXISTS `Erpn_out_load`;
CREATE TABLE IF NOT EXISTS `Erpn_out_load` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_invoice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_create_invoice` date NOT NULL,
  `date_reg_invoice` date NOT NULL,
  `type_invoice_full` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `edrpou_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inn_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_branch_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suma_invoice` decimal(10,2) NOT NULL,
  `pdvinvoice` decimal(10,2) DEFAULT NULL,
  `baza_invoice` decimal(10,2) NOT NULL,
  `name_vendor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_branch_vendor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_reg_invoice` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `type_invoice` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_contract` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_contract` date DEFAULT NULL,
  `type_contract` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_create_invoice` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_field` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key_fields` (`num_invoice`,`date_create_invoice`,`type_invoice_full`,`inn_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Erpn_out_temp`
--

DROP TABLE IF EXISTS `Erpn_out_temp`;
CREATE TABLE IF NOT EXISTS `Erpn_out_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_invoice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_create_invoice` date NOT NULL,
  `date_reg_invoice` date NOT NULL,
  `type_invoice_full` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `edrpou_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inn_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_branch_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suma_invoice` decimal(10,2) NOT NULL,
  `pdvinvoice` decimal(10,2) DEFAULT NULL,
  `baza_invoice` decimal(10,2) NOT NULL,
  `name_vendor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_branch_vendor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_reg_invoice` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `type_invoice` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_contract` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_contract` date DEFAULT NULL,
  `type_contract` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_create_invoice` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_field` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=80001 ;

--
-- Триггеры `Erpn_out_temp`
--
DROP TRIGGER IF EXISTS `insert_erpn_out_temp`;
DELIMITER //
CREATE TRIGGER `insert_erpn_out_temp` AFTER INSERT ON `Erpn_out_temp`
 FOR EACH ROW BEGIN
DECLARE cnt INTEGER;
SELECT COUNT('id') INTO cnt FROM Erpn_out WHERE Erpn_out.num_invoice = NEW.num_invoice
AND  Erpn_out.date_create_invoice = NEW.date_create_invoice 
AND  Erpn_out.inn_client = NEW.inn_client 
AND Erpn_out.type_invoice_full = NEW.type_invoice_full;
SET @key_field=CONCAT_WS('/',NEW.num_invoice,NEW.type_invoice_full,NEW.date_create_invoice,NEW.inn_client);
IF(cnt=0) THEN 
INSERT INTO Erpn_out (num_invoice,date_create_invoice,date_reg_invoice,
type_invoice_full,edrpou_client,inn_client,num_branch_client,name_client,
suma_invoice,pdvinvoice,baza_invoice,name_vendor,num_branch_vendor,num_reg_invoice,
type_invoice,num_contract,date_contract,type_contract,person_create_invoice,
key_field) 
VALUES(NEW.num_invoice,NEW.date_create_invoice,NEW.date_reg_invoice,
NEW.type_invoice_full,NEW.edrpou_client,NEW.inn_client,NEW.num_branch_client,NEW.name_client,
NEW.suma_invoice,NEW.pdvinvoice,NEW.baza_invoice,NEW.name_vendor,NEW.num_branch_vendor,NEW.num_reg_invoice,
NEW.type_invoice,NEW.num_contract,NEW.date_contract,NEW.type_contract,NEW.person_create_invoice,
@key_field);
END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `LoadFile`
--

DROP TABLE IF EXISTS `LoadFile`;
CREATE TABLE IF NOT EXISTS `LoadFile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `upload_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type_file` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `description_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type_doc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `upload_date` datetime NOT NULL,
  `processing_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Структура таблицы `SprBranch`
--

DROP TABLE IF EXISTS `SprBranch`;
CREATE TABLE IF NOT EXISTS `SprBranch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_branch` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `name_branch` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `branch_adr` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `name_main_branch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `num_main_branch` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4296 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
