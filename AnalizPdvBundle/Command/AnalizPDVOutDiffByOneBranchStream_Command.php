<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Model\writeAnalizPDVToFile\writeAnalizPDVToFile;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalizPDVOutDiffByOneBranchStream_Command extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('analiz_pdv:AnalizOutDiffByOneBranchStream')
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
        $write->writeAnalizPDVOutDiffByAllBranch(8,2016);
        unset($write);
        gc_collect_cycles();
    }
}
