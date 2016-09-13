SELECT
  reestr_out_inn_group_numbranch.`MONTH(ReestrBranch_out.date_create_invoice)`,
  reestr_out_inn_group_numbranch.`YEAR(ReestrBranch_out.date_create_invoice)`,
  reestr_out_inn_group_numbranch.inn,
  reestr_out_inn_group_numbranch.num_branch,
  reestr_out_inn_group_numbranch.pdv AS reestr_pdv,
  erpn_out_inn_group_numbranch.pdv AS erpn_pdv
FROM reestr_out_inn_group_numbranch
  INNER JOIN erpn_out_inn_group_numbranch
    ON reestr_out_inn_group_numbranch.key_ = erpn_out_inn_group_numbranch.key_
WHERE reestr_out_inn_group_numbranch.`MONTH(ReestrBranch_out.date_create_invoice)` = 7
AND reestr_out_inn_group_numbranch.`YEAR(ReestrBranch_out.date_create_invoice)` = 2016
AND reestr_out_inn_group_numbranch.num_branch = 678