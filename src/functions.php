<?php

namespace Muse;


use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\HttpFoundation\Request;

function is_debug($env)
{
    return in_array($env, ['test', 'dev']);
}

function create_application()
{
    $app = new Application($env = 'dev', is_debug($env));
    $app->loadClassCache();

    return $app;
}


function run(HttpKernelInterface $app, Request $request = null)
{
    $request = $request ?: Request::createFromGlobals();

    $response = $app->handle($request);
    $response->send();
    if ($app instanceof TerminableInterface) {
        $app->terminate($request, $response);
    }
}
