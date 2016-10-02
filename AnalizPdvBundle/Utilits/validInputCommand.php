<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.10.2016
 * Time: 16:56
 */

namespace AnalizPdvBundle\Utilits;


/**
 * Клас проверяет данные которые вводятся при ввводе команд на проведение анализов
 * Class validInputCommand
 * @package AnalizPdvBundle\Utilits
 */
class validInputCommand
{
	private $em;
		public function __construct ($entityManager)
	{
		$this->em=$entityManager;
	}

	public function  validMonth($month)
	{
		$arrMonth=array(1,2,3,4,5,6,7,8,9,10,11,12);
		if(2<strlen($month))
		{
			return false;
		}
		if(!in_array((int) $month,$arrMonth))
		{
			return false;
		}
			return true;
	}

	public function  validYear($year)
	{
		$arrYear=array(2015,2016,2017);
		if(4<strlen($year))
		{
			return false;
		}
		if(!in_array($year,$arrYear))
		{
			return false;
		}
		return true;
	}
	public function  validBranch($numBranch)
	{
		return false;
	}
}