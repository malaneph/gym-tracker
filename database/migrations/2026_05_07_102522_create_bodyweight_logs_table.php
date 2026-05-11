<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('bodyweight_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignUuid('user')->constrained('users');
            $table->decimal('weight');
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bodyweight_logs');
    }
};
