<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.09.2016
 * Time: 0:35
 */

namespace AnalizPdvBundle\Model\getDataFromSQL;

/**
 * Задача класса предоставить данные для заполннения анализа обязательств
 * реестра и ЕРПН в разрезе ИНН по одному филиалу
 * @package AnalizPdvBundle\Model\getDataFromSQL


 */
class getDataOutINNByOne extends getDataFromAnalizAbstract
{
	/**
	 * Данные анализа обязательств если документы с ЕРПН равны документам с Реестра филиала
	 * @param int $month
	 * @param int $year
	 * @param string $numBranch
	 * @return array
	 * @uses writeAnalizOutByInn::writeAnalizPDVOutInnByOneBranch - отсюда вызывается функция
	 * @uses store_procedure::AnalizInnOutInnerJoinOneBranch_tempTable - хранимая процедура для генерации данных
	 */
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

	/**
	 * Данные анализа обязательств только документы которые есть в Реестрах филиала но нет в ЕРПН
	 * @param int $month
	 * @param int $year
	 * @param string $numBranch
	 * @return array
	 * @uses writeAnalizOutByInn::writeAnalizPDVOutInnByOneBranch - отсюда вызывается функция
	 * @uses store_procedure::AnalizInnOutRightJoinOneBranch_tempTable - хранимая процедура для генерации данных
	 */
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

	/**
	 * Данные анализа обязательств только документы которые есть в ЕРПН но нет в Реестрах филилала
	 * @param int $month
	 * @param int $year
	 * @param string $numBranch
	 * @return array
	 * @uses writeAnalizOutByInn::writeAnalizPDVOutInnByOneBranch - отсюда вызывается функция
	 * @uses store_procedure::AnalizInnOutLeftJoinOneBranch_tempTable - хранимая процедура для генерации данных
	 */
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