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
 * Задача класса предоставить данные для заполннения анализа реестров
 * Class getReestrEqualErpn
 * @package AnalizPdvBundle\Model\getDataFromSQL
 */
class getDataFromReestrsByOne
{
	private $em;
	public function __construct (EntityManager $em)
	{
		$this->em=$em;
	}

	/**
	 * Возвращает массив информации с реестра полученных НН которые совпали с ЕРПН по параметрам
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 */
	public function getReestrInEqualErpn($month, $year, $numBranch)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		/**$sql="SELECT month,year,num_branch,type_invoice_full,
				num_invoice,
				date_format(date_create_invoice,'%d.%m.%Y'),
				inn_client,
				name_client,
				suma_invoice as edrpou_sum,
				baza_invoice as edrpou_baza,
				pdvinvoice as edrpou_pdv,
				zag_summ as reestr_sum,
				baza as reestr_baza,
				pdv as reestr_pdv,
				(suma_invoice - zag_summ) as saldo_sum,
				(baza_invoice - baza) as saldo_baza,
				(pdvinvoice - pdv) as saldo_pdv
				from `in_erpn=reestr`
				WHERE month =:m AND year=:y AND num_branch=:nb";*/
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
	 * Возвращает массив информации с реестра полученных НН которые НЕ совпали с ЕРПН по параметрам
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 */
	public function getReestrInNotEqualErpn($month, $year, $numBranch)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		/**$sql="SELECT month,year,num_branch,type_invoice_full,
			num_invoice, date_format(date_create_invoice,'%d.%m.%Y'),
			inn_client,name_client,
			zag_summ,baza,pdv
			from no_valid_reestr_in
			WHEre month=:m and year=:y and num_branch=:nb";*/
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
	 * Возвращает массив информации с реестра выданных НН которые совпали с ЕРПН по параметрам
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 */
	public function getReestrOutEqualErpn($month, $year, $numBranch)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		/**$sql="SELECT month,year,num_branch,type_invoice_full,
				num_invoice,
				date_format(date_create_invoice,'%d.%m.%Y'),
				inn_client,
				name_client,
				suma_invoice as edrpou_sum,
				baza_invoice as edrpou_baza,
				pdvinvoice as edrpou_pdv,
				zag_summ as reestr_sum,
				baza as reestr_baza,
				pdv as reestr_pdv,
				(suma_invoice - zag_summ) as saldo_sum,
				(baza_invoice - baza) as saldo_baza,
				(pdvinvoice - pdv) as saldo_pdv
				from `out_erpn=reestr`
				WHERE month =:m AND year=:y AND num_branch=:nb";*/
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
	 * Возвращает массив информации с реестра выданных НН которые НЕ совпали с ЕРПН по параметрам
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 */
	public function getReestrOutNotEqualErpn($month, $year, $numBranch)
	{
		//$smtp=$this->em->getConnection();
		$this->reconnect();
		/**$sql="SELECT month,year,num_branch,type_invoice_full,
			num_invoice, date_format(date_create_invoice,'%d.%m.%Y'),
			inn_client,name_client,
			zag_summ,baza,pdv
			from no_valid_reestr_out
			WHEre month=:m and year=:y and num_branch=:nb";*/
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
	 * получить массив всех филиалов которые имели реестры в данном периоде
	 * @param $month
	 * @param $year
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
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