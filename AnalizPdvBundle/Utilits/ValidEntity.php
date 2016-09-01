<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.07.2016
 * Time: 23:27
 */

namespace LoadFileBundle\Utilits;


use Doctrine\ORM\EntityManager;
use LoadFileBundle\Entity\Repository\Erpn_out;


class ValidEntity
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em=$em;
    }
    /*
     * Проверяем правильность данных в сущности перед ее сохранением
     *  первая и самая важная проверка - проверка на уникальность документа
     * @var  сущность Erpn_out
     */
    public function ValidInvoice(\LoadFileBundle\Entity\Erpn_out $Invoice)
    {
        // Раскладывам сущность на элементы
        $num=$Invoice->getNumInvoice();
        $date=$Invoice->getDateCreateInvoice()->format('d.m.Y');
        $Type=$Invoice->getTypeInvoiceFull();
        $inn=$Invoice->getInnClient();
      // формируем ключевое поле
        $key="$num/$date/$Type/$inn";
        $this->em->getRepository("LoadFileBundle:Erpn_out");

    }
}