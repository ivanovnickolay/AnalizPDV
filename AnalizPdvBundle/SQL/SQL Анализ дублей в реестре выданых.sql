SELECT
  rbo.key_field,rbo.num_branch,
  COUNT(rbo.key_field) AS expr1
FROM ReestrBranch_out rbo
  WHERE rbo.type_invoice_full IN ("ПНЕ","РКЕ")
  GROUP BY rbo.key_field,rbo.num_branch
ORDER BY expr1 DESC;