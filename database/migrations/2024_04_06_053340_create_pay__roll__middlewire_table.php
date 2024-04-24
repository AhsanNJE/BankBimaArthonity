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
        Schema::create('pay__roll__middlewires', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->unsignedBigInteger('head_id');
            $table->float('amount');
            $table->date('date')->nullable();
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            //Foreignkey Decleration
            $table->foreign('emp_id')->references('user_id')->on('user__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('head_id')->references('id')->on('transaction__heads')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay__roll__middlewires');
    }
};
