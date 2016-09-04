<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Utilits\loadData\factoryLoadData;
use AnalizPdvBundle\Utilits\loadData\getFileFromDir;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class loadReestBranchCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('analiz_pdv:load_reest_branch_command')
            ->setDescription('Load data from files to Dir');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dt=$this->getContainer()->get('doctrine');
            $em=$dt->getManager();
               $pathToReestr=$this->getContainer()->getParameter('file_dir_reestr');
                      $a=new getFileFromDir($pathToReestr);
                        $arrayFiles=$a->getFiles();
        $factoryLoad=new factoryLoadData($em);
        foreach ($arrayFiles as $fileName => $type) {
            $pathToFileReestr=$fileName;
                $factoryLoad->loadDataFromFile($pathToFileReestr,$type);
        }

    }
}
