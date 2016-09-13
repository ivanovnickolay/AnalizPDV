<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrsByOne;
use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrsAll;
use AnalizPdvBundle\Utilits\createWriteFile\getWriteExcel;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalizPDVByOneBranchStream_Command extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('analiz_pdv:AnalizPDVByOneBranch')
            ->setDescription('analyze reestr by one branch');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $numBranch="578";
        $dt=$this->getContainer()->get('doctrine');
        $em=$dt->getManager();
        $file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV.xlsx";
        $data=new getDataFromReestrsByOne($em);
        $write=new getWriteExcel($file);
        $write->setParamFile(6,2016,$numBranch);
        $f=$write->getNewFileName();
        $arr=$data->getReestrInEqualErpn(6,2016,$numBranch);
        $write->setDataFromWorksheet('In_reestr=edrpu',$arr,'A4');
        unset($arr);
        gc_collect_cycles();
        $arr=$data->getReestrInNotEqualErpn(6,2016,$numBranch);
        $write->setDataFromWorksheet('In_reestr<>edrpou',$arr,'A4');
        unset($arr);
        gc_collect_cycles();
        $arr=$data->getReestrOutEqualErpn(6,2016,$numBranch);
        $write->setDataFromWorksheet('Out_reestr=edrpu',$arr,'A4');
        unset($arr);
        gc_collect_cycles();
        $arr=$data->getReestrOutNotEqualErpn(6,2016,$numBranch);
        $write->setDataFromWorksheet('Out_reestr<>edrpou',$arr,'A4');
        unset($arr);
        gc_collect_cycles();
        $write->fileWriteAndSave();

    }
}
