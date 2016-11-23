<?php

namespace AnalizPdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function getDocAction()
	{
		return $this->render('@AnalizPdv/search.html.twig');
	}
}
