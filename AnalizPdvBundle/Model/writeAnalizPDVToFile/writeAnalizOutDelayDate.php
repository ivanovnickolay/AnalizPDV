<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.10.2016
 * Time: 21:22
 */

namespace AnalizPdvBundle\Model\writeAnalizPDVToFile;


use AnalizPdvBundle\Model\getDataFromSQL\getDataFromAnalizPDVOutDelay;
use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrsByOne;
use AnalizPdvBundle\Model\getDataFromSQL\getDataOutDelay;
use AnalizPdvBundle\Utilits\createWriteFile\getWriteExcel;

/**
 * Формирование файла анализа опаздавших выданных НН
 * @uses writeAnalizOutDelayDate::writeAnalizPDVOutDelayByOneBranch по одному филиалу в периоде
 * @uses writeAnalizOutDelayDate::writeAnalizPDVOutDelayByAllBranch по всем филиалам в периоде
 * @package AnalizPdvBundle\Model\writeAnalizPDVToFile
 */
class writeAnalizOutDelayDate extends writeAnalizToFileAbstract
{

	/**
	 * формирование файла анализа опаздавших выданных НН по одному конкретному филиалу
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @param string $numBranch номер филиала по которому надо сформировать анализ
	 * @uses getDataFromAnalizPDVOutDelay::getAllDelay - формирование данных
	 * @uses getDataFromAnalizPDVOutDelay::getDelayToReestr- формирование данных
	 * @uses getDataFromAnalizPDVOutDelay::getDelayToNotReestr- формирование данных
	 * @uses getWriteExcel::setParamFile
	 * @uses getWriteExcel::getNewFileName
	 * @uses getWriteExcel::setDataFromWorksheet
	 * @uses getWriteExcel::fileWriteAndSave
	 * @see OutDelayByOneBranch_Command::execute - отсюда вызывается функция
	 */
	public function writeAnalizPDVOutDelayByOneBranch(int $month,int $year,string $numBranch)
	{
		//todo сменить жесткую привязку к файлу анализа
		$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_DiffDate.xlsx";
		//$data=new getDataFromAnalizPDVOutDelay($this->em);
		$data=new getDataOutDelay($this->em);
		$write=new getWriteExcel($file);
		$write->setParamFile($month,$year,$numBranch);
		$write->getNewFileName();

		$arr=$data->getAllDelay($month,$year,$numBranch);
		$write->setDataFromWorksheet('AllDiff_out',$arr,'A4');
		unset($arr);
		gc_collect_cycles();

		$arr=$data->getDelayToReestr($month,$year,$numBranch);
		$write->setDataFromWorksheet('DiffOut_reestr=erpn',$arr,'A4');
		unset($arr);
		gc_collect_cycles();

		$arr=$data->getDelayToNotReestr($month,$year,$numBranch);
		$write->setDataFromWorksheet('DiffOut_reestr<>erpn',$arr,'A4');
		unset($arr);
		gc_collect_cycles();

		$write->fileWriteAndSave();
		unset($data,$write);
		gc_collect_cycles();
	}

	/**
	 * формирование файлов анализа опаздавших выданных НН по всем филиалам
	 * каждый филиал в свой файл
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @uses writeAnalizOutDelayDate::writeAnalizPDVOutDelayByOneBranch - формирование анализа
	 * @uses getDataFromReestrsByOne::getAllBranch получение списка филиалов
	 * @see OutDelayByOneBranchStream_Command::execute - отсюда вызывается функция
	 */
	public function writeAnalizPDVOutDelayByAllBranch(int $month,int $year)
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