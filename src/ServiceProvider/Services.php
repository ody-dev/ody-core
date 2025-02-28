<?php

namespace Ody\Core\ServiceProvider;

use Ody\Core\Kernel;

class Services
{
    /** @var Resolver */
    protected $resolver;

    /** @var ServiceProvider[] */
    private $providers = [];

    /** @var array */
    protected $options;

    /**
     * @param Resolver
     * @param array $options
     */
    public function __construct(Resolver $resolver, array $options = [])
    {
        $this->resolver = $resolver;
        $this->options = $options;
    }

    /**
     * Override this in subclasses to add your module's services
     *
     * This method will be called at the beginning of ComPHPPuebla\Slim\Services::configure
     */
    protected function init()
    {
    }

    /**
     * @param ServiceProvider $provider
     * @return Services
     */
    public function add(ServiceProvider $provider)
    {
        $this->providers[] = $provider;

        return $this;
    }

    /**
     * Configure the services for all your modules
     *
     * @param Slim $app
     */
    public function configure(Slim $app)
    {
        $this->init();

        /** @var ServiceProvider $provider */
        foreach ($this->providers as $provider) {
            $provider->configure($app, $this->resolver, $this->options);
        }
    }
}