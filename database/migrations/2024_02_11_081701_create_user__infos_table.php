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
        Schema::create('user__infos', function (Blueprint $table) {
                $table->id();
                $table->string('user_id')->unique();
                $table->string('user_name')->nullable();
                $table->string('user_email')->unique()->nullable();
                $table->string('user_phone')->unique()->nullable();
                $table->string('gender')->nullable();
                $table->unsignedBigInteger('loc_id')->nullable();
                $table->string('user_type');
                $table->unsignedBigInteger('tran_user_type')->nullable();
                $table->unsignedBigInteger('dept_id')->nullable();
                $table->unsignedBigInteger('designation_id')->nullable();
                $table->date('dob')->nullable();
                $table->string('nid')->nullable();
                $table->string('address')->nullable();
                $table->string('image')->nullable();
                $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inactive');
                
                // Foreignkey Decleration 
                $table->foreign('loc_id')->references('id')->on('location__infos')
                        ->onUpdate('cascade')
                        ->onDelete('set null');
                $table->foreign('dept_id')->references('id')->on('department__infos')
                        ->onUpdate('cascade');
                $table->foreign('designation_id')->references('id')->on('designations')
                        ->onUpdate('cascade');
                $table->foreign('tran_user_type')->references('id')->on('transaction__withs')
                        ->onUpdate('cascade');

                $table->timestamp('added_at')->useCurrent();
                $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user__infos');
    }
};
