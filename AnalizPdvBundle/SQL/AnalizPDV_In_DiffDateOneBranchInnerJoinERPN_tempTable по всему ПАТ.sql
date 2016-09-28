CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromBranch  (
   key_field varchar(50)DEFAULT NULL ,
    diffDate bigint DEFAULT NULL ,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (key_field),
    INDEX diff USING BTREE (diffDate)
  ) AS  
  (
  SELECT 
    eo.key_field AS key_field,
    DATEDIFF(eo.date_reg_invoice,eo.date_create_invoice) AS diffDate
  FROM erpn_in eo
  WHERE eo.type_invoice_full = "РКЕ" and eo.pdvinvoice<0
 );

  SELECT num_invoice, date_create_invoice, date_reg_invoice,(diffDate-15) AS diff, 
  type_invoice_full, inn_client, name_client, suma_invoice, pdvinvoice, baza_invoice, 
  name_vendor,num_branch_vendor
    INTO OUTFILE 'D:\\OpenServer525\\domains\\AnalizPDV\\web\\Doc\\InvoiceIn\\export_data1.csv' CHARACTER SET cp1251 
	 FROM erpn_in
   INNER JOIN temp_diffDateFromBranch ON
    erpn_in.key_field=temp_diffDateFromBranch.key_field
    WHERE temp_diffDateFromBranch.diffDate>=16;