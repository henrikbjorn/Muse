<?php

namespace Muse\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function indexAction()
    {
        return new Response('<html><head></head><body><p>Hello</p></body></html>');
    }
}
