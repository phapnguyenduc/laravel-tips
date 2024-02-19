<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Post;
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
            'first_name' => 'abcd',
            'last_name' => 'Nguyen',
            'gender' => true
        ]);
        // logic ....

        $employeeCopied = $employee->replicate()->fill([
           'gender' => false
        ]);

        // more infor:  replicate([except column in here])

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

    public function sole()
    {
        dd(Employee::query()->where('id', 1)->sole());
//        dd(Employee::query()->where('gender', true)->sole());
    }

    public function withAggregateEx()
    {
        // Instead of eager loading all users...
        $posts = Post::with('user')->get();
//        $posts = Post::with('user:name,email')->get(); // Cannot get user model, do not have user id
//        $posts = Post::with('user:id,name,email')->get();

        // You can add a subselect to only retrieve the user's name...
//        $posts = Post::withAggregate('user', 'name');
//        $posts = Post::withAggregate([
//            'user as user_name' => function ($query) {
//                // calculate sum/count... logic here
//                $query->select('name');
//            },
//            'user as user_email' => function ($query) {
//                // calculate sum/count... logic here
//                $query->select('email');
//            }
//        ], null)->dd();

        // This will add a 'user_name' attribute to the Post instance:
        dd($posts->first());
    }

    public function multipleUpsert()
    {
        Employee::upsert(
            [
                [
                    'birth_date' => '2003-06-21',
                    'first_name' => 'Jane test',
                    'last_name' => 'Schaefer',
                    'gender' => true
                ],
                [
                    'birth_date' => '2000-01-02',
                    'first_name' => 'D',
                    'last_name' => 'Nguyen',
                    'gender' => true
                ]
            ], ['first_name', 'last_name', 'gender'], ['birth_date']
        );
    }

    public function retrieveQueryBuilder()
    {
        $employee = Employee::where('gender', true)->limit(20)->get();

        // [1,2,3,4,5,6,7,8,9,10, 11] => [1, 4, 7, 10]
        $nthEmployee = $employee->nth(3); // return first item and 3th items ...
        $nthEmployee->update(['gender' => false]); // can't do this on the collection
//        $nthEmployee->toQuery()->update(['gender' => false]);

//        $employee = Employee::whereIn('id', range(1, 10));
//        $employee->update(['gender' => true]);
    }

    public function customCast()
    {
        Employee::create([
            'birth_date' => '2005-10-10',
            'first_name' => 'merry',
            'last_name' => 'Nguyen',
            'gender' => true
        ]);
        return 'ok';
    }

    public function humanDate()
    {
        $post = Post::whereId(1)->first();
        $result = $post->created_at->diffForHumans();
        return $result;
    }

    public function checkRecentlyCreated()
    {
        $user = User::create([
            'name' => 'Oussama',
            'email' => 'oussama@gmail.com',
            'password' => '123123123'
        ]);

        // return boolean
        return $user->wasRecentlyCreated;

        // true for recently created
        // false for found (already on you db)
    }
}
