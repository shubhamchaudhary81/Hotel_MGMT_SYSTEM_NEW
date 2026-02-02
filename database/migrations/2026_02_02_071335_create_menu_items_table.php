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
        Schema::create('menu_items', function (Blueprint $table) {
             $table->id();
            $table->string('item_name')->unique();
            $table->text('item_description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('item_type');
            $table->string('category')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('menu_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
