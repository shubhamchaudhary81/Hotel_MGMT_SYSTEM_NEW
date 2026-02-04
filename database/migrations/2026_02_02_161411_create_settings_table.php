<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('app_name')->nullable();
            $table->string('app_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Contact
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_address')->nullable();

            // Social
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();

            // Theme Colors
            $table->string('primary_color')->default('#6B4C2B');
            $table->string('primary_hover')->default('#5A3F20');
            $table->string('accent_color')->default('#2665CB');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
