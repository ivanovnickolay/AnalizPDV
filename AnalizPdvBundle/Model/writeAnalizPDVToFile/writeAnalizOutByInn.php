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
 * - по одному конкретному филиалу
 * - по всем филиалам
 * - по всей УЗ
 * Class writeAnalizOutByInn
 * @package AnalizPdvBundle\Model\writeAnalizPDVToFile
 */
class writeAnalizOutByInn extends writeAnalizToFileAbstract
{
	const fileNameAllUZ="AnalizPDV_Out_INN.xlsx";
	/**
	 *формирование файла анализа расхождений по ИНН по одному конкретному филиалу
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
	 * @param string $numBranch номер филиала по которому надо сформировать анализ
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
	 * формирование файлов анализа расхождений по ИНН по всем филиалам
	 * каждый филиал в свой файл
	 * @param int $month номер месяца по которому надо сформировать анализ
	 * @param int $year номер года по которому надо сформировать анализ
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
					$this->writeAnalizPDVOutInnByOneBranch($month,$year,(string) $numBranch);
				}
			}
		}
	}
	public function writeAnalizPDVOutInnByAllUZ(int $month,int $year)
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

	public function writeAnalizPDVOutInnByAllUZ_new(int $month,int $year)
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