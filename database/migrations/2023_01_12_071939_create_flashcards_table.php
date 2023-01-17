<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->string('concept');
            $table->string('definition');
            $table->string('image')->nullable();
            $table->foreignId(column: 'topic_id')->index()->nullable()->constrained(table: 'topics')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flashcards');
    }
};
