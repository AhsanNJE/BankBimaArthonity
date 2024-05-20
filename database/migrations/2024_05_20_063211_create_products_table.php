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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_name');
            $table->unsignedBigInteger('manufacturer_name')->nullable();
            $table->unsignedBigInteger('category_name')->nullable();
            $table->double('quantity')->default('0');
            $table->double('cost_price')->default('0');
            $table->double('mrp')->default('0');
            $table->date('expiry_date')->nullable();
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('product_name')->references('id')->on('transaction__heads')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreign('manufacturer_name')->references('id')->on('manufacturer__infos')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreign('category_name')->references('id')->on('category__names')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
