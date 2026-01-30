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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price', 100);
            $table->string('image')->nullable();
            $table->enum('category', ['suv', 'sedan', 'hatchback', 'electric', 'luxury']);
            $table->string('tag', 50)->nullable();
            $table->boolean('is_upcoming')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->enum('listing_type', ['most_seen', 'electric', 'upcoming', 'used']);
            $table->json('specs')->nullable();
            $table->integer('year')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
