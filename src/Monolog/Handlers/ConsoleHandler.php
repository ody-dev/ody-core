<?php

namespace Ody\Core\Monolog\Handlers;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Ody\Core\Monolog\CommandLine\Color;
use Symfony\Component\VarDumper\Caster\ScalarStub;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class ConsoleHandler
 * @package Mix\Monolog\Handler
 */
class ConsoleHandler extends AbstractProcessingHandler
{

    /**
     * ConsoleHandler constructor.
     * @param int $level
     * @param bool $bubble
     */
    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LineFormatter("[%datetime%] %level_name% - %message%\n", 'Y-m-d H:i:s', true);
    }

    /**
     * @param $level
     * @param string $message
     * @return string
     */
    protected function colour($level, string $message)
    {
        $start   = strpos($message, '- ');
        $label   = substr($message, 0, $start + 1);
        $content = substr($message, $start + 1);

        switch ($level) { // 渲染颜色
            case Logger::ERROR:
                $label = Color::new(Color::FG_RED)->sprint($label);
                break;
            case Logger::WARNING:
                $label = Color::new(Color::FG_YELLOW)->sprint($label);
                break;
            case Logger::NOTICE:
                $label = Color::new(Color::FG_GREEN)->sprint($label);
                break;
            case Logger::DEBUG:
                $label = Color::new(Color::FG_CYAN)->sprint($label);
                break;
            case Logger::INFO:
                $label = Color::new(Color::FG_BLUE)->sprint($label);
                break;
        }

        return sprintf('%s%s', $label, $content);
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array|\Monolog\LogRecord $record): void
    {
        $message = (string)$record['formatted'];
        $level   = $record['level'];

        if (!(stripos(PHP_OS, 'Darwin') !== false) && stripos(PHP_OS, 'WIN') !== false) {
            echo $message;
            return;
        }

        echo $this->colour($level, $message);

        /** Handle log records with context */
        if (!empty($record['context'])) {
//            $record->formatted = "$record->message: ";
            $this->dump($record['context']);
        }
    }

    private function dump(mixed ...$vars): void
    {
        if (!$vars) {
            VarDumper::dump(new ScalarStub('🐛'));
            return;
        }

        if (array_key_exists(0, $vars) && count($vars) === 1) {
            VarDumper::dump(var: $vars[0]);
        } else {
            foreach ($vars as $key => $value) {
                VarDumper::dump(
                    var: $value,
                    label: is_int($key) ? $key + 1 : $key
                );
            }
        }
    }
}