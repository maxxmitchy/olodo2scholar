<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flashcard_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flashcard_id');
            $table->unsignedBigInteger('user_id');
            $table->date('next_review');
            $table->timestamps();

            $table->foreign('flashcard_id')->references('id')->on('flashcards')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('flashcard_reviews');
    }
};