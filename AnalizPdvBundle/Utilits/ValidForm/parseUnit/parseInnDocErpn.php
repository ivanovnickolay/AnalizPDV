<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.12.2016
 * Time: 18:58
 */

namespace AnalizPdvBundle\Utilits\ValidForm\parseUnit;


use AnalizPdvBundle\Utilits\ValidForm\validUnit\validInnDoc;

/**
 * парсинг ИНН клиента в ЕРПН
 * Class parseInnDoc
 * @package AnalizPdvBundle\Utilits\ValidForm\parseUnit
 */
class parseInnDocErpn extends parseUnitAbstract
{
	/**
	 * @param array $data
	 */
	public function parse (array $data)
	{
		$valid=new validInnDoc();
		foreach ($data as $key=>$value) {
			if (($key = "inn_client"))
			{
				if ($valid->isValid ($value))
				{
					$arr["inn_client"] = $value;
					return $arr;
				} else
				{
					return null;
				}

			}
		}
	}
}