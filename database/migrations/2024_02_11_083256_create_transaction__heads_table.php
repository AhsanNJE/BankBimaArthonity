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
            $table->unsignedBigInteger('groupe_id')->nullabe();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('manufacture_id')->nullable();
            $table->unsignedBigInteger('item_form_id')->nullable();
            $table->unsignedBigInteger('item_unite_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->double('quantity')->default(0);
            $table->double('cost_price')->default(0);
            $table->double('mrp')->default(0);
            $table->date('expired_date')->nullable();
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // Foreignkey Decleration
            $table->foreign('groupe_id')->references('id')->on('transaction__groupes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category__names')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('manufacture_id')->references('id')->on('manufacturer__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('item_form_id')->references('id')->on('item__forms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('item_unite_id')->references('id')->on('item__units')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')
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
