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
        Schema::create('coupoms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->boolean('enabled');
            $table->integer('quantity');
            $table->enum('type', ['PERCENTAGE', 'VALUE']);
            $table->decimal('price', 8, 2);
            $table->integer('percentage');
            $table->datetime('available_in');
            $table->datetime('expires_in')->nullable();
            $table->foreignUuid('user_id')->references('id')->on('users');
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
        Schema::table('coupoms', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('coupoms');
    }
};
