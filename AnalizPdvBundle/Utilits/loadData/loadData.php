<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.09.2016
 * Time: 18:40
 */

namespace AnalizPdvBundle\Utilits\loadData;


use AnalizPdvBundle\Utilits\createEntitys;
use AnalizPdvBundle\Utilits\createReaderFile\getReaderExcel;
use AnalizPdvBundle\Utilits\ValidEntity\interfaceValidEntity;
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
	public function __construct (EntityManager $em,$fileName,string $columnLast, int $chunkSize=200)
	{
		$this->em=$em;
		$this->readerFile=new getReaderExcel($fileName);
		$this->readerFile->createFilter($columnLast,$chunkSize);
		$this->readerFile->getReader();
		return $this;
	}

	public function setValidator(interfaceValidEntity $validData)
	{
		$this->validator=$validData;

		return $this;
	}

	public function setEntity($entity)
	{
		$this->entity=$entity;

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

			$maxR=$this->readerFile->getMaxRow();
			for($startRow=2;$startRow<=$maxR;$startRow+=$this->readerFile->getFilterChunkSize())
			{
				$this->readerFile->loadFileWithFilter($startRow);
					$maxRow=$this->readerFile->getFilterChunkSize()+$startRow;
						if($maxRow>$maxR)
							{
								// специально что бы была прочитана последняя строка с данными
								$maxRow=$maxR+1;
							}
						for($d=$startRow;$d<$maxRow;$d++)
						{
							$arr=$this->readerFile->getRowDataArray($d);
								$e=$this->entity->createReestr($arr);
									if($this->validator->validEntity($e))
									{
										$this->em->persist($e);
										$this->entity->unsetReestr();
									} else {
										$this->em->persist ($e);
										$errorEntity=$this->validator->getErrorEntity();
										$this->em->persist ($errorEntity);
										$this->entity->unsetReestr ();
									}
						}
				$this->em->flush ();
				$this->em->clear ();
				$this->readerFile->unset_loadFileWithFilter();
			}
		}
	}
}