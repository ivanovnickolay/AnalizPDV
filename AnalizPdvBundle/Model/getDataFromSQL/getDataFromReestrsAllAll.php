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
class getDataFromReestrsAll
{
	private $em;
	public function __construct (EntityManager $em)
	{
		$this->em=$em;
	}

	/**
	 * Возвращает массив информации с реестра полученных НН которые
	 * совпали с ЕРПН по параметрам
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 */
	public function getReestrInEqualErpn($month, $year)
	{
		//$smtp=$this->em->getConnection();
		$sql="SELECT
        month,
        year,num_branch,
        COUNT(num_invoice),
				SUM(suma_invoice) as edrpou_sum,
				SUM(baza_invoice) as edrpou_baza,
				SUM(pdvinvoice) as edrpou_pdv,
				SUM(zag_summ) as reestr_sum,
				SUM(baza) as reestr_baza,
				SUM(pdv) as reestr_pdv,
				SUM(suma_invoice - zag_summ) as saldo_sum,
				SUM(baza_invoice - baza) as saldo_baza,
				SUM(pdvinvoice - pdv) as saldo_pdv
				from `in_erpn=reestr`
				WHERE month =:m AND year=:y
        		GROUP BY
       			 month,
       			year,
        		num_branch";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}
	/**
	 * Возвращает массив информации с реестра полученных НН которые
	 * совпали с ЕРПН по параметрам
	 * @link  http://yapro.ru/web-master/mysql/doctrine2-nativnie-zaprosi.html
	 * @param $month string
	 * @param $year string
	 * @param $numBranch string
	 * @return array arrayResult
	 */
	public function getReestrInNotEqualErpn($month, $year)
	{
		//$smtp=$this->em->getConnection();
		$sql="SELECT month,
		  	year,
		  	num_branch,
		  	COUNT(num_branch),
			SUM(zag_summ),
		  	SUM(baza),
		  	SUM(pdv)
			from no_valid_reestr_in
			WHEre month=:m and year=:y
		    GROUP BY
		        month,
		        year,
		        num_branch";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}
}