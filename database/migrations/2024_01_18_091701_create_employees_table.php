<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('emp_no')->unique();
            $table->date('birth_date');
            $table->string('first_name', 14);
            $table->string('last_name', 16);
            $table->enum('gender', ['M', 'F']);
            $table->date('hire_date');
            $table->timestamps();
            $table->primary('emp_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
