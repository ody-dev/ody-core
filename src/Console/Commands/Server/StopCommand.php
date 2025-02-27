<?php
declare(strict_types=1);

namespace Ody\Core\Console\Commands\Server;

use Ody\Core\Console\Style;
use Ody\Swoole\ServerState;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'server:stop' ,
    description: 'stops the http server')
]
class StopCommand extends Command
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


        $serverState->killProcesses([
            $serverState->getMasterProcessId(),
            $serverState->getManagerProcessId(),
            $serverState->getWatcherProcessId(),
            ...$serverState->getWorkerProcessIds()
        ]);

        $serverState->clearHttpProcessIds();
        sleep(1);

        $io->success('stopping server...' , true);
        return self::SUCCESS;
    }
}
