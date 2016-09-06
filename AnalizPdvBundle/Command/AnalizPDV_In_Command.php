<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrs;
use AnalizPdvBundle\Utilits\createWriteFile\getWriteExcel;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalizPDV_In_Command extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('analiz_pdv:analyze_reestr_in')
            ->setDescription('analyze reestr in');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dt=$this->getContainer()->get('doctrine');
        $em=$dt->getManager();
        $file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\analiz_In.xlsx";
        $data=new getDataFromReestrs($em);
        $write=new getWriteExcel($file);
        $write->setParamFile(7,2016,'678');
        $f=$write->getNewFileName();
        $arr=$data->getReestrInEqualErpn(7,2016,678);
        $write->setDataFromWorksheet('reestr=edrpu',$arr,'A4');
        unset($arr);
        $arr=$data->getReestrInNotEqualErpn(7,2016,678);
        $write->setDataFromWorksheet('reestr<>edrpou',$arr,'A4');
        unset($arr);
        $write->fileWriteAndSave();

    }
}
