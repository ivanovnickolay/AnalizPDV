INSERT INTO Reestr_out_svod_inn_date_create(month_create,
  year_create,
  inn,
  numBranch,
  sum_pdv,
  key_)
SELECT
    MONTH(rbo.date_create_invoice),
    YEAR(rbo.date_create_invoice), 
    rbo.inn_client, 
    rbo.num_branch,
    SUM(rbo.pdv_20+rbo.pdv_7),
    CONCAT_WS('/', MONTH(rbo.date_create_invoice),
    YEAR(rbo.date_create_invoice), 
    rbo.inn_client, 
    rbo.num_branch)
FROM
    ReestrBranch_out rbo
  GROUP BY 
MONTH(rbo.date_create_invoice),
    YEAR(rbo.date_create_invoice), 
    rbo.inn_client, 
    rbo.num_branch,
    CONCAT_WS('/', MONTH(rbo.date_create_invoice),
    YEAR(rbo.date_create_invoice), 
    rbo.inn_client, 
    rbo.num_branch)