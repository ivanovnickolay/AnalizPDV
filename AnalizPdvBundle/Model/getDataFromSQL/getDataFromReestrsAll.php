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
 * Задача класса предоставить данные для заполннения анализа реестров по всему УЗ за период
 * заполнение идет в как "слитие" всех расхождений филиалов в один файл по всему УЗ
 *
 * @package AnalizPdvBundle\Model\getDataFromSQL
 */
class getDataFromReestrsAll
{
	private $em;

	/**
	 * getDataFromReestrsAll constructor.
	 * @param EntityManager $em
	 */
	public function __construct (EntityManager $em)
	{
		$this->em=$em;
	}

	/**
	 * Возвращает массив информации с реестра полученных НН которые
	 * совпали с ЕРПН по параметрам по всему УЗ
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @return array arrayResult
	 * @see writeAnalizReestr::writeAnalizPDVByAllUZ - отсюда вызывается функция
	 * @uses store_procedure::getReestrInEqualErpnAllUZ - хранимая процедура для генерации данных
	 */
	public function getReestrInEqualErpn($month, $year)
{
	$this->reconnect();
	$sql="call getReestrInEqualErpnAllUZ(:m,:y)";
	$smtp=$this->em->getConnection()->prepare($sql);
	$smtp->bindValue("m",$month);
	$smtp->bindValue("y",$year);
	$smtp->execute();
	$arrayResult=$smtp->fetchAll();
	return $arrayResult;
}

	/**
	 * @return string
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
			(suma_invoice - zag_summ) as saldo_sum,
			(baza_invoice - 'baza') as saldo_baza,
			(pdvinvoice - 'pdv') as saldo_pdv,
			`ei`.`name_vendor` AS `name_vendor`
					
			from `analizpdv`.`erpn_in` `ei`
			join `analizpdv`.`reestrbranch_in` `rbi`
			on`ei`.`key_field` = `rbi`.`key_field`
			WHERE `rbi`.`month` =:m AND `rbi`.`year`=:y
			        AND((`ei`.`suma_invoice` - `rbi`.`zag_summ`)<>0
			        OR (`ei`.`baza_invoice` - (`rbi`.`baza_20` + `rbi`.`baza_7` + `rbi`.`baza_0` + `rbi`.`baza_zvil` + `rbi`.`pdv_ne_gos` + `rbi`.`pdv_za_mezhi`) )<>0
			        OR (`ei`.`pdvinvoice` - (`rbi`.`pdv_20` + `rbi`.`pdv_7` + `rbi`.`pdv_0` + `rbi`.`pdv_ne_gos` + `rbi`.`pdv_zvil` + `rbi`.`pdv_za_mezhi`))<>0);";

}
	/**
	 * Возвращает массив информации с реестра полученных НН которые не
	 * совпали с ЕРПН по параметрам по всему УЗ
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @return array arrayResult
	 * @see writeAnalizReestr::writeAnalizPDVByAllUZ - отсюда вызывается функция
	 * @uses store_procedure::getReestrInNotEqualErpnAllUZ - хранимая процедура для генерации данных
	 */
	public function getReestrInNotEqualErpn($month, $year)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="call getReestrInNotEqualErpnAllUZ(:m,:y)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * TODO проверить процелура на IN запрос на OUT !!!!
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
			  (`rbi`.`baza_20` + `rbi`.`baza_7`+ `rbi`.`baza_0`+`rbi`.`baza_ne_gos`+ `rbi`.`baza_za_mezhi`+`rbi`.`baza_zvil`) AS `baza`,
			  (`rbi`.`pdv_20` + `rbi`.`pdv_7`+rbi.pdv_0) AS `pdv`
			FROM (`ReestrBranch_in` `rbi`
			  LEFT JOIN `erpn_in` `ei`
			    ON ((`rbi`.`key_field` = `ei`.`key_field`)))
			WHERE ISNULL(`ei`.`key_field`) AND `rbi`.`month`=:m and `rbi`.`year` =:y
		";

	}

	/**
	 * Возвращает массив информации с реестра выданных НН которые совпали с ЕРПН по параметрам по всему УЗ
	 * @param $month
	 * @param $year
	 * @return array
	 * @see writeAnalizReestr::writeAnalizPDVByAllUZ - отсюда вызывается функция
	 * @uses store_procedure::getReestrOutEqualErpnAllUZ - хранимая процедура для генерации данных
	 */
	public function getReestrOutEqualErpn($month, $year)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="call getReestrOutEqualErpnAllUZ(:m,:y)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}
			/**
		 * @return string
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
			  		AND 
					(( `eo`.`suma_invoice` - `rbo`.`zag_summ`)<>0
			        OR (`eo`.`baza_invoice`- (`rbo`.`baza_20` + `rbo`.`baza_7` + `rbo`.`baza_0` + `rbo`.`baza_zvil` + `rbo`.`baza_ne_obj` + `rbo`.`baza_za_mezhi_tovar` + `rbo`.`baza_za_mezhi_poslug`))<>0
			        OR ( `eo`.`pdvinvoice`-  (`rbo`.`pdv_20` + `rbo`.`pdv_7`))<>0);
		";


	}

	/**
	 * Возвращает массив информации с реестра полученных НН которые
	 * не совпали с ЕРПН по параметрам по всему УЗ
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @return array arrayResult
	 * @see writeAnalizReestr::writeAnalizPDVByAllUZ - отсюда вызывается функция
	 * @uses store_procedure::getReestrOutNotEqualErpnAllUZ - хранимая процедура для генерации данных
	 */
	public function getReestrOutNotEqualErpn($month, $year)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		$sql="call getReestrOutNotEqualErpnAllUZ(:m,:y)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
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
		WHERE ISNULL(`eo`.`key_field`) AND `rbo`.`month`=:m AND `rbo`.`year`=:y;";

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