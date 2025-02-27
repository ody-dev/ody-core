<?php

namespace Ody\Core\Console\Commands\Server;

use Ody\Swoole\ServerState;
use Swoole\Process;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ody\Core\Console\Style;

#[AsCommand(
    name: 'server:reload' ,
    description: 'reload http server'
)]
class ReloadCommand extends Command
{
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $serverState = ServerState::getInstance();
        $io = new Style($input, $output);

        if (!$serverState->httpServerIsRunning()){
            $io->error('server is not running...' , true);
            return self::FAILURE;
        }

        posix_kill($serverState->getManagerProcessId(), SIGUSR1);
        posix_kill($serverState->getMasterProcessId(), SIGUSR1);

        foreach ($serverState->getWorkerProcessIds() as $processId) {
            posix_kill($processId , SIGUSR1);
        }

        $io->success('reloading workers...' , true);
        return self::SUCCESS;
    }
}