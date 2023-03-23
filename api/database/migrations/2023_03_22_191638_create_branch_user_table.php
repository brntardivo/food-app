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
        Schema::create('branch_user', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('role_id')->references('id')->on('roles');
            $table->foreignUuid('branch_id')->references('id')->on('branches');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branch_user', function(Blueprint $table) {
            $table->dropForeign(['role_id', 'branch_id']);
        });

        Schema::dropIfExists('branch_user');
    }
};
