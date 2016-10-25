SELECT * FROM erpn_in ei
WHERE CONCAT(ei.num_invoice,ei.date_create_invoice,ei.type_invoice_full) IN (
                      SELECT CONCAT(ei1.num_invoice,ei1.date_create_invoice,ei1.type_invoice_full)
                      FROM erpn_in ei1
                      GROUP BY ei1.num_invoice, ei1.date_create_invoice, ei1.type_invoice_full
                      HAVING COUNT(ei1.id)>1
                     )
  AND MONTH(ei.date_create_invoice)=8
  AND YEAR(ei.date_create_invoice)=2016

