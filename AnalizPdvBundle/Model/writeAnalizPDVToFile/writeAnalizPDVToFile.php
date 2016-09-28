<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.09.2016
 * Time: 20:52
 */

namespace AnalizPdvBundle\Model\writeAnalizPDVToFile;
use AnalizPdvBundle\Model\getDataFromSQL\getDataFromAnalizPDVOutDiff;
use AnalizPdvBundle\Model\getDataFromSQL\getDataFromAnalizPDVOutINN;
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
	private $pathToTemplate;

public function __construct ($entityManager,string $pathToTemplate='')
{
	$this->em=$entityManager;
	$this->pathToTemplate=$pathToTemplate;
}

	/**
	 * формирование файла анализа сводного всему УЗ
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 */
	public function writeAnalizPDVByAllUZ(int $month, int $year)
{
	$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_All.xlsx";
	$data=new getDataFromReestrsAll($this->em);
	$write=new getWriteExcel($file);
	$write->setParamFile($month,$year,'ALL');
	$write->getNewFileName();
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
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @param string $numBranch номер филиала по которому надо сформировать анализ
	 */
	public function writeAnalizPDVByOneBranch(int $month,int $year,string $numBranch)
	{
		$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV.xlsx";
		$data=new getDataFromReestrsByOne($this->em);
		$write=new getWriteExcel($file);
		$write->setParamFile($month,$year,$numBranch);
		$write->getNewFileName();
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
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
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

	/**
	 *формирование файла анализа расхождений по ИНН по одному конкретному филиалу
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @param string $numBranch номер филиала по которому надо сформировать анализ
	 */
	public function writeAnalizPDVOutInnByOneBranch(int $month,int $year,string $numBranch)
	{
		$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_Out_INN.xlsx";
		$data=new getDataFromAnalizPDVOutINN($this->em);
		$write=new getWriteExcel($file);
		$write->setParamFile($month,$year,$numBranch);
		$write->getNewFileName();
		$arr=$data->getReestrEqualErpn($month,$year,$numBranch);
		$write->setDataFromWorksheet('Out_reestr=erpn',$arr,'A4');
		unset($arr);
		gc_collect_cycles();
		$arr=$data->getErpnNoEqualReestr($month,$year,$numBranch);
		$write->setDataFromWorksheet('Out_erpn<>reestr',$arr,'A4');
		unset($arr);
		gc_collect_cycles();
		$arr=$data->getReestrNoEqualErpn($month,$year,$numBranch);
		$write->setDataFromWorksheet('Out_reestr<>erpn',$arr,'A4');
		unset($arr);
		gc_collect_cycles();

		$write->fileWriteAndSave();
		unset($data,$write);
		gc_collect_cycles();
	}

	/**
	 * формирование файлов анализа расхождений по ИНН по всем филиалам
	 * каждый филиал в свой файл
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 */
	public function writeAnalizPDVOutInnByAllBranch(int $month,int $year)
	{
		$data=new getDataFromReestrsByOne($this->em);
		$arrAllBranch=$data->getAllBranchToPeriod($month,$year);
		if(!empty($arrAllBranch)) {
			foreach ($arrAllBranch as $arrAll)
			{
				foreach ($arrAll as $key => $numBranch)
				{
					$this->writeAnalizPDVOutInnByOneBranch($month,$year,(string) $numBranch);
				}
			}
		}
	}
	/**
	 *формирование файла анализа опаздавших НН по одному конкретному филиалу
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @param string $numBranch номер филиала по которому надо сформировать анализ
	 */
	public function writeAnalizPDVOutDiffByOneBranch(int $month,int $year,string $numBranch)
	{
		$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_DiffDate.xlsx";
		$data=new getDataFromAnalizPDVOutDiff($this->em);
		$write=new getWriteExcel($file);
		echo "$month $year $numBranch begin   \r\n";
		$write->setParamFile($month,$year,$numBranch);
		$write->getNewFileName();
		echo " getAllDiff begin   \r\n";
		$arr=$data->getAllDiff($month,$year,$numBranch);
		echo " getAllDiff end   \r\n";
		$write->setDataFromWorksheet('AllDiff_out',$arr,'A4');
		unset($arr);
		gc_collect_cycles();
		$arr=$data->getDiffToReestr($month,$year,$numBranch);
		$write->setDataFromWorksheet('DiffOut_reestr=erpn',$arr,'A4');
		unset($arr);
		gc_collect_cycles();
		$arr=$data->getDiffToNotReestr($month,$year,$numBranch);
		$write->setDataFromWorksheet('DiffOut_reestr<>erpn',$arr,'A4');
		unset($arr);
		gc_collect_cycles();

		$write->fileWriteAndSave();
		echo "$month $year $numBranch end   \r\n";
		unset($data,$write);
		gc_collect_cycles();
	}

	/**
	 * формирование файлов анализа опаздавших НН по всем филиалам
	 * каждый филиал в свой файл
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 */
	public function writeAnalizPDVOutDiffByAllBranch(int $month,int $year)
	{
		$data=new getDataFromReestrsByOne($this->em);
		$arrAllBranch=$data->getAllBranch();
		foreach ($arrAllBranch as $arrAll)
			{
				foreach ($arrAll as $key => $numBranch)
				{
					$this->writeAnalizPDVOutDiffByOneBranch($month,$year,$numBranch);
				}
			}
		}
}