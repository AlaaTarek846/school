<?php
$arFile = __DIR__.'/resources/js/translation/ar.json';
$enFile = __DIR__.'/resources/js/translation/en.json';

$ar = json_decode(file_get_contents($arFile), true);
$en = json_decode(file_get_contents($enFile), true);

$arAdmin = [
    'governorate' => 'المحافظة',
    'city' => 'المدينة',
    'address' => 'العنوان',
    'birth_day' => 'تاريخ الميلاد',
    'is_completed' => 'مكتمل التسجيل',
    'education_stage' => 'المرحلة التعليمية',
];

$enAdmin = [
    'governorate' => 'Governorate',
    'city' => 'City',
    'address' => 'Address',
    'birth_day' => 'Birthday',
    'is_completed' => 'Registration Completed',
    'education_stage' => 'Education Stage',
];

if(!isset($ar['admin'])) $ar['admin'] = [];
if(!isset($en['admin'])) $en['admin'] = [];

$ar['admin'] = array_merge($ar['admin'], $arAdmin);
$en['admin'] = array_merge($en['admin'], $enAdmin);

file_put_contents($arFile, json_encode($ar, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
file_put_contents($enFile, json_encode($en, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

echo "JSON translations updated successfully.\n";
