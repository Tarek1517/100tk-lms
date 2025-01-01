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
        Schema::create('student_exam_answers', function (Blueprint $table) {
            $table->id();
			 $table->foreignId('student_exam_attempt_id')->constrained('student_exam_attempts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('selected_option_id')->constrained('question_options')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('is_correct')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_answers');
    }
};
