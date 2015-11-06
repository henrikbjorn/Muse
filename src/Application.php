<?php

namespace Muse;

use Symfony\Bundle;
use Symfony\Component\Routing\RouteCollectionBuilder;

class Application extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Bundle\FrameworkBundle\FrameworkBundle(),
            new Bundle\MonologBundle\MonologBundle(),
            new Bundle\TwigBundle\TwigBundle(),
        ];

        if (is_debug($this->environment)) {
            $bundles[] = new Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        parent::configureRoutes($routes);

        if (is_debug($this->environment)) {
            $routes->mount('/_wdt', $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml'));
            $routes->mount('/_profiler', $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml'));
        }
    }
}
