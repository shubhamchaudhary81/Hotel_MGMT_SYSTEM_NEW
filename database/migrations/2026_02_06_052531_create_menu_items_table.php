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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('menu_categories')
                ->cascadeOnDelete();

            $table->string('item_name');
            $table->text('item_description')->nullable();

            $table->decimal('price', 10, 2);

            $table->boolean('is_available')->default(true)->index();
            $table->string('menu_image')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Optional: prevent duplicate item name inside same category
            $table->unique(['category_id', 'item_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
