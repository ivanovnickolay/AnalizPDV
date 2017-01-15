<?php

namespace AnalizPdvBundle\Entity\Repository;
use AnalizPdvBundle\Entity\forForm\search\allFromPeriod_Branch;
use AnalizPdvBundle\Entity\forForm\search\getArrayFromSearch_Interface;

/**
 * ErpnIn
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ErpnInRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	 * поиск данных в ЕРПН по условиям из класса getSearchAllFromPeriod_Branch
	 *
	 * @uses allFromPeriod_Branch класс поиска
	 * @uses allFromPeriod_Branch::getArrayFromSearchErpn возвращает данные для $arrayFromSearch
	 *
	 * использованные расширения
	 * @link  https://simukti.net/blog/2012/04/05/how-to-select-year-month-day-in-doctrine2/
	 * @link  https://github.com/beberlei/DoctrineExtensions
	 *
	 * @param getArrayFromSearch_Interface $arrayFromSearch
	 */
	public function getSearchAllFromPeriod_Branch($arrayFromSearch)
	{
		$emConfig = $this->getEntityManager()->getConfiguration();
		$emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
		$emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');

		$qr=$this->createQueryBuilder('ErpnIn');
		$qr->where('MONTH(ErpnIn.dateCreateInvoice)=:m');
		$qr->setParameter('m', $arrayFromSearch['monthCreateInvoice']);
		$qr->andWhere('YEAR(ErpnIn.dateCreateInvoice)=:y');
		$qr->setParameter('y', $arrayFromSearch['yearCreateInvoice']);

		if(array_key_exists('numBranchVendor', $arrayFromSearch))
		{
			$qr->andWhere('ErpnIn.numBranchVendor=:nbv');
			$qr->setParameter('nbv', $arrayFromSearch['numBranchVendor']);
		}

		if(array_key_exists('numMainBranch', $arrayFromSearch))
		{
			$qr->andWhere('ErpnIn.numMainBranch=:nmb');
			$qr->setParameter('nmb', $arrayFromSearch['numMainBranch']);
		}

		$result=$qr->getQuery();
		return $result->getResult();
	}

}
