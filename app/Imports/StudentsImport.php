<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\SchoolClass;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class StudentsImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                $student = Student::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'code' => $row['code'],
                    'username' => $row['code'], // using code as username if missing
                    'gender' => strtolower($row['gender']) == 'female' ? 'female' : 'male',
                    'phone_1' => $row['phone_1'],
                    'phone_2' => $row['phone_2'],
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
            'email' => 'nullable|email|unique:students,email',
            'code' => 'required|integer|unique:students,code',
            'gender' => 'required|in:male,female,Male,Female',
            'phone_1' => 'nullable|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'is_active' => 'required',
        ];
    }
}
