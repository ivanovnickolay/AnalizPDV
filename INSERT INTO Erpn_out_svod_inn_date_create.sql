INSERT INTO Erpn_out_svod_inn_date_create(
month_create,
year_create,
inn,
numBranch,
sum_pdv,key_)
SELECT
    MONTH(eo.date_create_invoice),
	 YEAR(eo.date_create_invoice), 
	 eo.inn_client, 
	 eo.num_branch_vendor,
	SUM(eo.pdvinvoice),
  CONCAT_WS('/', 
		 MONTH(eo.date_create_invoice),
		 YEAR(eo.date_create_invoice), 
		 eo.inn_client, 
		 eo.num_branch_vendor)

FROM
    Erpn_out eo
  GROUP BY 
   MONTH(eo.date_create_invoice),
	 YEAR(eo.date_create_invoice), 
	 eo.inn_client, 
	 eo.num_branch_vendor,
    CONCAT_WS('/', 
		 MONTH(eo.date_create_invoice),
		 YEAR(eo.date_create_invoice), 
		 eo.inn_client, 
		 eo.num_branch_vendor)