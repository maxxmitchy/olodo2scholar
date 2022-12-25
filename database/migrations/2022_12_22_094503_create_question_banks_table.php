<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id();

            $table->string(column: 'key')->unique();
            $table->string(column: 'title')->unique();
            $table->text(column: 'description');

            $table->boolean(column: 'active')->default(false);
            $table->integer(column: 'time_per_question')->default(15);

            $table->foreignId(column: 'user_id')->constrained();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_banks');
    }
};
