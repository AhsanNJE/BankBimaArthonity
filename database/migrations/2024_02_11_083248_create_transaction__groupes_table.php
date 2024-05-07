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
        Schema::create('transaction__groupes', function (Blueprint $table) {
            $table->id();
            $table->string('tran_groupe_name');
            $table->unsignedBigInteger('tran_groupe_type');
            $table->string('tran_method');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // Foreignkey Decleration
            $table->foreign('tran_groupe_type')->references('id')->on('transaction__types')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction__groupes');
    }
};
