<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'key')->unique();

            $table->longText(column:  'content');
            $table->longText(column: 'explanation')->nullable();

            $table->integer(column: 'questionable_id');
            $table->string(column: 'questionable_type');
            $table->unsignedBigInteger(column: 'question_type_id'); //mcq, multiselect and textarea

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
