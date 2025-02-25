<?php

namespace Ody\Core\Console;

use Symfony\Component\Console\Style\SymfonyStyle;

class Style extends SymfonyStyle
{


    /**
     * @psalm-param 'http server running…'|'reloading workers...'|'stopping server...' $message
     */
    public function success(string|array $message , bool $withNewLine = false): void
    {
        $this->writeln([
            '',
            "  <fg=#C3E88D;options=bold> SUCCESS </> $message",
        ]);

        if ($withNewLine){
            $this->newLine();
        }
    }

    public function info(string|array $message , bool $withNewLine = false): void
    {
        $this->writeln([
            "  <options=bold> INFO </> $message",
        ]);

        if ($withNewLine){
            $this->newLine();
        }
    }

    public function warning($message , bool $withNewLine = false): void
    {
        $this->writeln([
            '',
            "  <fg=#FFCB8B;options=bold> WARNING </> $message",
        ]);

        if ($withNewLine){
            $this->newLine();
        }
    }

    public function error(string|array $message , bool $withNewLine = false): void
    {
        $this->writeln([
            '',
            "  <fg=#FF5572;options=bold> ERROR </> $message",
        ]);

        if ($withNewLine){
            $this->newLine();
        }
    }

//    public function failed($message , bool $withNewLine = false): void
//    {
//        $this->writeln([
//            '',
//            "  <fg=#FF5572;options=bold> FAILED </> $message",
//        ]);
//
//        if ($withNewLine){
//            $this->newLine();
//        }
//    }
//
//    public function done($message , bool $withNewLine = false): void
//    {
//        $this->writeln([
//            '',
//            "  <fg=#C3E88D;options=bold> DONE </> $message",
//        ]);
//
//        if ($withNewLine){
//            $this->newLine();
//        }
//    }
}