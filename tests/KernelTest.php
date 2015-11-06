<?php

namespace Muse\Tests;

use Muse\Tests\Fixtures\app\src\Application;

class KernelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function its_root_path_is_relative_to_implementation()
    {
        $app = new Application('dev', true);

        $rootDir = dirname((new \ReflectionClass(Application::CLASS))->getFileName());

        $this->assertEquals($rootDir . '/..', $app->getRootDir());
    }

    /**
     * @test
     * @dataProvider environmentDataProvider
     */
    public function its_cache_and_log_path_is_relative_to_root_dir($env)
    {
        $app = new Application($env, true);

        $rootDir = $app->getRootDir();

        $this->assertEquals($rootDir . '/var/cache/' . $env, $app->getCacheDir());
        $this->assertEquals($rootDir . '/var/logs/' . $env, $app->getLogDir());
    }

    /**
     * @test
     * @dataProvider environmentDataProvider
     */
    public function it_load_config_based_on_environment($env)
    {
        $app = new Application($env, true);
        $app->boot();

        $this->assertEquals($app->getEnvironment(), $app->getContainer()->getParameter('muse.loaded_config'));
    }

    public function environmentDataProvider()
    {
        return [
            ['dev'],
            ['prod'],
        ];
    }
}
