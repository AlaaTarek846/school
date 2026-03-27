<?php
$arFile = __DIR__.'/resources/js/translation/ar.json';
$enFile = __DIR__.'/resources/js/translation/en.json';

$ar = json_decode(file_get_contents($arFile), true);
$en = json_decode(file_get_contents($enFile), true);

$arAdmin = [
    'code' => 'كود الطالب',
    'gender' => 'الجنس',
    'male' => 'ذكر',
    'female' => 'أنثى',
    'status' => 'الحالة',
    'active' => 'مفعل',
    'inactive' => 'غير مفعل',
    'academic_year' => 'العام الدراسي',
    'semester' => 'الترم',
    'school_class' => 'الفصل الدراسي',
    'phone_1' => 'رقم الهاتف 1',
    'phone_2' => 'رقم الهاتف 2',
    'username' => 'اسم المستخدم',
    'import_excel' => 'استيراد شيت إكسيل',
    'select_excel_file' => 'اختر ملف الإكسيل',
    'imported_successfully' => 'تم الاستيراد بنجاح',
    'error_occurred' => 'حدث خطأ يرجى المحاولة مرة أخرى',
    'students' => 'الطلاب'
];

$enAdmin = [
    'code' => 'Student Code',
    'gender' => 'Gender',
    'male' => 'Male',
    'female' => 'Female',
    'status' => 'Status',
    'active' => 'Active',
    'inactive' => 'Inactive',
    'academic_year' => 'Academic Year',
    'semester' => 'Semester',
    'school_class' => 'School Class',
    'phone_1' => 'Phone 1',
    'phone_2' => 'Phone 2',
    'username' => 'Username',
    'import_excel' => 'Import Excel Sheet',
    'select_excel_file' => 'Select Excel File',
    'imported_successfully' => 'Imported successfully',
    'error_occurred' => 'An error occurred, please try again',
    'students' => 'Students'
];

if(!isset($ar['admin'])) $ar['admin'] = [];
if(!isset($en['admin'])) $en['admin'] = [];

$ar['admin'] = array_merge($ar['admin'], $arAdmin);
$en['admin'] = array_merge($en['admin'], $enAdmin);

$ar['validation']['emailValid'] = 'البريد الإلكتروني غير صالح';
$en['validation']['emailValid'] = 'Invalid Email';

file_put_contents($arFile, json_encode($ar, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
file_put_contents($enFile, json_encode($en, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

echo "JSON translations updated successfully.\n";
