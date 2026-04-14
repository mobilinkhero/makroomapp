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
        Schema::create('app_configs', function (Blueprint $table) {
            $table->id();
            $table->enum('config_type', ['config_a', 'config_b'])->unique();
            $table->string('version')->default('1.0.0');
            $table->string('app_title');
            $table->string('app_subtitle')->nullable();
            $table->string('search_placeholder');
            $table->string('search_hint')->nullable();
            $table->json('feature_flags')->nullable();
            $table->json('components')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_configs');
    }
};
