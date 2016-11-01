<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.10.2016
 * Time: 21:26
 */

namespace AnalizPdvBundle\Model\writeAnalizPDVToFile;


use AnalizPdvBundle\Model\getDataFromSQL\getDataFromAnalizPDVOutINN;
use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrsByOne;
use AnalizPdvBundle\Model\getDataFromSQL\getDataOutINNByAll;
use AnalizPdvBundle\Model\getDataFromSQL\getDataOutInnByAllUZ;
use AnalizPdvBundle\Model\getDataFromSQL\getDataOutINNByOne;
use AnalizPdvBundle\Utilits\createWriteFile\getWriteExcel;

/**
 * Класс формирует файлы анализа расхождения по ИНН по обязательствам ПАТ за период
 * @see writeAnalizOutByInn::writeAnalizPDVOutInnByOneBranch по одному конкретному филиалу без документов
 * @see writeAnalizOutByInn::writeAnalizPDVOutInnByAllBranch по всем филиалам без документов
 * @see writeAnalizOutByInn::writeAnalizPDVOutInnByAllUZ по всей УЗ без документов
 * @see writeAnalizOutByInn::writeAnalizPDVOutInnByAllUZ_new по всей УЗ с документами которые вызвали расхождение
 * @package AnalizPdvBundle\Model\writeAnalizPDVToFile
 */
class writeAnalizOutByInn extends writeAnalizToFileAbstract
{
	const fileNameAllUZ="AnalizPDV_Out_INN.xlsx";
	const fileNameOneBranch="AnalizPDV_Out_INN_By_Branch.xlsx";
	/**
	 *формирование файла анализа расхождений обязательств по ИНН по одному конкретному филиалу без документов
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @param string $numBranch номер филиала по которому надо сформировать анализ
	 * @uses getDataOutINNByOne::getReestrEqualErpn формирование данных
	 * @uses getDataOutINNByOne::getErpnNoEqualReestr формирование данных
	 * @uses getDataOutINNByOne::getReestrNoEqualErpn формирование данных
	 * @uses getWriteExcel::setParamFile
	 * @uses getWriteExcel::getNewFileName
	 * @uses getWriteExcel::setDataFromWorksheet
	 * @uses getWriteExcel::fileWriteAndSave
	 * @see OutGroupInnByOneBranchCommand::execute - отсюда вызывается функция
	 */
	public function writeAnalizPDVOutInnByOneBranch(int $month,int $year,string $numBranch)
	{
		//todo сменить жесткую привязку к файлу анализа
		$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_Out_INN.xlsx";
		$data=new getDataOutINNByOne($this->em);
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
	 *формирование файла анализа расхождений обязательств по ИНН по одному конкретному филиалу c документами
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @param string $numBranch номер филиала по которому надо сформировать анализ
	 * @uses getDataOutINNByOne::getReestrEqualErpn формирование данных
	 * @uses getDataOutINNByOne::getErpnNoEqualReestr формирование данных
	 * @uses getDataOutINNByOne::getReestrNoEqualErpn формирование данных
	 * @uses getWriteExcel::setParamFile
	 * @uses getWriteExcel::getNewFileName
	 * @uses getWriteExcel::setDataFromWorksheet
	 * @uses getWriteExcel::fileWriteAndSave
	 * @see OutGroupInnByOneBranchCommand::execute - отсюда вызывается функция
	 */
	public function writeAnalizPDVOutInnByOneBranchWithDoc(int $month,int $year,string $numBranch)
	{

		//$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_Out_INN.xlsx";
		$file=$this->pathToTemplate.self::fileNameOneBranch;
		//echo $file;
		if (file_exists($file)) {
			$data = new getDataOutINNByOne($this->em);
			$write = new getWriteExcel($file);
			$write->setParamFile ($month , $year , $numBranch);
			$write->getNewFileName ();

			$arr=$data->getReestrEqualErpn($month,$year, $numBranch);
			$write->setDataFromWorksheet('Out_R=E',$arr,'A4');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getReestrEqualErpn_DocErpn($month,$year, $numBranch);
			$write->setDataFromWorksheet('Out_R=E DocByE',$arr,'A3');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getReestrEqualErpn_DocReestr($month,$year, $numBranch);
			$write->setDataFromWorksheet('Out_R=E DocByR',$arr,'A3');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getReestrNoEqualErpn($month,$year, $numBranch);
			$write->setDataFromWorksheet('Out_R<>E',$arr,'A4');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getReestrNoEqualErpn_DocReestr($month,$year, $numBranch);
			$write->setDataFromWorksheet('Out_R<>E DocByR',$arr,'A3');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getErpnNoEqualReestr($month,$year, $numBranch);
			$write->setDataFromWorksheet('Out_E<>R',$arr,'A4');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getErpnNoEqualReestr_DocErpn($month,$year, $numBranch);
			$write->setDataFromWorksheet('Out_E<>R DocByE',$arr,'A3');
			unset($arr);
			gc_collect_cycles();

			$write->fileWriteAndSave();
			unset($data,$write);
			gc_collect_cycles();
		}	else {
			echo "File " . $file . " not found";
		}
	}

	/**
	 * формирование файлов анализа расхождений обязательств по ИНН (без документов)
	 * по всем филиалам каждый филиал в свой файл
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @uses getDataFromReestrsByOne::getAllBranchToPeriodOut
	 * @uses writeAnalizPDVOutInnByOneBranchWithDoc
	 * @see OutGroupInnByOneBranchStreamCommand::execute - отсюда вызывается функция
	 */
	public function writeAnalizPDVOutInnByAllBranch(int $month,int $year)
	{
		$data=new getDataFromReestrsByOne($this->em);
		$arrAllBranch=$data->getAllBranchToPeriodOut($month,$year);
		if(!empty($arrAllBranch)) {
			foreach ($arrAllBranch as $arrAll)
			{
				foreach ($arrAll as $key => $numBranch)
				{
					$this->writeAnalizPDVOutInnByOneBranchWithDoc($month,$year,(string) $numBranch);
				}
			}
		}
	}
	/**
	 * формирование файлов анализа расхождений обязательств по ИНН (c документами)
	 * по всем филиалам каждый филиал в свой файл
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @uses getDataFromReestrsByOne::getAllBranchToPeriodOut
	 * @uses writeAnalizPDVOutInnByOneBranch
	 * @see OutGroupInnByOneBranchStreamCommand::execute - отсюда вызывается функция
	 */
	public function writeAnalizPDVOutInnByAllBranchWithDoc(int $month,int $year)
	{
		$data=new getDataFromReestrsByOne($this->em);
		$arrAllBranch=$data->getAllBranchToPeriodOut($month,$year);
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
	 * формирование файла анализа расхождений обязательств по ИНН по ПАТ целиком без документов
	 * @param int $month
	 * @param int $year
	 *  @uses getDataOutINNByAll::getReestrEqualErpnAllUZ формирование данных
	 *  @uses getDataOutINNByAll::getErpnNoEqualReestrAllUZ формирование данных
	 *  @uses getDataOutINNByAll::getReestrNoEqualErpnAllUZ формирование данных
	 * @uses getWriteExcel::setParamFile
	 * @uses getWriteExcel::getNewFileName
	 * @uses getWriteExcel::setDataFromWorksheet
	 * @uses getWriteExcel::fileWriteAndSave
	 * @see OutGroupInnByAll_Command::execute  - отсюда вызывается функция
	 */
	public function writeAnalizPDVOutInnByAllUZ(int $month, int $year)
	{
		//todo сменить жесткую привязку к файлу анализа
		$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_Out_INN.xlsx";
		$data=new getDataOutINNByAll($this->em);
		$write=new getWriteExcel($file);
		$write->setParamFile($month,$year,"All");
		$write->getNewFileName();

		$arr=$data->getReestrEqualErpnAllUZ($month,$year);
		$write->setDataFromWorksheet('Out_reestr=erpn',$arr,'A4');
		unset($arr);
		gc_collect_cycles();

		$arr=$data->getErpnNoEqualReestrAllUZ($month,$year);
		$write->setDataFromWorksheet('Out_erpn<>reestr',$arr,'A4');
		unset($arr);
		gc_collect_cycles();

		$arr=$data->getReestrNoEqualErpnAllUZ($month,$year);
		$write->setDataFromWorksheet('Out_reestr<>erpn',$arr,'A4');
		unset($arr);
		gc_collect_cycles();

		$write->fileWriteAndSave();
		unset($data,$write);
		gc_collect_cycles();
	}

	/**
	 * формирование файла анализа расхождений обязательств по ИНН по ПАТ целиком
	 * с документами которые вызвали расхождение
	 * @param int $month
	 * @param int $year
	 * @uses getDataOutInnByAllUZ::getReestrEqualErpnAllUZ формирование данных
	 * @uses getDataOutInnByAllUZ::getReestrEqualErpnAllUZ_DocErpn формирование данных
	 * @uses getDataOutInnByAllUZ::getReestrEqualErpnAllUZ_DocReestr формирование данных
	 * @uses getDataOutInnByAllUZ::getReestrNoEqualErpnAllUZ формирование данных
	 * @uses getDataOutInnByAllUZ::getReestrNoEqualErpnAllUZ_DocReestr формирование данных
	 * @uses getDataOutInnByAllUZ::getErpnNoEqualReestrAllUZ формирование данных
	 * @uses getDataOutInnByAllUZ::getErpnNoEqualReestrAllUZ_DocErpn формирование данных
	 * @uses getWriteExcel::setParamFile
	 * @uses getWriteExcel::getNewFileName
	 * @uses getWriteExcel::setDataFromWorksheet
	 * @uses getWriteExcel::fileWriteAndSave
	 * @see OutGroupInnByAllUZ_Command::execute  - отсюда вызывается функция
	 */
	public function writeAnalizPDVOutInnByAllUZ_new(int $month, int $year)
	{
		//$file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_Out_INN.xlsx";
		$file=$this->pathToTemplate.self::fileNameAllUZ;
		//echo $file;
		if (file_exists($file))
		{
			$data=new getDataOutInnByAllUZ($this->em);
			$write=new getWriteExcel($file);
			$write->setParamFile($month,$year,"All");
			$write->getNewFileName();

			$arr=$data->getReestrEqualErpnAllUZ($month,$year);
			$write->setDataFromWorksheet('Out_R=E',$arr,'A4');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getReestrEqualErpnAllUZ_DocErpn($month,$year);
			$write->setDataFromWorksheet('Out_R=E DocByE',$arr,'A3');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getReestrEqualErpnAllUZ_DocReestr($month,$year);
			$write->setDataFromWorksheet('Out_R=E DocByR',$arr,'A3');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getReestrNoEqualErpnAllUZ($month,$year);
			$write->setDataFromWorksheet('Out_R<>E',$arr,'A4');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getReestrNoEqualErpnAllUZ_DocReestr($month,$year);
			$write->setDataFromWorksheet('Out_R<>E DocByR',$arr,'A3');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getErpnNoEqualReestrAllUZ($month,$year);
			$write->setDataFromWorksheet('Out_E<>R',$arr,'A4');
			unset($arr);
			gc_collect_cycles();

			$arr=$data->getErpnNoEqualReestrAllUZ_DocErpn($month,$year);
			$write->setDataFromWorksheet('Out_E<>R DocByE',$arr,'A3');
			unset($arr);
			gc_collect_cycles();

			$write->fileWriteAndSave();
			unset($data,$write);
			gc_collect_cycles();
		}	else
		{
			echo "File ".$file." not found";
		}
	}
}