<?php

namespace App\Command;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'app:summator')]
class SummatorCommand extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Sum all numbers from count files in a given directory')
            ->addArgument('directory', InputArgument::OPTIONAL, 'Directory to scan for count files', './');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = $input->getArgument('directory');

        if ($dir) {
            $dir = realpath($dir);

            if (!$dir || !is_readable($dir)) {
                $output->writeln('<error>Invalid directory specified.</error>');
                return Command::FAILURE;
            }
        } else {
            $dir = getcwd();
        }
        $total = 0; 

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getBasename('.' . $file->getExtension()) == 'count') {
                $content = file_get_contents($file->getPathname());
                $numbers = preg_split('/[\n,;]+/', $content);
                
                foreach ($numbers as $number) {
                    $total += (int) $number;
                }
            }
        }

        $output->writeln(sprintf('<info>Total counts:</info> %d', $total));

        return Command::SUCCESS;
    }
}