SELECT sum(Erpn_out.pdvinvoice) from Erpn_out
where 
MONTH(Erpn_out.date_create_invoice) =7 and 
YEAR(Erpn_out.date_create_invoice) =2016
and Erpn_out.inn_client="000177326652" 
;
SELECT SUM(ReestrBranch_out.pdv_20) from ReestrBranch_out 
where 
MONTH(ReestrBranch_out.date_create_invoice) =7 and 
YEAR(ReestrBranch_out.date_create_invoice) =2016
and ReestrBranch_out.inn_client="000177326652" 
;
