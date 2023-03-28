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
        Schema::create('parameter_product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('product_parameter_id')->references('id')->on('product_parameters');
            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parameter_product', function (Blueprint $table) {
            $table->dropForeign(['product_parameter_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('parameter_product');
    }
};
