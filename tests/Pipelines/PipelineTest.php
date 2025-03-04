<?php

namespace Ody\Core\Tests\Pipelines;

use Closure;
use Ody\Core\Pipelines\Pipeline;
use PHPUnit\Framework\TestCase;


class PipelineTest extends TestCase
{
    public function test_it_passes_through_information_without_stages(): void
    {
        $pipeline = new Pipeline();

        $result = $pipeline->process(10);

        self::assertEquals(10, $result);
    }

    public function test_it_passes_through_pipelines(): void
    {
        $pipeline = (new Pipeline())
            ->send(10)
            ->through([
                TimesTwoStage::class,
                AddOneStage::class,
            ])->thenReturn();

        $this->assertEquals(21, $pipeline);
    }
}

class TimesTwoStage
{
    public function handle($payload, Closure $next)
    {
        return $next($payload * 2);
    }
}

class AddOneStage
{
    public function handle($payload, Closure $next)
    {
        return $next($payload + 1);
    }
}