<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class CustomHelper
{
    public function generateRandomData()
    {
        Company::factory(10)->create();
        Student::factory(10)->create();
        Lecturer::factory(5)->create();

        $students = Student::all();

        foreach ($students as $student) {
            User::create([
                'name' => $student->name,
                'email' => $student->email,
                'password' => bcrypt($student->registration_number),
                'level' => 'mahasiswa',
                'is_active' => true
            ]);
        }

        $lecturers = Lecturer::all();

        foreach ($lecturers as $lecturer) {
            User::create([
                'name' => $lecturer->name,
                'email' => $lecturer->email,
                'password' => bcrypt($lecturer->lecturer_id_number),
                'level' => 'dosen',
                'is_active' => true
            ]);
        }
    }
}
