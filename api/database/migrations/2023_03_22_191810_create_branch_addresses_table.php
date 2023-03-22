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
        Schema::create('branch_addresses', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('branch_id')->references('id')->on('branches');
            $table->string('address');
            $table->string('complement')->nullable();
            $table->string('zip_code');
            $table->string('district');
            $table->string('city');
            $table->string('state');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branch_addresses', function(Blueprint $table) {
            $table->dropForeign(['branch_id']);
        });

        Schema::dropIfExists('branch_addresses');
    }
};
