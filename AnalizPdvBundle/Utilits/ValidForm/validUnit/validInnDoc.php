<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.12.2016
 * Time: 22:01
 */

namespace AnalizPdvBundle\Utilits\ValidForm\validUnit;


/**
 * проверка ИНН докумета
 * Class validInnDoc
 * @package AnalizPdvBundle\Utilits\ValidForm\validUnit
 */
class validInnDoc extends validUnitAbsract
{
	/**
	 * @param $data
	 * @return bool|mixed
	 */
	public function isValid ($data)
	{
		$this->errorMsg="";
		if (!ctype_digit($data))
		{
			$this->errorMsg=$this->errorMsg." ИНН не может содержать буквы";
		}
		if (strlen($data)>12)
		{
			$this->errorMsg=$this->errorMsg." ИНН не может быть длинее 12 цифр";
		}
		if (!empty($this->errorMsg))
		{
			return false;
		} else
		{
			return true;
		}
	}

}