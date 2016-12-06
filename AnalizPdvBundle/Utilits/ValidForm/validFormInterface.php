<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.12.2016
 * Time: 19:59
 */

namespace AnalizPdvBundle\Utilits\ValidForm;


/**
 * Interface validForm
 * @package AnalizPdvBundle\Utilits\ValidForm
 * Интерфейс валидации форм которые получают данные через AJAX
 */
class validForm
{
	private $repository;
	private $errorMessage;
	// вызывается для валидации данных формы

	/**
	 * @param $data array
	 * @return mixed
	 */
	public function isValdForm(array $data)
	{
		foreach ($data as $field=>$value)
		{
			if($this->repository.isField($field))
			{
				$valid=$this->repository->getValidUnit($field);
				if (!$valid->isValid($value))
				{
					$this->errorMessage[$field]=$valid->getError();
				}
			} else
			{
				$this->errorMessage[$field]="Validator not found";
			}
		}
		if (count($this->errorMessage)>0)
		{
			return true;
		}else
		{
			return false;
		}

    }

	/**
	 * @param validUnitRepository $repository
	 * @return mixed
	 */
	public function setValidUnitRepository(validUnitRepository $repository)
	{
		$this->repository=$repository;
	}

	/**
	 * @return mixed
	 */
	public function getErrorMessage()
    {
    	return $this->errorMessage;
    }



}