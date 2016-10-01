<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.09.2016
 * Time: 0:35
 */

namespace AnalizPdvBundle\Model\getDataFromSQL;

/**
 * Задача класса предоставить данные для заполннения анализа
 * опаздавших выданных НН
 * Class getDataFromAnalizPDVOutINN
 * @package AnalizPdvBundle\Model\getDataFromSQL
 */
class getDataPDVOutDiff extends getDataFromAnalizAbstract
{
	/**
	 * Получаем весь список опаздавших с регистрацией НН
	 * @param int $month
	 * @param int $year
	 * @param string $numBranch
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
	 */
	public function getAllDiff(int $month, int $year, string $numBranch)
	{
		// так как в хранимой процедуре используются временные таблицы, для их обнуления
		// "передергнем соединение с базой для очистки временных таблиц
		$this->disconnect();
		$this->connect();
		$sql="CALL AnalizPDVOutDiffDateOneBranchInnerJoinERPN_tempTable(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		//var_dump($arrayResult);

		return $arrayResult;
	}

	/**
	 * Получаем список опаздавших НН которые включены в Реестр филиала
	 * @param int $month
	 * @param int $year
	 * @param string $numBranch
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
	 */
	public function getDiffToReestr(int $month, int $year, string $numBranch)
	{
		// так как в хранимой процедуре используются временные таблицы, для их обнуления
		// "передергнем соединение с базой для очистки временных таблиц
		$this->disconnect();
		$this->connect();
		$sql="CALL AnalizPDVOutDiffDateOneBranchInnerJoinReestr_tempTable(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}

	/**
	 * Получаем список опаздавших НН которые НЕ включены в Реестр филиала
	 * @param int $month
	 * @param int $year
	 * @param string $numBranch
	 * @return array
	 * @throws \Doctrine\DBAL\DBALException
	 */
	public function getDiffToNotReestr(int $month, int $year, string $numBranch)
	{
		// так как в хранимой процедуре используются временные таблицы, для их обнуления
		// "передергнем соединение с базой для очистки временных таблиц
		$this->disconnect();
		$this->connect();
		$sql="CALL AnalizPDVOutDiffDateOneBranchLeftJoinERPN_tempTable(:m,:y,:nb)";
		$smtp=$this->em->getConnection()->prepare($sql);
		$smtp->bindValue("m",$month);
		$smtp->bindValue("y",$year);
		$smtp->bindValue("nb",$numBranch);
		$smtp->execute();
		$arrayResult=$smtp->fetchAll();
		return $arrayResult;
	}
}