<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.09.2016
 * Time: 17:14
 */

namespace AnalizPdvBundle\Model\getDataFromSQL;


use Doctrine\ORM\EntityManager;

/**
 *
 * Задача класса предоставить данные для заполннения анализа реестров и ЕРПН по одному филиалу
 * @package AnalizPdvBundle\Model\getDataFromSQL
 */
class getDataFromReestrsByOne
{
	private $em;

	/**
	 * getDataFromReestrsByOne constructor.
	 * @param EntityManager $em
	 */
	public function __construct (EntityManager $em)
	{
		$this->em=$em;
	}

	/**
	 * Возвращает массив информации с реестра полученных НН которые совпали с ЕРПН
	 * по параметрам по одному филиалу
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 * @see writeAnalizReestr::writeAnalizPDVByOneBranch - отсюда вызывается функция
	 * @see writeAnalizPDVToFile::writeAnalizPDVByOneBranch - отсюда вызывается функция
	 * @uses store_procedure::getReestrInEqualErpn - хранимая процедура для генерации данных
	 */
	public function getReestrInEqualErpn($month, $year, $numBranch)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="CALL getReestrInEqualErpn(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * @return mixed
	 */
	private function getReestrInEqualErpn_SQL()
	{
		return /** @lang MySQL */
			"select
			`rbi`.`month` AS `month`,
			`rbi`.`year` AS `year`,
			`rbi`.`num_branch` AS `num_branch`,
			`ei`.`type_invoice_full` AS `type_invoice_full`,
			`ei`.`num_invoice` AS `num_invoice`,
			`ei`.`date_create_invoice` AS `date_create_invoice`,
			`ei`.`inn_client` AS `inn_client`,
			`ei`.`name_client` AS `name_client`,
			`ei`.`suma_invoice` AS `suma_invoice`,
			`ei`.`baza_invoice` AS `baza_invoice`,
			`ei`.`pdvinvoice` AS `pdvinvoice`,
			`rbi`.`zag_summ` AS `zag_summ`,
			(`rbi`.`baza_20` + `rbi`.`baza_7` + `rbi`.`baza_0` + `rbi`.`baza_zvil` + `rbi`.`pdv_ne_gos` + `rbi`.`pdv_za_mezhi`) AS `baza`,
			(`rbi`.`pdv_20` + `rbi`.`pdv_7` + `rbi`.`pdv_0` + `rbi`.`pdv_ne_gos` + `rbi`.`pdv_zvil` + `rbi`.`pdv_za_mezhi`) AS `pdv`,
			(`ei`.`suma_invoice`  - `rbi`.`zag_summ`) as saldo_sum,
			(`ei`.`baza_invoice`- (`rbi`.`baza_20` + `rbi`.`baza_7` + `rbi`.`baza_0` + `rbi`.`baza_zvil` + `rbi`.`pdv_ne_gos` + `rbi`.`pdv_za_mezhi`)) as saldo_baza,
			(`ei`.`pdvinvoice` - (`rbi`.`pdv_20` + `rbi`.`pdv_7` + `rbi`.`pdv_0` + `rbi`.`pdv_ne_gos` + `rbi`.`pdv_zvil` + `rbi`.`pdv_za_mezhi`)) as saldo_pdv
								
			from `erpn_in` `ei`
			join `reestrbranch_in` `rbi`
			on`ei`.`key_field` = `rbi`.`key_field`
			WHERE `rbi`.`month` =:m AND `rbi`.`year`=:y AND `rbi`.`num_branch`=:b  
			        AND((`ei`.`suma_invoice` - `rbi`.`zag_summ`)<>0
			        OR (`ei`.`baza_invoice` - (`rbi`.`baza_20` + `rbi`.`baza_7` + `rbi`.`baza_0` + `rbi`.`baza_zvil` + `rbi`.`pdv_ne_gos` + `rbi`.`pdv_za_mezhi`) )<>0
			        OR (`ei`.`pdvinvoice` - (`rbi`.`pdv_20` + `rbi`.`pdv_7` + `rbi`.`pdv_0` + `rbi`.`pdv_ne_gos` + `rbi`.`pdv_zvil` + `rbi`.`pdv_za_mezhi`))<>0);";

	}

	/**
	 * Возвращает массив информации с реестра полученных НН которые НЕ совпали с ЕРПН
	 * по параметрам по одному филиалу
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 * @see writeAnalizReestr::writeAnalizPDVByOneBranch - отсюда вызывается функция
	 * @see writeAnalizPDVToFile::writeAnalizPDVByOneBranch - отсюда вызывается функция
	 * @uses store_procedure::getReestrInNotEqualErpn - хранимая процедура для генерации данных
	 */
	public function getReestrInNotEqualErpn($month, $year, $numBranch)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="call getReestrInNotEqualErpn(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * @return string
	 */
	private function getReestrInNotEqualErpn_SQL()
	{
		return /** @lang MySQL */
			"SELECT
			  `rbi`.`month` AS `month`,
			  `rbi`.`year` AS `year`,
			  `rbi`.`num_branch` AS `num_branch`,
			  `rbi`.`type_invoice_full` AS `type_invoice_full`,
			  `rbi`.`num_invoice` AS `num_invoice`,
			  date_format(`rbi`.`date_create_invoice`,'%d.%m.%Y') AS `date_create_invoice`,
			  `rbi`.`inn_client` AS `inn_client`,
			  `rbi`.`name_client` AS `name_client`,
			  `rbi`.`zag_summ` AS `zag_summ`,
			  (`rbi`.`baza_20` + `rbi`.`baza_7`+ `rbi`.`baza_0`+rbi.baza_zvil+rbi.baza_za_mezhi+rbi.baza_ne_gos) AS `baza`,
			  (`rbi`.`pdv_20` + `rbi`.`pdv_7`+rbi.pdv_0+rbi.pdv_ne_gos+rbi.pdv_za_mezhi+rbi.pdv_zvil) AS `pdv`
			FROM (`ReestrBranch_in` `rbi`
			  LEFT JOIN `erpn_in` `ei`
			    ON ((`rbi`.`key_field` = `ei`.`key_field`)))
			WHERE ISNULL(`ei`.`key_field`) AND `rbi`.`month`=:m and `rbi`.`year` =:y AND rbi.num_branch=:n
		";

	}
	/**
	 * Возвращает массив информации с реестра выданных НН которые совпали с ЕРПН по параметрам
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 * @see writeAnalizReestr::writeAnalizPDVByOneBranch - отсюда вызывается функция
	 * @see writeAnalizPDVToFile::writeAnalizPDVByOneBranch - отсюда вызывается функция
	 * @uses store_procedure::getReestrOutEqualErpn - хранимая процедура для генерации данных
	 */
	public function getReestrOutEqualErpn($month, $year, $numBranch)
	{
		$this->reconnect();
		$sql="call getReestrOutEqualErpn(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * @return mixed
	 */
	private function getReestrOutEqualErpn_SQL()
	{
		return
			/** @lang MySQL */
			"SELECT
				`rbo`.`month` AS `month`,
			  	`rbo`.`year` AS `year`,
				`rbo`.`num_branch` AS `num_branch`,
				`eo`.`type_invoice_full` AS `type_invoice_full`,
			  	`eo`.`num_invoice` AS `num_invoice`,
			  	date_format(`eo`.`date_create_invoice`,'%d.%m.%Y') AS `date_create_invoice`,
			    `eo`.`inn_client` AS `inn_client`,
			  	`eo`.`name_client` AS `name_client`,
			  	`eo`.`suma_invoice` AS `suma_invoice`,
			  	`eo`.`baza_invoice` AS `baza_invoice`,
			  	`eo`.`pdvinvoice` AS `pdvinvoice`,
			 	`rbo`.`zag_summ` AS `zag_summ`,
			  	(`rbo`.`baza_20` + `rbo`.`baza_7` + `rbo`.`baza_0` + `rbo`.`baza_zvil` + `rbo`.`baza_ne_obj` + `rbo`.`baza_za_mezhi_tovar` + `rbo`.`baza_za_mezhi_poslug`) AS `baza`,
				(`rbo`.`pdv_20` + `rbo`.`pdv_7`) AS `pdv`,
				(`eo`.`suma_invoice` - `rbo`.`zag_summ`) as saldo_sum,
				(`eo`.`baza_invoice` - (`rbo`.`baza_20` + `rbo`.`baza_7` + `rbo`.`baza_0` + `rbo`.`baza_zvil` + `rbo`.`baza_ne_obj` + `rbo`.`baza_za_mezhi_tovar` + `rbo`.`baza_za_mezhi_poslug`)) as saldo_baza,
				(`eo`.`pdvinvoice` - (`rbo`.`pdv_20` + `rbo`.`pdv_7`)) as saldo_pdv			  
			FROM (`erpn_out` `eo`
			  JOIN `reestrbranch_out` `rbo`
			    ON ((`eo`.`key_field` = `rbo`.`key_field`)))
			  WHERE rbo.month=:m 
			  		AND rbo.year=:y 
			  		AND rbo.num_branch=:branch
          AND 
					(( `eo`.`suma_invoice` - `rbo`.`zag_summ`)<>0
			        OR (`eo`.`baza_invoice`- (`rbo`.`baza_20` + `rbo`.`baza_7` + `rbo`.`baza_0` + `rbo`.`baza_zvil` + `rbo`.`baza_ne_obj` + `rbo`.`baza_za_mezhi_tovar` + `rbo`.`baza_za_mezhi_poslug`))<>0
			        OR ( `eo`.`pdvinvoice`-  (`rbo`.`pdv_20` + `rbo`.`pdv_7`))<>0);
		";

	}

	/**
	 * Возвращает массив информации с реестра выданных НН которые НЕ совпали с ЕРПН по параметрам
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 * @see writeAnalizReestr::writeAnalizPDVByOneBranch - отсюда вызывается функция
	 * @see writeAnalizPDVToFile::writeAnalizPDVByOneBranch - отсюда вызывается функция
	 * @uses store_procedure::getReestrOutNotEqualErpn - хранимая процедура для генерации данных
	 */
	public function getReestrOutNotEqualErpn($month, $year, $numBranch)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="call getReestrOutNotEqualErpn(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * @return string
	 */
	private function getReestrOutNotEqualErpn_SQL()
	{
		return
			"SELECT
		  `rbo`.`month` AS `month`,
		  `rbo`.`year` AS `year`,
		  `rbo`.`num_branch` AS `num_branch`,
		  `rbo`.`type_invoice_full` AS `type_invoice_full`,
		  `rbo`.`num_invoice` AS `num_invoice`,
		  date_format(`rbo`.`date_create_invoice`,'%d.%m.%Y') AS `date_create_invoice`,
		  `rbo`.`inn_client` AS `inn_client`,
		  `rbo`.`name_client` AS `name_client`,
		  `rbo`.`zag_summ` AS `zag_summ`,
		  (`rbo`.`baza_20` + `rbo`.`baza_7`+`rbo`.`baza_zvil`+`rbo`.`baza_ne_obj`+`rbo`.`baza_za_mezhi_tovar`+`rbo`.`baza_za_mezhi_poslug`) AS `baza`,
		  (`rbo`.`pdv_20` + `rbo`.`pdv_7`) AS `pdv`
		 FROM (`reestrbranch_out` `rbo`
		  LEFT JOIN `erpn_out` `eo`
		    ON ((`rbo`.`key_field` = `eo`.`key_field`)))
		WHERE ISNULL(`eo`.`key_field`) AND `rbo`.`month`=:m AND `rbo`.`year`=:y AND rbo.num_branch=:b;";

	}


	/**
	 * получает список уникальных филиалов из реестра полученных НН за период
	 * @param $month
	 * @param $year
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
	 * @see writeAnalizReestr::writeAnalizPDVByAllBranch - отсюда вызывается функция
	 */
	public function getAllBranchToPeriod($month, $year)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="SELECT DISTINCT rbi.num_branch FROM ReestrBranch_in rbi
			WHERE rbi.month =:m AND rbi.year=:y";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * получить список всех главных филиалов ПАТ
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
	 * @see writeAnalizPDVToFile::writeOutDelayByAllBranch - отсюда вызывается функция
	 */
	public function getAllBranch()
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="SELECT DISTINCT num_main_branch FROM `SprBranch`";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * получает список уникальных  филиалов из реестра выдынных НН за период
	 * @param $month
	 * @param $year
	 * @return array
	 * @uses writeAnalizOutByInn::writeAnalizPDVOutInnByAllBranch - отсюда вызывается функция
	 */
	public function getAllBranchToPeriodOut($month, $year)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="SELECT DISTINCT rbi.num_branch FROM ReestrBranch_Out rbi
			WHERE rbi.month =:m AND rbi.year=:y";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	public function disconnect()
	{
		$this->em->getConnection()->close();
	}

	public function connect()
	{
		$this->em->getConnection()->connect();
	}

	/**
	 * MySQL Server has gone away
	 */
	public function reconnect()
	{
		$connection = $this->em->getConnection();
		if (!$connection->ping()) {

			$this->disconnect();
			$this->connect();

			$this->checkEMConnection($connection);
		}
	}

	/**
	 * method checks connection and reconnect if needed
	 * MySQL Server has gone away
	 *
	 * @param $connection
	 * @throws \Doctrine\ORM\ORMException
	 */
	protected function checkEMConnection($connection)
	{

		if (!$this->em->isOpen()) {
			$config = $this->em->getConfiguration();

			$this->em = $this->em->create(
				$connection, $config
			);
		}
	}
}