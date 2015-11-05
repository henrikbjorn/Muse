<?php

namespace Muse;

use function Stack\run;

require __DIR__ . '/../vendor/autoload.php';

$app = new Kernel('dev', true);
$app->loadClassCache();

run($app);
