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
            $table->unsignedBigInteger('tran_type');
            $table->string('tran_method');
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('loc_id')->nullable();
            $table->unsignedBigInteger('tran_type_with')->nullable();
            $table->string('tran_user')->nullable();
            $table->unsignedBigInteger('tran_groupe_id')->nullable();
            $table->unsignedBigInteger('tran_head_id')->nullable();
            $table->double('quantity')->default(1);
            $table->double('quantity_issue')->default(0);
            $table->double('amount')->nullable();
            $table->double('tot_amount')->nullable();
            $table->double('mrp')->nullable();
            $table->double('unit_id')->nullable();
            $table->date('expiry_date')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->string('batch_id')->nullable();
            $table->timestamp('tran_date')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            
            // Foreignkey Decleration
            $table->foreign('tran_type')->references('id')->on('transaction__types')
                    ->onUpdate('cascade');
            $table->foreign('loc_id')->references('id')->on('location__infos')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->foreign('tran_type_with')->references('id')->on('transaction__withs')
                    ->onUpdate('cascade');
            $table->foreign('tran_groupe_id')->references('id')->on('transaction__groupes')
                    ->onUpdate('cascade');
            $table->foreign('tran_head_id')->references('id')->on('transaction__heads')
                    ->onUpdate('cascade');
            $table->foreign('tran_user')->references('user_id')->on('user__infos')
                    ->onUpdate('cascade');
            $table->foreign('store_id')->references('id')->on('stores')
                    ->onUpdate('cascade');
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
