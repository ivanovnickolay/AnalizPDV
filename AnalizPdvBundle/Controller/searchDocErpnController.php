<?php

namespace AnalizPdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class searchDocController
 * @package AnalizPdvBundle\Controller
 */
class searchDocErpnController extends Controller
{
	/**
	 * @param $name
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function viewFormAction()
    {
        return $this->render('@AnalizPdv/search.html.twig');
    }

	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 * request -> parameters
	 *  typeRoute = "Выданные"
		periodCreate = "2016-11"
		numDoc = "64654"
		dataDoc = "2016-11-10"
		InnDoc = "3212465487"
	 */
	public function getDocAction(Request $request)
	{
		$r=$request;

		return $this->render('@AnalizPdv/search.html.twig');
	}
}
