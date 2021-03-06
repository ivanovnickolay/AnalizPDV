﻿CALL AnalizPDV.getTempTable_In(6,2016);
 SELECT
    temp_erpn_in.month_create,
    temp_erpn_in.year_create,
    temp_erpn_in.inn_client AS Erpn_Inn,
    temp_erpn_in.pdv AS Erpn_pdv_PRAVO
    FROM temp_erpn_in 
    LEFT JOIN temp_reestr_in
      ON temp_erpn_in.month_create = temp_reestr_in.month_create
      AND temp_erpn_in.year_create = temp_reestr_in.year_create
  AND temp_erpn_in.inn_client = temp_reestr_in.inn_client
      WHERE  temp_reestr_in.month_create IS NULL;