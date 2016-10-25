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
  WHERE MONTH(`erpn_in`.`date_create_invoice`) = 5
  AND YEAR(`erpn_in`.`date_create_invoice`) = 2016
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
  WHERE MONTH(`ReestrBranch_in`.`date_create_invoice`) = 5
  AND YEAR(`ReestrBranch_in`.`date_create_invoice`) = 2016
  GROUP BY MONTH(`ReestrBranch_in`.`date_create_invoice`),
           YEAR(`ReestrBranch_in`.`date_create_invoice`),
           `ReestrBranch_in`.`inn_client`);
 SELECT
    temp_erpn_in.month_create,
    temp_erpn_in.year_create,
    temp_erpn_in.inn_client AS Erpn_Inn,
     temp_reestr_in.inn_client AS Reestr_inn,
     temp_erpn_in.pdv AS Erpn_pdv,
      temp_reestr_in.pdv AS Reestr_pdv,
   temp_erpn_in.pdv - temp_reestr_in.pdv AS saldo_pdv
  FROM temp_erpn_in 
    INNER JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE temp_erpn_in.pdv<temp_reestr_in.pdv
