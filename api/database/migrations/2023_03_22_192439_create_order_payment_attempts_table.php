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
        Schema::create('order_payment_attempts', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('order_id')->references('id')->on('orders');
            $table->foreignUuid('customer_payment_method_id')->references('id')->on('customer_payment_methods');
            $table->enum('status', ['PAID', 'ERROR', 'PENDING', 'AWAITING']);
            $table->integer('attempt');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_payment_attempts', function(Blueprint $table) {
            $table->dropForeign(['order_id', 'customer_payment_method_id']);
        });

        Schema::dropIfExists('order_payment_attempts');
    }
};
