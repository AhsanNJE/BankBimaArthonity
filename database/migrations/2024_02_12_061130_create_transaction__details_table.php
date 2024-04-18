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
        Schema::create('transaction__details', function (Blueprint $table) {
            $table->id();
            $table->string('tran_id');
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('loc_id')->nullable();
            $table->string('tran_type');
            $table->unsignedBigInteger('tran_type_with')->nullable();
            $table->string('tran_user')->nullable();
            $table->unsignedBigInteger('tran_groupe_id')->nullable();
            $table->unsignedBigInteger('tran_head_id')->nullable();
            $table->float('quantity')->nullable();
            $table->float('amount')->nullable();
            $table->float('tot_amount')->nullable();
            $table->foreign('loc_id')->references('id')->on('location__infos')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->foreign('tran_type_with')->references('id')->on('transaction__withs')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->foreign('tran_groupe_id')->references('id')->on('transaction__groupes')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->foreign('tran_head_id')->references('id')->on('transaction__heads')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
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
        Schema::dropIfExists('transaction__details');
    }
};
