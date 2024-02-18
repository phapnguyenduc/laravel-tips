<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['birth_date', 'first_name', 'last_name', 'gender'];

    public function scopeMale($query) {
        return $query->where('gender', 1);
    }

    public function scopeBirthDateFilter($query, $date) {
        return $query->where('birth_date', '<=', $date);
    }
}
