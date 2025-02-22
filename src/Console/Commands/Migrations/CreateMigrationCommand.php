<?php

namespace Ody\Core\Console\Commands\Migrations;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateMigrationCommand extends Command
{
    protected string $commandName = 'migrations:create';
    protected string $commandDescription = "Creates a new migration file";

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