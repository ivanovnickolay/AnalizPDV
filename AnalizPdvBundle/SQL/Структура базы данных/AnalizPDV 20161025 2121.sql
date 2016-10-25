--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 7.1.31.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 25.10.2016 21:21:52
-- Версия сервера: 5.7.13
-- Версия клиента: 4.1
--


-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE AnalizPDV;

--
-- Описание для таблицы erpn_in
--
DROP TABLE IF EXISTS erpn_in;
CREATE TABLE erpn_in (
  id INT(11) NOT NULL AUTO_INCREMENT,
  num_invoice VARCHAR(20) NOT NULL,
  date_create_invoice DATE NOT NULL,
  date_reg_invoice DATE NOT NULL,
  type_invoice_full VARCHAR(255) NOT NULL,
  edrpou_client VARCHAR(255) DEFAULT NULL,
  inn_client VARCHAR(255) NOT NULL,
  num_branch_client VARCHAR(255) DEFAULT NULL,
  name_client VARCHAR(500) NOT NULL,
  suma_invoice DOUBLE(15, 2) NOT NULL,
  pdvinvoice DOUBLE(15, 2) DEFAULT NULL,
  baza_invoice DOUBLE(15, 2) NOT NULL,
  name_vendor VARCHAR(500) NOT NULL,
  num_branch_vendor VARCHAR(255) DEFAULT NULL,
  num_reg_invoice VARCHAR(12) NOT NULL,
  type_invoice VARCHAR(2) DEFAULT NULL,
  num_contract VARCHAR(100) DEFAULT NULL,
  date_contract DATE DEFAULT NULL,
  type_contract VARCHAR(100) DEFAULT NULL,
  person_create_invoice VARCHAR(40) DEFAULT NULL,
  key_field VARCHAR(50) NOT NULL,
  rke_info VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX inn (inn_client),
  INDEX `key` (key_field),
  UNIQUE INDEX Key_fields (num_invoice, date_create_invoice, type_invoice_full, inn_client)
)
ENGINE = INNODB
AUTO_INCREMENT = 254017
AVG_ROW_LENGTH = 754
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом кредите по данным ЕРПН. Данные по данным Медка '
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы erpn_in_svod_inn
--
DROP TABLE IF EXISTS erpn_in_svod_inn;
CREATE TABLE erpn_in_svod_inn (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month INT(11) DEFAULT NULL,
  year INT(11) DEFAULT NULL,
  inn VARCHAR(255) NOT NULL,
  suma_invoice DOUBLE(15, 2) NOT NULL,
  pdvinvoice DOUBLE(15, 2) DEFAULT NULL,
  baza_invoice DOUBLE(15, 2) DEFAULT NULL,
  key_field VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX UK_Erpn_in_svod_inn_key_field (key_field)
)
ENGINE = INNODB
AUTO_INCREMENT = 194755
AVG_ROW_LENGTH = 125
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом кредите по данным ЕРПН на дату. Дата это или дата создания НН или дата НН которую уточняет РКЕ (вне зависимости от периода выписки РКЕ)'
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы Erpn_in_svod_inn_date_create
--
DROP TABLE IF EXISTS erpn_in_svod_inn_date_create;
CREATE TABLE erpn_in_svod_inn_date_create (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month_create INT(11) DEFAULT NULL,
  year_create INT(11) DEFAULT NULL,
  inn VARCHAR(255) DEFAULT NULL,
  numBranch VARCHAR(255) DEFAULT NULL,
  sum_pdv DECIMAL(15, 2) DEFAULT NULL,
  key_field VARCHAR(255) DEFAULT NULL,
  key_ VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  INDEX key_ (key_),
  INDEX vv (month_create, year_create, numBranch, inn)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
AVG_ROW_LENGTH = 93
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом кредите по данным ЕРПН на дату создания НН или РКЕ...'
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы erpn_out
--
DROP TABLE IF EXISTS erpn_out;
CREATE TABLE erpn_out (
  id INT(11) NOT NULL AUTO_INCREMENT,
  num_invoice VARCHAR(20) NOT NULL,
  date_create_invoice DATE NOT NULL,
  date_reg_invoice DATE NOT NULL,
  type_invoice_full VARCHAR(255) NOT NULL,
  edrpou_client VARCHAR(255) DEFAULT NULL,
  inn_client VARCHAR(255) NOT NULL,
  num_branch_client VARCHAR(255) DEFAULT NULL,
  name_client VARCHAR(500) NOT NULL,
  suma_invoice DOUBLE(15, 2) NOT NULL,
  pdvinvoice DOUBLE(15, 2) DEFAULT NULL,
  baza_invoice DOUBLE(15, 2) NOT NULL,
  name_vendor VARCHAR(500) NOT NULL,
  num_branch_vendor VARCHAR(255) DEFAULT NULL,
  num_reg_invoice VARCHAR(12) NOT NULL,
  type_invoice VARCHAR(2) DEFAULT NULL,
  num_contract VARCHAR(100) DEFAULT NULL,
  date_contract DATE DEFAULT NULL,
  type_contract VARCHAR(100) DEFAULT NULL,
  person_create_invoice VARCHAR(40) DEFAULT NULL,
  key_field VARCHAR(50) DEFAULT NULL,
  rke_info VARCHAR(200) DEFAULT NULL,
  num_main_branch VARCHAR(255) DEFAULT NULL,
  month_create_invoice INT(11) DEFAULT NULL COMMENT 'месяц создания НН, формируется из поля date_create_invoice',
  year_create_invoice YEAR(4) DEFAULT NULL COMMENT 'год создания НН, формируется из поля date_create_invoice',
  PRIMARY KEY (id),
  INDEX IDX_erpn_out (month_create_invoice, year_create_invoice, inn_client),
  INDEX inn (inn_client),
  INDEX `key` (key_field),
  UNIQUE INDEX Key_fields (num_invoice, date_create_invoice, type_invoice_full, inn_client),
  INDEX num_branch_vendor (num_branch_vendor),
  INDEX num_main_branch (num_main_branch)
)
ENGINE = INNODB
AUTO_INCREMENT = 819447
AVG_ROW_LENGTH = 712
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом обязательстве по данным ЕРПН. Данные по данным Медка '
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы erpn_out_svod_inn
--
DROP TABLE IF EXISTS erpn_out_svod_inn;
CREATE TABLE erpn_out_svod_inn (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month INT(11) NOT NULL,
  year INT(11) NOT NULL,
  inn VARCHAR(255) NOT NULL,
  suma_invoice DOUBLE(15, 2) NOT NULL,
  pdvinvoice DOUBLE(15, 2) DEFAULT NULL,
  baza_invoice DOUBLE(15, 2) DEFAULT NULL,
  key_field VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX UK_Erpn_out_svod_inn_key_field (key_field)
)
ENGINE = INNODB
AUTO_INCREMENT = 766442
AVG_ROW_LENGTH = 142
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом обязательстве по данным Реестров на дату. Дата это или дата создания НН или дата НН которую уточняет РКЕ (вне зависимости от периода выписки РКЕ)'
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы Erpn_out_svod_inn_date_create
--
DROP TABLE IF EXISTS erpn_out_svod_inn_date_create;
CREATE TABLE erpn_out_svod_inn_date_create (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month_create INT(11) DEFAULT NULL,
  year_create INT(11) DEFAULT NULL,
  inn VARCHAR(255) DEFAULT NULL,
  numBranch VARCHAR(255) DEFAULT NULL,
  sum_pdv DECIMAL(15, 2) DEFAULT NULL,
  key_field VARCHAR(255) DEFAULT NULL,
  key_ VARCHAR(255) NOT NULL,
  numMainBranch VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX key_ (key_),
  INDEX vv (month_create, year_create, numBranch, inn)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом обязательстве по данным ЕРПН на дату создания НН или РКЕ...'
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы errorloadreestr
--
DROP TABLE IF EXISTS errorloadreestr;
CREATE TABLE errorloadreestr (
  Id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  key_field VARCHAR(255) DEFAULT NULL COMMENT 'ключевое поле ',
  TypeReestr VARCHAR(50) DEFAULT NULL COMMENT 'тип реестра In/Out',
  Error VARCHAR(500) DEFAULT NULL COMMENT 'Описание ошибки валидации ',
  numBranch VARCHAR(50) DEFAULT NULL COMMENT 'Номер филиала ',
  PRIMARY KEY (Id)
)
ENGINE = INNODB
AUTO_INCREMENT = 10281
AVG_ROW_LENGTH = 264
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Сохранются логические ошибки при валидации реестров Выданных и Полученных НН'
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы LoadFile
--
DROP TABLE IF EXISTS loadfile;
CREATE TABLE loadfile (
  id INT(11) NOT NULL AUTO_INCREMENT,
  original_name VARCHAR(50) NOT NULL,
  upload_name VARCHAR(50) NOT NULL,
  type_file VARCHAR(3) NOT NULL,
  description_file VARCHAR(50) NOT NULL,
  type_doc VARCHAR(50) NOT NULL,
  upload_date DATETIME NOT NULL,
  processing_date DATETIME NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_unicode_ci
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы Reestr_in_svod_inn
--
DROP TABLE IF EXISTS reestr_in_svod_inn;
CREATE TABLE reestr_in_svod_inn (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month INT(11) DEFAULT NULL,
  year INT(11) DEFAULT NULL,
  inn VARCHAR(255) DEFAULT NULL,
  suma_invoice DOUBLE(15, 2) DEFAULT NULL,
  pdvinvoice DOUBLE(15, 2) DEFAULT NULL,
  baza_invoice DOUBLE(15, 2) DEFAULT NULL,
  key_field VARCHAR(50) DEFAULT NULL,
  numBranch VARCHAR(255) DEFAULT NULL COMMENT 'номер филиала ',
  PRIMARY KEY (id),
  UNIQUE INDEX `key` (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 154578
AVG_ROW_LENGTH = 119
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом кредите по данным Реестра на дату. Дата это или дата создания НН или дата НН которую уточняет РКЕ (вне зависимости от периода выписки РКЕ)'
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы Reestr_out_svod_inn
--
DROP TABLE IF EXISTS reestr_out_svod_inn;
CREATE TABLE reestr_out_svod_inn (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month INT(11) DEFAULT NULL,
  year INT(11) DEFAULT NULL,
  inn VARCHAR(255) DEFAULT NULL,
  suma_invoice DOUBLE(15, 2) DEFAULT NULL,
  pdvinvoice DOUBLE(15, 2) DEFAULT NULL,
  baza_invoice DOUBLE(15, 2) DEFAULT NULL,
  key_field VARCHAR(50) DEFAULT NULL,
  numBranch VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX id (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 201209
AVG_ROW_LENGTH = 118
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом обязательстве по данным ЕРПН на дату. Дата это или дата создания НН или дата НН которую уточняет РКЕ (вне зависимости от периода выписки РКЕ)'
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы Reestr_out_svod_inn_date_create
--
DROP TABLE IF EXISTS reestr_out_svod_inn_date_create;
CREATE TABLE reestr_out_svod_inn_date_create (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month_create INT(11) DEFAULT NULL,
  year_create INT(11) DEFAULT NULL,
  inn VARCHAR(255) DEFAULT NULL,
  numBranch VARCHAR(255) DEFAULT NULL,
  sum_pdv DECIMAL(15, 2) DEFAULT NULL,
  key_field VARCHAR(255) DEFAULT NULL,
  key_ VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  INDEX key_ (key_),
  INDEX vv (month_create, year_create, numBranch, inn)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
AVG_ROW_LENGTH = 129
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Хранит информацию о налоговом обязательстве по данным Реестра на дату создания НН или РКЕ...'
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы ReestrBranch_in
--
DROP TABLE IF EXISTS reestrbranch_in;
CREATE TABLE reestrbranch_in (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month INT(11) NOT NULL DEFAULT 0 COMMENT 'отчетный месяц  реестра ',
  year INT(11) NOT NULL DEFAULT 0 COMMENT 'отчетный год  реестра ',
  num_branch VARCHAR(255) DEFAULT NULL COMMENT 'номер филиала ',
  date_get_invoice DATE DEFAULT NULL COMMENT 'дата получения НН',
  date_create_invoice DATE DEFAULT NULL COMMENT 'дата создания НН',
  num_invoice VARCHAR(255) DEFAULT NULL COMMENT 'номер НН',
  type_invoice_full VARCHAR(255) DEFAULT NULL COMMENT 'ПНЕ или РКЕ ',
  name_client VARCHAR(500) DEFAULT NULL COMMENT 'наименование клиента',
  inn_client VARCHAR(255) DEFAULT NULL COMMENT 'ИНН клиента ',
  zag_summ DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'общая сумма с ПДВ (столб 8)',
  baza_20 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ (столб 10)',
  pdv_20 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'пдв по ставке 20 % (столб 11)',
  baza_7 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ (столб 12)',
  pdv_7 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'пдв по ставке 7 % (столб 13)',
  baza_0 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ (столб 14)',
  pdv_0 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'пдв по ставке 0 % (столб 15) ',
  baza_zvil DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ (столб 16)',
  pdv_zvil DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'ПДВ  (столб 17) ',
  baza_ne_gos DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость не предназначених в хоз деятельности (столб 18)',
  pdv_ne_gos DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'ПДВ не предназначених в хоз деятельности (столб 19)',
  baza_za_mezhi DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ поставка услуг за пределы Украины (столб 20)',
  pdv_za_mezhi DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость с ПДВ поставка услуг за пределы Украины (столб 21)',
  rke_date_create_invoice DATE DEFAULT NULL COMMENT 'дата сознание НН которую корректирует РКЕ',
  rke_num_invoice VARCHAR(50) DEFAULT NULL COMMENT 'номер НН которую корректирует РКЕ',
  rke_pidstava VARCHAR(250) DEFAULT NULL COMMENT 'основание для выписки РКЕ ',
  key_field VARCHAR(250) DEFAULT NULL COMMENT 'ключевое поле ',
  PRIMARY KEY (id),
  INDEX `key` (key_field),
  INDEX `m+y` (year, month),
  INDEX `month+year+branch` (month, year, num_branch)
)
ENGINE = INNODB
AUTO_INCREMENT = 154624
AVG_ROW_LENGTH = 316
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Информация о налоговом кредите филиалов на основании из Реестров '
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы reestrbranch_out
--
DROP TABLE IF EXISTS reestrbranch_out;
CREATE TABLE reestrbranch_out (
  id INT(11) NOT NULL AUTO_INCREMENT,
  month INT(11) NOT NULL DEFAULT 0 COMMENT 'отчетный месяц  реестра ',
  year INT(11) NOT NULL DEFAULT 0 COMMENT 'отчетный год  реестра ',
  num_branch VARCHAR(255) DEFAULT NULL COMMENT 'номер филиала ',
  date_create_invoice DATE DEFAULT NULL COMMENT 'дата создания НН',
  num_invoice VARCHAR(255) DEFAULT NULL COMMENT 'номер НН',
  type_invoice_full VARCHAR(255) DEFAULT NULL COMMENT 'ПНЕ или РКЕ ',
  type_invoice VARCHAR(5) DEFAULT NULL COMMENT 'тип причины не выдачи покупателю ',
  name_client VARCHAR(500) DEFAULT NULL COMMENT 'наименование клиента',
  inn_client VARCHAR(255) DEFAULT NULL COMMENT 'ИНН клиента ',
  zag_summ DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'общая сумма с ПДВ (столб 7)',
  baza_20 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ (столб 8)',
  pdv_20 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'пдв по ставке 20 % (столб 9)',
  baza_7 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ (столб 10)',
  pdv_7 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'пдв по ставке 7 % (столб 11)',
  baza_0 DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ ставка 0 % (столб 12)',
  baza_zvil DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ освобождены от налогообложения (столб 13)',
  baza_ne_obj DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'сумма поставки для не есть объектом налогообложения (столб 14)',
  baza_za_mezhi_tovar DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость без ПДВ поставка товаров за пределы Украины (столб 15)',
  baza_za_mezhi_poslug DOUBLE(15, 2) DEFAULT 0.00 COMMENT 'стоимость с ПДВ поставка услуг за пределы Украины (столб 16)',
  rke_date_create_invoice DATE DEFAULT NULL COMMENT 'дата сознание НН которую корректирует РКЕ',
  rke_num_invoice VARCHAR(50) DEFAULT NULL COMMENT 'номер НН которую корректирует РКЕ',
  rke_pidstava VARCHAR(250) DEFAULT NULL COMMENT 'основание для выписки РКЕ ',
  key_field VARCHAR(250) DEFAULT NULL COMMENT 'ключевое поле ',
  month_create_invoice INT(11) DEFAULT NULL,
  year_create_invoice YEAR(4) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX branch (num_branch),
  INDEX IDX_ReestrBranch_out (date_create_invoice, num_branch),
  INDEX IDX_reestrbranch_out2 (month_create_invoice, year_create_invoice, inn_client),
  INDEX `key` (key_field),
  INDEX `month+year+branch` (month, year, num_branch)
)
ENGINE = INNODB
AUTO_INCREMENT = 201289
AVG_ROW_LENGTH = 344
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Информация о налоговом обязательстве филиалов на основании из Реестров '
ROW_FORMAT = DYNAMIC;

--
-- Описание для таблицы SprBranch
--
DROP TABLE IF EXISTS sprbranch;
CREATE TABLE sprbranch (
  id INT(11) NOT NULL AUTO_INCREMENT,
  num_branch VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  name_branch VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  branch_adr VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  name_main_branch VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  num_main_branch VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (id),
  INDEX mainBranch (num_main_branch),
  INDEX num_branch (num_branch)
)
ENGINE = INNODB
AUTO_INCREMENT = 860
AVG_ROW_LENGTH = 324
CHARACTER SET utf8
COLLATE utf8_unicode_ci
COMMENT = 'Хранится информация о филиалах ПАТ '
ROW_FORMAT = DYNAMIC;

DELIMITER $$

--
-- Описание для процедуры AnalizInnOutFullJoinOneBranch
--
DROP PROCEDURE IF EXISTS AnalizInnOutFullJoinOneBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE AnalizInnOutFullJoinOneBranch(IN m INT, IN y INT, IN b VARCHAR(255))
BEGIN
SELECT
  erpn_out_inn_group_numbranch.month_create,
  erpn_out_inn_group_numbranch.year_create,
  erpn_out_inn_group_numbranch.num_main_branch,
  erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
  reestr_out_inn_group_numbranch.inn AS Reestr_inn,
  erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
  reestr_out_inn_group_numbranch.pdv AS Reestr_pdv,
  erpn_out_inn_group_numbranch.pdv - reestr_out_inn_group_numbranch.pdv AS saldo_pdv
FROM erpn_out_inn_group_numbranch
  RIGHT OUTER JOIN reestr_out_inn_group_numbranch
    ON erpn_out_inn_group_numbranch.month_create = reestr_out_inn_group_numbranch.`MONTH(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.year_create = reestr_out_inn_group_numbranch.`YEAR(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.num_main_branch = reestr_out_inn_group_numbranch.num_branch
    AND erpn_out_inn_group_numbranch.inn_client = reestr_out_inn_group_numbranch.inn
  WHERE month_create=m AND year_create=y AND num_main_branch=b
  UNION
   SELECT
  erpn_out_inn_group_numbranch.month_create,
  erpn_out_inn_group_numbranch.year_create,
  erpn_out_inn_group_numbranch.num_main_branch,
  erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
  reestr_out_inn_group_numbranch.inn AS Reestr_inn,
  erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
  reestr_out_inn_group_numbranch.pdv AS Reestr_pdv,
  erpn_out_inn_group_numbranch.pdv - reestr_out_inn_group_numbranch.pdv AS saldo_pdv
FROM erpn_out_inn_group_numbranch
  LEFT OUTER JOIN reestr_out_inn_group_numbranch
    ON erpn_out_inn_group_numbranch.month_create = reestr_out_inn_group_numbranch.`MONTH(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.year_create = reestr_out_inn_group_numbranch.`YEAR(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.num_main_branch = reestr_out_inn_group_numbranch.num_branch
    AND erpn_out_inn_group_numbranch.inn_client = reestr_out_inn_group_numbranch.inn
   WHERE month_create=m AND year_create=y AND num_main_branch=b;

END
$$

--
-- Описание для процедуры AnalizInnOutInnerJoinOneBranch
--
DROP PROCEDURE IF EXISTS AnalizInnOutInnerJoinOneBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE AnalizInnOutInnerJoinOneBranch(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT 'Внутренне соединение данных ЕРПН и реестра за период по одному филиалу '
BEGIN
SELECT
  erpn_out_inn_group_numbranch.month_create,
  erpn_out_inn_group_numbranch.year_create,
  erpn_out_inn_group_numbranch.num_main_branch,
  erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
  reestr_out_inn_group_numbranch.inn AS Reestr_inn,
  erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
  reestr_out_inn_group_numbranch.pdv AS Reestr_pdv,
  erpn_out_inn_group_numbranch.pdv - reestr_out_inn_group_numbranch.pdv AS saldo_pdv
FROM erpn_out_inn_group_numbranch
  INNER JOIN reestr_out_inn_group_numbranch
    ON erpn_out_inn_group_numbranch.month_create = reestr_out_inn_group_numbranch.`MONTH(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.year_create = reestr_out_inn_group_numbranch.`YEAR(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.num_main_branch = reestr_out_inn_group_numbranch.num_branch
    AND erpn_out_inn_group_numbranch.inn_client = reestr_out_inn_group_numbranch.inn
  WHERE month_create=m AND year_create=y AND num_main_branch=b;

END
$$

--
-- Описание для процедуры AnalizInnOutLeftJoinOneBranch
--
DROP PROCEDURE IF EXISTS AnalizInnOutLeftJoinOneBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE AnalizInnOutLeftJoinOneBranch(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT 'Левое соединение данных ЕРПН и реестра за период по одному филиалу. Вывод только данных из ЕРПН которые не совпали с реестром '
BEGIN
SELECT
  erpn_out_inn_group_numbranch.month_create,
  erpn_out_inn_group_numbranch.year_create,
  erpn_out_inn_group_numbranch.num_main_branch,
  erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
  erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
  COALESCE(reestr_out_inn_group_numbranch.pdv,0) AS Reestr_pdv,
  erpn_out_inn_group_numbranch.pdv - COALESCE(reestr_out_inn_group_numbranch.pdv,0) AS saldo_pdv
FROM erpn_out_inn_group_numbranch
  LEFT JOIN reestr_out_inn_group_numbranch
    ON erpn_out_inn_group_numbranch.month_create = reestr_out_inn_group_numbranch.`MONTH(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.year_create = reestr_out_inn_group_numbranch.`YEAR(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.num_main_branch = reestr_out_inn_group_numbranch.num_branch
    AND erpn_out_inn_group_numbranch.inn_client = reestr_out_inn_group_numbranch.inn
  WHERE month_create=m AND year_create=y AND num_main_branch=b
  AND `MONTH(ReestrBranch_out.date_create_invoice)`IS NULL 
  AND `YEAR(ReestrBranch_out.date_create_invoice)` IS NULL
  AND inn IS NULL
  AND num_branch IS NULL;

END
$$

--
-- Описание для процедуры AnalizInnOutRightJoinOneBranch
--
DROP PROCEDURE IF EXISTS AnalizInnOutRightJoinOneBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE AnalizInnOutRightJoinOneBranch(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT 'Правое соединение данных ЕРПН и реестра за период по одному филиалу. Вывод только данных из Реестра которые не совпали с ЕРПН'
BEGIN
SELECT
 `MONTH(ReestrBranch_out.date_create_invoice)` AS month,
 `YEAR(ReestrBranch_out.date_create_invoice)` AS year,
  num_branch AS Reestr_num_main_branch, 
  inn AS Reestr_inn,
  COALESCE(erpn_out_inn_group_numbranch.pdv,0) AS Erpn_pdv,
  COALESCE(reestr_out_inn_group_numbranch.pdv,0) AS Reestr_pdv,
  COALESCE(erpn_out_inn_group_numbranch.pdv,0) - COALESCE(reestr_out_inn_group_numbranch.pdv,0) AS saldo_pdv
FROM reestr_out_inn_group_numbranch
  LEFT JOIN  erpn_out_inn_group_numbranch
    ON reestr_out_inn_group_numbranch.`MONTH(ReestrBranch_out.date_create_invoice)`=erpn_out_inn_group_numbranch.month_create
    AND reestr_out_inn_group_numbranch.`YEAR(ReestrBranch_out.date_create_invoice)`=erpn_out_inn_group_numbranch.year_create 
    AND reestr_out_inn_group_numbranch.num_branch = erpn_out_inn_group_numbranch.num_main_branch
    AND reestr_out_inn_group_numbranch.inn = erpn_out_inn_group_numbranch.inn_client 
  WHERE `MONTH(ReestrBranch_out.date_create_invoice)`=m 
  AND `YEAR(ReestrBranch_out.date_create_invoice)`=y 
  AND num_branch=b
  AND month_create IS NULL 
  AND  year_create IS NULL
  AND inn_client IS NULL
  AND num_main_branch IS NULL;

END
$$

--
-- Описание для процедуры AnalizPDVOutDiffDateOneBranchInnerJoinERPN_tempTable
--
DROP PROCEDURE IF EXISTS AnalizPDVOutDiffDateOneBranchInnerJoinERPN_tempTable$$
CREATE DEFINER = 'root'@'%'
PROCEDURE AnalizPDVOutDiffDateOneBranchInnerJoinERPN_tempTable(IN m INT, IN y INT, IN b VARCHAR(3))
BEGIN
CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromBranch  (
   key_field varchar(50)DEFAULT NULL ,
    diffDate bigint DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (key_field),
    INDEX diff USING BTREE (diffDate)
  ) ENGINE = MEMORY AS  
  (
  SELECT 
    eo.key_field AS key_field,
    DATEDIFF(eo.date_reg_invoice,eo.date_create_invoice) AS diffDate
  FROM erpn_out eo
  WHERE eo.type_invoice_full = "ПНЕ"
  AND MONTH(eo.date_create_invoice)=m
  AND YEAR(eo.date_create_invoice)=y
  AND eo.num_main_branch =b 
  );

  SELECT num_invoice, date_create_invoice, date_reg_invoice,(diffDate-15) AS diff, 
  type_invoice_full, inn_client, name_client, suma_invoice, pdvinvoice, baza_invoice, 
  name_vendor,num_branch_vendor, num_main_branch FROM erpn_out
   INNER JOIN temp_diffDateFromBranch ON
    erpn_out.key_field=temp_diffDateFromBranch.key_field
    WHERE temp_diffDateFromBranch.diffDate>=16;

   
END
$$

--
-- Описание для процедуры AnalizPDVOutDiffDateOneBranchInnerJoinReestr_tempTable
--
DROP PROCEDURE IF EXISTS AnalizPDVOutDiffDateOneBranchInnerJoinReestr_tempTable$$
CREATE DEFINER = 'root'@'%'
PROCEDURE AnalizPDVOutDiffDateOneBranchInnerJoinReestr_tempTable(IN m INT, IN y INT, IN b VARCHAR(3))
  COMMENT 'Проверка факта включения опаздавших в реестр филиала '
BEGIN
  CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromBranch (
    key_field varchar(50) DEFAULT NULL,
    diffDate bigint DEFAULT NULL,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (key_field),
    INDEX diff USING BTREE (diffDate)
  ) ENGINE = MEMORY AS (SELECT
      eo.key_field AS key_field,
      DATEDIFF(eo.date_reg_invoice, eo.date_create_invoice) AS diffDate
    FROM erpn_out eo
    WHERE eo.type_invoice_full = "ПНЕ"
    AND MONTH(eo.date_create_invoice) = m
    AND YEAR(eo.date_create_invoice) = y
    AND eo.num_main_branch = b);

  SELECT
    rbo.month,
    rbo.year,
    rbo.num_branch,
    rbo.date_create_invoice,
    rbo.num_invoice,
    rbo.inn_client,
    rbo.name_client
  FROM ReestrBranch_out rbo
    INNER JOIN temp_diffDateFromBranch
      ON rbo.key_field = temp_diffDateFromBranch.key_field
  WHERE temp_diffDateFromBranch.diffDate >= 16;


END
$$

--
-- Описание для процедуры AnalizPDVOutDiffDateOneBranchLeftJoinERPN_tempTable
--
DROP PROCEDURE IF EXISTS AnalizPDVOutDiffDateOneBranchLeftJoinERPN_tempTable$$
CREATE DEFINER = 'root'@'%'
PROCEDURE AnalizPDVOutDiffDateOneBranchLeftJoinERPN_tempTable(IN m INT, IN y INT, IN b VARCHAR(3))
  COMMENT 'Проверка факта включения опаздавших в реестр филиала '
BEGIN
CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromBranch  (
   key_field varchar(50)DEFAULT NULL ,
    diffDate bigint DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (key_field),
    INDEX diff USING BTREE (diffDate)
  ) ENGINE = MEMORY AS  
  (
  SELECT 
    eo.key_field AS key_field,
    DATEDIFF(eo.date_reg_invoice,eo.date_create_invoice) AS diffDate
  FROM erpn_out eo
  WHERE eo.type_invoice_full = "ПНЕ"
  AND MONTH(eo.date_create_invoice)=m
  AND YEAR(eo.date_create_invoice)=y
  AND eo.num_main_branch =b 
  );
  
  SELECT num_invoice, date_create_invoice, date_reg_invoice,(DATEDIFF(date_reg_invoice, date_create_invoice)-15) AS diff, 
  type_invoice_full, inn_client, name_client, suma_invoice, pdvinvoice, baza_invoice, 
  name_vendor,num_branch_vendor, num_main_branch FROM erpn_out
      WHERE key_field IN(
  SELECT temp_diffDateFromBranch.key_field FROM temp_diffDateFromBranch 
   LEFT JOIN ReestrBranch_out ON
    temp_diffDateFromBranch.key_field=ReestrBranch_out.key_field
    WHERE temp_diffDateFromBranch.diffDate>=16
      AND ReestrBranch_out.key_field IS NULL) ;

   
END
$$

--
-- Описание для процедуры full_join
--
DROP PROCEDURE IF EXISTS full_join$$
CREATE DEFINER = 'root'@'%'
PROCEDURE full_join(IN month INT, IN year INT)
BEGIN
  SELECT
    Erpn_out_svod_inn_date_create.month_create,
    Erpn_out_svod_inn_date_create.year_create,
    Erpn_out_svod_inn_date_create.inn,
    Erpn_out_svod_inn_date_create.numMainBranch,
    Erpn_out_svod_inn_date_create.sum_pdv AS erpn_pdv,
    Reestr_out_svod_inn_date_create.sum_pdv AS reestr_pdv,
    (Erpn_out_svod_inn_date_create.sum_pdv - Reestr_out_svod_inn_date_create.sum_pdv) AS saldo
  FROM Erpn_out_svod_inn_date_create
    LEFT JOIN Reestr_out_svod_inn_date_create
      ON Erpn_out_svod_inn_date_create.key_ = Reestr_out_svod_inn_date_create.key_
  WHERE Erpn_out_svod_inn_date_create.month_create = month
  AND Erpn_out_svod_inn_date_create.year_create = year 
    UNION ALL
    SELECT
    Erpn_out_svod_inn_date_create.month_create,
    Erpn_out_svod_inn_date_create.year_create,
    Erpn_out_svod_inn_date_create.inn,
      Erpn_out_svod_inn_date_create.numMainBranch,
    Erpn_out_svod_inn_date_create.sum_pdv AS erpn_pdv,
    Reestr_out_svod_inn_date_create.sum_pdv AS reestr_pdv,
    (Erpn_out_svod_inn_date_create.sum_pdv - Reestr_out_svod_inn_date_create.sum_pdv) AS saldo
  FROM Erpn_out_svod_inn_date_create
    RIGHT JOIN Reestr_out_svod_inn_date_create
      ON Erpn_out_svod_inn_date_create.key_ = Reestr_out_svod_inn_date_create.key_
  WHERE Erpn_out_svod_inn_date_create.month_create = month
  AND Erpn_out_svod_inn_date_create.year_create = year
   AND Erpn_out_svod_inn_date_create.numMainBranch IS  NULL  ;

END
$$

--
-- Описание для процедуры getAnalizInnInInnerJoinAllUZ
--
DROP PROCEDURE IF EXISTS getAnalizInnInInnerJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnInInnerJoinAllUZ(IN month INT, IN year INT)
  COMMENT 'Анализ ПДВ по кредиту в резрезе ИНН за период. Внутренне соединение для не совпавших сумм ПДВ'
BEGIN
CALL AnalizPDV.getTempTable_In(month,year);
 SELECT
    temp_erpn_in.month_create,
    temp_erpn_in.year_create,
    temp_erpn_in.inn_client AS Erpn_Inn,
     temp_reestr_in.inn_client AS Reestr_inn,
     temp_erpn_in.pdv AS Erpn_pdv_PRAVO,
      temp_reestr_in.pdv AS Reestr_pdv_FACT,
   temp_erpn_in.pdv - temp_reestr_in.pdv AS saldo_pdv
  FROM temp_erpn_in 
    INNER JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE temp_erpn_in.pdv<>temp_reestr_in.pdv;
END
$$

--
-- Описание для процедуры getAnalizInnInLeftJoinAllUZ
--
DROP PROCEDURE IF EXISTS getAnalizInnInLeftJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnInLeftJoinAllUZ(IN month INT, IN year INT)
  COMMENT 'Анализ ПДВ по кредиту в резрезе ИНН за период. Вывод только ИНН с ЕРПН которые не имеют сумм в реестрах'
BEGIN
CALL AnalizPDV.getTempTable_In(month,year);
 SELECT
    temp_erpn_in.month_create,
    temp_erpn_in.year_create,
    temp_erpn_in.inn_client AS Erpn_Inn,
    temp_erpn_in.pdv AS Erpn_pdv_PRAVO
    FROM temp_erpn_in 
    LEFT JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE  temp_reestr_in.month_create IS NULL;
END
$$

--
-- Описание для процедуры getAnalizInnInRightJoinAllUZ
--
DROP PROCEDURE IF EXISTS getAnalizInnInRightJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnInRightJoinAllUZ(IN month INT, IN year INT)
  COMMENT 'Анализ ПДВ по кредиту в резрезе ИНН за период. Вывод только ИНН с Реестров  которые не имеют сумм в ЕРПН'
BEGIN
CALL AnalizPDV.getTempTable_In(month,year);
 SELECT
    temp_reestr_in.month_create,
    temp_reestr_in.year_create,
    temp_reestr_in.inn_client AS Reestr_in,
    temp_reestr_in.pdv AS Reestr_pdv
   FROM temp_erpn_in 
    RIGHT JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE temp_erpn_in.month_create IS NULL;
END
$$

--
-- Описание для процедуры getAnalizInnOutInnerJoin
--
DROP PROCEDURE IF EXISTS getAnalizInnOutInnerJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutInnerJoin(IN m int, IN y int, IN b varchar(255))
BEGIN
CREATE TEMPORARY TABLE IF NOT EXISTS  temp_erpn_out_inn_group_numbranch (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    num_main_branch varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  ) ENGINE = MEMORY AS 
  (SELECT
    MONTH(`erpn_out`.`date_create_invoice`) AS `month_create`,
    YEAR(`erpn_out`.`date_create_invoice`) AS `year_create`,
    `erpn_out`.`inn_client` AS `inn_client`,
    `erpn_out`.`num_main_branch` AS `num_main_branch`,
    SUM(`erpn_out`.`pdvinvoice`) AS `pdv`
  FROM `erpn_out`
  WHERE MONTH(`erpn_out`.`date_create_invoice`) = m
  AND YEAR(`erpn_out`.`date_create_invoice`) = y
  AND num_main_branch = b
  GROUP BY MONTH(`erpn_out`.`date_create_invoice`),
           YEAR(`erpn_out`.`date_create_invoice`),
           `erpn_out`.`inn_client`,
           `erpn_out`.`num_main_branch`);

CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_out_inn_group_numbranch (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    num_main_branch varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  )
  ENGINE = MEMORY AS 
  (SELECT
    MONTH(`reestrbranch_out`.`date_create_invoice`) AS `month_create`,
    YEAR(`reestrbranch_out`.`date_create_invoice`) AS `year_create`,
    `reestrbranch_out`.`inn_client` AS `inn_client`,
    `reestrbranch_out`.`num_branch` AS `num_main_branch`,
    SUM((`reestrbranch_out`.`pdv_20` + `reestrbranch_out`.`pdv_7`)) AS `pdv`
  FROM `reestrbranch_out`
  WHERE MONTH(`reestrbranch_out`.`date_create_invoice`) = m
  AND YEAR(`reestrbranch_out`.`date_create_invoice`) = y
  AND num_branch = b
  GROUP BY MONTH(`reestrbranch_out`.`date_create_invoice`),
           YEAR(`reestrbranch_out`.`date_create_invoice`),
           `reestrbranch_out`.`inn_client`,
           `reestrbranch_out`.`num_branch`);


  SELECT
    temp_erpn_out_inn_group_numbranch.month_create,
    temp_erpn_out_inn_group_numbranch.year_create,
    temp_erpn_out_inn_group_numbranch.num_main_branch,
    temp_erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
    temp_reestr_out_inn_group_numbranch.inn_client AS Reestr_inn,
    temp_erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
    temp_reestr_out_inn_group_numbranch.pdv AS Reestr_pdv,
    temp_erpn_out_inn_group_numbranch.pdv - temp_reestr_out_inn_group_numbranch.pdv AS saldo_pdv
  FROM temp_erpn_out_inn_group_numbranch 
    INNER JOIN temp_reestr_out_inn_group_numbranch
      ON temp_erpn_out_inn_group_numbranch.month_create = temp_reestr_out_inn_group_numbranch.month_create
      AND temp_erpn_out_inn_group_numbranch.year_create = temp_reestr_out_inn_group_numbranch.year_create
      AND temp_erpn_out_inn_group_numbranch.num_main_branch = temp_reestr_out_inn_group_numbranch.num_main_branch
      AND temp_erpn_out_inn_group_numbranch.inn_client = temp_reestr_out_inn_group_numbranch.inn_client
  WHERE temp_erpn_out_inn_group_numbranch.month_create = m
  AND temp_erpn_out_inn_group_numbranch.year_create = y
  AND temp_erpn_out_inn_group_numbranch.num_main_branch = b
  AND (temp_erpn_out_inn_group_numbranch.pdv - temp_reestr_out_inn_group_numbranch.pdv)<>0;


END
$$

--
-- Описание для процедуры getAnalizInnOutInnerJoinAllUZ
--
DROP PROCEDURE IF EXISTS getAnalizInnOutInnerJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutInnerJoinAllUZ(IN m INT, IN y INT)
BEGIN
CREATE TEMPORARY TABLE IF NOT EXISTS  temp_erpn_out_inn_group_numbranch_allUZ (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    num_main_branch varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  ) AS 
  (SELECT
    MONTH(`erpn_out`.`date_create_invoice`) AS `month_create`,
    YEAR(`erpn_out`.`date_create_invoice`) AS `year_create`,
    `erpn_out`.`inn_client` AS `inn_client`,
    `erpn_out`.`num_main_branch` AS `num_main_branch`,
    SUM(`erpn_out`.`pdvinvoice`) AS `pdv`
  FROM `erpn_out`
  WHERE MONTH(`erpn_out`.`date_create_invoice`) = m
  AND YEAR(`erpn_out`.`date_create_invoice`) = y
  GROUP BY MONTH(`erpn_out`.`date_create_invoice`),
           YEAR(`erpn_out`.`date_create_invoice`),
           `erpn_out`.`inn_client`,
           `erpn_out`.`num_main_branch`);

CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_out_inn_group_numbranch_allUZ (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    num_main_branch varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  )
  AS 
  (SELECT
    MONTH(`reestrbranch_out`.`date_create_invoice`) AS `month_create`,
    YEAR(`reestrbranch_out`.`date_create_invoice`) AS `year_create`,
    `reestrbranch_out`.`inn_client` AS `inn_client`,
    `reestrbranch_out`.`num_branch` AS `num_main_branch`,
    SUM((`reestrbranch_out`.`pdv_20` + `reestrbranch_out`.`pdv_7`)) AS `pdv`
  FROM `reestrbranch_out`
  WHERE MONTH(`reestrbranch_out`.`date_create_invoice`) = m
  AND YEAR(`reestrbranch_out`.`date_create_invoice`) = y
  GROUP BY MONTH(`reestrbranch_out`.`date_create_invoice`),
           YEAR(`reestrbranch_out`.`date_create_invoice`),
           `reestrbranch_out`.`inn_client`,
           `reestrbranch_out`.`num_branch`);


  SELECT
    temp_erpn_out_inn_group_numbranch_allUZ.month_create,
    temp_erpn_out_inn_group_numbranch_allUZ.year_create,
    temp_erpn_out_inn_group_numbranch_allUZ.num_main_branch,
    temp_erpn_out_inn_group_numbranch_allUZ.inn_client AS Erpn_Inn,
    temp_reestr_out_inn_group_numbranch_allUZ.inn_client AS Reestr_inn,
    temp_erpn_out_inn_group_numbranch_allUZ.pdv AS Erpn_pdv,
    temp_reestr_out_inn_group_numbranch_allUZ.pdv AS Reestr_pdv,
    temp_erpn_out_inn_group_numbranch_allUZ.pdv - temp_reestr_out_inn_group_numbranch_allUZ.pdv AS saldo_pdv
  FROM temp_erpn_out_inn_group_numbranch_allUZ 
    INNER JOIN temp_reestr_out_inn_group_numbranch_allUZ
      ON temp_erpn_out_inn_group_numbranch_allUZ.month_create = temp_reestr_out_inn_group_numbranch_allUZ.month_create
      AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = temp_reestr_out_inn_group_numbranch_allUZ.year_create
      AND temp_erpn_out_inn_group_numbranch_allUZ.num_main_branch = temp_reestr_out_inn_group_numbranch_allUZ.num_main_branch
      AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client = temp_reestr_out_inn_group_numbranch_allUZ.inn_client
  WHERE temp_erpn_out_inn_group_numbranch_allUZ.month_create = m
  AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = y 
  AND (temp_erpn_out_inn_group_numbranch_allUZ.pdv - temp_reestr_out_inn_group_numbranch_allUZ.pdv)<>0;


END
$$

--
-- Описание для процедуры getAnalizInnOutInnerJoinAllUZ_tmp
--
DROP PROCEDURE IF EXISTS getAnalizInnOutInnerJoinAllUZ_tmp$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutInnerJoinAllUZ_tmp(IN m int, IN y int)
BEGIN
  CALL getTmpTbl_OutAllUZ(m, y);
  SELECT
    temp_erpn_out_inn_group_numbranch_allUZ.month_create,
    temp_erpn_out_inn_group_numbranch_allUZ.year_create,
    temp_erpn_out_inn_group_numbranch_allUZ.inn_client AS Erpn_inn,
    temp_reestr_out_inn_group_numbranch_allUZ.inn_client AS Reestr_inn,
    temp_erpn_out_inn_group_numbranch_allUZ.pdv AS Erpn_pdv,
    temp_reestr_out_inn_group_numbranch_allUZ.pdv AS Reestr_pdv,
    temp_erpn_out_inn_group_numbranch_allUZ.pdv - temp_reestr_out_inn_group_numbranch_allUZ.pdv AS saldo_pdv
  FROM temp_erpn_out_inn_group_numbranch_allUZ
    INNER JOIN temp_reestr_out_inn_group_numbranch_allUZ
      ON temp_erpn_out_inn_group_numbranch_allUZ.month_create = temp_reestr_out_inn_group_numbranch_allUZ.month_create
      AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = temp_reestr_out_inn_group_numbranch_allUZ.year_create
      AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client = temp_reestr_out_inn_group_numbranch_allUZ.inn_client
  WHERE (temp_erpn_out_inn_group_numbranch_allUZ.pdv - temp_reestr_out_inn_group_numbranch_allUZ.pdv) <> 0;


END
$$

--
-- Описание для процедуры getAnalizInnOutInnerJoinBranch
--
DROP PROCEDURE IF EXISTS getAnalizInnOutInnerJoinBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutInnerJoinBranch(IN m int, IN y int, IN b varchar(255))
  COMMENT 'Внетренне соединение данных ЕРПН и реестра за период по филиалу.'
BEGIN
  CALL getTmpTbl_OutBranch(m, y, b);
  SELECT
    temp_erpn_out_inn_group_numbranch.month_create,
    temp_erpn_out_inn_group_numbranch.year_create,
    temp_erpn_out_inn_group_numbranch.num_main_branch,
    temp_erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
    temp_reestr_out_inn_group_numbranch.inn_client AS Reestr_inn,
    temp_erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
    temp_reestr_out_inn_group_numbranch.pdv AS Reestr_pdv,
    temp_erpn_out_inn_group_numbranch.pdv - temp_reestr_out_inn_group_numbranch.pdv AS saldo_pdv
  FROM temp_erpn_out_inn_group_numbranch
    INNER JOIN temp_reestr_out_inn_group_numbranch
      ON temp_erpn_out_inn_group_numbranch.month_create = temp_reestr_out_inn_group_numbranch.month_create
      AND temp_erpn_out_inn_group_numbranch.year_create = temp_reestr_out_inn_group_numbranch.year_create
      AND temp_erpn_out_inn_group_numbranch.num_main_branch = temp_reestr_out_inn_group_numbranch.num_main_branch
      AND temp_erpn_out_inn_group_numbranch.inn_client = temp_reestr_out_inn_group_numbranch.inn_client
  WHERE temp_erpn_out_inn_group_numbranch.month_create = m
  AND temp_erpn_out_inn_group_numbranch.year_create = y
  AND temp_erpn_out_inn_group_numbranch.num_main_branch = b
  AND (temp_erpn_out_inn_group_numbranch.pdv - temp_reestr_out_inn_group_numbranch.pdv) <> 0;


END
$$

--
-- Описание для процедуры getAnalizInnOutLeftJoin
--
DROP PROCEDURE IF EXISTS getAnalizInnOutLeftJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutLeftJoin(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT 'Левое соединение данных ЕРПН и реестра за период по УЗ. Вывод только данных из ЕРПН которые не совпали с реестром '
BEGIN
CREATE TEMPORARY TABLE IF NOT EXISTS  temp_erpn_out_inn_group_numbranch (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    num_main_branch varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  ) ENGINE = MEMORY AS 
  (SELECT
    MONTH(`erpn_out`.`date_create_invoice`) AS `month_create`,
    YEAR(`erpn_out`.`date_create_invoice`) AS `year_create`,
    `erpn_out`.`inn_client` AS `inn_client`,
    `erpn_out`.`num_main_branch` AS `num_main_branch`,
    SUM(`erpn_out`.`pdvinvoice`) AS `pdv`
  FROM `erpn_out`
  WHERE MONTH(`erpn_out`.`date_create_invoice`) = m
  AND YEAR(`erpn_out`.`date_create_invoice`) = y
  AND num_main_branch = b
  GROUP BY MONTH(`erpn_out`.`date_create_invoice`),
           YEAR(`erpn_out`.`date_create_invoice`),
           `erpn_out`.`inn_client`,
           `erpn_out`.`num_main_branch`);

CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_out_inn_group_numbranch (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    num_main_branch varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  )
  ENGINE = MEMORY AS 
  (SELECT
    MONTH(`reestrbranch_out`.`date_create_invoice`) AS `month_create`,
    YEAR(`reestrbranch_out`.`date_create_invoice`) AS `year_create`,
    `reestrbranch_out`.`inn_client` AS `inn_client`,
    `reestrbranch_out`.`num_branch` AS `num_main_branch`,
    SUM((`reestrbranch_out`.`pdv_20` + `reestrbranch_out`.`pdv_7`)) AS `pdv`
  FROM `reestrbranch_out`
  WHERE MONTH(`reestrbranch_out`.`date_create_invoice`) = m
  AND YEAR(`reestrbranch_out`.`date_create_invoice`) = y
  AND num_branch = b
  GROUP BY MONTH(`reestrbranch_out`.`date_create_invoice`),
           YEAR(`reestrbranch_out`.`date_create_invoice`),
           `reestrbranch_out`.`inn_client`,
           `reestrbranch_out`.`num_branch`);

SELECT
  temp_erpn_out_inn_group_numbranch.month_create,
  temp_erpn_out_inn_group_numbranch.year_create,
  temp_erpn_out_inn_group_numbranch.num_main_branch,
  temp_erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
  temp_erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
  COALESCE(temp_reestr_out_inn_group_numbranch.pdv,0) AS Reestr_pdv,
  temp_erpn_out_inn_group_numbranch.pdv - COALESCE(temp_reestr_out_inn_group_numbranch.pdv,0) AS saldo_pdv
FROM temp_erpn_out_inn_group_numbranch
  LEFT JOIN temp_reestr_out_inn_group_numbranch
    ON temp_erpn_out_inn_group_numbranch.month_create = temp_reestr_out_inn_group_numbranch.month_create
    AND temp_erpn_out_inn_group_numbranch.year_create = temp_reestr_out_inn_group_numbranch.year_create
    AND temp_erpn_out_inn_group_numbranch.num_main_branch = temp_reestr_out_inn_group_numbranch.num_main_branch
    AND temp_erpn_out_inn_group_numbranch.inn_client = temp_reestr_out_inn_group_numbranch.inn_client
 WHERE temp_erpn_out_inn_group_numbranch.month_create = m
  AND temp_erpn_out_inn_group_numbranch.year_create = y
  AND temp_erpn_out_inn_group_numbranch.num_main_branch = b
  AND temp_reestr_out_inn_group_numbranch.month_create IS NULL 
  AND temp_erpn_out_inn_group_numbranch.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.inn_client IS NULL
  AND temp_erpn_out_inn_group_numbranch.num_main_branch IS NULL
  AND (temp_erpn_out_inn_group_numbranch.pdv - COALESCE(temp_reestr_out_inn_group_numbranch.pdv,0)<>0);

END
$$

--
-- Описание для процедуры getAnalizInnOutLeftJoinAllUZ
--
DROP PROCEDURE IF EXISTS getAnalizInnOutLeftJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutLeftJoinAllUZ(IN m INT, IN y INT)
  COMMENT 'Левое соединение данных ЕРПН и реестра за период по УЗ. Вывод только данных из ЕРПН которые не совпали с реестром '
BEGIN
  CALL getTmpTbl_OutAllUZ(m, y);
SELECT
  temp_erpn_out_inn_group_numbranch_allUZ.month_create,
  temp_erpn_out_inn_group_numbranch_allUZ.year_create,
  temp_erpn_out_inn_group_numbranch_allUZ.inn_client AS Erpn_Inn,
  temp_erpn_out_inn_group_numbranch_allUZ.pdv AS Erpn_pdv,
  COALESCE(temp_reestr_out_inn_group_numbranch_allUZ.pdv,0) AS Reestr_pdv,
  temp_erpn_out_inn_group_numbranch_allUZ.pdv - COALESCE(temp_reestr_out_inn_group_numbranch_allUZ.pdv,0) AS saldo_pdv
FROM temp_erpn_out_inn_group_numbranch_allUZ
  LEFT JOIN temp_reestr_out_inn_group_numbranch_allUZ
    ON temp_erpn_out_inn_group_numbranch_allUZ.month_create = temp_reestr_out_inn_group_numbranch_allUZ.month_create
    AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = temp_reestr_out_inn_group_numbranch_allUZ.year_create
    AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client = temp_reestr_out_inn_group_numbranch_allUZ.inn_client
 WHERE temp_erpn_out_inn_group_numbranch_allUZ.month_create = m
  AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = y
  AND temp_reestr_out_inn_group_numbranch_allUZ.month_create IS NULL 
  AND temp_erpn_out_inn_group_numbranch_allUZ.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client IS NULL;
END
$$

--
-- Описание для процедуры getAnalizInnOutLeftJoinBranch
--
DROP PROCEDURE IF EXISTS getAnalizInnOutLeftJoinBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutLeftJoinBranch(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT 'Левое соединение данных ЕРПН и реестра за период по УЗ. Вывод только данных из ЕРПН которые не совпали с реестром '
BEGIN

CALL AnalizPDV.getTmpTbl_OutLeftJoin(m,y,b);
SELECT
  temp_erpn_out_inn_group_numbranch.month_create,
  temp_erpn_out_inn_group_numbranch.year_create,
  temp_erpn_out_inn_group_numbranch.num_main_branch,
  temp_erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
  temp_erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
  COALESCE(temp_reestr_out_inn_group_numbranch.pdv,0) AS Reestr_pdv,
  temp_erpn_out_inn_group_numbranch.pdv - COALESCE(temp_reestr_out_inn_group_numbranch.pdv,0) AS saldo_pdv
FROM temp_erpn_out_inn_group_numbranch
  LEFT JOIN temp_reestr_out_inn_group_numbranch
    ON temp_erpn_out_inn_group_numbranch.month_create = temp_reestr_out_inn_group_numbranch.month_create
    AND temp_erpn_out_inn_group_numbranch.year_create = temp_reestr_out_inn_group_numbranch.year_create
    AND temp_erpn_out_inn_group_numbranch.num_main_branch = temp_reestr_out_inn_group_numbranch.num_main_branch
    AND temp_erpn_out_inn_group_numbranch.inn_client = temp_reestr_out_inn_group_numbranch.inn_client
 WHERE temp_erpn_out_inn_group_numbranch.month_create = m
  AND temp_erpn_out_inn_group_numbranch.year_create = y
  AND temp_erpn_out_inn_group_numbranch.num_main_branch = b
  AND temp_reestr_out_inn_group_numbranch.month_create IS NULL 
  AND temp_erpn_out_inn_group_numbranch.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.inn_client IS NULL
  AND temp_erpn_out_inn_group_numbranch.num_main_branch IS NULL
  AND (temp_erpn_out_inn_group_numbranch.pdv - COALESCE(temp_reestr_out_inn_group_numbranch.pdv,0)<>0);

END
$$

--
-- Описание для процедуры getAnalizInnOutRightJoin
--
DROP PROCEDURE IF EXISTS getAnalizInnOutRightJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutRightJoin(IN m int, IN y int, IN b varchar(255))
  COMMENT 'Правое соединение данных ЕРПН и реестра за период по одному филиалу. Вывод только данных из Реестра которые не совпали с ЕРПН'
BEGIN
  CREATE TEMPORARY TABLE IF NOT EXISTS temp_erpn_out_inn_group_numbranch (
    month_create int(11) DEFAULT NULL,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL,
    num_main_branch varchar(255) DEFAULT NULL,
    pdv decimal(15, 2) DEFAULT NULL,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  ) ENGINE = MEMORY AS (SELECT
      MONTH(`erpn_out`.`date_create_invoice`) AS `month_create`,
      YEAR(`erpn_out`.`date_create_invoice`) AS `year_create`,
      `erpn_out`.`inn_client` AS `inn_client`,
      `erpn_out`.`num_main_branch` AS `num_main_branch`,
      SUM(`erpn_out`.`pdvinvoice`) AS `pdv`
    FROM `erpn_out`
    WHERE MONTH(`erpn_out`.`date_create_invoice`) = m
    AND YEAR(`erpn_out`.`date_create_invoice`) = y
    AND num_main_branch = b
    GROUP BY MONTH(`erpn_out`.`date_create_invoice`),
             YEAR(`erpn_out`.`date_create_invoice`),
             `erpn_out`.`inn_client`,
             `erpn_out`.`num_main_branch`);

  CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_out_inn_group_numbranch (
    month_create int(11) DEFAULT NULL,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL,
    num_main_branch varchar(255) DEFAULT NULL,
    pdv decimal(15, 2) DEFAULT NULL,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  )
  ENGINE = MEMORY AS (SELECT
      MONTH(`reestrbranch_out`.`date_create_invoice`) AS `month_create`,
      YEAR(`reestrbranch_out`.`date_create_invoice`) AS `year_create`,
      `reestrbranch_out`.`inn_client` AS `inn_client`,
      `reestrbranch_out`.`num_branch` AS `num_main_branch`,
      SUM((`reestrbranch_out`.`pdv_20` + `reestrbranch_out`.`pdv_7`)) AS `pdv`
    FROM `reestrbranch_out`
    WHERE MONTH(`reestrbranch_out`.`date_create_invoice`) = m
    AND YEAR(`reestrbranch_out`.`date_create_invoice`) = y
    AND num_branch = b
    GROUP BY MONTH(`reestrbranch_out`.`date_create_invoice`),
             YEAR(`reestrbranch_out`.`date_create_invoice`),
             `reestrbranch_out`.`inn_client`,
             `reestrbranch_out`.`num_branch`);

  SELECT
    temp_reestr_out_inn_group_numbranch.month_create AS month,
    temp_reestr_out_inn_group_numbranch.year_create AS year,
    temp_reestr_out_inn_group_numbranch.num_main_branch AS Reestr_num_main_branch,
    temp_reestr_out_inn_group_numbranch.inn_client AS Reestr_inn,
    COALESCE(temp_erpn_out_inn_group_numbranch.pdv, 0) AS Erpn_pdv,
    COALESCE(temp_reestr_out_inn_group_numbranch.pdv, 0) AS Reestr_pdv,
    COALESCE(temp_erpn_out_inn_group_numbranch.pdv, 0) - COALESCE(temp_reestr_out_inn_group_numbranch.pdv, 0) AS saldo_pdv
  FROM temp_reestr_out_inn_group_numbranch
    LEFT JOIN temp_erpn_out_inn_group_numbranch
      ON temp_reestr_out_inn_group_numbranch.month_create = temp_erpn_out_inn_group_numbranch.month_create
      AND temp_reestr_out_inn_group_numbranch.year_create = temp_erpn_out_inn_group_numbranch.year_create
      AND temp_reestr_out_inn_group_numbranch.num_main_branch = temp_erpn_out_inn_group_numbranch.num_main_branch
      AND temp_reestr_out_inn_group_numbranch.inn_client = temp_erpn_out_inn_group_numbranch.inn_client
  WHERE temp_reestr_out_inn_group_numbranch.month_create = m
  AND temp_reestr_out_inn_group_numbranch.year_create = y
  AND temp_reestr_out_inn_group_numbranch.num_main_branch = b
  AND temp_erpn_out_inn_group_numbranch.month_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.inn_client IS NULL
  AND temp_erpn_out_inn_group_numbranch.num_main_branch IS NULL;

END
$$

--
-- Описание для процедуры getAnalizInnOutRightJoinAllUZ
--
DROP PROCEDURE IF EXISTS getAnalizInnOutRightJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutRightJoinAllUZ(IN m INT, IN y INT)
  COMMENT 'Правое соединение данных ЕРПН и реестра за период по одному филиалу. Вывод только данных из Реестра которые не совпали с ЕРПН'
BEGIN
  CALL AnalizPDV.getTmpTbl_OutAllUZ(m,y);
  SELECT
    temp_reestr_out_inn_group_numbranch_allUZ.month_create AS month,
    temp_reestr_out_inn_group_numbranch_allUZ.year_create AS year,
    temp_reestr_out_inn_group_numbranch_allUZ.inn_client AS Reestr_inn,
    
    COALESCE(temp_reestr_out_inn_group_numbranch_allUZ.pdv, 0) AS Reestr_pdv
    
  FROM temp_reestr_out_inn_group_numbranch_allUZ
    LEFT JOIN temp_erpn_out_inn_group_numbranch_allUZ
      ON temp_reestr_out_inn_group_numbranch_allUZ.month_create = temp_erpn_out_inn_group_numbranch_allUZ.month_create
      AND temp_reestr_out_inn_group_numbranch_allUZ.year_create = temp_erpn_out_inn_group_numbranch_allUZ.year_create
      AND temp_reestr_out_inn_group_numbranch_allUZ.inn_client = temp_erpn_out_inn_group_numbranch_allUZ.inn_client
  WHERE temp_reestr_out_inn_group_numbranch_allUZ.month_create = m
  AND temp_reestr_out_inn_group_numbranch_allUZ.year_create = y
  AND temp_erpn_out_inn_group_numbranch_allUZ.month_create IS NULL
  AND temp_erpn_out_inn_group_numbranch_allUZ.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client IS NULL;

END
$$

--
-- Описание для процедуры getAnalizInnOutRightJoinBranch
--
DROP PROCEDURE IF EXISTS getAnalizInnOutRightJoinBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getAnalizInnOutRightJoinBranch(IN m int, IN y int, IN b varchar(255))
  COMMENT 'Правое соединение данных ЕРПН и реестра за период по одному филиалу. Вывод только данных из Реестра которые не совпали с ЕРПН'
BEGIN
 CALL AnalizPDV.getTmpTbl_OutRightJoin(m,y,b);
  SELECT
    temp_reestr_out_inn_group_numbranch.month_create AS month,
    temp_reestr_out_inn_group_numbranch.year_create AS year,
    temp_reestr_out_inn_group_numbranch.num_main_branch AS Reestr_num_main_branch,
    temp_reestr_out_inn_group_numbranch.inn_client AS Reestr_inn,
    COALESCE(temp_erpn_out_inn_group_numbranch.pdv, 0) AS Erpn_pdv,
    COALESCE(temp_reestr_out_inn_group_numbranch.pdv, 0) AS Reestr_pdv,
    COALESCE(temp_erpn_out_inn_group_numbranch.pdv, 0) - COALESCE(temp_reestr_out_inn_group_numbranch.pdv, 0) AS saldo_pdv
  FROM temp_reestr_out_inn_group_numbranch
    LEFT JOIN temp_erpn_out_inn_group_numbranch
      ON temp_reestr_out_inn_group_numbranch.month_create = temp_erpn_out_inn_group_numbranch.month_create
      AND temp_reestr_out_inn_group_numbranch.year_create = temp_erpn_out_inn_group_numbranch.year_create
      AND temp_reestr_out_inn_group_numbranch.num_main_branch = temp_erpn_out_inn_group_numbranch.num_main_branch
      AND temp_reestr_out_inn_group_numbranch.inn_client = temp_erpn_out_inn_group_numbranch.inn_client
  WHERE temp_reestr_out_inn_group_numbranch.month_create = m
  AND temp_reestr_out_inn_group_numbranch.year_create = y
  AND temp_reestr_out_inn_group_numbranch.num_main_branch = b
  AND temp_erpn_out_inn_group_numbranch.month_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.inn_client IS NULL
  AND temp_erpn_out_inn_group_numbranch.num_main_branch IS NULL;

END
$$

--
-- Описание для процедуры getDocErpnBy_AnalizInnInInnerJoinAllUZ
--
DROP PROCEDURE IF EXISTS getDocErpnBy_AnalizInnInInnerJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocErpnBy_AnalizInnInInnerJoinAllUZ(IN month INT, IN year INT)
  COMMENT 'Получает список полученных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnInInnerJoin'
BEGIN
CALL getTmpTbl_InnInnerJoin (month,year);
SELECT 
  ei.num_invoice, 
  date_format(ei.date_create_invoice,'%d.%m.%Y'), 
  ei.type_invoice_full, 
  ei.inn_client, 
  ei.name_client, 
  ei.pdvinvoice,
  ei.name_vendor FROM erpn_in ei
  WHERE MONTH(ei.date_create_invoice)=month 
        AND YEAR(ei.date_create_invoice)=year
        AND ei.inn_client IN (SELECT DISTINCT Erpn_Inn FROM Inn_InnerJoin);
END
$$

--
-- Описание для процедуры getDocErpnBy_AnalizInnInLeftJoin
--
DROP PROCEDURE IF EXISTS getDocErpnBy_AnalizInnInLeftJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocErpnBy_AnalizInnInLeftJoin(IN month INT, IN year INT)
  COMMENT 'Получает список полученных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnInLeftJoin'
BEGIN
CALL getTmpTbl_InnLeftJoin (month,year);
SELECT 
  ei.num_invoice, 
  date_format(ei.date_create_invoice,'%d.%m.%Y'), 
  ei.type_invoice_full, 
  ei.inn_client, 
  ei.name_client, 
  ei.pdvinvoice,
  ei.name_vendor FROM erpn_in ei
  WHERE MONTH(ei.date_create_invoice)=month 
        AND YEAR(ei.date_create_invoice)=year
        AND ei.inn_client IN (SELECT DISTINCT Erpn_Inn FROM Inn_LeftJoin);
END
$$

--
-- Описание для процедуры getDocErpnBy_AnalizInnOutInnerJoinAllUZ
--
DROP PROCEDURE IF EXISTS getDocErpnBy_AnalizInnOutInnerJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocErpnBy_AnalizInnOutInnerJoinAllUZ(IN m INT, IN y INT)
  COMMENT 'Получает список полученных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnInInnerJoinAllUZ'
BEGIN
  CALL getTmpTbl_OutInnerJoinAllUZ(m, y);
  SELECT
    ei.num_invoice,
    DATE_FORMAT(ei.date_create_invoice, '%d.%m.%Y'),
    ei.type_invoice_full,
    ei.inn_client,
    ei.name_client,
    ei.pdvinvoice,
    ei.name_vendor
  FROM erpn_out ei
  WHERE month_create_invoice = m
  AND year_create_invoice = y
  AND ei.inn_client IN (SELECT DISTINCT
      Erpn_Inn
    FROM Out_InnerJoinAll);
END
$$

--
-- Описание для процедуры getDocErpnBy_AnalizInnOutInnerJoinBranch
--
DROP PROCEDURE IF EXISTS getDocErpnBy_AnalizInnOutInnerJoinBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocErpnBy_AnalizInnOutInnerJoinBranch(IN month int, IN year int, IN b varchar(255))
  COMMENT 'Получает список полученных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnInInnerJoin'
BEGIN
  CALL getTmpTbl_OutInnerJoin(month, YEAR,b);
  SELECT
    ei.num_invoice,
    DATE_FORMAT(ei.date_create_invoice, '%d.%m.%Y'),
    ei.type_invoice_full,
    ei.inn_client,
    ei.name_client,
    ei.pdvinvoice,
    ei.name_vendor
  FROM erpn_out ei
  WHERE MONTH(ei.date_create_invoice) = month
  AND YEAR(ei.date_create_invoice) = year
  AND ei.inn_client IN (SELECT DISTINCT
      Erpn_Inn
    FROM Out_InnerJoin);
END
$$

--
-- Описание для процедуры getDocErpnBy_AnalizInnOutLeftJoinAllUZ
--
DROP PROCEDURE IF EXISTS getDocErpnBy_AnalizInnOutLeftJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocErpnBy_AnalizInnOutLeftJoinAllUZ(IN month INT, IN year INT)
  COMMENT 'Получает список выданных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnOutLeftJoinBranch'
BEGIN
CALL getTmpTbl_OutLeftJoinAllUZ (month,year);
SELECT 
  ei.num_invoice, 
  date_format(ei.date_create_invoice,'%d.%m.%Y'), 
  ei.type_invoice_full, 
  ei.inn_client, 
  ei.name_client, 
  ei.pdvinvoice,
  ei.name_vendor FROM erpn_out ei
  WHERE ei.month_create_invoice=month 
        AND ei.year_create_invoice=year
        AND ei.inn_client IN (SELECT DISTINCT Erpn_Inn FROM Out_LeftJoinAll);
END
$$

--
-- Описание для процедуры getDocErpnBy_AnalizInnOutLeftJoinBranch
--
DROP PROCEDURE IF EXISTS getDocErpnBy_AnalizInnOutLeftJoinBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocErpnBy_AnalizInnOutLeftJoinBranch(IN month INT, IN year INT, IN b VARCHAR(255))
  COMMENT 'Получает список выданных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnOutLeftJoinBranch'
BEGIN
CALL getTmpTbl_OutLeftJoin (month,year,b);
SELECT 
  ei.num_invoice, 
  date_format(ei.date_create_invoice,'%d.%m.%Y'), 
  ei.type_invoice_full, 
  ei.inn_client, 
  ei.name_client, 
  ei.pdvinvoice,
  ei.name_vendor FROM erpn_out ei
  WHERE MONTH(ei.date_create_invoice)=month 
        AND YEAR(ei.date_create_invoice)=year
        AND ei.inn_client IN (SELECT DISTINCT Erpn_Inn FROM Out_LeftJoin);
END
$$

--
-- Описание для процедуры getDocReestrBy_AnalizInnInInnerJoinAllUZ
--
DROP PROCEDURE IF EXISTS getDocReestrBy_AnalizInnInInnerJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocReestrBy_AnalizInnInInnerJoinAllUZ(IN month INT, IN year INT)
  COMMENT 'Получает список полученных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnInInnerJoin'
BEGIN
CALL getTmpTbl_InnInnerJoin (month,year);
SELECT rbi.month, rbi.year, rbi.num_branch, 
  date_format(rbi.date_create_invoice,'%d.%m.%Y'), 
  rbi.num_invoice, rbi.type_invoice_full, rbi.name_client, 
  rbi.inn_client,
  (rbi.`pdv_20` + rbi.`pdv_7`+rbi.pdv_0+rbi.pdv_zvil+rbi.pdv_ne_gos+rbi.pdv_za_mezhi) AS pdv
   FROM ReestrBranch_in rbi
  WHERE MONTH(rbi.date_create_invoice)=month 
        AND YEAR(rbi.date_create_invoice)=year
        AND rbi.inn_client IN (SELECT DISTINCT Reestr_inn FROM Inn_InnerJoin);
END
$$

--
-- Описание для процедуры getDocReestrBy_AnalizInnInRightJoin
--
DROP PROCEDURE IF EXISTS getDocReestrBy_AnalizInnInRightJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocReestrBy_AnalizInnInRightJoin(IN month INT, IN year INT)
  COMMENT 'Получает список полученных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnInInnerJoin'
BEGIN
  CALL getTmpTbl_InnRightJoin (month,year);
SELECT rbi.month, rbi.year, rbi.num_branch, 
  date_format(rbi.date_create_invoice,'%d.%m.%Y'), 
  rbi.num_invoice, rbi.type_invoice_full, rbi.name_client, 
  rbi.inn_client,
  (rbi.`pdv_20` + rbi.`pdv_7`+rbi.pdv_0+rbi.pdv_zvil+rbi.pdv_ne_gos+rbi.pdv_za_mezhi) AS pdv
   FROM ReestrBranch_in rbi
  WHERE MONTH(rbi.date_create_invoice)=month 
        AND YEAR(rbi.date_create_invoice)=year
        AND rbi.inn_client IN (SELECT DISTINCT Reestr_Inn FROM Inn_RightJoin);
END
$$

--
-- Описание для процедуры getDocReestrBy_AnalizInnOutInnerJoinAllUZ
--
DROP PROCEDURE IF EXISTS getDocReestrBy_AnalizInnOutInnerJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocReestrBy_AnalizInnOutInnerJoinAllUZ(IN month INT, IN year INT)
  COMMENT 'Получает список полученных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnOutInnerJoinAllUZ'
BEGIN
CALL getTmpTbl_OutInnerJoinAllUZ (month,year);
SELECT rbi.month, rbi.year, rbi.num_branch, 
  date_format(rbi.date_create_invoice,'%d.%m.%Y'), 
  rbi.num_invoice, rbi.type_invoice_full, rbi.name_client, 
  rbi.inn_client,
  (rbi.`pdv_20` + rbi.`pdv_7`) AS pdv
   FROM ReestrBranch_out rbi
  WHERE rbi.month_create_invoice=month 
        AND rbi.year_create_invoice=year
        AND rbi.inn_client IN (SELECT DISTINCT Reestr_inn FROM Out_InnerJoinAll);
END
$$

--
-- Описание для процедуры getDocReestrBy_AnalizInnOutInnerJoinBranch
--
DROP PROCEDURE IF EXISTS getDocReestrBy_AnalizInnOutInnerJoinBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocReestrBy_AnalizInnOutInnerJoinBranch(IN month INT, IN year INT, IN b VARCHAR(255))
  COMMENT 'Получает список полученных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnOutInnerJoin'
BEGIN
CALL getTmpTbl_OutInnerJoin (month,year,b);
SELECT rbi.month, rbi.year, rbi.num_branch, 
  date_format(rbi.date_create_invoice,'%d.%m.%Y'), 
  rbi.num_invoice, rbi.type_invoice_full, rbi.name_client, 
  rbi.inn_client,
  (rbi.`pdv_20` + rbi.`pdv_7`) AS pdv
   FROM ReestrBranch_out rbi
  WHERE MONTH(rbi.date_create_invoice)=month 
        AND YEAR(rbi.date_create_invoice)=year
        AND rbi.inn_client IN (SELECT DISTINCT Reestr_inn FROM Out_InnerJoin);
END
$$

--
-- Описание для процедуры getDocReestrBy_AnalizInnOutRightJoinAllUZ
--
DROP PROCEDURE IF EXISTS getDocReestrBy_AnalizInnOutRightJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocReestrBy_AnalizInnOutRightJoinAllUZ(IN month INT, IN year INT)
  COMMENT 'Получает список выданных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnOutInnerJoinBranch'
BEGIN
  CALL getTmpTbl_OutRightJoinAllUZ(month, year);
  SELECT
    rbi.month,
    rbi.year,
    rbi.num_branch,
    DATE_FORMAT(rbi.date_create_invoice, '%d.%m.%Y'),
    rbi.num_invoice,
    rbi.type_invoice_full,
    rbi.name_client,
    rbi.inn_client,
    (rbi.`pdv_20` + rbi.`pdv_7`) AS pdv
  FROM ReestrBranch_out rbi
  WHERE rbi.month_create_invoice = month
  AND rbi.year_create_invoice = year
  AND rbi.inn_client IN (SELECT DISTINCT
      Reestr_Inn
    FROM Out_RightJoinAll);
END
$$

--
-- Описание для процедуры getDocReestrBy_AnalizInnOutRightJoinBranch
--
DROP PROCEDURE IF EXISTS getDocReestrBy_AnalizInnOutRightJoinBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getDocReestrBy_AnalizInnOutRightJoinBranch(IN month int, IN year int, IN b varchar(255))
  COMMENT 'Получает список выданных НН из ЕРПН  по ИПНам которые признаны ошибочними при AnalizInnOutInnerJoinBranch'
BEGIN
  CALL getTmpTbl_OutRightJoin(month, year, b);
  SELECT
    rbi.month,
    rbi.year,
    rbi.num_branch,
    DATE_FORMAT(rbi.date_create_invoice, '%d.%m.%Y'),
    rbi.num_invoice,
    rbi.type_invoice_full,
    rbi.name_client,
    rbi.inn_client,
    (rbi.`pdv_20` + rbi.`pdv_7`) AS pdv
  FROM ReestrBranch_out rbi
  WHERE MONTH(rbi.date_create_invoice) = month
  AND YEAR(rbi.date_create_invoice) = year
  AND rbi.inn_client IN (SELECT DISTINCT
      Reestr_Inn
    FROM Out_RightJoin);
END
$$

--
-- Описание для процедуры getReestrInEqualErpn
--
DROP PROCEDURE IF EXISTS getReestrInEqualErpn$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getReestrInEqualErpn(IN month INT, IN year INT, IN branch VARCHAR(255))
  COMMENT 'Возвращает массив информации с реестра полученных НН которые совпали с ЕРПН по параметрам'
BEGIN
SELECT month,year,num_branch,type_invoice_full,
				num_invoice,
				date_format(date_create_invoice,'%d.%m.%Y'),
				inn_client,
				name_client,
				suma_invoice as edrpou_sum,
				baza_invoice as edrpou_baza,
				pdvinvoice as edrpou_pdv,
				zag_summ as reestr_sum,
				baza as reestr_baza,
				pdv as reestr_pdv,
				(suma_invoice - zag_summ) as saldo_sum,
				(baza_invoice - baza) as saldo_baza,
				(pdvinvoice - pdv) as saldo_pdv
				from `in_erpn=reestr`
				WHERE month =month AND year=year AND num_branch=branch
        AND((suma_invoice - zag_summ)<>0
        OR (baza_invoice - baza)<>0
        OR (pdvinvoice - pdv)<>0);
END
$$

--
-- Описание для процедуры getReestrInEqualErpnAllUZ
--
DROP PROCEDURE IF EXISTS getReestrInEqualErpnAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getReestrInEqualErpnAllUZ(IN m INT, IN y INT)
  COMMENT 'Возвращает массив информации с реестра полученных НН которые совпали с ЕРПН по параметрам в целом по УЗ'
BEGIN
SELECT month,year,num_branch,type_invoice_full,
				num_invoice,
				date_format(date_create_invoice,'%d.%m.%Y'),
				inn_client,
				name_client,
				suma_invoice as edrpou_sum,
				baza_invoice as edrpou_baza,
				pdvinvoice as edrpou_pdv,
				zag_summ as reestr_sum,
				baza as reestr_baza,
				pdv as reestr_pdv,
				(suma_invoice - zag_summ) as saldo_sum,
				(baza_invoice - baza) as saldo_baza,
				(pdvinvoice - pdv) as saldo_pdv
				from `in_erpn=reestr`
				WHERE month =m AND year=y
        AND((suma_invoice - zag_summ)<>0
        OR (baza_invoice - baza)<>0
        OR (pdvinvoice - pdv)<>0);
END
$$

--
-- Описание для процедуры getReestrInNotEqualErpn
--
DROP PROCEDURE IF EXISTS getReestrInNotEqualErpn$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getReestrInNotEqualErpn(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT ' Возвращает массив информации с реестра полученных НН которые НЕ совпали с ЕРПН по параметрам'
BEGIN
SELECT month,year,num_branch,type_invoice_full,
			num_invoice, date_format(date_create_invoice,'%d.%m.%Y'),
			inn_client,name_client,
			zag_summ,baza,pdv
			from no_valid_reestr_in
			WHEre month=m and year=y and num_branch=b;
END
$$

--
-- Описание для процедуры getReestrInNotEqualErpnAllUZ
--
DROP PROCEDURE IF EXISTS getReestrInNotEqualErpnAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getReestrInNotEqualErpnAllUZ(IN m INT, IN y INT)
  COMMENT ' Возвращает массив информации с реестра полученных НН которые НЕ совпали с ЕРПН по параметрам по всему УЗ'
BEGIN
SELECT month,year,num_branch,type_invoice_full,
			num_invoice, date_format(date_create_invoice,'%d.%m.%Y'),
			inn_client,name_client,
			zag_summ,baza,pdv
			from no_valid_reestr_in
			WHEre month=m and year=y;
END
$$

--
-- Описание для процедуры getReestrOutEqualErpn
--
DROP PROCEDURE IF EXISTS getReestrOutEqualErpn$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getReestrOutEqualErpn(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT 'Возвращает массив информации с реестра выданных НН которые совпали с ЕРПН по параметрам'
BEGIN
SELECT month,year,num_branch,type_invoice_full,
				num_invoice,
				date_format(date_create_invoice,'%d.%m.%Y'),
				inn_client,
				name_client,
				suma_invoice as edrpou_sum,
				baza_invoice as edrpou_baza,
				pdvinvoice as edrpou_pdv,
				zag_summ as reestr_sum,
				baza as reestr_baza,
				pdv as reestr_pdv,
				(suma_invoice - zag_summ) as saldo_sum,
				(baza_invoice - baza) as saldo_baza,
				(pdvinvoice - pdv) as saldo_pdv
				from `out_erpn=reestr`
				WHERE month =m AND year=y AND num_branch=b
       AND((suma_invoice - zag_summ)<>0
        OR (baza_invoice - baza)<>0
        OR (pdvinvoice - pdv)<>0);
END
$$

--
-- Описание для процедуры getReestrOutEqualErpnAllUZ
--
DROP PROCEDURE IF EXISTS getReestrOutEqualErpnAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getReestrOutEqualErpnAllUZ(IN m INT, IN y INT)
  COMMENT 'Возвращает массив информации с реестра выданных НН которые совпали с ЕРПН по параметрам по всему УЗ'
BEGIN
SELECT month,year,num_branch,type_invoice_full,
				num_invoice,
				date_format(date_create_invoice,'%d.%m.%Y'),
				inn_client,
				name_client,
				suma_invoice as edrpou_sum,
				baza_invoice as edrpou_baza,
				pdvinvoice as edrpou_pdv,
				zag_summ as reestr_sum,
				baza as reestr_baza,
				pdv as reestr_pdv,
				(suma_invoice - zag_summ) as saldo_sum,
				(baza_invoice - baza) as saldo_baza,
				(pdvinvoice - pdv) as saldo_pdv
				from `out_erpn=reestr`
				WHERE month =m AND year=y 
       AND((suma_invoice - zag_summ)<>0
        OR (baza_invoice - baza)<>0
        OR (pdvinvoice - pdv)<>0);
END
$$

--
-- Описание для процедуры getReestrOutNotEqualErpn
--
DROP PROCEDURE IF EXISTS getReestrOutNotEqualErpn$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getReestrOutNotEqualErpn(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT 'Возвращает массив информации с реестра выданных НН которые НЕ совпали с ЕРПН по параметрам'
BEGIN
SELECT month,year,num_branch,type_invoice_full,
			num_invoice, date_format(date_create_invoice,'%d.%m.%Y'),
			inn_client,name_client,
			zag_summ,baza,pdv
			from no_valid_reestr_out
			WHEre month=m and year=y and num_branch=b;
END
$$

--
-- Описание для процедуры getReestrOutNotEqualErpnAllUZ
--
DROP PROCEDURE IF EXISTS getReestrOutNotEqualErpnAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getReestrOutNotEqualErpnAllUZ(IN m INT, IN y INT)
  COMMENT 'Возвращает массив информации с реестра выданных НН которые НЕ совпали с ЕРПН по параметрам по всему УЗ'
BEGIN
SELECT month,year,num_branch,type_invoice_full,
			num_invoice, date_format(date_create_invoice,'%d.%m.%Y'),
			inn_client,name_client,
			zag_summ,baza,pdv
			from no_valid_reestr_out
			WHEre month=m and year=y;
END
$$

--
-- Описание для процедуры getTempTable_In
--
DROP PROCEDURE IF EXISTS getTempTable_In$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTempTable_In(IN month INT, IN year INT)
  COMMENT 'Формирует временные таблицы для анализа ПДВ по кредиту в резрезе ИНН за период'
BEGIN
CREATE TEMPORARY TABLE IF NOT EXISTS temp_erpn_in(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client)
  )AS 
(SELECT
    MONTH(`erpn_in`.`date_create_invoice`) AS `month_create`,
    YEAR(`erpn_in`.`date_create_invoice`) AS `year_create`,
    `erpn_in`.`inn_client` AS `inn_client`,
     SUM(`erpn_in`.`pdvinvoice`) AS `pdv`
  FROM `erpn_in`
  WHERE MONTH(`erpn_in`.`date_create_invoice`) = month
  AND YEAR(`erpn_in`.`date_create_invoice`) = year
  GROUP BY MONTH(`erpn_in`.`date_create_invoice`),
           YEAR(`erpn_in`.`date_create_invoice`),
           `erpn_in`.`inn_client`);

CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_in (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client)
  ) AS 
  (SELECT
    MONTH(`ReestrBranch_in`.`date_create_invoice`) AS `month_create`,
    YEAR(`ReestrBranch_in`.`date_create_invoice`) AS `year_create`,
    `ReestrBranch_in`.`inn_client` AS `inn_client`,
     SUM((`ReestrBranch_in`.`pdv_20` + `ReestrBranch_in`.`pdv_7`+pdv_0+pdv_zvil+pdv_ne_gos+pdv_za_mezhi)) AS `pdv`
  FROM `ReestrBranch_in`
  WHERE MONTH(`ReestrBranch_in`.`date_create_invoice`) = month
  AND YEAR(`ReestrBranch_in`.`date_create_invoice`) = year
  GROUP BY MONTH(`ReestrBranch_in`.`date_create_invoice`),
           YEAR(`ReestrBranch_in`.`date_create_invoice`),
           `ReestrBranch_in`.`inn_client`);
END
$$

--
-- Описание для процедуры getTmpTbl_InnInnerJoin
--
DROP PROCEDURE IF EXISTS getTmpTbl_InnInnerJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_InnInnerJoin(IN month INT, IN year INT)
BEGIN
    CALL getTempTable_In(month,year);
CREATE TEMPORARY TABLE IF NOT EXISTS Inn_InnerJoin(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Erpn_Inn varchar(255) DEFAULT NULL ,
    Reestr_inn varchar(255) DEFAULT NULL ,
    Erpn_pdv_PRAVO decimal(15, 2) DEFAULT NULL ,
    Reestr_pdv_FACT decimal(15, 2) DEFAULT NULL ,
    saldo_pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,  Erpn_Inn)
  ) as
  (SELECT
    temp_erpn_in.month_create AS month_create,
    temp_erpn_in.year_create AS year_create,
    temp_erpn_in.inn_client AS Erpn_Inn,
     temp_reestr_in.inn_client AS Reestr_inn,
     temp_erpn_in.pdv AS Erpn_pdv_PRAVO,
      temp_reestr_in.pdv AS Reestr_pdv_FACT,
   temp_erpn_in.pdv - temp_reestr_in.pdv AS saldo_pdv
  FROM temp_erpn_in 
    INNER JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE temp_erpn_in.pdv<>temp_reestr_in.pdv);
END
$$

--
-- Описание для процедуры getTmpTbl_InnLeftJoin
--
DROP PROCEDURE IF EXISTS getTmpTbl_InnLeftJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_InnLeftJoin(IN month INT, IN year INT)
BEGIN
    CALL getTempTable_In(month,year);
CREATE TEMPORARY TABLE IF NOT EXISTS Inn_LeftJoin(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Erpn_Inn varchar(255) DEFAULT NULL ,
    Erpn_pdv_PRAVO decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,  Erpn_Inn)
  ) as
  (SELECT
    temp_erpn_in.month_create,
    temp_erpn_in.year_create,
    temp_erpn_in.inn_client AS Erpn_Inn,
    temp_erpn_in.pdv AS Erpn_pdv_PRAVO
    FROM temp_erpn_in 
    LEFT JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE  temp_reestr_in.month_create IS NULL);
END
$$

--
-- Описание для процедуры getTmpTbl_InnRightJoin
--
DROP PROCEDURE IF EXISTS getTmpTbl_InnRightJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_InnRightJoin(IN month INT, IN year INT)
BEGIN
    CALL getTempTable_In(month,year);
CREATE TEMPORARY TABLE IF NOT EXISTS Inn_RightJoin(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Reestr_Inn varchar(255) DEFAULT NULL ,
    Reestr_pdv_Fact decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,Reestr_Inn)
  ) as
  ( SELECT
    temp_reestr_in.month_create,
    temp_reestr_in.year_create,
    temp_reestr_in.inn_client AS Reestr_Inn,
    temp_reestr_in.pdv AS Reestr_pdv_Fact
   FROM temp_erpn_in 
    RIGHT JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE temp_erpn_in.month_create IS NULL);
END
$$

--
-- Описание для процедуры getTmpTbl_OutAllUZ
--
DROP PROCEDURE IF EXISTS getTmpTbl_OutAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_OutAllUZ(IN m int, IN y int)
  COMMENT 'Формирует временные таблицы для анализа ПДВ по обязательствам в резрезе ИНН за период по УЗ '
BEGIN
  CREATE TEMPORARY TABLE IF NOT EXISTS temp_erpn_out_inn_group_numbranch_allUZ (
    month_create int(11) DEFAULT NULL,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL,
    pdv decimal(15, 2) DEFAULT NULL,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client)
  ) AS (SELECT 
      `erpn_out`.`month_create_invoice` AS `month_create`,
      `erpn_out`.`year_create_invoice` AS `year_create`,
      `erpn_out`.`inn_client` AS `inn_client`,
      SUM(`erpn_out`.`pdvinvoice`) AS `pdv`
    FROM `erpn_out`
    WHERE `erpn_out`.`month_create_invoice` = m
    AND `erpn_out`.`year_create_invoice` = y
    GROUP BY MONTH(`erpn_out`.`date_create_invoice`),
             YEAR(`erpn_out`.`date_create_invoice`),
             `erpn_out`.`inn_client`);

  CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_out_inn_group_numbranch_allUZ (
    month_create int(11) DEFAULT NULL,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL,
    pdv decimal(15, 2) DEFAULT NULL,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client)
  ) AS (SELECT
      `reestrbranch_out`.`month_create_invoice` AS `month_create`,
      `reestrbranch_out`.`year_create_invoice` AS `year_create`,
      `reestrbranch_out`.`inn_client` AS `inn_client`,
      SUM((`reestrbranch_out`.`pdv_20` + `reestrbranch_out`.`pdv_7`)) AS `pdv`
    FROM `reestrbranch_out`
    WHERE  `reestrbranch_out`.`month_create_invoice` = m
    AND  `reestrbranch_out`.`year_create_invoice` = y
    GROUP BY MONTH(`reestrbranch_out`.`date_create_invoice`),
             YEAR(`reestrbranch_out`.`date_create_invoice`),
             `reestrbranch_out`.`inn_client`);
END
$$

--
-- Описание для процедуры getTmpTbl_OutBranch
--
DROP PROCEDURE IF EXISTS getTmpTbl_OutBranch$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_OutBranch(IN m INT, IN y INT)
  COMMENT 'Формирует временные таблицы для анализа ПДВ по обязательствам в резрезе ИНН за период УЗ'
BEGIN
CREATE TEMPORARY TABLE IF NOT EXISTS  temp_erpn_out_inn_group_numbranchAll (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    num_main_branch varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  ) ENGINE = MEMORY AS 
  (SELECT
    MONTH(`erpn_out`.`date_create_invoice`) AS `month_create`,
    YEAR(`erpn_out`.`date_create_invoice`) AS `year_create`,
    `erpn_out`.`inn_client` AS `inn_client`,
    `erpn_out`.`num_main_branch` AS `num_main_branch`,
    SUM(`erpn_out`.`pdvinvoice`) AS `pdv`
  FROM `erpn_out`
  WHERE MONTH(`erpn_out`.`date_create_invoice`) = m
  AND YEAR(`erpn_out`.`date_create_invoice`) = y
  AND num_main_branch = b
  GROUP BY MONTH(`erpn_out`.`date_create_invoice`),
           YEAR(`erpn_out`.`date_create_invoice`),
           `erpn_out`.`inn_client`,
           `erpn_out`.`num_main_branch`);

CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_out_inn_group_numbranchAll (
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    inn_client varchar(255) DEFAULT NULL ,
    num_main_branch varchar(255) DEFAULT NULL ,
    pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create, inn_client, num_main_branch)
  )
  ENGINE = MEMORY AS 
  (SELECT
    MONTH(`reestrbranch_out`.`date_create_invoice`) AS `month_create`,
    YEAR(`reestrbranch_out`.`date_create_invoice`) AS `year_create`,
    `reestrbranch_out`.`inn_client` AS `inn_client`,
    `reestrbranch_out`.`num_branch` AS `num_main_branch`,
    SUM((`reestrbranch_out`.`pdv_20` + `reestrbranch_out`.`pdv_7`)) AS `pdv`
  FROM `reestrbranch_out`
  WHERE MONTH(`reestrbranch_out`.`date_create_invoice`) = m
  AND YEAR(`reestrbranch_out`.`date_create_invoice`) = y
  GROUP BY MONTH(`reestrbranch_out`.`date_create_invoice`),
           YEAR(`reestrbranch_out`.`date_create_invoice`),
           `reestrbranch_out`.`inn_client`,
           `reestrbranch_out`.`num_branch`);
END
$$

--
-- Описание для процедуры getTmpTbl_OutInnerJoin
--
DROP PROCEDURE IF EXISTS getTmpTbl_OutInnerJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_OutInnerJoin(IN m INT, IN y INT, IN b VARCHAR(255))
BEGIN
CALL AnalizPDV.getTmpTbl_OutBranch(m,y,b);
CREATE TEMPORARY TABLE IF NOT EXISTS Out_InnerJoin(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Erpn_Inn varchar(255) DEFAULT NULL ,
    Reestr_inn varchar(255) DEFAULT NULL ,
    Erpn_pdv_PRAVO decimal(15, 2) DEFAULT NULL ,
    Reestr_pdv_FACT decimal(15, 2) DEFAULT NULL ,
    saldo_pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,  Erpn_Inn)
  ) AS
  (SELECT
    temp_erpn_out_inn_group_numbranch.month_create,
    temp_erpn_out_inn_group_numbranch.year_create,
    temp_erpn_out_inn_group_numbranch.num_main_branch,
    temp_erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
    temp_reestr_out_inn_group_numbranch.inn_client AS Reestr_inn,
    temp_erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
    temp_reestr_out_inn_group_numbranch.pdv AS Reestr_pdv,
    temp_erpn_out_inn_group_numbranch.pdv - temp_reestr_out_inn_group_numbranch.pdv AS saldo_pdv
  FROM temp_erpn_out_inn_group_numbranch 
    INNER JOIN temp_reestr_out_inn_group_numbranch
      ON temp_erpn_out_inn_group_numbranch.month_create = temp_reestr_out_inn_group_numbranch.month_create
      AND temp_erpn_out_inn_group_numbranch.year_create = temp_reestr_out_inn_group_numbranch.year_create
      AND temp_erpn_out_inn_group_numbranch.num_main_branch = temp_reestr_out_inn_group_numbranch.num_main_branch
      AND temp_erpn_out_inn_group_numbranch.inn_client = temp_reestr_out_inn_group_numbranch.inn_client
  WHERE temp_erpn_out_inn_group_numbranch.month_create = m
  AND temp_erpn_out_inn_group_numbranch.year_create = y
  AND temp_erpn_out_inn_group_numbranch.num_main_branch = b
  AND (temp_erpn_out_inn_group_numbranch.pdv - temp_reestr_out_inn_group_numbranch.pdv)<>0);
END
$$

--
-- Описание для процедуры getTmpTbl_OutInnerJoinAllUZ
--
DROP PROCEDURE IF EXISTS getTmpTbl_OutInnerJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_OutInnerJoinAllUZ(IN m INT, IN y INT)
BEGIN
CALL getTmpTbl_OutAllUZ(m,y);
CREATE TEMPORARY TABLE IF NOT EXISTS Out_InnerJoinAll(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Erpn_Inn varchar(255) DEFAULT NULL ,
    Reestr_inn varchar(255) DEFAULT NULL ,
    Erpn_pdv_PRAVO decimal(15, 2) DEFAULT NULL ,
    Reestr_pdv_FACT decimal(15, 2) DEFAULT NULL ,
    saldo_pdv decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,  Erpn_Inn)
  ) AS
  (SELECT
    temp_erpn_out_inn_group_numbranch_allUZ.month_create,
    temp_erpn_out_inn_group_numbranch_allUZ.year_create,
    temp_erpn_out_inn_group_numbranch_allUZ.inn_client AS Erpn_Inn,
    temp_reestr_out_inn_group_numbranch_allUZ.inn_client AS Reestr_inn,
    temp_erpn_out_inn_group_numbranch_allUZ.pdv AS Erpn_pdv,
    temp_reestr_out_inn_group_numbranch_allUZ.pdv AS Reestr_pdv,
    temp_erpn_out_inn_group_numbranch_allUZ.pdv - temp_reestr_out_inn_group_numbranch_allUZ.pdv AS saldo_pdv
  FROM temp_erpn_out_inn_group_numbranch_allUZ 
    INNER JOIN temp_reestr_out_inn_group_numbranch_allUZ
      ON temp_erpn_out_inn_group_numbranch_allUZ.month_create = temp_reestr_out_inn_group_numbranch_allUZ.month_create
      AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = temp_reestr_out_inn_group_numbranch_allUZ.year_create
      AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client = temp_reestr_out_inn_group_numbranch_allUZ.inn_client
  WHERE temp_erpn_out_inn_group_numbranch_allUZ.month_create = m
  AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = y
  AND (temp_erpn_out_inn_group_numbranch_allUZ.pdv - temp_reestr_out_inn_group_numbranch_allUZ.pdv)<>0);
END
$$

--
-- Описание для процедуры getTmpTbl_OutLeftJoin
--
DROP PROCEDURE IF EXISTS getTmpTbl_OutLeftJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_OutLeftJoin(IN m INT, IN y INT, IN b VARCHAR(255))
  COMMENT 'формирование временных таблиц по левому объединению - данные только с ЕРПН по филиалу за период'
BEGIN
CALL AnalizPDV.getTmpTbl_OutBranch(m,y,b);
  CREATE TEMPORARY TABLE IF NOT EXISTS Out_LeftJoin(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Erpn_Inn varchar(255) DEFAULT NULL ,
    Erpn_pdv_PRAVO decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,  Erpn_Inn)
  ) as
  (SELECT
  temp_erpn_out_inn_group_numbranch.month_create,
  temp_erpn_out_inn_group_numbranch.year_create,
  temp_erpn_out_inn_group_numbranch.num_main_branch,
  temp_erpn_out_inn_group_numbranch.inn_client AS Erpn_Inn,
  temp_erpn_out_inn_group_numbranch.pdv AS Erpn_pdv
    FROM temp_erpn_out_inn_group_numbranch
  LEFT JOIN temp_reestr_out_inn_group_numbranch
    ON temp_erpn_out_inn_group_numbranch.month_create = temp_reestr_out_inn_group_numbranch.month_create
    AND temp_erpn_out_inn_group_numbranch.year_create = temp_reestr_out_inn_group_numbranch.year_create
    AND temp_erpn_out_inn_group_numbranch.num_main_branch = temp_reestr_out_inn_group_numbranch.num_main_branch
    AND temp_erpn_out_inn_group_numbranch.inn_client = temp_reestr_out_inn_group_numbranch.inn_client
 WHERE temp_erpn_out_inn_group_numbranch.month_create = m
  AND temp_erpn_out_inn_group_numbranch.year_create = y
  AND temp_erpn_out_inn_group_numbranch.num_main_branch = b
  AND temp_reestr_out_inn_group_numbranch.month_create IS NULL 
  AND temp_erpn_out_inn_group_numbranch.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.inn_client IS NULL
  AND temp_erpn_out_inn_group_numbranch.num_main_branch IS NULL
  AND (temp_erpn_out_inn_group_numbranch.pdv - COALESCE(temp_reestr_out_inn_group_numbranch.pdv,0)<>0));
END
$$

--
-- Описание для процедуры getTmpTbl_OutLeftJoinAllUZ
--
DROP PROCEDURE IF EXISTS getTmpTbl_OutLeftJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_OutLeftJoinAllUZ(IN m INT, IN y INT)
  COMMENT 'формирование временных таблиц по левому объединению - данные только с ЕРПН по филиалу за период'
BEGIN
CALL AnalizPDV.getTmpTbl_OutAllUZ(m,y);
  CREATE TEMPORARY TABLE IF NOT EXISTS Out_LeftJoinAll(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Erpn_Inn varchar(255) DEFAULT NULL ,
    Erpn_pdv_PRAVO decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,  Erpn_Inn)
  ) as
  (SELECT
  temp_erpn_out_inn_group_numbranch_allUZ.month_create,
  temp_erpn_out_inn_group_numbranch_allUZ.year_create,
  temp_erpn_out_inn_group_numbranch_allUZ.inn_client AS Erpn_Inn,
  temp_erpn_out_inn_group_numbranch_allUZ.pdv AS Erpn_pdv
    FROM temp_erpn_out_inn_group_numbranch_allUZ
  LEFT JOIN temp_reestr_out_inn_group_numbranch_allUZ
    ON temp_erpn_out_inn_group_numbranch_allUZ.month_create = temp_reestr_out_inn_group_numbranch_allUZ.month_create
    AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = temp_reestr_out_inn_group_numbranch_allUZ.year_create
    AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client = temp_reestr_out_inn_group_numbranch_allUZ.inn_client
 WHERE temp_erpn_out_inn_group_numbranch_allUZ.month_create = m
  AND temp_erpn_out_inn_group_numbranch_allUZ.year_create = y
  AND temp_reestr_out_inn_group_numbranch_allUZ.month_create IS NULL 
  AND temp_erpn_out_inn_group_numbranch_allUZ.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client IS NULL
  AND (temp_erpn_out_inn_group_numbranch_allUZ.pdv - COALESCE(temp_reestr_out_inn_group_numbranch_allUZ.pdv,0)<>0));
END
$$

--
-- Описание для процедуры getTmpTbl_OutRightJoin
--
DROP PROCEDURE IF EXISTS getTmpTbl_OutRightJoin$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_OutRightJoin(IN m INT, IN y INT, IN b VARCHAR(255))
BEGIN
 CREATE TEMPORARY TABLE IF NOT EXISTS Out_RightJoin(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Reestr_Inn varchar(255) DEFAULT NULL ,
    Reestr_pdv_Fact decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,Reestr_Inn)
  ) as
  ( SELECT
    temp_reestr_out_inn_group_numbranch.month_create AS month,
    temp_reestr_out_inn_group_numbranch.year_create AS year,
    temp_reestr_out_inn_group_numbranch.num_main_branch AS Reestr_num_main_branch,
    temp_reestr_out_inn_group_numbranch.inn_client AS Reestr_inn,
    COALESCE(temp_reestr_out_inn_group_numbranch.pdv, 0) AS Reestr_pdv
   FROM temp_reestr_out_inn_group_numbranch
    LEFT JOIN temp_erpn_out_inn_group_numbranch
      ON temp_reestr_out_inn_group_numbranch.month_create = temp_erpn_out_inn_group_numbranch.month_create
      AND temp_reestr_out_inn_group_numbranch.year_create = temp_erpn_out_inn_group_numbranch.year_create
      AND temp_reestr_out_inn_group_numbranch.num_main_branch = temp_erpn_out_inn_group_numbranch.num_main_branch
      AND temp_reestr_out_inn_group_numbranch.inn_client = temp_erpn_out_inn_group_numbranch.inn_client
  WHERE temp_reestr_out_inn_group_numbranch.month_create = m
  AND temp_reestr_out_inn_group_numbranch.year_create = y
  AND temp_reestr_out_inn_group_numbranch.num_main_branch = b
  AND temp_erpn_out_inn_group_numbranch.month_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch.inn_client IS NULL
  AND temp_erpn_out_inn_group_numbranch.num_main_branch IS NULL);
END
$$

--
-- Описание для процедуры getTmpTbl_OutRightJoinAllUZ
--
DROP PROCEDURE IF EXISTS getTmpTbl_OutRightJoinAllUZ$$
CREATE DEFINER = 'root'@'%'
PROCEDURE getTmpTbl_OutRightJoinAllUZ(IN m INT, IN y INT)
BEGIN
  CALL AnalizPDV.getTmpTbl_OutAllUZ(m,y);
 CREATE TEMPORARY TABLE IF NOT EXISTS Out_RightJoinAll(
    month_create int(11)DEFAULT NULL ,
    year_create year(4) DEFAULT NULL,
    Reestr_Inn varchar(255) DEFAULT NULL ,
    Reestr_pdv_Fact decimal(15, 2) DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (month_create, year_create,Reestr_Inn)
  ) as
  ( SELECT
    temp_reestr_out_inn_group_numbranch_allUZ.month_create AS month,
    temp_reestr_out_inn_group_numbranch_allUZ.year_create AS year,
    temp_reestr_out_inn_group_numbranch_allUZ.inn_client AS Reestr_inn,
    COALESCE(temp_reestr_out_inn_group_numbranch_allUZ.pdv, 0) AS Reestr_pdv
   FROM temp_reestr_out_inn_group_numbranch_allUZ
    LEFT JOIN temp_erpn_out_inn_group_numbranch_allUZ
      ON temp_reestr_out_inn_group_numbranch_allUZ.month_create = temp_erpn_out_inn_group_numbranch_allUZ.month_create
      AND temp_reestr_out_inn_group_numbranch_allUZ.year_create = temp_erpn_out_inn_group_numbranch_allUZ.year_create
      AND temp_reestr_out_inn_group_numbranch_allUZ.inn_client = temp_erpn_out_inn_group_numbranch_allUZ.inn_client
  WHERE temp_reestr_out_inn_group_numbranch_allUZ.month_create = m
  AND temp_reestr_out_inn_group_numbranch_allUZ.year_create = y
  AND temp_erpn_out_inn_group_numbranch_allUZ.month_create IS NULL
  AND temp_erpn_out_inn_group_numbranch_allUZ.year_create IS NULL
  AND temp_erpn_out_inn_group_numbranch_allUZ.inn_client IS NULL);
END
$$

--
-- Описание для процедуры `get_erpn=reestr_by_dateCreate`
--
DROP PROCEDURE IF EXISTS `get_erpn=reestr_by_dateCreate`$$
CREATE DEFINER = 'root'@'%'
PROCEDURE `get_erpn=reestr_by_dateCreate`(IN month int, IN year int)
  COMMENT 'Возвращает результат внутреннего соединения для данных ЕРПН и Реестров'
BEGIN
  SELECT
    Erpn_out_svod_inn_date_create.month_create,
    Erpn_out_svod_inn_date_create.year_create,
    Erpn_out_svod_inn_date_create.inn,
    Erpn_out_svod_inn_date_create.numMainBranch,
    Erpn_out_svod_inn_date_create.sum_pdv AS erpn_pdv,
    Reestr_out_svod_inn_date_create.sum_pdv AS reestr_pdv,
    (Erpn_out_svod_inn_date_create.sum_pdv - Reestr_out_svod_inn_date_create.sum_pdv) AS saldo
  FROM Erpn_out_svod_inn_date_create
    INNER JOIN Reestr_out_svod_inn_date_create
      ON Erpn_out_svod_inn_date_create.key_ = Reestr_out_svod_inn_date_create.key_
  WHERE Erpn_out_svod_inn_date_create.month_create = month
  AND Erpn_out_svod_inn_date_create.year_create = year;
END
$$

--
-- Описание для функции getMonth
--
DROP FUNCTION IF EXISTS getMonth$$
CREATE DEFINER = 'root'@'%'
FUNCTION getMonth(`str` VARCHAR(200))
  RETURNS int(11)
  DETERMINISTIC
BEGIN
    DECLARE d_txt varchar(20);
		DECLARE d_d int;
			DECLARE ret int;
 		set d_txt=LEFT(TRIM(str), 10);
			set d_d=STR_TO_DATE(d_txt, '%d.%m.%Y');
				set ret=MONTH(d_d);
 RETURN (ret);
END
$$

--
-- Описание для функции getYear
--
DROP FUNCTION IF EXISTS getYear$$
CREATE DEFINER = 'root'@'%'
FUNCTION getYear(`str` VARCHAR(200))
  RETURNS int(11)
BEGIN
DECLARE d_d int;
DECLARE d_txt varchar(20);
DECLARE ret int;
set d_txt=LEFT(TRIM(str), 10);
set d_d=STR_TO_DATE(d_txt, '%d.%m.%Y');
set ret = YEAR(d_d);
RETURN (ret);
END
$$

DELIMITER ;

--
-- Описание для представления `in_erpn=reestr`
--
DROP VIEW IF EXISTS `in_erpn=reestr` CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW `in_erpn=reestr`
AS
	select `ei`.`num_invoice` AS `num_invoice`,`ei`.`date_create_invoice` AS `date_create_invoice`,`ei`.`type_invoice_full` AS `type_invoice_full`,`ei`.`inn_client` AS `inn_client`,`ei`.`name_client` AS `name_client`,`ei`.`suma_invoice` AS `suma_invoice`,`ei`.`pdvinvoice` AS `pdvinvoice`,`ei`.`baza_invoice` AS `baza_invoice`,`ei`.`name_vendor` AS `name_vendor`,`ei`.`num_branch_client` AS `num_branch_client`,`rbi`.`zag_summ` AS `zag_summ`,(((((`rbi`.`pdv_20` + `rbi`.`pdv_7`) + `rbi`.`pdv_0`) + `rbi`.`pdv_ne_gos`) + `rbi`.`pdv_zvil`) + `rbi`.`pdv_za_mezhi`) AS `pdv`,(((((`rbi`.`baza_20` + `rbi`.`baza_7`) + `rbi`.`baza_0`) + `rbi`.`baza_zvil`) + `rbi`.`pdv_ne_gos`) + `rbi`.`pdv_za_mezhi`) AS `baza`,`rbi`.`num_branch` AS `num_branch`,`rbi`.`month` AS `month`,`rbi`.`year` AS `year` from (`erpn_in` `ei` join `reestrbranch_in` `rbi` on((`ei`.`key_field` = `rbi`.`key_field`)));

--
-- Описание для представления `out_erpn=reestr_by_inn`
--
DROP VIEW IF EXISTS `out_erpn=reestr_by_inn` CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW `out_erpn=reestr_by_inn`
AS
	select `erpn_out_svod_inn_date_create`.`month_create` AS `month_create`,`erpn_out_svod_inn_date_create`.`year_create` AS `year_create`,`erpn_out_svod_inn_date_create`.`inn` AS `inn`,`erpn_out_svod_inn_date_create`.`numBranch` AS `numBranch`,`erpn_out_svod_inn_date_create`.`sum_pdv` AS `erpn_pdv`,`reestr_out_svod_inn_date_create`.`sum_pdv` AS `reestr_pdv`,(`erpn_out_svod_inn_date_create`.`sum_pdv` - `reestr_out_svod_inn_date_create`.`sum_pdv`) AS `saldo` from (`erpn_out_svod_inn_date_create` join `reestr_out_svod_inn_date_create` on((`erpn_out_svod_inn_date_create`.`key_` = `reestr_out_svod_inn_date_create`.`key_`)));

--
-- Описание для представления `out_erpn=reestr`
--
DROP VIEW IF EXISTS `out_erpn=reestr` CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW `out_erpn=reestr`
AS
	select `eo`.`num_invoice` AS `num_invoice`,`eo`.`date_create_invoice` AS `date_create_invoice`,`eo`.`type_invoice_full` AS `type_invoice_full`,`eo`.`inn_client` AS `inn_client`,`eo`.`name_client` AS `name_client`,`eo`.`suma_invoice` AS `suma_invoice`,`eo`.`pdvinvoice` AS `pdvinvoice`,`eo`.`baza_invoice` AS `baza_invoice`,`eo`.`name_vendor` AS `name_vendor`,`eo`.`num_branch_client` AS `num_branch_client`,`rbo`.`zag_summ` AS `zag_summ`,(`rbo`.`pdv_20` + `rbo`.`pdv_7`) AS `pdv`,((((((`rbo`.`baza_20` + `rbo`.`baza_7`) + `rbo`.`baza_0`) + `rbo`.`baza_zvil`) + `rbo`.`baza_ne_obj`) + `rbo`.`baza_za_mezhi_tovar`) + `rbo`.`baza_za_mezhi_poslug`) AS `baza`,`rbo`.`num_branch` AS `num_branch`,`rbo`.`month` AS `month`,`rbo`.`year` AS `year` from (`erpn_out` `eo` join `reestrbranch_out` `rbo` on((`eo`.`key_field` = `rbo`.`key_field`)));

--
-- Описание для представления erpn_in_svod_to_date_create_invoice
--
DROP VIEW IF EXISTS erpn_in_svod_to_date_create_invoice CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW erpn_in_svod_to_date_create_invoice
AS
	select month(`ei`.`date_create_invoice`) AS `month_create`,year(`ei`.`date_create_invoice`) AS `year_create`,`ei`.`inn_client` AS `inn_client`,`ei`.`suma_invoice` AS `suma_invoice`,`ei`.`pdvinvoice` AS `pdvinvoice`,`ei`.`baza_invoice` AS `baza_invoice`,`ei`.`key_field` AS `key_field` from `erpn_in` `ei`;

--
-- Описание для представления erpn_out_inn_group_numbranch
--
DROP VIEW IF EXISTS erpn_out_inn_group_numbranch CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW erpn_out_inn_group_numbranch
AS
	select month(`erpn_out`.`date_create_invoice`) AS `month_create`,year(`erpn_out`.`date_create_invoice`) AS `year_create`,`erpn_out`.`inn_client` AS `inn_client`,`erpn_out`.`num_main_branch` AS `num_main_branch`,sum(`erpn_out`.`pdvinvoice`) AS `pdv` from `erpn_out` group by month(`erpn_out`.`date_create_invoice`),year(`erpn_out`.`date_create_invoice`),`erpn_out`.`inn_client`,`erpn_out`.`num_main_branch`;

--
-- Описание для представления erpn_out_svod_to_date_create_invoice
--
DROP VIEW IF EXISTS erpn_out_svod_to_date_create_invoice CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW erpn_out_svod_to_date_create_invoice
AS
	select `erpn_out_svod_inn_date_create`.`month_create` AS `month_create`,`erpn_out_svod_inn_date_create`.`year_create` AS `year_create`,`erpn_out_svod_inn_date_create`.`inn` AS `inn`,`erpn_out_svod_inn_date_create`.`numBranch` AS `numBranch`,sum(`erpn_out_svod_inn_date_create`.`sum_pdv`) AS `expr1` from `erpn_out_svod_inn_date_create` group by `erpn_out_svod_inn_date_create`.`id`,`erpn_out_svod_inn_date_create`.`month_create`,`erpn_out_svod_inn_date_create`.`year_create`,`erpn_out_svod_inn_date_create`.`inn`,`erpn_out_svod_inn_date_create`.`numBranch`;

--
-- Описание для представления erpn_out_svod_to_date_create_invoice_copy
--
DROP VIEW IF EXISTS erpn_out_svod_to_date_create_invoice_copy CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW erpn_out_svod_to_date_create_invoice_copy
AS
	select month(`eo`.`date_create_invoice`) AS `month_create`,year(`eo`.`date_create_invoice`) AS `year_create`,`eo`.`inn_client` AS `inn_client`,`eo`.`suma_invoice` AS `suma_invoice`,`eo`.`pdvinvoice` AS `pdvinvoice`,`eo`.`baza_invoice` AS `baza_invoice`,`eo`.`key_field` AS `key_field` from `erpn_out` `eo`;

--
-- Описание для представления no_valid_reestr_in
--
DROP VIEW IF EXISTS no_valid_reestr_in CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW no_valid_reestr_in
AS
	select `rbi`.`id` AS `id`,`rbi`.`month` AS `month`,`rbi`.`year` AS `year`,`rbi`.`num_branch` AS `num_branch`,`rbi`.`date_get_invoice` AS `date_get_invoice`,`rbi`.`date_create_invoice` AS `date_create_invoice`,`rbi`.`num_invoice` AS `num_invoice`,`rbi`.`type_invoice_full` AS `type_invoice_full`,`rbi`.`name_client` AS `name_client`,`rbi`.`inn_client` AS `inn_client`,`rbi`.`zag_summ` AS `zag_summ`,`rbi`.`baza_zvil` AS `baza_zvil`,((`rbi`.`pdv_20` + `rbi`.`pdv_7`) + `rbi`.`pdv_0`) AS `pdv`,((`rbi`.`baza_20` + `rbi`.`baza_7`) + `rbi`.`baza_0`) AS `baza`,`rbi`.`pdv_zvil` AS `pdv_zvil`,`rbi`.`baza_ne_gos` AS `baza_ne_gos`,`rbi`.`pdv_ne_gos` AS `pdv_ne_gos`,`rbi`.`baza_za_mezhi` AS `baza_za_mezhi`,`rbi`.`pdv_za_mezhi` AS `pdv_za_mezhi`,`rbi`.`rke_date_create_invoice` AS `rke_date_create_invoice`,`rbi`.`rke_num_invoice` AS `rke_num_invoice`,`rbi`.`rke_pidstava` AS `rke_pidstava`,`rbi`.`key_field` AS `key_field` from (`reestrbranch_in` `rbi` left join `erpn_in` `ei` on((`rbi`.`key_field` = `ei`.`key_field`))) where isnull(`ei`.`key_field`);

--
-- Описание для представления no_valid_reestr_out
--
DROP VIEW IF EXISTS no_valid_reestr_out CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW no_valid_reestr_out
AS
	select `rbo`.`id` AS `id`,`rbo`.`month` AS `month`,`rbo`.`year` AS `year`,`rbo`.`num_branch` AS `num_branch`,`rbo`.`date_create_invoice` AS `date_create_invoice`,`rbo`.`num_invoice` AS `num_invoice`,`rbo`.`type_invoice_full` AS `type_invoice_full`,`rbo`.`name_client` AS `name_client`,`rbo`.`inn_client` AS `inn_client`,`rbo`.`zag_summ` AS `zag_summ`,(`rbo`.`pdv_20` + `rbo`.`pdv_7`) AS `pdv`,(`rbo`.`baza_20` + `rbo`.`baza_7`) AS `baza`,`rbo`.`baza_zvil` AS `baza_zvil`,`rbo`.`baza_ne_obj` AS `baza_ne_obj`,`rbo`.`baza_za_mezhi_tovar` AS `baza_za_mezhi_tovar`,`rbo`.`baza_za_mezhi_poslug` AS `baza_za_mezhi_poslug`,`rbo`.`rke_date_create_invoice` AS `rke_date_create_invoice`,`rbo`.`rke_num_invoice` AS `rke_num_invoice`,`rbo`.`rke_pidstava` AS `rke_pidstava` from (`reestrbranch_out` `rbo` left join `erpn_out` `eo` on((`rbo`.`key_field` = `eo`.`key_field`))) where isnull(`eo`.`key_field`);

--
-- Описание для представления reestr_out_inn_group_numbranch
--
DROP VIEW IF EXISTS reestr_out_inn_group_numbranch CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW reestr_out_inn_group_numbranch
AS
	select month(`reestrbranch_out`.`date_create_invoice`) AS `MONTH(ReestrBranch_out.date_create_invoice)`,year(`reestrbranch_out`.`date_create_invoice`) AS `YEAR(ReestrBranch_out.date_create_invoice)`,`reestrbranch_out`.`inn_client` AS `inn`,`reestrbranch_out`.`num_branch` AS `num_branch`,sum((`reestrbranch_out`.`pdv_20` + `reestrbranch_out`.`pdv_7`)) AS `pdv`,concat_ws('/',month(`reestrbranch_out`.`date_create_invoice`),year(`reestrbranch_out`.`date_create_invoice`),`reestrbranch_out`.`inn_client`,`reestrbranch_out`.`num_branch`) AS `key_` from `reestrbranch_out` group by month(`reestrbranch_out`.`date_create_invoice`),year(`reestrbranch_out`.`date_create_invoice`),`reestrbranch_out`.`inn_client`,`reestrbranch_out`.`num_branch`,concat_ws('/',month(`reestrbranch_out`.`date_create_invoice`),year(`reestrbranch_out`.`date_create_invoice`),`reestrbranch_out`.`inn_client`,`reestrbranch_out`.`num_branch`);

--
-- Описание для представления reestr_out_svod_to_date_create_invoice
--
DROP VIEW IF EXISTS reestr_out_svod_to_date_create_invoice CASCADE;
CREATE OR REPLACE 
	DEFINER = 'root'@'%'
VIEW reestr_out_svod_to_date_create_invoice
AS
	select `reestr_out_svod_inn_date_create`.`month_create` AS `month_create`,`reestr_out_svod_inn_date_create`.`year_create` AS `year_create`,`reestr_out_svod_inn_date_create`.`inn` AS `inn`,`reestr_out_svod_inn_date_create`.`numBranch` AS `numBranch`,sum(`reestr_out_svod_inn_date_create`.`sum_pdv`) AS `expr1` from `reestr_out_svod_inn_date_create` group by `reestr_out_svod_inn_date_create`.`id`,`reestr_out_svod_inn_date_create`.`month_create`,`reestr_out_svod_inn_date_create`.`year_create`,`reestr_out_svod_inn_date_create`.`inn`,`reestr_out_svod_inn_date_create`.`numBranch`;

DELIMITER $$

--
-- Описание для триггера Add_num_main_branch
--
DROP TRIGGER IF EXISTS Add_num_main_branch$$
CREATE 
	DEFINER = 'root'@'%'
TRIGGER Add_num_main_branch
	BEFORE INSERT
	ON erpn_out
	FOR EACH ROW
BEGIN
  set new.num_main_branch=(SELECT num_main_branch FROM SprBranch WHERE num_branch=new.num_branch_vendor);
  SET new.month_create_invoice=MONTH(new.date_create_invoice);
  set new.year_create_invoice=YEAR(new.date_create_invoice);
END
$$

--
-- Описание для триггера Erpn_in_after_insert
--
DROP TRIGGER IF EXISTS Erpn_in_after_insert$$
CREATE 
	DEFINER = 'root'@'%'
TRIGGER Erpn_in_after_insert
	AFTER INSERT
	ON erpn_in
	FOR EACH ROW
BEGIN
DECLARE get_Month int;
DECLARE get_Year int;
IF new.type_invoice_full="ПНЕ" or new.rke_info='' THEN 
	INSERT INTO Erpn_in_svod_inn(Erpn_in_svod_inn.month,Erpn_in_svod_inn.year,Erpn_in_svod_inn.inn,Erpn_in_svod_inn.suma_invoice,
	Erpn_in_svod_inn.pdvinvoice,Erpn_in_svod_inn.baza_invoice,Erpn_in_svod_inn.key_field) 
	VALUES(MONTH(new.date_create_invoice),YEAR(new.date_create_invoice),new.inn_client,new.suma_invoice,
	new.pdvinvoice,new.baza_invoice,new.key_field);
END IF;

IF new.type_invoice_full="РКЕ" and new.rke_info<>'' THEN 
	set get_Month = getMonth(new.rke_info);
	set get_Year = 	getYear(new.rke_info);
	INSERT INTO Erpn_in_svod_inn(Erpn_in_svod_inn.month,Erpn_in_svod_inn.year,Erpn_in_svod_inn.inn,Erpn_in_svod_inn.suma_invoice,
	Erpn_in_svod_inn.pdvinvoice,Erpn_in_svod_inn.baza_invoice,Erpn_in_svod_inn.key_field) 
	VALUES(get_Month,get_Year,new.inn_client,new.suma_invoice,
	new.pdvinvoice,new.baza_invoice,new.key_field);
END IF;
END
$$

--
-- Описание для триггера Erpn_out_after_insert
--
DROP TRIGGER IF EXISTS Erpn_out_after_insert$$
CREATE 
	DEFINER = 'root'@'%'
TRIGGER Erpn_out_after_insert
	AFTER INSERT
	ON erpn_out
	FOR EACH ROW
BEGIN
IF new.type_invoice_full="ПНЕ" or new.rke_info='' THEN 
	INSERT INTO Erpn_out_svod_inn(Erpn_out_svod_inn.month,Erpn_out_svod_inn.year,Erpn_out_svod_inn.inn,Erpn_out_svod_inn.suma_invoice,
	Erpn_out_svod_inn.pdvinvoice,Erpn_out_svod_inn.baza_invoice,Erpn_out_svod_inn.key_field) 
	VALUES(MONTH(new.date_create_invoice),YEAR(new.date_create_invoice),new.inn_client,new.suma_invoice,
	new.pdvinvoice,new.baza_invoice,new.key_field);
END IF;
IF new.type_invoice_full="РКЕ" and new.rke_info<>'' THEN 
	INSERT INTO Erpn_out_svod_inn(Erpn_out_svod_inn.month,Erpn_out_svod_inn.year,Erpn_out_svod_inn.inn,Erpn_out_svod_inn.suma_invoice,
	Erpn_out_svod_inn.pdvinvoice,Erpn_out_svod_inn.baza_invoice,Erpn_out_svod_inn.key_field) 
	VALUES(getMonth(new.rke_info),getYear(new.rke_info),new.inn_client,new.suma_invoice,
	new.pdvinvoice,new.baza_invoice,new.key_field);
END IF;
END
$$

--
-- Описание для триггера Reestr_in_after_delete
--
DROP TRIGGER IF EXISTS Reestr_in_after_delete$$
CREATE 
	DEFINER = 'root'@'%'
TRIGGER Reestr_in_after_delete
	AFTER DELETE
	ON ReestrBranch_in
	FOR EACH ROW
BEGIN
  delete from AnalizPDV.Reestr_in_svod_inn
    where numBranch = old.num_branch
      AND
      key_field = OLD.key_field;

delete from AnalizPDV.ErrorLoadReestr
    where numBranch = old.num_branch
      AND
      key_field = OLD.key_field
      and
      Error="In";
END
$$

--
-- Описание для триггера Reestr_in_after_insert
--
DROP TRIGGER IF EXISTS Reestr_in_after_insert$$
CREATE 
	DEFINER = 'root'@'%'
TRIGGER Reestr_in_after_insert
	AFTER INSERT
	ON ReestrBranch_in
	FOR EACH ROW
BEGIN
  DECLARE get_Month int;
DECLARE get_Year int;
DECLARE pdv float;
DECLARE baza float;
set pdv=	(new.pdv_20+new.pdv_7+new.pdv_0);
set baza =  (new.baza_20+new.baza_7+new.baza_0+new.baza_zvil+new.baza_ne_gos+new.baza_za_mezhi);
IF new.type_invoice_full="ПНЕ" or (new.rke_date_create_invoice is null) THEN 
	INSERT INTO Reestr_in_svod_inn(Reestr_in_svod_inn.month,Reestr_in_svod_inn.year,Reestr_in_svod_inn.inn,Reestr_in_svod_inn.suma_invoice,
	Reestr_in_svod_inn.pdvinvoice,Reestr_in_svod_inn.baza_invoice,Reestr_in_svod_inn.key_field,Reestr_in_svod_inn.numBranch) 
	VALUES(MONTH(new.date_create_invoice),YEAR(new.date_create_invoice),new.inn_client,new.zag_summ,
	pdv,baza,new.key_field,new.num_branch);
END IF;

IF new.type_invoice_full="РКЕ" and (new.rke_date_create_invoice is not null) THEN 
	set get_Month = month(new.rke_date_create_invoice);
	set get_Year = 	year(new.rke_date_create_invoice);
	INSERT INTO Reestr_in_svod_inn(Reestr_in_svod_inn.month,Reestr_in_svod_inn.year,Reestr_in_svod_inn.inn,Reestr_in_svod_inn.suma_invoice,
	Reestr_in_svod_inn.pdvinvoice,Reestr_in_svod_inn.baza_invoice,Reestr_in_svod_inn.key_field,Reestr_in_svod_inn.numBranch) 
	VALUES(get_Month,get_Year,new.inn_client,new.zag_summ,
	pdv,baza,new.key_field,new.num_branch);
END IF;
END
$$

--
-- Описание для триггера Reestr_out_after_delete
--
DROP TRIGGER IF EXISTS Reestr_out_after_delete$$
CREATE 
	DEFINER = 'root'@'%'
TRIGGER Reestr_out_after_delete
	AFTER DELETE
	ON reestrbranch_out
	FOR EACH ROW
BEGIN
   delete from AnalizPDV.Reestr_out_svod_inn
    where numBranch = old.num_branch
      AND
      key_field = OLD.key_field;
  delete from AnalizPDV.ErrorLoadReestr
    where numBranch = old.num_branch
      AND
      key_field = OLD.key_field
      and
      Error="Out";
END
$$

--
-- Описание для триггера Reestr_out_after_insert
--
DROP TRIGGER IF EXISTS Reestr_out_after_insert$$
CREATE 
	DEFINER = 'root'@'%'
TRIGGER Reestr_out_after_insert
	AFTER INSERT
	ON reestrbranch_out
	FOR EACH ROW
BEGIN
DECLARE get_Month int;
DECLARE get_Year int;
DECLARE pdv float;
DECLARE baza float;
set pdv=	(new.pdv_20+new.pdv_7);
set baza =  (new.baza_20+new.baza_7+new.baza_0+new.baza_zvil+new.baza_ne_obj+new.baza_za_mezhi_tovar+new.baza_za_mezhi_poslug);
IF new.type_invoice_full="ПНЕ" or (new.rke_date_create_invoice is null) THEN 

	INSERT INTO Reestr_out_svod_inn(Reestr_out_svod_inn.month,Reestr_out_svod_inn.year,Reestr_out_svod_inn.inn,Reestr_out_svod_inn.suma_invoice,
	Reestr_out_svod_inn.pdvinvoice,Reestr_out_svod_inn.baza_invoice,Reestr_out_svod_inn.key_field,Reestr_out_svod_inn.numBranch) 
	VALUES(MONTH(new.date_create_invoice),YEAR(new.date_create_invoice),new.inn_client,new.zag_summ,
	pdv,baza,new.key_field,new.num_branch);
END IF;

IF new.type_invoice_full="РКЕ" and (new.rke_date_create_invoice is not null) THEN 
	set get_Month = month(new.rke_date_create_invoice);
	set get_Year = 	year(new.rke_date_create_invoice);
	INSERT INTO Reestr_out_svod_inn(Reestr_out_svod_inn.month,Reestr_out_svod_inn.year,Reestr_out_svod_inn.inn,Reestr_out_svod_inn.suma_invoice,
	Reestr_out_svod_inn.pdvinvoice,Reestr_out_svod_inn.baza_invoice,Reestr_out_svod_inn.key_field,Reestr_out_svod_inn.numBranch) 
	VALUES(get_Month,get_Year,new.inn_client,new.zag_summ,
	pdv,baza,new.key_field,new.num_branch);
END IF;
END
$$

--
-- Описание для триггера Reestr_out_BEFORE_INSERT
--
DROP TRIGGER IF EXISTS Reestr_out_BEFORE_INSERT$$
CREATE 
	DEFINER = 'root'@'%'
TRIGGER Reestr_out_BEFORE_INSERT
	BEFORE INSERT
	ON reestrbranch_out
	FOR EACH ROW
BEGIN
  SET new.month_create_invoice=MONTH(new.date_create_invoice);
  set new.year_create_invoice=YEAR(new.date_create_invoice);

END
$$

DELIMITER ;

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;