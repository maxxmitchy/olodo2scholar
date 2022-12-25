<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'key')->unique();
            $table->string(column: 'country')->default('Nigeria');
            $table->string(column: 'addressLine1');
            $table->string(column: 'addressLine2');
            $table->foreignId(column: 'city_id')->index()->nullable()->constrained(table: 'cities')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
