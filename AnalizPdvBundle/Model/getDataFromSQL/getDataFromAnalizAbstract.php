<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.10.2016
 * Time: 21:31
 */

namespace AnalizPdvBundle\Model\getDataFromSQL;


use Doctrine\ORM\EntityManager;

/**
 * Абстрактный класс который наследуют все классы которые "тянут" данные
 * для формирования анализов
 * Class getDataFromAnalizAbstract
 * @package AnalizPdvBundle\Model\getDataFromSQL
  */
class getDataFromAnalizAbstract
{

	protected $em;

	/**
	 * getDataFromAnalizAbstract constructor.
	 * @param EntityManager $em
	 */
	final function __construct (EntityManager $em)
	{
		$this->em=$em;
	}

	final function disconnect()
	{
		$this->em->getConnection()->close();
	}

	final function connect()
	{
		$this->em->getConnection()->connect();
	}

	/**
	 * MySQL Server has gone away
	 */
	final function reconnect()
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