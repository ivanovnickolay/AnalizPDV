CREATE TEMPORARY TABLE IF NOT EXISTS temp_reestr_out(
   key_f char(255),
    cnt_key int,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (cnt_key)
  )AS 
(SELECT 
  rbi.key_field AS key_f , COUNT(rbi.key_field)  AS cnt_key FROM ReestrBranch_out rbi
   GROUP BY 
  rbi.key_field);

SELECT 
  rbo.month, 
  rbo.year, 
  rbo.num_branch,
  rbo.date_create_invoice,
  rbo.num_invoice, 
  rbo.type_invoice_full,
  rbo.name_client,
  rbo.inn_client,
  rbo.zag_summ,
  (rbo.baza_20+rbo.baza_7+rbo.baza_0+rbo.baza_zvil+rbo.baza_ne_obj+rbo.baza_za_mezhi_tovar+rbo.baza_za_mezhi_poslug) AS basa,
  (rbo.pdv_20+rbo.pdv_7) AS PDV,
  rbo.key_field

FROM reestrbranch_out rbo,temp_reestr_out tri
WHERE rbo.key_field = tri.key_f AND tri.cnt_key>1 AND rbo.type_invoice_full IN ("ПНЕ","РКЕ")