CALL AnalizPDV.getTempTable_In(6,2016);
 SELECT
    temp_erpn_in.month_create,
    temp_erpn_in.year_create,
    temp_erpn_in.inn_client AS Erpn_Inn,
     temp_reestr_in.inn_client AS Reestr_inn,
     temp_erpn_in.pdv AS Erpn_pdv,
      temp_reestr_in.pdv AS Reestr_pdv,
   temp_erpn_in.pdv - temp_reestr_in.pdv AS saldo_pdv
  FROM temp_erpn_in 
    INNER JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE temp_erpn_in.pdv<temp_reestr_in.pdv;