<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class DbModelEloquentController extends Controller
{
    public function cloneIntro()
    {
        $employeeArr1 = Employee::query();
        $employeeMaleBefore = $employeeArr1->where('gender', 0)->get();
        $employeeFemaleBefore = $employeeArr1->where('gender', 1)->get();
        dump('Before', $employeeMaleBefore, $employeeFemaleBefore);

        $employeeArr2 = Employee::query();
        $employeeMaleAfter = $employeeArr2->clone()->where('gender', 0)->get();
        $employeeFemaleAfter = $employeeArr2->clone()->where('gender', 1)->get();
//        $employeeMaleBefore = (clone $employeeArr2)->where('gender', 'M')->get();
//        $employeeFemaleBefore = (clone $employeeArr2)->where('gender', 'F')->get();
        dump('After', $employeeMaleAfter, $employeeFemaleAfter);
    }
    public function mergeCollectionIntro()
    {
        dd(Employee::all());
    }
}
