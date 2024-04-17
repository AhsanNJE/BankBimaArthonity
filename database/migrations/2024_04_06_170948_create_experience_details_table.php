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
        Schema::create('experience_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('company_name');
            $table->string('designation');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('department');
            $table->string('company_location');
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
        Schema::dropIfExists('experience_details');
    }
};
