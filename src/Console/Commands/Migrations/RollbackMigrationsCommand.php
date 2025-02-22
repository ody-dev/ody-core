<?php

namespace Ody\Core\Console\Commands\Migrations;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RollbackMigrationsCommand extends Command
{
    protected string $commandName = 'migrations:rollback';
    protected string $commandDescription = "Rolls back migrations";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return true;
    }
}