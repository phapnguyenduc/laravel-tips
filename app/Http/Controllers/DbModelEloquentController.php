<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class DbModelEloquentController extends Controller
{
    public function index()
    {
        $employeeArr = Employee::query()->whereRaw('emp_no <= ?', 10010);
        $employeeMaleBefore = $employeeArr->where('gender', 'M')->get();
        $employeeFemaleBefore = $employeeArr->where('gender', 'F')->get();
        dump('Before', $employeeMaleBefore, $employeeFemaleBefore);

//        $employeeMaleAfter = $employeeArr->clone()->where('gender', 'M')->get();
//        $employeeFemaleAfter = $employeeArr->clone()->where('gender', 'F')->get();
//        $employeeMaleBefore = (clone $employeeArr)->where('gender', 'M')->get();
//        $employeeFemaleBefore = (clone $employeeArr)->where('gender', 'F')->get();
//        dump('After', $employeeMaleAfter, $employeeFemaleAfter);
    }
}
