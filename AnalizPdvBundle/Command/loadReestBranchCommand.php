<?php

namespace AnalizPdvBundle\Command;

use AnalizPdvBundle\Utilits\loadData\factoryLoadData;
use AnalizPdvBundle\Utilits\loadData\workWithFiles;
use AnalizPdvBundle\Utilits\loadReestrBranch\loadReestrBranch;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Клас загружает файлы реестров из каталога пачками по количеству штук
 * указаных в переменной $cntFilesLoad
 * и загруженные файлы переносит в другую папку
 * Class loadReestBranchCommand
 * @package AnalizPdvBundle\Command
 */
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
       // Количество файлов, загружаемых за раз
        $cntFilesLoad=20;
        $dt=$this->getContainer()->get('doctrine');
            $em=$dt->getManager();
               $pathToReestr=$this->getContainer()->getParameter('file_dir_reestr');
                $pathToReestrArch=$this->getContainer()->getParameter('file_dir_reestr_arch');
        $arr = workWithFiles::getFilesArray ($pathToReestr);
        $arr_slice = array_slice ($arr , 0 , $cntFilesLoad);
        foreach ($arr_slice as $fileName => $type) {
            $output->writeln("load file ". $fileName);
            loadReestrBranch::load ($em,$fileName,$type);
            workWithFiles::moveFiles ($fileName , $pathToReestrArch);
            $output->writeln("move File ". $fileName);
            //http://ru.php.net/manual/ru/features.gc.collecting-cycles.php
            gc_enable();
            gc_collect_cycles();
        }
    }
}
