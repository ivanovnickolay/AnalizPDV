<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Model\writeAnalizPDVToFile\writeAnalizPDVToFile;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Команда формирует сводный анализ ПДВ по реестрам и ЕРПН по всему ПАТ
 * todo реализовать ввод параметров команды
 * todo пример реализации https://github.com/sensiolabs/SensioGeneratorBundle/blob/master/Command/GenerateCommandCommand.php
 * Class AnalizPDVByAll_UZ_Command
 * @package AnalizPdvBundle\Command
 */
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
        gc_enable();
        $dt=$this->getContainer()->get('doctrine');
        $em=$dt->getManager();
        $write=new writeAnalizPDVToFile($em);
        $write->writeAnalizPDVByAllUZ(8,2016);
        unset($write);
        gc_collect_cycles();


    }
}
