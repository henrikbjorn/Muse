<?php

namespace Muse\Benchmarks;

use Muse\Tests\Fixtures\app\src\Application;
use Symfony\Component\HttpFoundation\Request;

class KernelBenchmark extends \Athletic\AthleticEvent
{
    public function classSetUp()
    {
        $this->app = new Application('dev', false);
        $this->app->boot();

    }

    /**
     * @iterations 10000
     */
    public function homepage()
    {
        $this->app->handle(Request::create('/'));
    }
}
