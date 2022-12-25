<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'key')->unique();
            $table->string(column: 'title');
            $table->longText(column: 'body');
            $table->longText(column: 'overview');

            $table->foreignId(column: 'course_id')->index()->constrained(table: 'courses')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('topics');
    }
};
