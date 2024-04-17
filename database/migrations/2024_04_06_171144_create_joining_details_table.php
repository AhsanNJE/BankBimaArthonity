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
        Schema::create('joining_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->date('joining_date');
            $table->string('joining_location');
            $table->string('department');
            $table->string('designation');
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
        Schema::dropIfExists('joining_details');
    }
};
