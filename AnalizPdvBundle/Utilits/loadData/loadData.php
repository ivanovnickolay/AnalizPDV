<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.09.2016
 * Time: 18:40
 */

namespace AnalizPdvBundle\Utilits\loadData;


use AnalizPdvBundle\Utilits\createReaderFile\getReaderExcel;
use Doctrine\ORM\EntityManager;

/**
 * Класс служит для загрузки данных из файлов
 * Class loadData
 * @package AnalizPdvBundle\Utilits\loadData
 */
class loadData
{
	private $em;
	private $readerFile;
	private $entity;
	private $validator;


	/**
	 * loadData constructor.
	 * @param EntityManager $em
	 * @param getReaderExcel $reader
	 * @param $entity сущность которая будет заполнятся в процессе загрузки данных
	 */
	public function __construct (EntityManager $em)
	{
		$this->em=$em;

		return $this;
	}

	public function setValidator($validData)
	{
		if (is_object($validData)){
			$this->validator=$validData;
		} else {
			$this->validator=null;
		}
		return $this;
	}

	public function setEntity($entity)
	{
		if (is_object($entity)){
			$this->entity=$entity;
		} else{
			$this->entity=null;
		}
		return $this;
	}
	public function setReader(getReaderExcel $reader)
	{
		if ((is_object($reader))) {
			$this->readerFile=$reader;
		} else{
			$this->readerFile=null;
		}
		return $this;
	}

	private function validParametrClass()
	{
		if (((is_null($this->validator))||(is_null($this->entity))||(is_null($this->readerFile)))) {
			return false;
		}else{
			return true;
		}
	}

	public function loadData()
	{
		if (($this->validParametrClass())) {

		}
	}
}