<?php

namespace AnalizPdvBundle\Controller;

use AnalizPdvBundle\Form\handlerFormSearchErpn;
use AnalizPdvBundle\Utilits\ValidForm\validFormSearchErpn;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class searchDocController
 * @package AnalizPdvBundle\Controller
 */
class searchDocErpnController extends Controller
{
	/**
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
		/**
		$r=$request;
		$data = $r->request->all();
		$valid=new validFormSearchErpn();
		if ($valid->isValdForm($data))
		{

			return new JsonResponse("Form is Valid");
		} else
		{
			return new JsonResponse("Form is NO Valid");
		}*/

		$handlerForm=$this->get('handler_search_erpn');
			if ($handlerForm->handlerForm($request))
			{
				$returnData=$handlerForm->getData();
			} else
			{

			}


		//return $this->render('@AnalizPdv/search.html.twig');
	}
}
