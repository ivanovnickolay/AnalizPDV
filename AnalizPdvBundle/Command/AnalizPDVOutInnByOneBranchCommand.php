<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Model\writeAnalizPDVToFile\writeAnalizPDVToFile;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Команда формирует анализ совпадения номеров ИНН выданных НН по одному филиаоу в периоде
 * todo реализовать ввод параметров команды
 * Class AnalizPDVOutInnByOneBranchCommand
 * @package AnalizPdvBundle\Command
 */
class AnalizPDVOutInnByOneBranchCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('analiz_pdv:analiz_pdvout_inn_by_one_branch_command')
            ->setDescription('Hello PhpStorm');
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
        $write->writeAnalizPDVOutInnByOneBranch(7,2016,"667");
        unset($write);
        gc_collect_cycles();
    }
}
