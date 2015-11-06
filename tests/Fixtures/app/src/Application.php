<?php

namespace Muse\Tests\Fixtures\app\src;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;

class Application extends \Muse\Kernel
{
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
        ];
    }
}
