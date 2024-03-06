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
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('loc_id')->nullable();
            $table->string('tran_type');
            $table->float('balance_amount')->nullable();
            $table->float('discount')->default('0');
            $table->float('net_amount')->nullable();
            $table->float('receive')->nullable();
            $table->float('payment')->nullable();
            $table->float('due')->nullable();
            $table->string('tran_type_with')->nullable();
            $table->string('tran_user')->nullable();
            $table->float('due_col')->default(0)->nullable();
            $table->float('due_disc')->default(0)->nullable();
            $table->foreign('loc_id')->references('id')->on('location__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('tran_user')->references('user_id')->on('user__infos')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
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
