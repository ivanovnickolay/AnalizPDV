<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.12.2016
 * Time: 18:50
 */

namespace AnalizPdvBundle\Utilits\ValidForm\parseUnit;


/**
 * Абстрактный класс парсера данных полученных из формы поиска
 * в массив годный для использования в поиске по базе данных
 * Class parseUnitAbstract
 * @package AnalizPdvBundle\Utilits\ValidForm\parseUnit
 */
abstract class parseUnitAbstract
{
	/**
	 * метод в котором проводится парсинг данных и вывод данных годных для поиска
	 * @param $data array
	 * @return array в формате [поле_базы_данных]=>[значение_поля]
	 */
	public function parse(array $data)
	{

	}

}