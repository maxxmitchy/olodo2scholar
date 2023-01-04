<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId(column: 'course_id')->index()->nullable()->constrained(table: 'courses')->nullOnDelete();
            $table->foreignId(column: 'user_id')->index()->nullable()->constrained(table: 'users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_user');
    }
};
