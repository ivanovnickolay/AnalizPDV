<?php
namespace AnalizPdvBundle\Utilits\createReaderFile;
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30.08.2016
 * Time: 0:20
  */

use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;
use AnalizPdvBundle\Utilits\createReaderFile\chunkReadFilter;

class getReaderExcel
{
	private $phpExcel;
	private $objReader;
	private $fileName;
	private $ChunkFilter;
	private $filterStartRow=2;
	private $filterColumn;
	private $filterChunkSize=2000;
	private $filterWorksheetName;
	private $columnFirst = "A";
	private $columnLast="Z";

	/**
	 * loadDataFromExcel constructor.
	 * @param EntityManager $entityManager
	 * @param string $fileName Имя файла должно содержать полный путь к нему !!!
	 */
	public function __construct(string $fileName)
	{
		$this->filterStartRow=2;
		$this->filterColumn=range($this->columnFirst,$this->columnLast);
		$this->filterChunkSize=2000;
		$this->filterWorksheetName='';
		$this->ChunkFilter= new chunkReadFilter();
		$this->fileName=$fileName;

	}

	/**
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
	/**
	 * @link http://stackoverflow.com/questions/14278603/php-range-from-a-to-zz
	 * @link http://php.net/manual/ru/function.range.php#107440
	 * @param $end_column
	 * @param string $first_letters
	 * @return array
	 */
	public function createColumnsArray($end_column, $first_letters = '')
	{
		$columns = array();
		$length = strlen($end_column);
		$letters = range('A', 'Z');

		// Iterate over 26 letters.
		foreach ($letters as $letter) {
			// Paste the $first_letters before the next.
			$column = $first_letters . $letter;

			// Add the column to the final array.
			$columns[] = $column;

			// If it was the end column that was added, return the columns.
			if ($column == $end_column)
				return $columns;
		}

		// Add the column children.
		foreach ($columns as $column) {
			// Don't itterate if the $end_column was already set in a previous itteration.
			// Stop iterating if you've reached the maximum character length.
			if (!in_array($end_column, $columns) && strlen($column) < $length) {
				$new_columns =$this->createColumnsArray($end_column, $column);
				// Merge the new columns which were created with the final columns array.
				$columns = array_merge($columns, $new_columns);
			}
		}

		return $columns;
	}
	/**
	 * Определение типа файла исходя из названия (расширения) файла
	 * @param $pFilename
	 * @return null|string
	 */
	public function getFileType()
	{
		$pathinfo = pathinfo($this->fileName);
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

	public function setChunkFilter(\PHPExcel_Reader_IReadFilter $fil=null)
	{
		// ели нам переданный класс фильтра
		if(!null==$fil)
		{
			// анулируем установленный по умолчанию
			unset($this->ChunkFilter);
			// и инициализируем переданный
			$this->ChunkFilter= $fil;
		}

	}

	/**
	 * Установка параметров для фильтра по файлу
	 * @param int $startRow - стартовая строка
	 * @param string $columnFirst начало диапазона строк  текстовое
	 * @param string $columnLast конец диапазона столбцов текстовое
	 * @param int $chunkSize количество строк читаемое заодин раз
	 * @param string $worksheetName наименовение рабочего листа книги
	 */
	public function setParamFilter(int $startRow=2,string $columnFirst="A",string  $columnLast="Z",int $chunkSize=2000,
	                               string $worksheetName='')
	{
		$this->filterStartRow=$startRow;
			$this->columnFirst=$columnFirst;
				$this->columnLast=$columnLast;
					$this->filterColumn=$this->createColumnsArray($this->columnLast);
						$this->filterChunkSize=$chunkSize;
							$this->filterWorksheetName=$worksheetName;
	}

	/**
	 * Создание экземпляра класса Ридера файла и настроек чтения
	 * включая фильтр
	 * @param $FileName
	 * @return array
	 * @throws \PHPExcel_Reader_Exception
	 */
	private function createReader ()
	{
		if ($this->validFileName())
		{
				try {
					// получаем класс вида class PHPExcel_Reader_Excel2007 extends PHPExcel_Reader_Abstract implements PHPExcel_Reader_IReader
					$this->phpExcel = \PHPExcel_IOFactory::createReader ($this->getFileType ());
						/* Tell the Reader that we want to use the Read Filter **/
						$this->phpExcel->setReadFilter ($this->ChunkFilter);
							// Указываем что нам нужны только данные из файла - без форматирования
							$this->phpExcel->setReadDataOnly (true);
								// указываем диапазон для считывания
								$this->ChunkFilter->setRows($this->filterStartRow,$this->filterColumn,$this->filterChunkSize);
					// получаем объект книги
					$this->objReader=$this->phpExcel->load($this->fileName);

				} catch (Exception $e) {
					echo 'Ошибка подключения к файлу' . $this->fileName . ': ' , $e->getMessage () , "\n";
				}
		}
	}

	/**
	 * получить класс ридера
	 * @return mixed
	 */
	public function getReader()
	{
		$this->createReader();
		return $this->objReader;
	}

	public function getRowDataArray($numRow)
	{
		$range="$this->columnFirst$numRow:$this->columnLast$numRow";
		if(empty($this->filterWorksheetName)){
			$d=$this->objReader->getActiveSheet () ->rangeToArray($range,null,true,true,false);
			return $d;
		} else{
			$f=$this->objReader->getSheetByName($this->filterWorksheetName)->rangeToArray($range,null,true,true,false);
			return $f;
		}

	}

	public function getMaxRow()
	{
		if(empty($this->filterWorksheetName)){
			return $this->objReader->getActiveSheet () -> getHighestRow();
		} else{
			return $this->objReader->getSheetByName($this->filterWorksheetName)->getHighestRow();
		}
	}


}