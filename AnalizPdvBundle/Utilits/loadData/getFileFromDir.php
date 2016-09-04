<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.09.2016
 * Time: 16:19
 */

namespace AnalizPdvBundle\Utilits\loadData;
use Doctrine\ORM\EntityManager;


/**
 * Назначение класса - вернуть при помощи getFiles()
 * массив [название файла с путем к нему]=>[обрабочик файла]
 * Class LoadDataFromDir
 * @package AnalizPdvBundle\Utilits\loadData
 */
class getFileFromDir
{
	/**
	 * указание пути к директории файлы из которой надо загрузить
	 * @var string
	 */
	private $nameDir;
	/**
	 * массив [название файла с путем к нему]=>[обрабочик файла]
	 * @var array
	 */
	private $fileToDir;

	/**
	 * LoadDataFromDir constructor.
	 * @param string $nameDir
	 * @param EntityManager $em
	 */
	public function __construct (string $nameDir)
	{
	$this->nameDir=$nameDir;
		$this->fileToDir=array();
		return $this;
	}

	/**
	 * проверка имени файла на соответствие правилам
	 * - файл Excel
	 * - наименование файла содержит или tab1 & tab2
	 * @link  http://ru.stackoverflow.com/questions/14116/%D0%9E%D0%BF%D1%80%D0%B5%D0%B4%D0%B5%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5-%D0%BD%D0%B0%D0%BB%D0%B8%D1%87%D0%B8%D1%8F-%D1%81%D0%B8%D0%BC%D0%B2%D0%BE%D0%BB%D0%BE%D0%B2-%D0%B2-%D1%81%D1%82%D1%80%D0%BE%D0%BA%D0%B5
	 * @param $fileName
	 * @return bool
	 */
	public function isValidFile($fileName)
	{
		$validFileType=array("xls","xlsx");
		$pathinfo = pathinfo($fileName);
		$baseNameFile=$pathinfo['filename'];
		// если расширение файла не поддерживатеся возвращаем ложь
		if (!in_array($pathinfo['extension'],$validFileType)) {
			return false;
			}
		if ( 1 == substr_count($baseNameFile,'TAB1')){
			return true;
		}
		if ( 1 == substr_count($baseNameFile,'TAB2')){
			return true;
		}
		return false;
	}


	/**
	 * по названию файла определяем тип обработчика файла
	 * @return
	 */
	public function getTypeHandlerFile($fileName)
	{
		$pathinfo = pathinfo($fileName);
		$baseNameFile=$pathinfo['filename'];
		if ( 1 == substr_count($baseNameFile,'TAB1')){
			return "RestrIn";
		}
		if ( 1 == substr_count($baseNameFile,'TAB2')){
			return "RestrOut";
		}
		return "";
	}

	/**
	 * возвращаем массив файлов как массив [название файла с путем к нему]=>[обрабочик файла]
	 * из директории которые прошли проверку
	 * @return array
	 */
	public function getFiles()
	{
		$dir = new \DirectoryIterator($this->nameDir);
		foreach ($dir as $fileinfo) {
			if (!$fileinfo->isDot()) {
				if($this->isValidFile($fileinfo->getFilename())){
					$type=$this->getTypeHandlerFile($fileinfo->getFilename());
					$this->fileToDir[$fileinfo->getPathname()]=$type;
				}
			}
		}
		return $this->fileToDir;
	}
}