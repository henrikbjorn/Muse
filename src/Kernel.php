<?php

namespace Muse;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Routing\RouteCollectionBuilder;

use Symfony\Bundle\FrameworkBundle;

class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    use FrameworkBundle\Kernel\MicroKernelTrait;

    public function registerBundles()
    {
        return [
            new FrameworkBundle\FrameworkBundle(),
        ];
    }

    public function getCacheDir()
    {
        return $this->rootDir . '/../var/cache/' . $this->environment;
    }

    public function getLogDir()
    {
        return $this->rootDir . '/../var/logs/' . $this->environment;
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension('framework', [
            'secret' => 'justanonsecuresecret',
        ]);
    }
}
