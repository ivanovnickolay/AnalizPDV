<?php

namespace AnalizPdvBundle\Entity\Repository;

/**
 * ReestrBranch_in
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReestrBranch_in extends \Doctrine\ORM\EntityRepository
{
	/**
	 * поиск данных в Реестре выданых НН по параметрам
	 *
	 * @uses allFromPeriod_Branch класс поиска
	 * @uses allFromPeriod_Branch::getArrayFromSearchErpn возвращает данные для $arrayFromSearch
	 *
	 * использованные расширения
	 * @link  https://simukti.net/blog/2012/04/05/how-to-select-year-month-day-in-doctrine2/
	 * @link  https://github.com/beberlei/DoctrineExtensions
	 *
	 *
	 * @param $arrayFromSearch
	 */
	public function getSearchAllFromPeriod_Branch($arrayFromSearch)
	{
		$emConfig = $this->getEntityManager()->getConfiguration();
		$emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
		$emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');

		$qr=$this->createQueryBuilder('ReestrIn');
		$qr->where('MONTH(ReestrIn.dateCreateInvoice)=:m');
		$qr->setParameter('m', $arrayFromSearch['monthCreateInvoice']);
		$qr->andWhere('YEAR(ReestrIn.dateCreateInvoice)=:y');
		$qr->setParameter('y', $arrayFromSearch['yearCreateInvoice']);

		if(array_key_exists('numMainBranch', $arrayFromSearch))
		{
			$qr->andWhere('ReestrIn.numBranch=:nb');
			$qr->setParameter('nb', $arrayFromSearch['numMainBranch']);
		}

		$result=$qr->getQuery();
		return $result->getResult();
	}
}
