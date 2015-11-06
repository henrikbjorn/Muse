<?php

namespace Muse;

function is_debug($env)
{
    return in_array($env, ['test', 'dev']);
}
