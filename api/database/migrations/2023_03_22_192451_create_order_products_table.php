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
        Schema::create('order_products', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('order_id')->references('id')->on('orders');
            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->json('parameters')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_products', function(Blueprint $table) {
            $table->dropForeign(['order_id', 'product_id']);
        });

        Schema::dropIfExists('order_products');
    }
};
