<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\SchoolClass;
use App\Models\EducationStage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;

class StudentsImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    protected $isValidationOnly = false;
    protected $validationErrors = [];
    protected $validRowsCount = 0;
    protected $parsedStudents = [];

    public function __construct($isValidationOnly = false)
    {
        $this->isValidationOnly = $isValidationOnly;
    }

    public function collection(Collection $rows)
    {
        $educationStages = EducationStage::all();
        $schoolClasses = SchoolClass::all();
        $academicYears = AcademicYear::all();
        $semesters = Semester::all();

        $existingCodes = Student::pluck('code')->toArray();
        $existingUsernames = Student::pluck('username')->toArray();
        $existingEmails = Student::whereNotNull('email')->pluck('email')->toArray();

        $processedCodes = [];
        $processedUsernames = [];
        $processedEmails = [];

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2; // Including header row

            $name = trim($row['alasm_name'] ?? $row['name'] ?? '');
            $username = trim($row['asm_almstkhdm_username'] ?? $row['username'] ?? '');
            $code = trim($row['alkod_code'] ?? $row['code'] ?? '');
            $email = trim($row['albryd_alalktrony_email'] ?? $row['email'] ?? '');
            $password = trim($row['klm_almoror_password'] ?? $row['password'] ?? '');
            $gender = strtolower(trim($row['aljns_gender'] ?? $row['gender'] ?? ''));
            $phone1 = trim($row['alhatf_1_phone_1'] ?? $row['phone_1'] ?? '');
            $phone2 = trim($row['alhatf_2_phone_2'] ?? $row['phone_2'] ?? '');
            $stageStr = trim($row['almrhl_aldrasy_education_stage'] ?? $row['education_stage'] ?? '');
            $classStr = trim($row['alsf_aldrasy_school_class'] ?? $row['school_class'] ?? '');
            $yearStr = trim($row['alam_aldrasy_academic_year'] ?? $row['academic_year'] ?? '');
            $semesterStr = trim($row['alfl_aldrasy_semester'] ?? $row['semester'] ?? '');
            $governorate = trim($row['almhafth_governorate'] ?? $row['governorate'] ?? '');
            $city = trim($row['almdyn_city'] ?? $row['city'] ?? '');
            $address = trim($row['alonsan_address'] ?? $row['address'] ?? '');
            $birthDay = trim($row['tarykh_almylad_birth_date_yyyy_mm_dd'] ?? $row['birth_day'] ?? '');
            $isActiveStr = trim($row['nsht_is_active'] ?? $row['is_active'] ?? 'نعم');
            $isCompletedStr = trim($row['mktml_albyanat_is_completed'] ?? $row['is_completed'] ?? 'نعم');

            if (empty($name) && empty($code)) {
                continue;
            }

            $errors = [];

            if (empty($name)) {
                $errors[] = 'اسم الطالب مطلوب';
            }

            if (empty($username)) {
                // Auto generate username if empty from code or name
                $username = !empty($code) ? 'std_' . $code : 'std_' . uniqid();
            } else {
                if (in_array($username, $existingUsernames) || in_array($username, $processedUsernames)) {
                    $errors[] = "اسم المستخدم ({$username}) مستخدم من قبل";
                }
            }
            if (empty($code)) {
                $errors[] = 'كود الطالب مطلوب';
            } elseif (in_array($code, $existingCodes) || in_array($code, $processedCodes)) {
                $errors[] = "الكود ({$code}) مستخدم من قبل";
            }

            if (!empty($email)) {
                if (in_array($email, $existingEmails) || in_array($email, $processedEmails)) {
                    $errors[] = "البريد الإلكتروني ({$email}) مستخدم من قبل";
                }
            }

            if (!in_array($gender, ['male', 'female', 'ذكر', 'أنثى'])) {
                $errors[] = 'الجنس يجب أن يكون male أو female';
            }

            $stage = $educationStages->first(fn($s) => $s->title_ar == $stageStr || $s->title_en == $stageStr || $s->id == $stageStr);
            if (!$stage) {
                $errors[] = "المرحلة الدراسية ({$stageStr}) غير موجودة بالنظام";
            }

            $class = $schoolClasses->first(fn($c) => $c->name == $classStr || $c->id == $classStr);
            if (!$class) {
                $errors[] = "الصف الدراسي ({$classStr}) غير موجود بالنظام";
            }

            $year = $academicYears->first(fn($y) => $y->name == $yearStr || $y->id == $yearStr);
            if (!$year) {
                $errors[] = "العام الدراسي ({$yearStr}) غير موجود بالنظام";
            }

            $semester = $semesters->first(fn($sm) => $sm->title_ar == $semesterStr || $sm->title_en == $semesterStr || $sm->id == $semesterStr);
            if (!$semester) {
                $errors[] = "الفصل الدراسي ({$semesterStr}) غير موجود بالنظام";
            }

            if (count($errors) > 0) {
                $this->validationErrors[] = [
                    'row' => $rowNum,
                    'name' => $name ?: 'غير محدد',
                    'code' => $code ?: 'غير محدد',
                    'errors' => $errors,
                ];
            } else {
                $this->validRowsCount++;
                $processedCodes[] = $code;
                $processedUsernames[] = $username;
                if (!empty($email)) {
                    $processedEmails[] = $email;
                }

                $normalizedGender = ($gender == 'female' || $gender == 'أنثى') ? 'female' : 'male';
                $isActive = ($isActiveStr == 'لا' || $isActiveStr == '0' || $isActiveStr === false) ? 0 : 1;
                $isCompleted = ($isCompletedStr == 'لا' || $isCompletedStr == '0' || $isCompletedStr === false) ? 0 : 1;

                $this->parsedStudents[] = [
                    'student' => [
                        'name' => $name,
                        'username' => $username,
                        'code' => $code,
                        'email' => $email ?: null,
                        'password' => bcrypt($password ?: '12345678'),
                        'gender' => $normalizedGender,
                        'phone_1' => $phone1 ?: null,
                        'phone_2' => $phone2 ?: null,
                        'governorate' => $governorate ?: null,
                        'city' => $city ?: null,
                        'address' => $address ?: null,
                        'birth_day' => !empty($birthDay) ? date('Y-m-d', strtotime($birthDay)) : null,
                        'is_active' => $isActive,
                        'is_completed' => $isCompleted,
                    ],
                    'enrollment' => [
                        'education_stage_id' => $stage->id,
                        'school_class_id' => $class->id,
                        'academic_year_id' => $year->id,
                        'semester_id' => $semester->id,
                        'is_passed' => false,
                        'total_score' => 0,
                        'is_default' => true,
                    ]
                ];
            }
        }

        if (!$this->isValidationOnly && empty($this->validationErrors)) {
            DB::transaction(function () {
                foreach ($this->parsedStudents as $data) {
                    $student = Student::create($data['student']);
                    $student->enrollments()->create($data['enrollment']);
                }
            });
        }
    }

    public function getValidationSummary(): array
    {
        return [
            'valid_count' => $this->validRowsCount,
            'invalid_count' => count($this->validationErrors),
            'errors' => $this->validationErrors,
        ];
    }
}

