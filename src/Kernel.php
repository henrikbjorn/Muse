<?php

namespace Muse;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteCollectionBuilder;

/**
 * Abstract Kernel that used the MicroKernelTrait in order
 * to have a simpler Application structure than Symfony Standard
 */
abstract class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    use MicroKernelTrait;

    /**
     * By convention the rootDir is always one level up from the current direction.
     * eg:
     *      /Project/src/Kernel.php -> /Project
     *      /Project/Kernel.php -> /
     *
     * {@inheritDoc}
     */
    public function getRootDir()
    {
        if ($this->rootDir) {
            return $this->rootDir;
        }

        return dirname((new \ReflectionObject($this))->getFilename()) . '/..';
    }

    /**
     * Convention used by the "new" Symfony 3.0 layout %kernel.root_dir%/var/cache/%kernel.environment%
     *
     * {@inheritDoc}
     */
    public function getCacheDir()
    {
        return $this->rootDir . '/var/cache/' . $this->environment;
    }

    /**
     * Convention used by the "new" Symfony 3.0 layout %kernel.root_dir%/var/logs/%kernel.environment%
     * Mostly only useful when doing development as production and staging sites should log directly
     * into syslog.
     *
     * {@inheritDoc}
     */
    public function getLogDir()
    {
        return $this->rootDir . '/var/logs/' . $this->environment;
    }

    /**
     * Following our convention from Flint applications we assume the configuration is in
     * %kernel.root_dir%/config/%kernel.environment%.yml
     *
     * {@inheritDoc}
     */
    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $loader->load($this->rootDir . '/config/' . $this->environment . '.yml');
    }

    /**
     * When we use the ng platform, our parameters are defined in pco.json
     * these should be available to the container as ordinary parameters, so
     * they can be used in configurations.
     *
     * So we create a specialized ContainerBuilder and merge its parameters
     * with the original.
     *
     * {@inheritDoc}
     */
    protected function getContainerLoader(ContainerInterface $container)
    {
        $loader = parent::getContainerLoader($container);

        //$loader->getResolver()->addLoader(
        //    new PcoFileLoader(new FileLocator($this))
        //);

        return $loader;
    }
}
