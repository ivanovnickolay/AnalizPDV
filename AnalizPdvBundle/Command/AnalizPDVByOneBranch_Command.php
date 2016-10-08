<?php

namespace AnalizPdvBundle\Command;


use AnalizPdvBundle\Model\writeAnalizPDVToFile\writeAnalizPDVToFile;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Команда формирует анализ ПДВ по реестрам и ЕРПН по одному филиалу
 * todo реализовать ввод параметров команды
 * Class AnalizPDVByOneBranch_Command
 * @package AnalizPdvBundle\Command
 */
class AnalizPDVByOneBranch_Command extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('analiz_pdv:AnalizPDVByOneBranch')
            ->setDescription('Анализ ПДВ между ЕРПН и Реестрами филиалов по одному филиалу за период.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dt=$this->getContainer()->get('doctrine');
        $em=$dt->getManager();
        $pathTemplate=$this->getContainer()->getParameter('path_template');
        $write=new writeAnalizPDVToFile($em,$pathTemplate);
        $write->writeAnalizPDVByOneBranch(7,2016,"667");
        unset($write);
        gc_collect_cycles();
    }
}
