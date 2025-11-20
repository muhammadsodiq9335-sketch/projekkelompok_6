<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'CACHE_STORE=' . config('cache.default') . PHP_EOL;
echo 'CACHE_DB_TABLE=' . config('cache.stores.database.table') . PHP_EOL;
