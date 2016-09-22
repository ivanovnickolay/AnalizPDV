<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.09.2016
 * Time: 20:52
 */

namespace AnalizPdvBundle\Model\writeAnalizPDVToFile;
use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrsAll;
use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrsByOne;
use AnalizPdvBundle\Utilits\createWriteFile\getWriteExcel;
use Doctrine\ORM\EntityManager;


/**
 * Задача класса реализация алгоритмов ормирования
 * файлов анализов ПДВ из одного места
 * Class writeAnalizPDVToFile
 * @package AnalizPdvBundle\Model\writeAnalizPDVToFile
 */
class writeAnalizPDVToFile
{
	private $em;
public function __construct (EntityManager $entityManager)
{
	$this->em=$entityManager;
}

	/**
	 * формирование файла анализа сводного всему УЗ
	 */
	public function writeAnalizPDVByAllUZ(int $month, int $year)
{
	$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_All.xlsx";
	$data=new getDataFromReestrsAll($this->em);
	$write=new getWriteExcel($file);
	$write->setParamFile($month,$year,'ALL');
	$f=$write->getNewFileName();
	$arr=$data->getReestrInEqualErpn($month,$year);
		$write->setDataFromWorksheet('In_reestr=edrpu',$arr,'A4');
			unset($arr);
	gc_collect_cycles();
	$arr=$data->getReestrInNotEqualErpn($month,$year);
		$write->setDataFromWorksheet('In_reestr<>edrpou',$arr,'A4');
			unset($arr);
	gc_collect_cycles();
	$arr=$data->getReestrOutEqualErpn($month,$year);
		$write->setDataFromWorksheet('Out_reestr=edrpu',$arr,'A4');
			unset($arr);
	gc_collect_cycles();
	$arr=$data->getReestrOutNotEqualErpn($month,$year);
		$write->setDataFromWorksheet('Out_reestr<>edrpou',$arr,'A4');
			unset($arr);
	gc_collect_cycles();
	$write->fileWriteAndSave();
	unset($data,$write);
	gc_collect_cycles();
}

	/**
	 *формирование файла анализа по одному конкретному филиалу
	 */
	public function writeAnalizPDVByOneBranch(int $month,int $year,string $numBranch)
	{
		$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV.xlsx";
		$data=new getDataFromReestrsByOne($this->em);
		$write=new getWriteExcel($file);
		$write->setParamFile($month,$year,$numBranch);
		$f=$write->getNewFileName();
		$arr=$data->getReestrInEqualErpn($month,$year,$numBranch);
		$write->setDataFromWorksheet('In_reestr=edrpu',$arr,'A4');
		unset($arr);
		gc_collect_cycles();
		$arr=$data->getReestrInNotEqualErpn($month,$year,$numBranch);
		$write->setDataFromWorksheet('In_reestr<>edrpou',$arr,'A4');
		unset($arr);
		gc_collect_cycles();
		$arr=$data->getReestrOutEqualErpn($month,$year,$numBranch);
		$write->setDataFromWorksheet('Out_reestr=edrpu',$arr,'A4');
		unset($arr);
		gc_collect_cycles();
		$arr=$data->getReestrOutNotEqualErpn($month,$year,$numBranch);
		$write->setDataFromWorksheet('Out_reestr<>edrpou',$arr,'A4');
		unset($arr);
		gc_collect_cycles();
		$write->fileWriteAndSave();
		unset($data,$write);
		gc_collect_cycles();
	}

	/**
	 * формирование файлов анализа по всем филиалам
	 * каждый филиал в свой файл
	 */
	public function writeAnalizPDVByAllBranch(int $month,int $year)
	{
		$data=new getDataFromReestrsByOne($this->em);
		$arrAllBranch=$data->getAllBranchToPeriod($month,$year);
		if(!empty($arrAllBranch)) {
			foreach ($arrAllBranch as $arrAll)
			{
				foreach ($arrAll as $key => $numBranch)
				{
					$this->writeAnalizPDVByOneBranch($month,$year,$numBranch);
				}
			}
		}
	}
}