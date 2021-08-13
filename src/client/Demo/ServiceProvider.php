<?php

namespace Demo\DemoClient\Good;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['demo'] = function ($app) {
            return new Client($app);
        };
    }
}
