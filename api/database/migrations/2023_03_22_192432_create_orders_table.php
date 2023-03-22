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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('slug')->unique();
            $table->foreignUuid('branch_id')->references('id')->on('branches');
            $table->foreignUuid('customer_id')->references('id')->on('customers');
            $table->enum('overall_status', ['WAITING_ACCEPT','PREPARING','READY_FOR_DELIVERY','DELIVERED','CANCELLED']);
            $table->boolean('paid');
            $table->enum('payment_type', ['MANUAL', 'ONLINE']);
            $table->enum('delivery_type', ['TAKE_AWAY', 'DELIVERY']);
            $table->foreignUuid('coupon_id')->nullable()->references('id')->on('coupon');
            $table->decimal('total_price', 8, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign(['customer_id', 'coupon_id', 'branch_id']);
        });

        Schema::dropIfExists('orders');
    }
};
