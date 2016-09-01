<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31.08.2016
 * Time: 22:10
 */

namespace AnalizPdvBundle\Utilits\createEntity\reestrIn;


use AnalizPdvBundle\Entity\ReestrbranchIn;
use AnalizPdvBundle\Utilits\createEntity\interfaceReestr\createReestr;

class createReestrIn extends createReestr
{

	public function createReestr (array $arr)
	{
		// TODO: Implement createReestr() method.
		$reestrIn=new ReestrbranchIn();
			$reestrIn->setMonth($arr[0][79]);
				$reestrIn->setYear($arr[0][87]);
					$reestrIn->setNumBranch($arr[0][66]);
						$reestrIn->setDateGetInvoice($this->getDataType($arr[0][105]));
							$reestrIn->setDateCreateInvoice($this->getDataType($arr[0][126]));
								$reestrIn->setNumInvoice($arr[0][106]);
		$reestrIn->setTypeInvoiceFull($arr[0][134]);
			$reestrIn->setNameClient($arr[0][108]);
				$reestrIn->setInnClient($arr[0][109]);
					$reestrIn->setZagSumm($arr[0][111]);
						$reestrIn->setBaza20($arr[0][113]);
								$reestrIn->setPdv20($arr[0][116]);
		$reestrIn->setBaza7($arr[0][114]);
			$reestrIn->setPdv7($arr[0][117]);
				$reestrIn->setBaza0($arr[0][115]);
					$reestrIn->setPdv0($arr[0][118]);
						$reestrIn->setBazaZvil($arr[0][120]);
							$reestrIn->setPdvZvil($arr[0][95]);
								$reestrIn->setBazaNeGos($arr[0][98]);
									$reestrIn->setPdvNeGos($arr[0][101]);
		$reestrIn->setBazaZaMezhi($arr[0][103]);
			$reestrIn->setPdvZaMezhi($arr[0][104]);
				$reestrIn->setRkeDateCreateInvoice($this->getDataType($arr[0][122]));
					$reestrIn->setRkeNumInvoice($arr[0][123]);
						$reestrIn->setRkePidstava($arr[0][124]);
							$reestrIn->setKeyField();
		return $reestrIn;

	}
}