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
        Schema::create('transaction__heads', function (Blueprint $table) {
            $table->id();
            $table->string('tran_head_name');
            $table->unsignedBigInteger('groupe_id');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // Foreignkey Decleration
            $table->foreign('groupe_id')->references('id')->on('transaction__groupes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction__heads');
    }
};
