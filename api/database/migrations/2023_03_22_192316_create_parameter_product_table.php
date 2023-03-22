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
            $table->uuid('id');
            $table->foreignUuid('parameter_id')->references('id')->on('parameters');
            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parameter_product', function(Blueprint $table) {
            $table->dropForeign(['parameter_id', 'product_id']);
        });

        Schema::dropIfExists('parameter_product');
    }
};
