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
        Schema::create('personal_details', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('name');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('religion');
            $table->string('marital_status');
            $table->string('nationality');
            $table->string('nid_no');
            $table->string('phn_no');
            $table->string('blood_group');
            $table->string('email');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('tran_user_type')->nullable();
            $table->text('address')->nullable();
            $table->binary('image')->nullable();
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inactive');

            $table->foreign('location_id')->references('id')->on('location__infos')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreign('tran_user_type')->references('id')->on('transaction__withs')
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
        Schema::dropIfExists('personal_details');
    }
};
