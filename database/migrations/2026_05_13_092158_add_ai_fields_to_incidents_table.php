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
        Schema::table('incidents', function (Blueprint $table) {
            $table->text('ai_summary')->nullable()->after('description');
            $table->string('ai_suggested_category')->nullable()->after('category');
            $table->string('ai_suggested_priority')->nullable()->after('priority');
            $table->json('ai_raw_response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dropColumn(['ai_summary', 'ai_suggested_category', 'ai_suggested_priority', 'ai_raw_response']);
        });
    }
};
