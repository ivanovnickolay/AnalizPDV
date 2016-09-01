DELIMITER ;
create TRIGGER insert_erpn_out_temp AFTER INSERT ON Ernn_out_load FOR EACH ROW
BEGIN
DECLARE cnt
SELECT COUNT('id') INTO cnt FROM Erpn_out_temp
WHERE Erpn_out_temp.num_invoice=NEW.num_invoice AND
Erpn_out_temp.date_create_invoice=NEW.date_create_invoice AND
Erpn_out_temp.inn_client=NEW.inn_client AND
Erpn_out_temp.type_invoice_full=NEW.type_invoice_full;
SET key_field=CONCAT_WS('/',NEW.num_invoice,NEW.type_invoice_full,NEW.date_create_invoice,NEW.inn_client);
IF(cnt<>0) THEN
INSERT INTO Erpn_out_temp (num_invoice,date_create_invoice,date_reg_invoice,
type_invoice_full,edrpou_client,inn_client,num_branch_client,name_client,
suma_invoice,pdvinvoice,baza_invoice,name_vendor,num_branch_vendor,num_reg_invoice,
type_invoice,num_contract,date_contract,type_contract,person_create_invoice,
key_field)
VALUES(NEW.num_invoice,NEW.date_create_invoice,NEW.date_reg_invoice,
NEW.type_invoice_full,NEW.edrpou_client,NEW.inn_client,NEW.num_branch_client,NEW.name_client,
NEW.suma_invoice,NEW.pdvinvoice,NEW.baza_invoice,NEW.name_vendor,NEW.num_branch_vendor,NEW.num_reg_invoice,
NEW.type_invoice,NEW.num_contract,NEW.date_contract,NEW.type_contract,NEW.person_create_invoice,
@key_field)
END IF

END