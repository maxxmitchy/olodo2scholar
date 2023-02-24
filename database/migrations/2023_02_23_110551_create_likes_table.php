<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('likeable_id');
            
            $table->string('likeable_type');

            $table->foreignId(column: 'user_id')->index()->nullable()->constrained(table: 'users');

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('likes');
    }
};
