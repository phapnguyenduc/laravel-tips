<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentEmployee extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all()->take(100);
        $departments = Department::all()->take(10);
        foreach ($employees as $employee) {
            $departmentId = $departments->random();
            \App\Models\DepartmentEmployee::create([
                'emp_no' => $employee->id,
                'dept_no' => $departmentId->id
            ]);
        }
    }
}
