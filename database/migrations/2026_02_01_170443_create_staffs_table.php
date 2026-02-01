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
        Schema::create('staff', function (Blueprint $table) {
              $table->id();

            // Link to users (login)
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Department & Role
            $table->foreignId('department_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('role_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Staff details
            $table->string('phone', 20)->nullable();

            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            // Profile picture path
            $table->string('profile_image')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
