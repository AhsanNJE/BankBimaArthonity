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
        Schema::create('pay__roll__setups', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->unsignedBigInteger('head_id');
            $table->float('amount');
            $table->date('date')->nullable();
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('emp_id')->references('user_id')->on('user__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay__roll__setups');
    }
};
