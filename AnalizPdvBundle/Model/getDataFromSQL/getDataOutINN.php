<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.09.2016
 * Time: 0:35
 */

namespace AnalizPdvBundle\Model\getDataFromSQL;
use Doctrine\ORM\EntityManager;


/**
 * Задача класса предоставить данные для заполннения анализа
 * реестра и ЕРПН в разрезе ИНН
 * Class getDataFromAnalizPDVOutINN
 * @package AnalizPdvBundle\Model\getDataFromSQL
 */
class getDataOutINN extends getDataFromAnalizAbstract
{
	public function getReestrEqualErpn(int $month, int $year, string $numBranch)
	{
		$this->reconnect();
		$sql="CALL AnalizInnOutInnerJoinOneBranch_tempTable(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	public function getReestrNoEqualErpn(int $month, int $year, string $numBranch)
	{
		$this->reconnect();
		$sql="CALL AnalizInnOutRightJoinOneBranch_tempTable(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}
	public function getErpnNoEqualReestr(int $month, int $year, string $numBranch)
	{
		$this->reconnect();
		$sql="CALL AnalizInnOutLeftJoinOneBranch_tempTable(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}
}