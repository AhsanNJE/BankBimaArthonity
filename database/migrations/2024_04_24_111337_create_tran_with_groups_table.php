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
        Schema::create('tran_with_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tran_with')->nullable();
            $table->unsignedBigInteger('id_tran_group')->nullable();

             // Foreignkey Decleration 
            $table->foreign('id_tran_with')->references('id')->on('transaction__withs')
            ->onUpdate('cascade');
            $table->foreign('id_tran_group')->references('id')->on('transaction__groupes')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tran_with_groups');
    }
};
