<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\WhyChooseUs;

echo "Checking WhyChooseUs count...\n";
try {
    $count = WhyChooseUs::count();
    echo "Count: " . $count . "\n";
    if ($count > 0) {
        $items = WhyChooseUs::all();
        foreach($items as $item) {
            echo "ID: " . $item->id . ", Title En: " . $item->title_en . ", Image: " . $item->image . "\n";
        }
    } else {
        echo "No records found.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
