<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'key')->unique();
            $table->string(column: 'name')->unique();
            $table->string(column: 'city_code');
            $table->foreignId(column: 'state_id')->index()->nullable()->constrained(table: 'states')->nullOnDelete();
            $table->boolean(column: 'active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
