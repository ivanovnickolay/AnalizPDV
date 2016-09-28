  CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromBranch (
    key_field varchar(50) DEFAULT NULL,
    diffDate bigint DEFAULT NULL,
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    INDEX main USING BTREE (key_field),
    INDEX diff USING BTREE (diffDate)
  )  AS (SELECT
      eo.key_field AS key_field,
      DATEDIFF(eo.date_reg_invoice, eo.date_create_invoice) AS diffDate
    FROM erpn_out eo
    WHERE eo.type_invoice_full = "ПНЕ"
   AND MONTH(eo.date_create_invoice)=8
  AND YEAR(eo.date_create_invoice)=2016);

  SELECT
    rbo.month,
    rbo.year,
    rbo.num_branch,
    rbo.date_create_invoice,
    rbo.num_invoice,
    rbo.inn_client,
    rbo.name_client
    INTO OUTFILE 'D:\\OpenServer525\\domains\\AnalizPDV\\web\\Doc\\InvoiceOut\\export_data15.txt' CHARACTER SET cp1251
  FROM ReestrBranch_out rbo
    INNER JOIN temp_diffDateFromBranch
      ON rbo.key_field = temp_diffDateFromBranch.key_field
  WHERE temp_diffDateFromBranch.diffDate >= 16;