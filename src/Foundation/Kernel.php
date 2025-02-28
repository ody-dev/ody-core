<?php

namespace Ody\Core\Foundation;

use Ody\Core\App;
use Ody\Core\Foundation\Bootstrappers\Bootstrapper;

abstract class Kernel
{
    public App $app;

    public array $bootstrappers = [];

    /**
     * Register application bootstrap loaders
     *
     * @var array
     */
    public array $bootstrap = [];

    public function __construct(App &$app)
    {
        $this->app = $app;

        $this->app->getContainer()->set(self::class, $this);

        Bootstrapper::setup($this->app, $this->bootstrap);
    }

    public static function bootstrap(App &$app)
    {
        return new static($app);
    }

    public function getApplication(): App
    {
        return $this->app;
    }
}