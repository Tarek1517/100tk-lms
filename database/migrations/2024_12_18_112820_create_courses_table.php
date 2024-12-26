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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('course_categories')->onDelete('cascade');
            $table->string('title')->unique()->index();
            $table->string('slug')->index();
            $table->string('cover_image');
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->double('price')->default(0);
            $table->enum('is_active', ['true', 'false'])->default('true');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
