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
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->unsignedBigInteger('dept_id');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            //Foreignkey Decleration
            $table->foreign('dept_id')->references('id')->on('department__infos')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
