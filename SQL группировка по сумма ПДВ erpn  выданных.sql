SELECT
  MONTH(`erpn_out`.`date_create_invoice`) AS `month_create`,
  YEAR(`erpn_out`.`date_create_invoice`) AS `year_create`,
  `erpn_out`.`inn_client` AS `inn_client`,
  `sprbranch`.`num_main_branch` AS `num_main_branch`,
  SUM(`erpn_out`.`pdvinvoice`) AS `pdv`,
  CONCAT_WS('/', MONTH(`erpn_out`.`date_create_invoice`),
  YEAR(`erpn_out`.`date_create_invoice`),
  `erpn_out`.`inn_client`,
  `sprbranch`.`num_main_branch`) AS key_
FROM (`erpn_out`
  JOIN `sprbranch`
    ON ((`erpn_out`.`num_branch_vendor` = `sprbranch`.`num_branch`)))
GROUP BY MONTH(`erpn_out`.`date_create_invoice`),
         YEAR(`erpn_out`.`date_create_invoice`),
         `erpn_out`.`inn_client`,
         `sprbranch`.`num_main_branch`,
   CONCAT_WS('/', MONTH(`erpn_out`.`date_create_invoice`),
  YEAR(`erpn_out`.`date_create_invoice`),
  `erpn_out`.`inn_client`,
  `sprbranch`.`num_main_branch`) 