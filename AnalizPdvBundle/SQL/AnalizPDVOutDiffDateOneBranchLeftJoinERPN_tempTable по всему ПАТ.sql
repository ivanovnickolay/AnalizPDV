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
  AND MONTH(eo.date_create_invoice)=8
  AND YEAR(eo.date_create_invoice)=2016
 );
  
  SELECT num_invoice, date_create_invoice, date_reg_invoice,(DATEDIFF(date_reg_invoice, date_create_invoice)-15) AS diff, 
  type_invoice_full, inn_client, name_client, suma_invoice, pdvinvoice, baza_invoice, 
  name_vendor,num_branch_vendor, num_main_branch 
     INTO OUTFILE 'D:\\OpenServer525\\domains\\AnalizPDV\\web\\Doc\\InvoiceOut\\export_data16.txt' CHARACTER SET cp1251
    FROM erpn_out
      WHERE key_field IN(
  SELECT temp_diffDateFromBranch.key_field FROM temp_diffDateFromBranch 
   LEFT JOIN ReestrBranch_out ON
    temp_diffDateFromBranch.key_field=ReestrBranch_out.key_field
    WHERE temp_diffDateFromBranch.diffDate>=16
      AND ReestrBranch_out.key_field IS NULL) ;