<?php
namespace AnalizPdvBundle\Utilits\createWriteFile;
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30.08.2016
 * Time: 0:20
  */

use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;
use AnalizPdvBundle\Utilits\createReaderFile\chunkReadFilter;

class getWriteExcel
{
	/**
	 * @var \PHPExcel_Writer_Abstract
	 */
	private $Writer;

	/**
	 * созданый класс PHPExcel для заполнения данными
	 * @link  https://github.com/PHPOffice/PHPExcel/blob/develop/Examples/30template.php
	 * @var \PHPExcel
	 */
	private $Excel;
	/**
	 * @var string наименование файла с путем к нему
	 */
	private $fileNameTemplate;

	private $month;
	private $year;
	private $numBranch;


	/**
	 * loadDataFromExcel constructor.
	 * @link  https://github.com/PHPOffice/PHPExcel/blob/develop/Examples/30template.php
	 * @param string $fileNameTemplate Имя шаблона файла должно содержать полный путь к нему !!!
	 */
	public function __construct(string $fileNameTemplate)
	{
		// Заполняем первоначальными значениями
		$this->fileNameTemplate=$fileNameTemplate;
		$objReader = \PHPExcel_IOFactory::createReader($this->getFileType ());
		$this->Excel = $objReader->load($this->fileNameTemplate);


	}

	/**
	* Проверяем наименование файла
	 * @return bool
	 */
	public function validFileName()
	{
		if(empty($this->fileName))
		{
			return false;
		}

		if (file_exists($this->fileName))
		{
			return true;
		}else{
			return false;
		}
	}

	public function setParamFile($month,$year,$numBranch)
	{
		$this->month=$month;
		$this->year=$year;
		$this->numBranch=$numBranch;
	}

	public function setDataFromWorksheet($nameWorksheet, array $data,string $startCell)
	{
		$this->Excel->getSheetByName("$nameWorksheet")->fromArray($data,null,$startCell);
	}

	public function fileWriteAndSave()
	{
		//$this->Writer=new \PHPExcel_Writer_Excel2007($this->Excel);
		$this->Writer=\PHPExcel_IOFactory::createWriter($this->Excel, $this->getFileType());
		list( $dirname, $basename, $extension, $filename ) = array_values( pathinfo($this->fileNameTemplate));
		$newFileName=$filename.' month '.$this->month.' year '.$this->year.' numBranch '.$this->numBranch;
		$path=$dirname.'/'.$newFileName.'.'.$extension;
		$this->Writer->save($path);
		$this->Excel->disconnectWorksheets();
		unset($this->Excel);
	}

	public function getNewFileName()
	{
		list( $dirname, $basename, $extension, $filename ) = array_values( pathinfo($this->fileNameTemplate));
		$newFileName=$filename.' month '.$this->month.' year '.$this->year.' numBranch '.$this->numBranch;
		$newFileName=$dirname.'/'.$newFileName.'.'.$extension;
		return $newFileName;
	}
	/**
	 * Определение типа файла исходя из названия (расширения) файла
	 * @param $pFilename
	 * @return null|string
	 */
	public function getFileType()
	{
		$pathinfo = pathinfo($this->fileNameTemplate);
		$extensionType = NULL;
		if (isset($pathinfo['extension'])) {
			switch (strtolower($pathinfo['extension'])) {
				case 'xlsx':            //	Excel (OfficeOpenXML) Spreadsheet
				case 'xlsm':            //	Excel (OfficeOpenXML) Macro Spreadsheet (macros will be discarded)
				case 'xltx':            //	Excel (OfficeOpenXML) Template
				case 'xltm':            //	Excel (OfficeOpenXML) Macro Template (macros will be discarded)
					$extensionType = 'Excel2007';
					break;
				case 'xls':                //	Excel (BIFF) Spreadsheet
				case 'xlt':                //	Excel (BIFF) Template
					$extensionType = 'Excel5';
					break;
				case 'ods':                //	Open/Libre Offic Calc
				case 'ots':                //	Open/Libre Offic Calc Template
					$extensionType = 'OOCalc';
					break;
				case 'slk':
					$extensionType = 'SYLK';
					break;
				case 'xml':                //	Excel 2003 SpreadSheetML
					$extensionType = 'Excel2003XML';
					break;
				case 'gnumeric':
					$extensionType = 'Gnumeric';
					break;
				case 'htm':
				case 'html':
					$extensionType = 'HTML';
					break;
				case 'csv':
					// Do nothing
					// We must not try to use CSV reader since it loads
					// all files including Excel files etc.
					break;
				default:
					break;
			}
			return $extensionType;
		}

	}
}