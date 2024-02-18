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

//        $employeeArr2 = Employee::query();
//        $employeeMaleAfter = $employeeArr2->clone()->where('gender', 0)->get();
//        $employeeFemaleAfter = $employeeArr2->clone()->where('gender', 1)->get();
////        $employeeMaleBefore = (clone $employeeArr2)->where('gender', 'M')->get();
////        $employeeFemaleBefore = (clone $employeeArr2)->where('gender', 'F')->get();
////        $employees = Employee::all()->clone(); Can not call clone
//        dump('After', $employeeMaleAfter, $employeeFemaleAfter);
    }
    public function mergeCollectionIntro()
    {
        $employees = Employee::all();
        $users = User::all();
        dump("User model", $users, "Employee model", $employees);
        dump("Merge", $users->merge($employees));
//        dump("Merge not remove duplicate, basic merge", $employees->toBase()->merge($employees));
    }

    public function loadDataFaster()
    {
        $start = microtime(true);

        // instead of using whereIn
        dump(Employee::whereIn('id', range(1, 50000))->get());
        // use WhereIntegerInRaw method for faster loading
//        dump(Employee::whereIntegerInRaw('id', range(1, 50000))->get());

        $end = microtime(true);
        $executionTime = ($end - $start) * 1000;
        echo "Eloquent Query Execution Time: {$executionTime} ms";
    }

    public function scope()
    {
        dd(Employee::birthDateFilter('2000-01-01')->male()->get()->take(10));
    }

    public function hideColumn()
    {
        $data = Employee::all()->take(1)->makeHidden(['gender', 'first_name']);
        dd(response()->json($data));
    }

    public function copyModel()
    {
        $employee = Employee::create([
            'birth_date' => '2000-01-01',
            'first_name' => 'A',
            'last_name' => 'Nguyen',
            'gender' => true
        ]);
        // logic ....

        $employeeCopied = $employee->replicate()->fill([
           'gender' => false
        ]);

        $employeeCopied->save();
        return 'ok';
    }

    public function reduceMem()
    {
        $startMemory = memory_get_usage();

        $employee = Employee::all();
//        $employee = Employee::toBase()->get();
        dump($employee);

        $endMemory = memory_get_usage();
        $memoryUsed = $endMemory - $startMemory;

        $memoryUsedInMB = round($memoryUsed / 1024 / 1024, 2); // Convert bytes to megabytes with two decimal places

        dd("Memory used: " . $memoryUsedInMB . " MB");
    }
}
