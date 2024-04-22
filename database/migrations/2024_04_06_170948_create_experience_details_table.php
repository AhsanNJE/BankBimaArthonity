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
            $table->unsignedBigInteger('department');
            $table->unsignedBigInteger('company_location');
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inactive');
            $table->timestamps();
            $table->foreign('emp_id')->references('user_id')->on('user__infos')
                     ->cascadeOnUpdate()
                     ->cascadeOnDelete();
            $table->foreign('department')->references('id')->on('department__infos')
                     ->cascadeOnUpdate()
                     ->cascadeOnDelete();
            $table->foreign('company_location')->references('id')->on('location__infos')
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
