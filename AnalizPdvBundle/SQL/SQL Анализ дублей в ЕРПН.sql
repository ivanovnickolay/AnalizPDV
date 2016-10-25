SELECT
  rbi.key_field,
    COUNT(rbi.key_field) AS expr1
FROM erpn_in rbi
 GROUP BY   
  rbi.key_field
ORDER BY expr1 DESC;

SELECT
  rbi.key_field,
    COUNT(rbi.key_field) AS expr1
FROM erpn_out rbi
 GROUP BY   
  rbi.key_field
  
ORDER BY expr1 DESC;