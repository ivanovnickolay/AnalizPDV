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
	 *
	 *
	 */
	public function analizInnOutAction(Request $request)
    {
	    $analizData= new analizInnOut($this->getDoctrine()->getManager());
	    $form=$this->createForm(analizInnOutForm::class,$analizData);
	    $handlerForm= new analizInnOutFormHandler();
	    if ($handlerForm->handler($form,$request))
	    {
	    	// если проверка прошла успешно то надо отобразить таблицу отклонений
		    // writeAnalizOutByInn::writeAnalizPDVOutInnByOneBranchWithDoc



	    }
	    return $this->render('@AnalizPdv/form/analizForm.html.twig', array(
		    'form' => $form->createView(),
	    ));

    }
}
