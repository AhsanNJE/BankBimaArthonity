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
        Schema::create('organization_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->date('joining_date');
            $table->string('joining_location');
            $table->unsignedBigInteger('department');
            $table->unsignedBigInteger('designation');
            $table->timestamps();

            $table->foreign('emp_id')->references('user_id')->on('user__infos')
                     ->cascadeOnUpdate()
                     ->cascadeOnDelete();
            $table->foreign('joining_location')->references('id')->on('location__infos')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreign('department')->references('id')->on('department__infos')
                     ->cascadeOnUpdate()
                     ->cascadeOnDelete();
             $table->foreign('designation')->references('id')->on('designations')
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
