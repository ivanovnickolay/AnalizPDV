INSERT INTO Erpn_out_svod_inn_date_create(
month_create,
year_create,
inn,
numMainBranch,
sum_pdv,key_)
SELECT 
  MONTH(eo.date_create_invoice) AS expr1,
  YEAR(eo.date_create_invoice) AS expr2,
  eo.inn_client,
  SprBranch.num_main_branch,
  SUM(eo.pdvinvoice) AS expr3,
  CONCAT_WS('/', MONTH(eo.date_create_invoice), YEAR(eo.date_create_invoice), eo.inn_client, SprBranch.num_main_branch) AS expr4
FROM Erpn_out eo
  INNER JOIN SprBranch
    ON eo.num_branch_vendor = SprBranch.num_branch
GROUP BY MONTH(eo.date_create_invoice),
         YEAR(eo.date_create_invoice),
         eo.inn_client,
         SprBranch.num_main_branch,
         CONCAT_WS('/', MONTH(eo.date_create_invoice), YEAR(eo.date_create_invoice), eo.inn_client, SprBranch.num_main_branch)