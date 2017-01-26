<?php

namespace AnalizPdvBundle\Controller;

use AnalizPdvBundle\AnalizPdvBundle;
use AnalizPdvBundle\Entity\forForm\search\allFromPeriod_Branch;
use AnalizPdvBundle\Entity\forForm\search\docFromParam;
use AnalizPdvBundle\Entity\forForm\search\searchAbstract;
use AnalizPdvBundle\Entity\Repository\ErpnOut;
use AnalizPdvBundle\Form\allFromPeriod_BranchForm;
use AnalizPdvBundle\Form\allFromPeriod_BranchFormHandler;
use AnalizPdvBundle\Form\docFromParamForm;
use AnalizPdvBundle\Form\docFromParamFormHandler;
use AnalizPdvBundle\Form\handlerFormSearchErpn;
use AnalizPdvBundle\Utilits\ValidForm\validFormSearchErpn;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Контроллер обслуживания поиска данных
 *
 * Class searchDocController
 * @package AnalizPdvBundle\Controller
 */
class searchDocController extends Controller
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

	/**
	 * поиск всех документов за период
	 *
	 * @uses allFromPeriod_Branch  сущность формы
	 * @uses allFromPeriod_BranchFormHandler обрабочик формы
	 * @uses allFromPeriod_BranchForm описание формы
	 * @uses ErpnOut таблица базы данных для поиска данных
	 *
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function searchDocByBranchAction(Request $request)
	{
		$searchData= new allFromPeriod_Branch();
		 $form=$this->createForm(allFromPeriod_BranchForm::class,$searchData);
		  $handlerForm= new allFromPeriod_BranchFormHandler();
		if ($handlerForm->handler($form,$request))
		{
			$validSearchData=$form->getData();
			//$arr=$searchData->getArrayFromSearchErpn();
			$resultSearchErpn = $this->searchDocByBranch_FromErpn($searchData);
			$resultSearchReestr = $this->searchDocByBranch_FromReestr($searchData);

			return $this->render('@AnalizPdv/resultSearchBranch.html.twig',array(
				'criteriaSearch'=>$validSearchData,
				'resultSearchErpn'=>$resultSearchErpn,
				'resultSearchReestr'=>$resultSearchReestr,
			));
		}
		return $this->render('@AnalizPdv/searchForm.html.twig', array(
			'form' => $form->createView(),
		));


		//return $this->render('@AnalizPdv/search.html.twig');
	}


	/**
	 * Поиск документов за период по параметрам
	 *
	 * @uses docFromParam  сущность формы
	 * @uses docFromParamhForm описание формы
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function searchDocByParamAction(Request $request)
	{
		$searchData=new docFromParam();
			$form=$this->createForm(docFromParamForm::class,$searchData);
				$handlerForm=new docFromParamFormHandler();
		if($handlerForm->handler($form, $request))
		{
			$validSearchData=$form->getData();
			$resultSearchErpn = $this->searchDocByParam_FromErpn($searchData);
			$resultSearchReestr = $this->searchDocByParam_FromReestr($searchData);

			return $this->render('@AnalizPdv/resultSearchParam.html.twig',array(
				'criteriaSearch'=>$validSearchData,
				'resultSearchErpn'=>$resultSearchErpn,
				'resultSearchReestr'=>$resultSearchReestr,
			));

		}
		return $this->render('@AnalizPdv/searchDocFromParamForm.html.twig', array(
			'form' => $form->createView(),
		));
	}

	/**
	 *
	 * Получение репозитория для поиска в ЕРПН
	 *
	 * @param searchAbstract $searchData
	 * @return \AnalizPdvBundle\Entity\Repository\ErpnInRepository|\AnalizPdvBundle\Entity\Repository\ErpnOutRepository|\Doctrine\Common\Persistence\ObjectRepository
	 */
	public function getRepositorySearchErpn(searchAbstract $searchData)
	{
		if ($searchData->getRouteSearch() == "Обязательства") {
			$repositorySearchErpn = $this->getDoctrine()->getManager()->getRepository('AnalizPdvBundle:ErpnOut');
			return $repositorySearchErpn;
		} else {
			$repositorySearchErpn = $this->getDoctrine()->getManager()->getRepository('AnalizPdvBundle:ErpnIn');
			return $repositorySearchErpn;
		}
	}

	/**
	 *
	 * Получение репозитория  для поиска в Реестре филиала
	 *
	 * @param allFromPeriod_Branch|searchAbstract $searchData
	 * @return \AnalizPdvBundle\Entity\Repository\ReestrBranch_in|\AnalizPdvBundle\Entity\Repository\ReestrBranch_out|\Doctrine\Common\Persistence\ObjectRepository
	 */
	public function getRepositorySearchReestr(searchAbstract $searchData)
	{
		if ($searchData->getRouteSearch() == "Обязательства") {
			$repositorySearchReestr = $this->getDoctrine()->getManager()->getRepository('AnalizPdvBundle:ReestrbranchOut');
			return $repositorySearchReestr;
		} else {
			$repositorySearchReestr = $this->getDoctrine()->getManager()->getRepository('AnalizPdvBundle:ReestrbranchIn');
			return $repositorySearchReestr;
		}
	}
	/**
	 * Получение данных из ЕРПН для поиска по филиалам
	 * @param $searchData allFromPeriod_Branch
	 * @return mixed
	 */
	public function searchDocByBranch_FromErpn(allFromPeriod_Branch $searchData)
	{
		$repositorySearchErpn = $this->getRepositorySearchErpn($searchData);
		$resultSearchErpn = $repositorySearchErpn->getSearchAllFromPeriod_Branch($searchData->getArrayFromSearchErpn());
		return $resultSearchErpn;
	}

	/**
	 * Получение данных из ЕРПН для поиска по параметрам
	 * @param docFromParam $searchData
	 * @return mixed
	 * @internal param $arr
	 */
	public function searchDocByParam_FromErpn(docFromParam $searchData)
	{
		$repositorySearchErpn = $this->getRepositorySearchErpn($searchData);
		$resultSearchErpn = $repositorySearchErpn->getSearchAllFromParam($searchData->getArrayFromSearchErpn());
		return $resultSearchErpn;
	}

	/**
	 * Получение данных из реестра для поиска по филиалам
	 * @param allFromPeriod_Branch $searchData
	 * @return null
	 * @internal param $arr
	 */
	public function searchDocByBranch_FromReestr(allFromPeriod_Branch $searchData)
	{
		// Если значение номера филиала заполнено
		if ($searchData->getNumMainBranch() != "000") {
			// получаем данные
			$repositorySearchReestr = $this->getRepositorySearchReestr($searchData);
			$resultSearchReestr = $repositorySearchReestr->getSearchAllFromPeriod_Branch($searchData->getArrayFromSearchErpn());
			return $resultSearchReestr;
		} else {
			// иначе передаем пустое значение
			$resultSearchReestr = null;
			return $resultSearchReestr;
		}
	}

	/**
	 * Получение данных из реестра для поиска по параметрам
	 * @param docFromParam $searchData
	 * @return null
	 * @internal param $arr
	 */
	public function searchDocByParam_FromReestr(docFromParam $searchData)
	{
		$repositorySearchReestr = $this->getRepositorySearchReestr($searchData);
		$resultSearchReestr = $repositorySearchReestr->getSearchAllFromParam($searchData->getArrayFromSearchErpn());
			return $resultSearchReestr;
	}

}
