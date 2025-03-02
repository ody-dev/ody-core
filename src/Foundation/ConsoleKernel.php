<?php

namespace Ody\Core\Foundation;

use Ody\Core\Foundation\Loaders\Bootstrapper;

class ConsoleKernel extends Kernel
{
    public array $bootstrap = [
        Loaders\LoadEnvironmentVariables::class,
        Loaders\LoadServiceProviders::class,
    ];
}