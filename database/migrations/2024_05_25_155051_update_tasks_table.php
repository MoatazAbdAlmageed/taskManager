<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('title')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->unsignedBigInteger('assigned_to_id')->nullable(false)->change();
            $table->unsignedBigInteger('assigned_by_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
