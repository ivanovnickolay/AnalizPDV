CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_in(
   key_f char(255),
    cnt_key int,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (cnt_key)
  )AS 
(SELECT 
  rbi.key_field AS key_f , COUNT(rbi.key_field)  AS cnt_key FROM ReestrBranch_in rbi
   GROUP BY 
  rbi.key_field);
SELECT rbi.month, 
  rbi.year, 
  rbi.num_branch, 
  rbi.date_get_invoice, 
  rbi.date_create_invoice, 
  rbi.num_invoice, 
  rbi.type_invoice_full, 
  rbi.name_client, 
  rbi.inn_client, 
  rbi.zag_summ, 
  (((((`rbi`.`pdv_20` + `rbi`.`pdv_7`) + `rbi`.`pdv_0`) + `rbi`.`pdv_ne_gos`) + `rbi`.`pdv_zvil`) + `rbi`.`pdv_za_mezhi`) AS `pdv`,
  (((((`rbi`.`baza_20` + `rbi`.`baza_7`) + `rbi`.`baza_0`) + `rbi`.`baza_zvil`) + `rbi`.`pdv_ne_gos`) + `rbi`.`pdv_za_mezhi`) AS `baza`,
  rbi.key_field,
  ei.name_vendor
  FROM ReestrBranch_in rbi
  LEFT JOIN erpn_in ei
  ON rbi.key_field=ei.key_field
  INNER JOIN temp_reestr_in tri 
   ON rbi.key_field = tri.key_f
  WHERE tri.cnt_key>1 AND rbi.type_invoice_full IN ("ПНЕ","РКЕ");