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
        Schema::create('dept_emp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_no');
            $table->unsignedBigInteger('dept_no');
            $table->timestamps();

            $table->foreign('emp_no')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('dept_no')->references('id')->on('departments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dept_emp');
    }
};
