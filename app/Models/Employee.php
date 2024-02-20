<?php

namespace App\Models;

use App\Casts\CapitalizeWordsCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Employee extends Model
{
    use HasFactory;

    // For update, create with multiple parameters
    protected $fillable = [
        'birth_date',
        'first_name',
        'last_name',
        'gender'
    ];

    protected $casts = [
        'first_name' => CapitalizeWordsCast::class
    ];

    protected static function boot()
    {
        parent::boot();

//        Employee::saving(function() {
//            dump('saving');
//        });
        Employee::creating(function($model) {
            dump('creating');
            $model->em_no = Employee::max('id') + 1;
        });
//        Employee::created(function() {
//            dump('created');
//        });
//        Employee::saved(function() {
//            dump('saved');
//        });
    }

    public function scopeMale($query) {
        return $query->where('gender', 1);
    }

    public function scopeBirthDateFilter($query, $date) {
        return $query->where('birth_date', '<=', $date);
    }

//    protected function lastName(): Attribute
//    {
//        return new Attribute(
//            get: fn ($value) => strtoupper($value),
//            set: fn ($value) => strtolower($value),
//        );
//    }
}
