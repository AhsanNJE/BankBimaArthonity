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
        Schema::create('transaction__with__groupes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('with_id');
            $table->unsignedBigInteger('groupe_id');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('with_id')->references('id')->on('transaction__withs')
                    ->onUpdate('cascade');
            $table->foreign('groupe_id')->references('id')->on('transaction__groupes')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction__with__groupes');
    }
};
