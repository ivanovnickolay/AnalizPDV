SELECT
  MONTH(ReestrBranch_out.date_create_invoice),
  YEAR(ReestrBranch_out.date_create_invoice),
  ReestrBranch_out.inn_client AS inn,
  ReestrBranch_out.num_branch,
  SUM(ReestrBranch_out.pdv_20 + ReestrBranch_out.pdv_7) AS pdv,
   CONCAT_WS('/',MONTH(ReestrBranch_out.date_create_invoice),
  YEAR(ReestrBranch_out.date_create_invoice),
  ReestrBranch_out.inn_client,
  ReestrBranch_out.num_branch) AS key_
  FROM ReestrBranch_out
 GROUP BY 
   MONTH(ReestrBranch_out.date_create_invoice),
  YEAR(ReestrBranch_out.date_create_invoice),
  ReestrBranch_out.inn_client,
  ReestrBranch_out.num_branch,
   CONCAT_WS('/',MONTH(ReestrBranch_out.date_create_invoice),
  YEAR(ReestrBranch_out.date_create_invoice),
  ReestrBranch_out.inn_client,
  ReestrBranch_out.num_branch)