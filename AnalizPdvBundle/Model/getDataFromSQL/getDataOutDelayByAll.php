<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.09.2016
 * Time: 0:35
 */

namespace AnalizPdvBundle\Model\getDataFromSQL;

/**
 * Задача класса предоставить данные для заполннения анализа опаздавших выданных НН по ПАТ
 * @see writeAnalizOutDelayDate::writeAnalizPDVOutDelayByAllUZ
 * @package AnalizPdvBundle\Model\getDataFromSQL
 */
class getDataOutDelayByAll extends getDataFromAnalizAbstract
{
	/**
	 * Получаем весь список опаздавших с регистрацией НН по ПАТ
	 * @param int $month
	 * @param int $year
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
	 * @see writeAnalizOutDelayDate::writeAnalizPDVOutDelayByAllUZ - отсюда вызывается функция
	 * @uses store_procedure::AnalizPDVOutDiffDateAllUZInnerJoinERPN - хранимая процедура для генерации данных
	 */
	public function getAllDelay(int $month, int $year)
	{
		// так как в хранимой процедуре используются временные таблицы, для их обнуления
		// "передергнем соединение с базой для очистки временных таблиц
		//$this->disconnect();
		//$this->connect();
		$this->reconnect();
		$this->getTempTable($month,$year);
		$sql=$this->getAllDelay_SQL();
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * Получаем список опаздавших НН которые включены в Реестр филиала по ПАТ
	 * @param int $month
	 * @param int $year
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
	 * @see writeAnalizOutDelayDate::writeAnalizPDVOutDelayByAllUZ - отсюда вызывается функция
	 * @uses store_procedure::AnalizPDVOutDiffDateAllUZInnerJoinReestr - хранимая процедура для генерации данных
	 */
	public function getDelayToReestr(int $month, int $year)
	{
		// так как в хранимой процедуре используются временные таблицы, для их обнуления
		// "передергнем соединение с базой для очистки временных таблиц
		//$this->disconnect();
		//$this->connect();
		$this->reconnect();
		//$sql="CALL AnalizPDVOutDiffDateAllUZInnerJoinReestr(:m,:y)";
		$this->getTempTable($month,$year);
		$sql=$this->getDelayToReestr_SQL();
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * Получаем список опаздавших НН которые НЕ включены в Реестр филиала
	 * @param int $month
	 * @param int $year
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
	 * @see writeAnalizOutDelayDate::writeAnalizPDVOutDelayByAllUZ - отсюда вызывается функция
	 * @uses store_procedure::AnalizPDVOutDiffDateAllUZLeftJoinERPN - хранимая процедура для генерации данных
	 */
	public function getDelayToNotReestr(int $month, int $year)
	{
		// так как в хранимой процедуре используются временные таблицы, для их обнуления
		// "передергнем соединение с базой для очистки временных таблиц
		//$this->disconnect();
		//$this->connect();
		$this->reconnect();
		//$sql="CALL AnalizPDVOutDiffDateAllUZLeftJoinERPN(:m,:y)";
		$this->getTempTable($month,$year);
		$sql=$this->getDelayToNotReestr_SQL();
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 *
	 * Запрос на формирование временной таблицы
	 *
	 * @link http://forum.sfhub.org/topic/1433/ne-rabotaet-vypolnenie-nativnogo-sql/
	 * @param int $month
	 * @param int $year
	 */
	private function getTempTable(int $month, int $year)
	{
		$this->disconnect();
		$this->connect();
		//$sql="CALL AnalizPDVOutDiffDateAllUZInnerJoinERPN(:m,:y)";
		$sql=$this->getTempTable_SQL();
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->execute();

	}

	/**
	 * SQL запрос для формирования временной таблицы
	 *  Алгоритм
	 * 1)формируем временную таблицу temp_diffDateFromAll по всем документам в периоде
	 *   с выборкой количества дней между созданием и регистрацией
	 * @return mixed
	 */
	private function getTempTable_SQL()
	{
		return /** @lang MySQL */
			"CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromAll  (
			   key_field varchar(50)DEFAULT NULL ,
			    diffDate bigint DEFAULT NULL ,
			    date_reg date,
			    id int NOT NULL AUTO_INCREMENT,
			    PRIMARY KEY (id),
			    INDEX main USING BTREE (key_field),
			    INDEX diff USING BTREE (diffDate)
			  )  AS
			  (
			  SELECT
			    eo.key_field AS key_field,
			    DATEDIFF(eo.date_reg_invoice,eo.date_create_invoice) AS diffDate,
			    eo.date_reg_invoice AS date_reg
			  FROM erpn_out eo
			  WHERE eo.month_create_invoice=:m
			  AND eo.year_create_invoice=:y
			  );";

	}


	/**
	 * SQL запрос для формирования списка опаздавших с регистрацией НН по ПАТ
	 *  Алгоритм
	 * 1)формируем временную таблицу temp_diffDateFromAll по всем документам в периоде
	 *   с выборкой количества дней между созданием и регистрацией
	 * 2) при помощи внутреннего соединения с ЕРПН (выданные) по ключевому полю key_field
	 *    отбираем данные по тем записям временной таблицы разница дат которых больше 16 дней
	 * @return string
	 */
	private function getAllDelay_SQL()
	{

		// return /** @lang MySQL */
			/*"CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromAll  (
			   key_field varchar(50)DEFAULT NULL ,
			    diffDate bigint DEFAULT NULL ,
			    id int NOT NULL AUTO_INCREMENT,
			    PRIMARY KEY (id),
			    INDEX main USING BTREE (key_field),
			    INDEX diff USING BTREE (diffDate)
			  )  AS
			  (
			  SELECT
			    eo.key_field AS key_field,
			    DATEDIFF(eo.date_reg_invoice,eo.date_create_invoice) AS diffDate
			  FROM erpn_out eo
			  WHERE eo.month_create_invoice=:m
			  AND eo.year_create_invoice=:y
			  );
			
			  SELECT num_invoice, DATE_FORMAT(date_create_invoice, '%d.%m.%Y'), DATE_FORMAT(date_reg_invoice, '%d.%m.%Y'),(diffDate-15) AS diff,
			  type_invoice_full, inn_client, name_client, suma_invoice, pdvinvoice, baza_invoice,
			  name_vendor,num_branch_vendor, num_main_branch FROM erpn_out
			   INNER JOIN temp_diffDateFromAll ON
			    erpn_out.key_field=temp_diffDateFromAll.key_field
			    WHERE temp_diffDateFromAll.diffDate>=16;";
		*/
		return /** @lang MySQL */
			"SELECT num_invoice, DATE_FORMAT(date_create_invoice, '%d.%m.%Y'), DATE_FORMAT(date_reg_invoice, '%d.%m.%Y'),(diffDate-15) AS diff,
			  type_invoice_full, inn_client, name_client, suma_invoice, pdvinvoice, baza_invoice,
			  name_vendor,num_branch_vendor, num_main_branch FROM erpn_out
			   INNER JOIN temp_diffDateFromAll ON
			    erpn_out.key_field=temp_diffDateFromAll.key_field
			    WHERE temp_diffDateFromAll.diffDate>=16;";

	}

	/**
	 * SQL запрос для формирования списка НН которые включены в Реестр филиала по ПАТ
	 *  Алгоритм
	 * 1)формируем временную таблицу temp_diffDateFromAll по всем документам в периоде
	 *   с выборкой количества дней между созданием и регистрацией
	 * 2) при помощи внутреннего соединения с Реестром (выданные) по ключевому полю key_field
	 *    отбираем данные по тем записям временной таблицы разница дат которых больше 16 дней
	 */
	private function getDelayToReestr_SQL()
	{
			//return /** @lang MySQL */
				/* "CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromAll (
				    key_field varchar(50) DEFAULT NULL,
				    diffDate bigint DEFAULT NULL,
				    date_reg date,
				    id int NOT NULL AUTO_INCREMENT,
				    PRIMARY KEY (id),
				    INDEX main USING BTREE (key_field),
				    INDEX diff USING BTREE (diffDate)
				) AS (
				  SELECT
					    eo.key_field AS key_field,
					    DATEDIFF(eo.date_reg_invoice, eo.date_create_invoice) AS diffDate,
						eo.date_reg_invoice AS date_reg
					  FROM erpn_out eo
					  WHERE  
						  eo.month_create_invoice=:m
						  AND eo.year_create_invoice=:y
				  );
				SELECT
				    rbo.month,
				    rbo.year,
				    rbo.num_branch,
				    rbo.type_invoice_full,
				    DATE_FORMAT(rbo.date_create_invoice, '%d.%m.%Y') AS date_create,
				    DATE_FORMAT(temp_diffDateFromAll.date_reg, '%d.%m.%Y') AS date_reg,
				    (temp_diffDateFromAll.diffDate-15) AS diff,
				    rbo.num_invoice,
				    rbo.inn_client,
				    rbo.name_client,
				    (rbo.pdv_20+rbo.pdv_7) AS pdv
				       
				  FROM ReestrBranch_out rbo
				    INNER JOIN temp_diffDateFromAll
				      ON rbo.key_field = temp_diffDateFromAll.key_field
				  WHERE temp_diffDateFromAll.diffDate >= 16;";
				*/
				return  /** @lang MySQL */
					"SELECT rbo.month,rbo.year, rbo.num_branch,rbo.type_invoice_full,DATE_FORMAT(rbo.date_create_invoice, '%d.%m.%Y') AS date_create,
				    DATE_FORMAT(temp_diffDateFromAll.date_reg, '%d.%m.%Y') AS date_reg,(temp_diffDateFromAll.diffDate-15) AS diff,
				    rbo.num_invoice,rbo.inn_client,rbo.name_client,(rbo.pdv_20+rbo.pdv_7) AS pdv
				    FROM ReestrBranch_out rbo
				    INNER JOIN temp_diffDateFromAll
				      ON rbo.key_field = temp_diffDateFromAll.key_field
				  WHERE temp_diffDateFromAll.diffDate >= 16;";
	}

	/**
	 * SQL запрос для формирования списка НН которые НЕ включены в Реестр филиала по ПАТ
	 *
	 *  Алгоритм
	 * 1)формируем временную таблицу temp_diffDateFromAll по всем документам в периоде
	 *   с выборкой количества дней между созданием и регистрацией
	 * 2) при помощи левого соединения с Реестром (выданные) по ключевому полю key_field
	 *    отбираем данные по тем записям временной таблицы разница дат которых больше 16 дней и
	 *    по которым нет записей в Реестре с данным ключевым полем
	 *
	 * @return string
	 */
	private function getDelayToNotReestr_SQL()
	{
		/*
		return /** @lang MySQL*/
			/*"CREATE TEMPORARY TABLE IF NOT EXISTS temp_diffDateFromAll  (
			   key_field varchar(50)DEFAULT NULL ,
			    diffDate bigint DEFAULT NULL ,
			    id int NOT NULL AUTO_INCREMENT,
			    PRIMARY KEY (id),
			    INDEX main USING BTREE (key_field),
			    INDEX diff USING BTREE (diffDate)
			)  AS
			(
			  SELECT
			    eo.key_field AS key_field,
			    DATEDIFF(eo.date_reg_invoice,eo.date_create_invoice) AS diffDate
			  FROM erpn_out eo
			  WHERE 
				  eo.month_create_invoice=:m
				  AND eo.year_create_invoice=:y
			);

			  SELECT 
				  num_invoice, 
				  DATE_FORMAT(date_create_invoice, '%d.%m.%Y'), 
				  DATE_FORMAT(date_reg_invoice, '%d.%m.%Y'),
				  (DATEDIFF(date_reg_invoice, date_create_invoice)-15) AS diff,
				  type_invoice_full, 
				  inn_client, 
				  name_client, 
				  suma_invoice, 
				  pdvinvoice, 
				  baza_invoice,
				  name_vendor,num_branch_vendor, 
				  num_main_branch 
			  FROM erpn_out
			      WHERE key_field 
			      IN(
					  SELECT temp_diffDateFromAll.key_field FROM temp_diffDateFromAll
					  LEFT JOIN ReestrBranch_out ON
					  temp_diffDateFromAll.key_field=ReestrBranch_out.key_field
					  WHERE temp_diffDateFromAll.diffDate>=16
					  AND ReestrBranch_out.key_field IS NULL
				  ) ;";
			*/
		return /** @lang MySQL*/
			" SELECT 
				  num_invoice, 
				  DATE_FORMAT(date_create_invoice, '%d.%m.%Y'), 
				  DATE_FORMAT(date_reg_invoice, '%d.%m.%Y'),
				  (DATEDIFF(date_reg_invoice, date_create_invoice)-15) AS diff,
				  type_invoice_full, 
				  inn_client, 
				  name_client, 
				  suma_invoice, 
				  pdvinvoice, 
				  baza_invoice,
				  name_vendor,num_branch_vendor, 
				  num_main_branch 
			  FROM erpn_out
			      WHERE key_field 
			      IN(
					  SELECT temp_diffDateFromAll.key_field FROM temp_diffDateFromAll
					  LEFT JOIN ReestrBranch_out ON
					  temp_diffDateFromAll.key_field=ReestrBranch_out.key_field
					  WHERE temp_diffDateFromAll.diffDate>=16
					  AND ReestrBranch_out.key_field IS NULL
				  ) ;";

	}
}