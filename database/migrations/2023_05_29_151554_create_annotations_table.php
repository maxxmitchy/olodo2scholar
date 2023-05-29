<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('annotations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('body');
            $table->foreignId('user_id')->index()->constrained('users');
            $table->foreignId('slide_id')->index()->constrained('slides');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('annotations');
    }
};
