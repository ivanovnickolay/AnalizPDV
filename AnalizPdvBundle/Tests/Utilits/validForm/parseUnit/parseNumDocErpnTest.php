<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.12.2016
 * Time: 19:11
 */

namespace AnalizPdvBundle\Tests\Utilits\validForm\parseUnit;


use AnalizPdvBundle\Utilits\ValidForm\parseUnit\parseInnDocErpn;
use AnalizPdvBundle\Utilits\ValidForm\parseUnit\parseNumDocErpn;

/**
 * Class parseInnDocErpnTest
 * @package AnalizPdvBundle\Tests\Utilits\validForm\parseUnit
 */
class parseNumDocErpnTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @return array
	 */
	public function data()
	{
		return[
		[["num_invoice"=>"12456ff54"],false],
		[["num_invoice"=>"1245654"],true],
		[["num_invoice"=>"dfsdf//464"],false],
		[["num_invoice"=>"1245654//ff"],false]
		];
	}


	/**
	 * @param $data
	 * @param $res
	 * @dataProvider data
	 */
	public function test_parseNumDoc ($data, $res)
	{
		$parse=new parseNumDocErpn();
		$arr=$parse->parse($data);
		if (!empty($arr))
		{
			$this->assertEquals($res,key_exists("num_invoice",$arr));
		}else
		{
			$this->assertEquals($res,false);
		}

	}
}
