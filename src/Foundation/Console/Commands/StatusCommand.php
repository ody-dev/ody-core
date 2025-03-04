<?php

namespace Ody\Core\Foundation\Console\Commands;

use Ody\HttpServer\HttpServerState;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'server:status',
    description: 'server status'
)]
class StatusCommand extends Command
{
    protected function configure(): void
    {
        $this->addOption('full', 'f', InputOption::VALUE_NONE, 'Display full information about the status of processes');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption('full')) {
            $this->fullInformation($output);
        } else {
            $this->generalInformation($output);
        }

        return self::SUCCESS;
    }

    protected function fullInformation(OutputInterface $output): void
    {
        $serverState = HttpServerState::getInstance();
        $rows = $this->getGeneralInformationTable($serverState);

        foreach ($serverState->getWorkerProcessIds() as $index => $workerId) {
            $index++;
            if (posix_kill($workerId, SIG_DFL)) {
                $rows[] = [
                    "HTTP process $index",
                    '<fg=#C3E88D;options=bold> ACTIVE </>',
                    $workerId
                ];
                continue;
            }
            $rows[] = [
                "Worker worker $index",
                '<fg=#FF5572;options=bold> DEACTIVE </>',
                $workerId
            ];
        }

        foreach ($serverState->getWebsocketWorkerProcessIds() as $index => $workerId) {
            $index++;
            if (posix_kill($workerId, SIG_DFL)) {
                $rows[] = [
                    "Websocket process $index",
                    '<fg=#C3E88D;options=bold> ACTIVE </>',
                    $workerId
                ];
                continue;
            }
            $rows[] = [
                "Worker worker $index",
                '<fg=#FF5572;options=bold> DEACTIVE </>',
                $workerId
            ];
        }

        $output->writeln('');
        $table = new Table($output);
        $table
            ->setHeaderTitle('full information')
            ->setHeaders([
                '<fg=#FFCB8B;options=bold> Process Name </>',
                '<fg=#FFCB8B;options=bold> Process Status </>',
                '<fg=#FFCB8B;options=bold> Process PID </>'
            ])
            ->setRows($rows);
        $table->setVertical();
        $table->render();
        $output->writeln('');
    }

    protected function generalInformation(OutputInterface $output): void
    {
        $output->writeln('');
        $table = new Table($output);
        $table
            ->setHeaderTitle('general information')
            ->setHeaders([
                '<fg=#FFCB8B;options=bold> Process Name </>',
                '<fg=#FFCB8B;options=bold> Process Status </>',
                '<fg=#FFCB8B;options=bold> Process PID </>'
            ])
            ->setRows($this->getGeneralInformationTable(HttpServerState::getInstance()));
        $table->setVertical();
        $table->render();
        $output->writeln('');
    }

    /**
     * @param HttpServerState $serverState
     * @return array
     */
    private function getGeneralInformationTable(HttpServerState $serverState): array
    {
        $processIds = [
            'manager' => $serverState->getManagerProcessId(),
            'master' => $serverState->getMasterProcessId(),
            'watcher' => $serverState->getWatcherProcessId(),
//            'factory' => $serverState->getFactoryProcessId(),
//            'queue' => $serverState->getQueueProcessId(),
        ];

        $rows = [];
        $i = 0;
        foreach ($processIds as $key => $processId) {
            $rows[$i] = [
                $key,
                !is_null($processId) && posix_kill($processId, SIG_DFL) ? '<fg=#C3E88D;options=bold> ACTIVE </>' : '<fg=#FF5572;options=bold> DEACTIVE </>', $processId
            ];
            $i++;
        }

        return $rows;
    }
}