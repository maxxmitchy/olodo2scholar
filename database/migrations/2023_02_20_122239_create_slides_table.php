<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();

            $table->string(column: 'key')->unique();
            $table->string(column: 'title')->nullable();
            $table->longText(column: 'body')->nullable();
            $table->string('image')->nullable();

            $table->foreignId(column: 'summary_id')->index()->nullable()->constrained(table: 'summaries');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('slides');
    }
};
