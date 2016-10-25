SELECT * FROM erpn_out eo
WHERE CONCAT(eo.num_invoice,eo.date_create_invoice,eo.type_invoice_full) IN (
                      SELECT CONCAT(eo.num_invoice,eo.date_create_invoice,eo.type_invoice_full)
                      FROM erpn_out eo
                      GROUP BY eo.num_invoice,eo.date_create_invoice,eo.type_invoice_full
                      HAVING COUNT(eo.id)>1
                     )
AND MONTH(eo.date_create_invoice)=8
AND YEAR(eo.date_create_invoice)=2016;
