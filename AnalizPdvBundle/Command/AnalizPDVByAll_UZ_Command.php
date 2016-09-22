<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Model\getDataFromSQL\getDataFromReestrsAll;
use AnalizPdvBundle\Utilits\createWriteFile\getWriteExcel;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalizPDVByAll_UZ_Command extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('analiz_pdv:AnalizPDVByAll')
            ->setDescription('analyze reestr by all UZ');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dt=$this->getContainer()->get('doctrine');
        $em=$dt->getManager();
        $file="d:\\OpenServer525\\domains\\AnalizPDV\\web\\template\\AnalizPDV_All.xlsx";
        $data=new getDataFromReestrsAll($em);
        $write=new getWriteExcel($file);
        $write->setParamFile(7,2016,'ALL');
        $f=$write->getNewFileName();
        $arr=$data->getReestrInEqualErpn(7,2016);
        $write->setDataFromWorksheet('In_reestr=edrpu',$arr,'A4');
        unset($arr);
        gc_collect_cycles();
        $arr=$data->getReestrInNotEqualErpn(7,2016);
        $write->setDataFromWorksheet('In_reestr<>edrpou',$arr,'A4');
        unset($arr);
        gc_collect_cycles();
        $arr=$data->getReestrOutEqualErpn(7,2016);
        $write->setDataFromWorksheet('Out_reestr=edrpu',$arr,'A4');
        unset($arr);
        gc_collect_cycles();
        $arr=$data->getReestrOutNotEqualErpn(7,2016);
        $write->setDataFromWorksheet('Out_reestr<>edrpou',$arr,'A4');
        unset($arr);
        gc_collect_cycles();
        $write->fileWriteAndSave();

    }
}
