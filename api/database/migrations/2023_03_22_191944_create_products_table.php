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
            $table->uuid('id');
            $table->foreignUuid('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('promotional_price', 8, 2)->nullable();
            $table->enum('type', ['PRODUCT', 'PARAMETER_WITH_PRICE', 'PARAMETER_WITHOUT_PRICE']);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('products');
    }
};
