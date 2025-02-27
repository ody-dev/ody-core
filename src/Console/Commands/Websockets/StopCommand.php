<?php
declare(strict_types=1);

namespace Ody\Core\Console\Commands\Websockets;

use Ody\Core\Console\Style;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'websocket:stop' ,
    description: 'stop websocket server')
]
class StopCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new Style($input, $output);

        if (!websocketServerIsRunning()){
            $io->error('server is not running...' , true);
            return self::FAILURE;
        }

        if (posix_kill(getWebsocketMasterProcessId(), SIG_DFL)){
            posix_kill(getWebsocketMasterProcessId(), SIGTERM);
        }

        if (posix_kill(getWebsocketManagerProcessId(), SIG_DFL)){
            posix_kill(getWebsocketManagerProcessId(), SIGTERM);
        }

        if (posix_kill(getWatcherProcessId(), SIG_DFL)){
            /** @psalm-suppress PossiblyNullArgument */
            posix_kill(getWatcherProcessId(), SIGTERM);
        }

        foreach (getWebsocketWorkerProcessIds() as $processId) {
            if (posix_kill($processId, SIG_DFL)){
                posix_kill($processId, SIGTERM);
            }
        }

        sleep(1);

        $io->success('Stopped websocket server...' , true);
        return self::SUCCESS;
    }
}
