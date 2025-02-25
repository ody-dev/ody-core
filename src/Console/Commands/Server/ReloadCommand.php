<?php

namespace Ody\Core\Console\Commands\Server;

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
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new Style($input, $output);

        if (! httpServerIsRunning()){
            $io->error('server is not running...' , true);
            return self::FAILURE;
        }

        if (httpServerIsRunning()) {
            posix_kill(getManagerProcessId(), SIGUSR1);
            posix_kill(getMasterProcessId(), SIGUSR1);

            foreach (getWorkerProcessIds() as $processId) {
                posix_kill($processId , SIGUSR1);
            }
        }

        $io->success('reloading workers...' , true);
        return self::SUCCESS;
    }
}