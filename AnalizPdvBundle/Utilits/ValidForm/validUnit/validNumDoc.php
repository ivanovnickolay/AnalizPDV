<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.12.2016
 * Time: 22:01
 */

namespace AnalizPdvBundle\Utilits\ValidForm\validUnit;


/**
 * проверка номера докумета
 * Class validNumDoc
 * @package AnalizPdvBundle\Utilits\ValidForm\validUnit
 */
class validNumDoc extends validUnitAbsract
{
	/**
	 * @param $data
	 */
	public function isValid ($data)
	{
		if (!preg_match("/[^0-9\/]/", $data))
		{
			return true;
			$this->errorMsg="Номер документа должен содержать только цифры и символ / ";
		}
			return false;
	}

}