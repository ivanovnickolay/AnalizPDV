SELECT
  erpn_out_inn_group_numbranch.month_create,
  erpn_out_inn_group_numbranch.year_create,
  erpn_out_inn_group_numbranch.num_main_branch,
  erpn_out_inn_group_numbranch.inn_client,
  erpn_out_inn_group_numbranch.pdv AS Erpn_pdv,
  reestr_out_inn_group_numbranch.pdv AS Reestr_pdv,
  erpn_out_inn_group_numbranch.pdv - reestr_out_inn_group_numbranch.pdv AS saldo_pdv
FROM erpn_out_inn_group_numbranch
  INNER JOIN reestr_out_inn_group_numbranch
    ON erpn_out_inn_group_numbranch.month_create = reestr_out_inn_group_numbranch.`MONTH(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.year_create = reestr_out_inn_group_numbranch.`YEAR(ReestrBranch_out.date_create_invoice)`
    AND erpn_out_inn_group_numbranch.num_main_branch = reestr_out_inn_group_numbranch.num_branch
    AND erpn_out_inn_group_numbranch.inn_client = reestr_out_inn_group_numbranch.inn
WHERE erpn_out_inn_group_numbranch.month_create = 7
AND erpn_out_inn_group_numbranch.year_create = 2016
AND erpn_out_inn_group_numbranch.num_main_branch = "678"
ORDER BY saldo_pdv DESC

