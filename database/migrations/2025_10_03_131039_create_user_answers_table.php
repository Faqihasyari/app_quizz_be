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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // user yang menjawab
            $table->unsignedBigInteger('question_id'); // pertanyaan
            $table->unsignedBigInteger('answer_id'); // jawaban yang dipilih
            $table->boolean('is_correct')->default(false); // benar/salah
            $table->timestamps();

             // relasi
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
             $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
