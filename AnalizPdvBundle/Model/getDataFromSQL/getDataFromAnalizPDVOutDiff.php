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
 * опаздавших выданных НН
 * Class getDataFromAnalizPDVOutINN
 * @package AnalizPdvBundle\Model\getDataFromSQL
 */
class getDataFromAnalizPDVOutDiff
{
	private $em;
	public function __construct (EntityManager $em)
	{
		$this->em=$em;
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