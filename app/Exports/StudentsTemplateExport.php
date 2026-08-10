<?php

namespace App\Exports;

use App\Models\EducationStage;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\Semester;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class StudentsTemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'الطلاب (Students)' => new StudentsDataSheet(),
            'تعليمات القواعد (Instructions)' => new InstructionsSheet(),
            'Lists' => new ListsSheet(),
        ];
    }
}

class StudentsDataSheet implements WithHeadings, WithEvents, WithTitle, WithStyles, ShouldAutoSize
{
    public function title(): string
    {
        return 'الطلاب (Students)';
    }

    public function headings(): array
    {
        return [
            'الاسم (Name) *',
            'اسم المستخدم (Username)',
            'الكود (Code) *',
            'البريد الإلكتروني (Email)',
            'كلمة المرور (Password)',
            'الجنس (Gender) *',
            'الهاتف 1 (Phone 1)',
            'الهاتف 2 (Phone 2)',
            'المرحلة الدراسية (Education Stage) *',
            'الصف الدراسي (School Class) *',
            'العام الدراسي (Academic Year) *',
            'الفصل الدراسي (Semester) *',
            'المحافظة (Governorate)',
            'المدينة (City)',
            'العنوان (Address)',
            'تاريخ الميلاد (Birth Date YYYY-MM-DD)',
            'نشط (Is Active)',
            'مكتمل البيانات (Is Completed)',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1E3A8A'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getRightToLeft(true);

                $firstStage = EducationStage::first();
                $firstClass = $firstStage ? SchoolClass::where('education_stage_id', $firstStage->id)->first() : null;
                $firstYear = AcademicYear::first();
                $firstSem = $firstYear ? Semester::where('academic_year_id', $firstYear->id)->first() : null;

                // Add sample row
                $sheet->setCellValue('A2', 'أحمد محمد علي');
                $sheet->setCellValue('B2', '');
                $sheet->setCellValue('C2', '1001');
                $sheet->setCellValue('D2', 'ahmed@example.com');
                $sheet->setCellValue('E2', '12345678');
                $sheet->setCellValue('F2', 'male');
                $sheet->setCellValue('G2', '01012345678');
                $sheet->setCellValue('H2', '');
                $sheet->setCellValue('I2', $firstStage?->title_ar ?? '');
                $sheet->setCellValue('J2', $firstClass?->name ?? '');
                $sheet->setCellValue('K2', $firstYear?->name ?? '');
                $firstSemName = $firstSem ? ($firstSem->title_ar ?? $firstSem->title) : '';
                $sheet->setCellValue('L2', $firstSemName);
                $sheet->setCellValue('M2', 'القاهرة');
                $sheet->setCellValue('N2', 'مدينة نصر');
                $sheet->setCellValue('O2', 'شارع الطيران');
                $sheet->setCellValue('P2', '2010-05-15');
                $sheet->setCellValue('Q2', 'نعم');
                $sheet->setCellValue('R2', 'نعم');

                $rowCount = 500;

                // 1. Gender Validation (Col F)
                $valGender = $sheet->getCell('F2')->getDataValidation();
                $valGender->setType(DataValidation::TYPE_LIST);
                $valGender->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $valGender->setAllowBlank(false);
                $valGender->setShowDropDown(true);
                $valGender->setFormula1('"male,female"');

                // 2. Education Stage Validation (Col I) -> Named Range StagesList
                $valStage = $sheet->getCell('I2')->getDataValidation();
                $valStage->setType(DataValidation::TYPE_LIST);
                $valStage->setErrorStyle(DataValidation::STYLE_STOP);
                $valStage->setAllowBlank(false);
                $valStage->setShowDropDown(true);
                $valStage->setFormula1('=StagesList');

                // 3. Academic Year Validation (Col K) -> Named Range YearsList
                $valYear = $sheet->getCell('K2')->getDataValidation();
                $valYear->setType(DataValidation::TYPE_LIST);
                $valYear->setErrorStyle(DataValidation::STYLE_STOP);
                $valYear->setAllowBlank(false);
                $valYear->setShowDropDown(true);
                $valYear->setFormula1('=YearsList');

                // 4. Active & Completed Validation (Col Q & R)
                $valActive = $sheet->getCell('Q2')->getDataValidation();
                $valActive->setType(DataValidation::TYPE_LIST);
                $valActive->setShowDropDown(true);
                $valActive->setFormula1('"نعم,لا"');

                for ($i = 2; $i <= $rowCount; $i++) {
                    $sheet->getCell("F{$i}")->setDataValidation(clone $valGender);
                    $sheet->getCell("I{$i}")->setDataValidation(clone $valStage);
                    $sheet->getCell("K{$i}")->setDataValidation(clone $valYear);
                    $sheet->getCell("Q{$i}")->setDataValidation(clone $valActive);
                    $sheet->getCell("R{$i}")->setDataValidation(clone $valActive);

                    // Cascading Dependent Class Validation (Col J) based on Stage (Col I)
                    $valClass = $sheet->getCell("J{$i}")->getDataValidation();
                    $valClass->setType(DataValidation::TYPE_LIST);
                    $valClass->setErrorStyle(DataValidation::STYLE_STOP);
                    $valClass->setAllowBlank(true);
                    $valClass->setShowDropDown(true);
                    // Sanitizes stage name in Excel formula to match Named Range
                    $valClass->setFormula1("=INDIRECT(IF(ISNUMBER(VALUE(LEFT(SUBSTITUTE(SUBSTITUTE(I{$i},\"-\",\"_\"),\" \",\"_\"),1))),CONCATENATE(\"Stage_\",SUBSTITUTE(SUBSTITUTE(I{$i},\"-\",\"_\"),\" \",\"_\")),SUBSTITUTE(SUBSTITUTE(I{$i},\"-\",\"_\"),\" \",\"_\")))");
                    $sheet->getCell("J{$i}")->setDataValidation($valClass);

                    // Cascading Dependent Semester Validation (Col L) based on Academic Year (Col K)
                    $valSem = $sheet->getCell("L{$i}")->getDataValidation();
                    $valSem->setType(DataValidation::TYPE_LIST);
                    $valSem->setErrorStyle(DataValidation::STYLE_STOP);
                    $valSem->setAllowBlank(true);
                    $valSem->setShowDropDown(true);
                    // Sanitizes year name in Excel formula (e.g., '2023-2024' -> 'Year_2023_2024') to match Named Range
                    $valSem->setFormula1("=INDIRECT(IF(ISNUMBER(VALUE(LEFT(SUBSTITUTE(SUBSTITUTE(SUBSTITUTE(K{$i},\"-\",\"_\"),\"/\",\"_\"),\" \",\"_\"),1))),CONCATENATE(\"Year_\",SUBSTITUTE(SUBSTITUTE(SUBSTITUTE(K{$i},\"-\",\"_\"),\"/\",\"_\"),\" \",\"_\")),SUBSTITUTE(SUBSTITUTE(SUBSTITUTE(K{$i},\"-\",\"_\"),\"/\",\"_\"),\" \",\"_\")))");
                    $sheet->getCell("L{$i}")->setDataValidation($valSem);
                }
            },
        ];
    }
}

class ListsSheet implements WithHeadings, WithEvents, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Lists';
    }

    public function headings(): array
    {
        return [
            'المراحل الدراسية',
            'السنوات الدراسية',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $workbook = $event->sheet->getParent();
                $sheet->getRightToLeft(true);

                $stages = EducationStage::all();
                $years = AcademicYear::all();

                // Fill Stages (Col A)
                $stageRow = 2;
                foreach ($stages as $stage) {
                    $sheet->setCellValue("A{$stageRow}", $stage->title_ar);
                    $stageRow++;
                }
                $lastStageRow = max(2, $stageRow - 1);
                $workbook->addNamedRange(
                    new \PhpOffice\PhpSpreadsheet\NamedRange('StagesList', $sheet, "\$A\$2:\$A\${$lastStageRow}")
                );

                // Fill Years (Col B)
                $yearRow = 2;
                foreach ($years as $yr) {
                    $sheet->setCellValue("B{$yearRow}", $yr->name);
                    $yearRow++;
                }
                $lastYearRow = max(2, $yearRow - 1);
                $workbook->addNamedRange(
                    new \PhpOffice\PhpSpreadsheet\NamedRange('YearsList', $sheet, "\$B\$2:\$B\${$lastYearRow}")
                );

                // Build Cascading Sub-Lists for Stages -> SchoolClasses starting from Col D
                $colIndex = 4; // Column D
                foreach ($stages as $stage) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
                    $sheet->setCellValue("{$colLetter}1", $stage->title_ar);
                    $sheet->getStyle("{$colLetter}1")->getFont()->setBold(true);

                    $classes = SchoolClass::where('education_stage_id', $stage->id)->get();
                    $r = 2;
                    foreach ($classes as $cls) {
                        $sheet->setCellValue("{$colLetter}{$r}", $cls->name);
                        $r++;
                    }
                    $lastClassRow = max(2, $r - 1);

                    // Excel Named Ranges allow letters, numbers, underscores. Convert hyphens/spaces to underscores.
                    $cleanName = preg_replace('/[^\p{L}\p{N}_]/u', '_', $stage->title_ar);
                    $cleanName = trim(preg_replace('/_+/', '_', $cleanName), '_');
                    if (is_numeric(substr($cleanName, 0, 1))) {
                        $cleanName = 'Stage_' . $cleanName;
                    }

                    $workbook->addNamedRange(
                        new \PhpOffice\PhpSpreadsheet\NamedRange($cleanName, $sheet, "\${$colLetter}\$2:\${$colLetter}\${$lastClassRow}")
                    );

                    $colIndex++;
                }

                // Build Cascading Sub-Lists for Academic Years -> Semesters
                foreach ($years as $yr) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
                    $sheet->setCellValue("{$colLetter}1", $yr->name);
                    $sheet->getStyle("{$colLetter}1")->getFont()->setBold(true);

                    $semesters = Semester::where('academic_year_id', $yr->id)->get();
                    $r = 2;
                    foreach ($semesters as $sem) {
                        $semName = $sem->title_ar ?? $sem->title ?? $sem->title_en ?? '';
                        $sheet->setCellValue("{$colLetter}{$r}", $semName);
                        $r++;
                    }
                    $lastSemRow = max(2, $r - 1);

                    // Excel Named Ranges allow letters, numbers, underscores. Replace dashes/spaces/slashes.
                    $cleanName = preg_replace('/[^\p{L}\p{N}_]/u', '_', $yr->name);
                    $cleanName = trim(preg_replace('/_+/', '_', $cleanName), '_');
                    if (is_numeric(substr($cleanName, 0, 1))) {
                        $cleanName = 'Year_' . $cleanName;
                    }

                    $workbook->addNamedRange(
                        new \PhpOffice\PhpSpreadsheet\NamedRange($cleanName, $sheet, "\${$colLetter}\$2:\${$colLetter}\${$lastSemRow}")
                    );

                    $colIndex++;
                }
            },
        ];
    }
}

class InstructionsSheet implements WithEvents, WithTitle, WithStyles, ShouldAutoSize
{
    public function title(): string
    {
        return 'تعليمات القواعد (Instructions)';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1E3A8A']],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getRightToLeft(true);

                $instructions = [
                    ['دليل قواعد تعبئة شيت استيراد الطلاب (Import Guide & Rules)'],
                    [''],
                    ['1. الحقول الإجبارية المميزة بـ (*):'],
                    ['   - الاسم (Name): اسم الطالب كاملاً.'],
                    ['   - الكود (Code): رقم فريد لكل طالب (لا يتكرر في النظام).'],
                    ['   - الجنس (Gender): اختر إما male أو female من القائمة المنسدلة.'],
                    ['   - المرحلة الدراسية (Education Stage): اختر المرحلة المتاحة من القائمة المنسدلة.'],
                    ['   - الصف الدراسي (School Class): اختر الصف المتاح المترتبط بالمرحلة المحددة (قائمة منسدلة ديناميكية مترابطة).'],
                    ['   - العام الدراسي (Academic Year): اختر السنة الدراسية المتاحة.'],
                    ['   - الفصل الدراسي (Semester): اختر الفصل الدراسي المتاح المترابط بالسنة الدراسية المحددة.'],
                    [''],
                    ['2. الحقول الاختيارية:'],
                    ['   - اسم المستخدم (Username): اختياري (في حال تركه فارغاً سيقوم النظام بتوليده تلقائياً std_CODE).'],
                    ['   - البريد الإلكتروني (Email): بريد إلكتروني فريد إن وجد.'],
                    ['   - كلمة المرور (Password): إذا تركت فارغة ستكون الافتراضية 12345678.'],
                    ['   - الهاتف 1 والهاتف 2: أرقام الهواتف.'],
                    ['   - تاريخ الميلاد: بتنسيق YYYY-MM-DD (مثل 2010-05-15).'],
                    ['   - نشط / مكتمل البيانات: اختر "نعم" أو "لا" من القائمة المنسدلة.'],
                    [''],
                    ['3. ميزة القوائم المنسدلة المترابطة (Cascading Dropdowns):'],
                    ['   - عند اختيار "المرحلة الدراسية"، تظهر الصفوف الدراسية التابعة لها فقط تلقائياً.'],
                    ['   - عند اختيار "العام الدراسي"، تظهر الفصول الدراسية التابعة له فقط تلقائياً.'],
                    ['   - تم بناء القوائم في ورقة Lists بشكل ديناميكي لتحديث البيانات بدون VBA.'],
                ];

                foreach ($instructions as $index => $row) {
                    $rowNum = $index + 1;
                    $sheet->setCellValue("A{$rowNum}", $row[0]);
                    if ($rowNum === 1) {
                        $sheet->getStyle("A1")->getFont()->setBold(true)->setSize(14);
                    } elseif (str_starts_with($row[0], '1.') || str_starts_with($row[0], '2.') || str_starts_with($row[0], '3.')) {
                        $sheet->getStyle("A{$rowNum}")->getFont()->setBold(true)->setSize(11);
                    }
                }
            },
        ];
    }
}

