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
        Schema::create('education_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('level_of_education');
            $table->string('degree_title');
            $table->string('group');
            $table->string('institution_name');
            $table->string('result');
            $table->decimal('scale');
            $table->decimal('cgpa');
            $table->integer('batch');
            $table->integer('passing_year');
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inactive');
            $table->timestamps();
            $table->foreign('emp_id')->references('employee_id')->on('personal_details')
                     ->cascadeOnUpdate()
                     ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_details');
    }
};
