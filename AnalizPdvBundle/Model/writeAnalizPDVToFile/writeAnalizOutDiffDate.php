<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.10.2016
 * Time: 21:22
 */

namespace AnalizPdvBundle\Model\writeAnalizPDVToFile;


use AnalizPdvBundle\Model\getDataFromSQL\getDataFromAnalizPDVOutDiff;
use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrsByOne;
use AnalizPdvBundle\Utilits\createWriteFile\getWriteExcel;

class writeAnalizOutDiffDate extends writeAnalizToFileAbstract
{

	/**
	 *формирование файла анализа опаздавших НН по одному конкретному филиалу
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @param string $numBranch номер филиала по которому надо сформировать анализ
	 */
	public function writeAnalizPDVOutDiffByOneBranch(int $month,int $year,string $numBranch)
	{
		//todo сменить жесткую привязку к файлу анализа
		$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_DiffDate.xlsx";
		$data=new getDataFromAnalizPDVOutDiff($this->em);
		$write=new getWriteExcel($file);
		$write->setParamFile($month,$year,$numBranch);
		$write->getNewFileName();

		$arr=$data->getAllDiff($month,$year,$numBranch);
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