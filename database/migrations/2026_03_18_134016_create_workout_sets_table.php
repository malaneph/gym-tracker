<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workout_sets', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('workout_session')->constrained('workout_sessions');
            $table->foreignUuid('workout_plan_exercise')->constrained('workout_plan_exercises');
            $table->integer('set_index');
            $table->integer('reps');
            $table->decimal('weight');
            $table->integer('rpe')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_sets');
    }
};
