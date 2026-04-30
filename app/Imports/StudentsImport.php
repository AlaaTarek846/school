<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\SchoolClass;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class StudentsImport implements ToCollection, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {

                if (!$row['name'] && !$row['email']) {
                    return null; // تجاهل الصف
                }

                $student = Student::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'code' => $row['code'],
                    'gender' => strtolower($row['gender']) == 'female' ? 'female' : 'male',
                    'phone_1' => (string) $row['phone_1'],
                    'phone_2' => (string) $row['phone_2'],
                    'is_active' => 1,
                    'password' => bcrypt('12345678'),
                ]);

            }
        });
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'code' => 'required|integer|unique:students,code',
            'gender' => 'required|in:male,female',
            'phone_1' => ['nullable','max:20', function ($attr, $value, $fail) {
                if (!is_string($value) && !is_numeric($value)) {
                    $fail('The '.$attr.' must be string or number');
                }
            }],
            'phone_2' => ['nullable','max:20', function ($attr, $value, $fail) {
                if (!is_string($value) && !is_numeric($value)) {
                    $fail('The '.$attr.' must be string or number');
                }
            }],
        ];
    }
}
