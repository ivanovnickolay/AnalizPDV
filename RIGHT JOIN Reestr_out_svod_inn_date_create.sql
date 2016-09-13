 SELECT
    Erpn_out_svod_inn_date_create.month_create,
    Erpn_out_svod_inn_date_create.year_create,
    Erpn_out_svod_inn_date_create.inn,
      Erpn_out_svod_inn_date_create.numMainBranch,
    Erpn_out_svod_inn_date_create.sum_pdv AS erpn_pdv,
    Reestr_out_svod_inn_date_create.sum_pdv AS reestr_pdv,
    (Erpn_out_svod_inn_date_create.sum_pdv - Reestr_out_svod_inn_date_create.sum_pdv) AS saldo
  FROM Erpn_out_svod_inn_date_create
    RIGHT JOIN Reestr_out_svod_inn_date_create
      ON Erpn_out_svod_inn_date_create.key_ = Reestr_out_svod_inn_date_create.key_
  WHERE Erpn_out_svod_inn_date_create.month_create = 7
  AND Erpn_out_svod_inn_date_create.year_create = 2016
  and Erpn_out_svod_inn_date_create.key_ IS NULL