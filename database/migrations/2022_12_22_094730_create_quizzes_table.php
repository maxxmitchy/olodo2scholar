<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'key')->unique();
            $table->string(column: 'name');
            $table->boolean(column: 'active')->default(true);

            $table->foreignId(column: 'difficulty_id')->index()->nullable()->constrained(table: 'difficulties')->nullOnDelete();
            $table->foreignId(column: 'topic_id')->index()->nullable()->constrained(table: 'topics')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
