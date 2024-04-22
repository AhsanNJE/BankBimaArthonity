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
        Schema::create('training_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('training_title');
            $table->string('country');
            $table->string('topic');
            $table->string('institution_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('training_year');
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inactive');
            $table->timestamps();
            $table->foreign('emp_id')->references('user_id')->on('user__infos')
                     ->cascadeOnUpdate()
                     ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_details');
    }
};
