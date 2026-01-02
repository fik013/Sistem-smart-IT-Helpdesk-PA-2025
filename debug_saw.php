<?php
// Load Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SawCriteria;
use App\Models\SawSubCriteria;

echo "--- DEBUG SAW CRITERIA & WEIGHTS ---\n";

$criterias = SawCriteria::with('subCriterias')->where('is_active', true)->get();

if ($criterias->isEmpty()) {
    echo "NO ACTIVE CRITERIA FOUND!\n";
}

foreach ($criterias as $c) {
    echo "\n[{$c->code}] {$c->name} (Weight: {$c->weight})\n";
    foreach ($c->subCriterias as $sub) {
        echo "  - {$sub->name}: {$sub->weight}\n";
    }
}
echo "\n--- END DEBUG ---\n";
