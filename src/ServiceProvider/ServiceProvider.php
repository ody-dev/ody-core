<?php

namespace Ody\Core\ServiceProvider;


use Ody\Core\Kernel;

interface ServiceProvider
{
    /**
     * @param Slim $app
     * @param Resolver $resolver
     * @param array $options
     * @return void
     */
    public function configure(Kernel $app, Resolver $resolver, array $options = []);
}