SELECT
  rbi.key_field,
  rbi.num_branch,
  rbi.date_get_invoice, 
  rbi.num_invoice, 
  rbi.type_invoice_full, 
  rbi.name_client, 
  rbi.inn_client,
  rbi.zag_summ,
  COUNT(rbi.key_field) AS expr1
FROM ReestrBranch_in rbi
  WHERE rbi.month=:m
  AND rbi.year =:y
GROUP BY   
  rbi.key_field,
  rbi.num_branch,
  rbi.date_get_invoice, 
  rbi.num_invoice, 
  rbi.type_invoice_full, 
  rbi.name_client, 
  rbi.inn_client,
  rbi.zag_summ
ORDER BY expr1 DESC;
    