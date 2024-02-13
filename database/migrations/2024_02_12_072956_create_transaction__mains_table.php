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
        Schema::create('transaction__mains', function (Blueprint $table) {
            $table->id();
            $table->string('tran_id');
            $table->string('invoice');
            $table->unsignedBigInteger('loc_id')->nullable();
            $table->string('tran_type');
            $table->float('receive')->nullabel();
            $table->float('payment')->nullable();
            $table->float('discount')->default('0');
            $table->float('net_receive')->nullable();
            $table->float('net_payment')->nullable();
            $table->foreign('loc_id')->references('id')->on('location__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamp('tran_date')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction__mains');
    }
};
