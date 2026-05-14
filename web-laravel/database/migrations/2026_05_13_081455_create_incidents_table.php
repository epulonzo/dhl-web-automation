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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('category')->index(); // Late Delivery, Damaged Parcel, etc.
            $table->string('priority')->index(); // Low, Medium, High, Critical
            $table->string('status')->default('New')->index(); // New, Assigned, In Progress, Resolved, Closed
            $table->string('tracking_number')->nullable()->index();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
