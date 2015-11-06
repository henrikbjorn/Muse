<?php

namespace Muse;

use function Stack\run;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application('dev', true);
$app->loadClassCache();

run($app);
