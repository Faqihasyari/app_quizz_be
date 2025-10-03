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
        Schema::create('user_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // siapa yang ikut quiz
            $table->unsignedBigInteger('quiz_id'); // quiz mana
            $table->integer('score')->default(0); // total skor
            $table->integer('correct_answers')->default(0); // jumlah benar
            $table->integer('wrong_answers')->default(0); // jumlah salah
            $table->timestamps();

             // relasi
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_scores');
    }
};
