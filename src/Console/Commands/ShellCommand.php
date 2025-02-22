<?php

namespace Ody\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShellCommand extends Command
{
    protected $commandName = 'shell';
    protected $commandDescription = "Starts a shell environment";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription);
    }

    /**
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        include('bin/index.php');

        $shell = new \Psy\Shell();
        $shell->run();

        return true;
    }
}