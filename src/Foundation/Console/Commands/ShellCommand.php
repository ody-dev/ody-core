<?php

namespace Ody\Core\Foundation\Console\Commands;

use Composer\InstalledVersions;
use Ody\Monolog\Logger;
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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (! InstalledVersions::isInstalled('psy/psysh')) {
            echo( 'Shell package not installed. Run "composer require psy/psysh"');
            return Command::FAILURE;
        }

        $shell = new \Psy\Shell();
        $shell->run();

        return Command::SUCCESS;
    }
}