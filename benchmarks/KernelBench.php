<?php

namespace Muse\Benchmarks;

use Muse\Tests\Fixtures\app\src\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * @BeforeMethods({"initApplication"})
 */
class KernelBench
{
    public function initApplication()
    {
        $this->app = new Application('prod', false);
        $this->app->loadClassCache();
        $this->app->boot();
    }

    /**
     * @Revs(25000)
     */
    public function benchHomepage()
    {
        $this->app->handle(Request::create('/'), 1, false);
    }
}
