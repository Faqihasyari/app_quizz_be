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
        Schema::create('daily_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // "Tugas Harian"
            $table->string('description')->nullable(); // misal "Jawab 14 soal benar hari ini"
            $table->integer('target')->default(14); // target harian
            $table->integer('reward_points')->default(1000);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_tasks');
    }
};
