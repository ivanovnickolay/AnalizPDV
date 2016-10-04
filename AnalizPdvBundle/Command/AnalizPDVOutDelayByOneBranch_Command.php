<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Model\writeAnalizPDVToFile\writeAnalizPDVToFile;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Команда формирует анализ опаздавших выданных НН одному филиалу в периоде
 * todo реализовать ввод параметров команды
 * Class AnalizPDVOutDiffByOneBranch_Command
 * @package AnalizPdvBundle\Command
 */
class AnalizPDVOutDelayByOneBranch_Command extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('analiz_pdv:OutDelayByOneBranch')
            ->setDescription('Анализ НН по обязательствам, которые зарегистрированы с опазданием по одному филиалу в периоде');
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
        $write->writeAnalizPDVOutDiffByOneBranch(8,2016,"682");
        unset($write);
        gc_collect_cycles();
    }
}