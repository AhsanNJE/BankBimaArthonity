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
        Schema::create('employee__infos', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->string('emp_name');
            $table->string('emp_email')->unique();
            $table->string('emp_phone')->unique();
            $table->unsignedBigInteger('loc_id')->nullable();
            $table->string('emp_type');
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->date('dob');
            $table->string('address');
            $table->string('image');
            $table->tinyInteger('status')->default('0')->comment('1 for Active 0 for Inactive');
            $table->foreign('loc_id')->references('id')->on('location__infos')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreign('dept_id')->references('id')->on('department__infos')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreign('designation_id')->references('id')->on('designations')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee__infos');
    }
};
