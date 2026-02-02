<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->string('room_number', 20)->unique();

            $table->foreignId('room_type_id')
                ->constrained('room_types')
                ->cascadeOnDelete();

            $table->decimal('base_price', 10, 2);

            $table->decimal('weekend_price', 10, 2)->nullable();
            $table->decimal('seasonal_price', 10, 2)->nullable();

            $table->boolean('use_weekend_price')->default(false);
            $table->boolean('use_seasonal_price')->default(false);

            $table->unsignedTinyInteger('capacity')->default(1);

            $table->enum('status', [
                'available',
                'occupied',
                'out_of_order'
            ])->default('available');

            $table->unsignedTinyInteger('floor_number');

            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
