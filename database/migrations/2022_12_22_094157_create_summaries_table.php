<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();

            $table->string(column: 'key')->unique();
            $table->string(column: 'title');
            $table->longText(column: 'body');

            $table->foreignId(column: 'topic_id')->index()->nullable()->constrained(table: 'topics');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('summaries');
    }
};
