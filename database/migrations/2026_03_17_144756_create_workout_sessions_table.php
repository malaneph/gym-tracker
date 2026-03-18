<?php

use App\Enums\WorkoutStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user')->constrained('users');
            $table->foreignUuid('workout_plan')->constrained('workout_plans');
            $table->timestamp('started_at')->default(now());
            $table->timestamp('finished_at')->nullable();
            $table->text('notes')->nullable();
            $table->integer('status')->default(WorkoutStatus::DRAFT->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_sessions');
    }
};
