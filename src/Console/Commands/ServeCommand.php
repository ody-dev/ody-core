<?php

namespace Ody\Core\Console\Commands;

use Ody\Core\Exception\PackageNotFoundException;
use Ody\Core\Facades\Facade;
use Ody\Core\Server\Swoole;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{
    protected $commandName = 'http:serve';
    protected $commandDescription = "Starts the server";
    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Who do you want to greet?";
    protected $commandOptionName = "watch"; // should be specified like "app:greet John --cap"
    protected $commandOptionDescription = 'Watch for file changes';

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            )
            ->addOption(
                $this->commandOptionName,
                null,
                InputOption::VALUE_NONE,
                $this->commandOptionDescription
            )
        ;
    }

    /**
     * @throws PackageNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument($this->commandArgumentName);
        include('bin/index.php');

        if (is_null($name)) {
            exec("php -S localhost:9501 " . __DIR__ . '/../../Server/init_php_server.php');
        }

        if ($name === 'swoole') {
            Swoole::start($app);
        }

        if ($name === 'reactphp') {
            echo 'ReactPHP Server is not implemented!';
        }

        return true;
    }
}