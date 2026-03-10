<?php

use App\Enums\WorkoutPlanStatusEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workout_plans', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->foreignIdFor(User::class, 'user');
            $table->string('name');
            $table->string('category');
            $table->integer('is_default')->default(0);
            $table->integer('status')->default(WorkoutPlanStatusEnum::DRAFT->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_plans');
    }
};
