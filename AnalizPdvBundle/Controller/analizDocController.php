<?php

namespace AnalizPdvBundle\Controller;

use AnalizPdvBundle\Entity\forForm\analiz\analizInnOut;
use AnalizPdvBundle\Entity\forForm\analiz\handlerData_analizInnOut;
use AnalizPdvBundle\Form\analizForm\analizInnOutForm;
use AnalizPdvBundle\Form\analizForm\analizInnOutFormHandler;
use AnalizPdvBundle\Model\getDataFromSQL\getDataOutINNByOne;
use Doctrine\ORM\EntityManager;
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
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @internal param $
	 */
	public function analizInnOutAction(Request $request)
    {
	    $analizData= new analizInnOut($this->getDoctrine()->getManager());
	    $form=$this->createForm(analizInnOutForm::class,$analizData);
	    $handlerForm= new analizInnOutFormHandler();
	    if ($handlerForm->handler($form,$request))
	    {
	    	$criteriaAnaliz=$form->getData();
			$Data= new handlerData_analizInnOut($this->getDoctrine()->getManager(),$analizData);
			$arrayData=$Data->getAnalizData();
			return $this->render('@AnalizPdv/resultSearch/resultAnalizINNOut.html.twig',array(
				'criteriaAnaliz'=>$criteriaAnaliz,
				'resultAnaliz'=>$arrayData,
				'nameTypeAnaliz'=>$Data->getNameTypeAnaliz(),
				'numMaimBranch'=>$Data->getNumBranch(),
			));
	    }
	    return $this->render('@AnalizPdv/form/analizForm.html.twig', array(
		    'form' => $form->createView(),
	    ));

    }

	/**
	 * Получение документов которые расшифровывают отклонения
	 *
	 * route /getDoc_analizInnOut/{month}/{year}/{numBranch}/{INN}/
	 * @param $month
	 * @param $year
	 * @param $numBranch
	 * @param $INN

	 */
	public function getDoc_analizInnOutAction($month, $year,$numBranch, $INN )
	{
		$entity=new analizInnOut($this->getDoctrine()->getManager());

			// Проверяем валидатором полученные значения
			$validatorData=$this->get('validDataController');
			$validMonth=$validatorData->validMonth($month);
			$validYear=$validatorData->validYear($year);
			$validINN=$validatorData->validINN($INN);
			$validNumBranch=$validatorData->validNumBranch($numBranch);

		if (count($validMonth)==0 and count($validYear)==0 and count($validINN)==0 and count($validNumBranch)==0) {
			$docByERPN=$this->get('doctrine')->getRepository('AnalizPdvBundle:ErpnOut')->getDocFromERPN($month, $year,$numBranch, $INN);
			$docByReestr=$this->get('doctrine')->getRepository('AnalizPdvBundle:ReestrbranchOut')->getDocFromReestr($month, $year,$numBranch, $INN);
			return $this->render("@AnalizPdv/resultSearch/resultSearchDocByOut.html.twig",array(
				'resultSearchReestr'=>$docByReestr,
				'resultSearchErpn'=>$docByERPN,

			));
		}
		return $this->render("@AnalizPdv/resultSearch/resultSearchDocByOut.html.twig",array());

	}
}
