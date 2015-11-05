<?php

namespace Muse;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle;

class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    use FrameworkBundle\Kernel\MicroKernelTrait;

    public function registerBundles()
    {
        return [
            new FrameworkBundle\FrameworkBundle(),
            new MonologBundle\MonologBundle(),
        ];
    }

    public function getRootDir()
    {
        if ($this->rootDir) {
            return $this->rootDir;
        }

        return dirname((new \ReflectionObject($this))->getFilename()) . '/..';
    }

    public function getCacheDir()
    {
        return $this->rootDir . '/var/cache/' . $this->environment;
    }

    public function getLogDir()
    {
        return $this->rootDir . '/var/logs/' . $this->environment;
    }

    protected function configureRoutes(RouteCollectionBuilder &$routes)
    {
        $routes = $routes->import($this->rootDir . '/src/Resources/routing/routing.xml', null);
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $loader->load($this->rootDir . '/config/' . $this->environment . '.yml');
    }
}
