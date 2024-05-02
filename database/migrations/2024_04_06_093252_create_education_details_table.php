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
            $table->string('group')->nullable();
            $table->string('institution_name');
            $table->string('result')->nullable();
            $table->decimal('scale')->nullable();
            $table->decimal('cgpa')->nullable();
            $table->integer('batch')->nullable();
            $table->integer('passing_year');
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inactive');
            $table->foreign('emp_id')->references('employee_id')->on('personal_details')
                     ->cascadeOnUpdate()
                     ->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
