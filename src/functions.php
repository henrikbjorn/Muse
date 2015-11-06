<?php

namespace Muse;

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
