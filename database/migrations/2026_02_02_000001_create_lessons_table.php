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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index(); // teacher ID
            $table->date('date');
            $table->time('start_time'); // 14:00, 14:30, etc.
            $table->string('student_name')->nullable();
            $table->string('age')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_fixed_student')->default(false);
            $table->timestamps();

            // Ensure one lesson per time slot per day per teacher
            $table->unique(['user_id', 'date', 'start_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
