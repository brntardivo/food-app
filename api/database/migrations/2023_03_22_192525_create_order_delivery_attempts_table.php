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
        Schema::create('order_delivery_attempts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('attempt');
            $table->enum('status', ['DELIVERED','NO_RECEIVED','ADDRESS_NOT_FOUND']);
            $table->foreignUuid('order_id')->references('id')->on('orders');
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->text('observation');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_delivery_attempts', function(Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('order_delivery_attempts');
    }
};
