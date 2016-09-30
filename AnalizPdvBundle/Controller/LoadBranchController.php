<?php

namespace AnalizPdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LoadFileBundle\Entity\SprBranch;

class LoadBranchController extends Controller
{
    public function LoadAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Path=$this->getParameter('file_dir_branch');
        $File_path="$Path\SprBranch.xlsx";
        $phpExcelObject=$this->get('phpexcel')->createPHPExcelObject($File_path);
        //$sheet=$phpExcelObject->setActiveSheetIndex(0);
        //$sheet = $ActiveSheet->getActiveSheet();

        //https://habrahabr.ru/post/245233/
        // http://www.cleverscript.ru/index.php/php/scripts-php/28-phpexel#.V3g26PmLTyF

        $rowIterator = $phpExcelObject->getActiveSheet()->getHighestRow();
        //getRowIterator(2);
        //foreach ($rowIterator as $row) {
        for ($row=2;$row <= $rowIterator;$row++){
            $data= new SprBranch();
            $ff=$phpExcelObject->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue();
            $data->setNumBranch($phpExcelObject->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue());
            $data->setNameBranch($phpExcelObject->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue());
            $data->setBranchAdr($phpExcelObject->getActiveSheet()->getCellByColumnAndRow(2, $row)->getValue());
            $data->setNameMainBranch($phpExcelObject->getActiveSheet()->getCellByColumnAndRow(3, $row)->getValue());
            $data->setNumMainBranch($phpExcelObject->getActiveSheet()->getCellByColumnAndRow(4, $row)->getValue());
            $em->persist($data);
            unset($data);
        }
            $em->flush();
    }

    }
