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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('sidebar_active_bg')->default('#EFE7DF');
            $table->string('sidebar_hover_bg')->default('#F5EFEA');
            $table->string('sidebar_active_text')->default('#6B4C2B');
            $table->string('table_header_bg')->default('#f9f6f2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
