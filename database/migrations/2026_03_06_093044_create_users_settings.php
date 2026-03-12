<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users_settings', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('user')->constrained('users');
            $table->string('language');
            $table->string('timezone');
            $table->string('units_system');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_settings');
    }
};
