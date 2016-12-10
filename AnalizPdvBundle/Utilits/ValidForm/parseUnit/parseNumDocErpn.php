<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.12.2016
 * Time: 18:58
 */

namespace AnalizPdvBundle\Utilits\ValidForm\parseUnit;


use AnalizPdvBundle\Utilits\ValidForm\validUnit\validInnDoc;
use AnalizPdvBundle\Utilits\ValidForm\validUnit\validNumDoc;

/**
 * парсинг ИНН клиента в ЕРПН
 * Class parseInnDoc
 * @package AnalizPdvBundle\Utilits\ValidForm\parseUnit
 */
class parseNumDocErpn extends parseUnitAbstract
{
	/**
	 * @param array $data
	 */
	public function parse (array $data)
	{
		$valid=new validNumDoc();
		foreach ($data as $key=>$value) {
			if (($key = "num_invoice"))
			{
				if ($valid->isValid ($value))
				{
					$arr["num_invoice"] = $value;
					return $arr;
				} else
				{
					return null;
				}

			}
		}
	}
}