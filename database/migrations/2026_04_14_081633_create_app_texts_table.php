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
        Schema::create('app_texts', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->enum('config_type', ['config_a', 'config_b', 'both'])->default('both');
            $table->text('value');
            $table->string('description')->nullable();
            $table->timestamps();
            
            $table->index(['config_type', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_texts');
    }
};
