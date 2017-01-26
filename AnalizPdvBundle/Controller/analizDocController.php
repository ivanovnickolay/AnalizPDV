<?php

namespace AnalizPdvBundle\Controller;

use AnalizPdvBundle\Entity\forForm\analiz\analizInnOut;
use AnalizPdvBundle\Form\analizForm\analizInnOutForm;
use AnalizPdvBundle\Form\analizForm\analizInnOutFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Контроллер обслуживания  анализа данных
 *
 * Class analizDocController
 * @package AnalizPdvBundle\Controller
 */
class analizDocController extends Controller
{
	/**
	 * Анализ выданных НН на основании сверки ИНН
	 * route /analizInnOut
	 * @param $name
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function analizInnOutAction(Request $request)
    {
	    $analizData= new analizInnOut($this->getDoctrine()->getManager());
	    $form=$this->createForm(analizInnOutForm::class,$analizData);
	    $handlerForm= new analizInnOutFormHandler();
	    if ($handlerForm->handler($form,$request))
	    {
	    	/*
		    $validSearchData=$form->getData();
		    //$arr=$searchData->getArrayFromSearchErpn();
		    $resultSearchErpn = $this->searchDocByBranch_FromErpn($searchData);
		    $resultSearchReestr = $this->searchDocByBranch_FromReestr($searchData);

		    return $this->render('@AnalizPdv/resultSearchBranch.html.twig',array(
			    'criteriaSearch'=>$validSearchData,
			    'resultSearchErpn'=>$resultSearchErpn,
			    'resultSearchReestr'=>$resultSearchReestr,
		    ));
	    	*/
	    }
	    return $this->render('@AnalizPdv/analizForm.html.twig', array(
		    'form' => $form->createView(),
	    ));

    }
}
