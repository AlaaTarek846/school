<?php
use App\Models\WhyChooseUs;

$count = WhyChooseUs::count();
$items = WhyChooseUs::all();

echo "Count: " . $count . "\n";
foreach($items as $item) {
    echo "ID: " . $item->id . ", Title: " . $item->title_en . ", Image: " . $item->image . "\n";
}
